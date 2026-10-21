# Laravel Student Management System

A practical Laravel application built to learn and implement real-world web development concepts. The project manages student records and courses, with search, sorting, pagination, CSV export, and bulk operations.

**Repository:** [Laravel2026](https://github.com/sanjeevrana01/Laravel2026)

## Features

### Student Management
- Create, view, edit, and delete student records.
- Store student name, email, age, and assigned course.
- Search students by name or email.
- Sort students alphabetically or by newest first.
- Paginate student records.
- Select multiple students and delete them in bulk.
- Select all students on the current page.
- Export student records to CSV, respecting search and sorting options.
- Basic CSV formula-injection protection for exported name and email values.

### Course Management
- Create and view courses.
- Store course names and optional descriptions.
- Assign courses to students.
- Change or remove a student's course assignment.
- Display each student's course in the student directory.
- View the number of students assigned to each course.
- Navigate between Students and Courses using the sidebar.

### User Interface
- Responsive layouts using Blade templates.
- Reusable application layout and navigation.
- Search and sorting controls.
- Form validation messages and success notifications.
- Styled forms, tables, and action buttons.

## Technology Stack

- **Backend:** PHP and Laravel
- **Database:** SQLite (current development configuration)
- **ORM:** Laravel Eloquent
- **Frontend:** Blade templates, HTML, CSS, and JavaScript
- **Version Control:** Git and GitHub

## Requirements

- PHP version compatible with the Laravel version installed in this project
- Composer
- Node.js and npm, if frontend assets require building
- SQLite, as configured for local development

## Installation

### 1. Clone the repository

```bash
git clone https://github.com/sanjeevrana01/Laravel2026.git
cd Laravel2026
```

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Configure the environment

```bash
cp .env.example .env
php artisan key:generate
```

Check your `.env` file and ensure the database settings match your local setup.

For SQLite, configure:

```env
DB_CONNECTION=sqlite
```

Ensure the SQLite database file exists at the path configured by your application. If necessary, create it:

```bash
touch database/database.sqlite
```

### 4. Run database migrations

```bash
php artisan migrate
```

### 5. Start the development server

```bash
php artisan serve
```

Open the application at:

http://127.0.0.1:8000

## Main Pages

| Page | URL | Purpose |
|---|---|---|
| Students | `/students` | Browse and manage students |
| Add Student | `/students/create` | Create a student record |
| Courses | `/courses` | View available courses |
| Add Course | `/courses/create` | Create a course |
| Export Students | `/students/export` | Download student data as CSV |

## Database Relationships

The project uses a one-to-many relationship between courses and students.

- A course can have many students.
- A student can belong to one course.
- A student can have no course assigned.

The relationship is implemented with Eloquent:

```php
// Student.php
public function course()
{
    return $this->belongsTo(Course::class);
}
```

```php
// Course.php
public function students()
{
    return $this->hasMany(Student::class);
}
```

The `course_id` column in the students table references the courses table and is nullable.

## Development and Learning Goals

This project is being developed incrementally to practise practical Laravel concepts, including:

- MVC architecture: routes, controllers, models, and Blade views.
- Eloquent ORM and database relationships.
- Request validation and mass assignment protection.
- Query filtering, sorting, and pagination.
- CSV generation and streamed downloads.
- Form handling and CSRF protection.
- Git commits, pushing changes, pulling updates, and conflict resolution.

## Future Improvements

Planned areas for further development include:

- Eloquent query optimization and the N+1 query problem.
- Form Request classes for reusable validation.
- Course editing and deletion.
- Automated feature tests.
- Authentication and authorization.
- Service classes and cleaner business logic organization.
- Production deployment and performance monitoring.

## Learning Approach
