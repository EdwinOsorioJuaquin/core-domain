# Core package implementing Incadev's business domain

[![Latest Version on Packagist](https://img.shields.io/packagist/v/incadev-uns/core-domain.svg?style=flat-square)](https://packagist.org/packages/incadev-uns/core-domain)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/incadev-uns/core-domain/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/incadev-uns/core-domain/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/incadev-uns/core-domain/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/incadev-uns/core-domain/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/incadev-uns/core-domain.svg?style=flat-square)](https://packagist.org/packages/incadev-uns/core-domain)

This package provides the single source of truth for the Incadev business domain, modeling the shared database schema, and Eloquent models. It ensures all projects built on this platform share the same data structure.

## Requirements

- PHP ^8.2
- Laravel ^12.0

## Installation

Installing this package is a multi-step process. Please follow these instructions carefully.

### 1. Install the Package

First, install the incadev-uns/core-domain package via Composer:

```bash
composer require incadev-uns/core-domain:dev-main
```

### 2. Install Dependencies

This package relies on [Laravel Sanctum](https://laravel.com/docs/12.x/sanctum) and [Spatie's Laravel-Permission](https://spatie.be/docs/laravel-permission/v6/installation-laravel). You must install and configure them first.

Publish Sanctum's configuration and migration

```bash
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
```

Publish Spatie/Permission's configuration and migration

```bash
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
```

### 3. Run Core Migrations

This package will add all core domain tables and modify your existing users table.

You must run the migrations:

```bash
php artisan migrate
```

### 4. Configure Your User Model

This is the most critical step. Your `app/Models/User.php` model must be updated to use the traits and fields provided by this package and its dependencies.

#### A. Add Traits

Import and use the `HasIncadevCore`, `HasApiTokens`, and `HasRoles` traits.

```php
<?php

namespace App\Models;

// ...
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;                 // <-- 1. Import Laravel Sanctum
use Spatie\Permission\Traits\HasRoles;            // <-- 2. Import Spatie Permission
use IncadevUns\CoreDomain\Traits\HasIncadevCore;  // <-- 3. Import Incadev Core

class User extends Authenticatable
{
    use // ...
        HasApiTokens, HasRoles, HasIncadevCore;   // <-- 4. Use all traits

    // ...
```

#### B. Update `$fillable` Array

Our migration adds dni, fullname, avatar, and phone to your users table. You must add these to the $fillable array to allow mass assignment.

```php
protected $fillable = [
    'name',
    'email',
    'password',
    
    // --- Add these new fields ---
    'dni',
    'fullname',
    'avatar',
    'phone',
    // ----------------------------
];
```

### 5. Run the Core Seeder

Finally, run the package seeder to populate the database with essential data.

```bash
php artisan db:seed --class="IncadevUns\CoreDomain\Database\Seeders\IncadevSeeder"
```

## Usage

The primary purpose of this package is to provide a **centralized core domain** (Eloquent models and migrations) ready for immediate use. This ensures that all teams and applications within the organization share the same data structure and business logic, **preventing you from having to create your own models** for common concepts (like students, courses, enrollments, etc.).

### A. Using the Package Models

Instead of creating your own models (e.g., `App\Models\Enrollment`), you should import and use the models provided by this package directly in your controllers, services, and other components.

For example, if you need to manage student profiles or enrollments, you would do so in a controller like this:

```php
<?php

namespace App\Http\Controllers;

// 1. Import models directly from the package
use IncadevUns\CoreDomain\Models\StudentProfile;
use IncadevUns\CoreDomain\Models\Enrollment;
use Illuminate\Http\Request;

class SomeController extends Controller
{
    /**
     * Display the enrollments for a specific student.
     */
    public function showStudentEnrollments($profileId)
    {
        // 2. Use the package model to find the profile
        $student = StudentProfile::findOrFail($profileId);

        // 3. Access relationships defined in the package
        $enrollments = $student->enrollments()->where('status', 'active')->get();

        return view('some.view', compact('student', 'enrollments'));
    }

    /**
     * Create a new enrollment.
     */
    public function storeEnrollment(Request $request)
    {
        // 4. Use the package models to create new records
        $enrollment = Enrollment::create([
            'student_profile_id' => $request->student_id,
            'course_id' => $request->course_id,
            'status' => 'pending',
            // ... other fields
        ]);

        return redirect()->route('home')->with('success', 'Enrollment created.');
    }
}
```

### B. Accessing Relations from the User Model

As an added benefit, once you have configured the `HasIncadevCore` trait on your `App\Models\User model`, you can instantly access all this related data directly from the authenticated user:

```php
$user = Auth::user();

// Get user profiles
$studentProfile = $user->studentProfile;
$teacherProfile = $user->teacherProfile;

// Get academic data
$enrollments = $user->enrollments;
$certificates = $user->certificates;

// Get community data
$threads = $user->threads;
$comments = $user->comments;

// Get support data
$tickets = $user->tickets;

// Get HR data
$contracts = $user->contracts;
$applications = $user->applications;

// Get appointments
$apptsAsStudent = $user->appointmentsAsStudent;
$apptsAsTeacher = $user->appointmentsAsTeacher;
```

### C. Using Polymorphic Traits

This package provides powerful traits to add behavior to any model.

- `CanBeAudited`: Allows all actions on a model to be audited.
- `CanBeRated`: Allows a model to be rated using the core Survey system.
- `CanBeVoted`: Allows a model to be upvoted or downvoted.

## Testing

```bash
composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Jose Vasquez Ramos](https://github.com/josevasquezramos)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
