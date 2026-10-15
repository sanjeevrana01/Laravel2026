# Laravel Student Management — UI Starter Pack

A polished, responsive Student Management project pack for your existing Laravel 13 project.

## What it includes
- Dashboard with student count and recent students
- Student list with search
- Create, edit, and delete students
- Laravel validation and CSRF protection
- Eloquent model usage
- Separate JSON API endpoints
- Responsive custom CSS; no frontend package installation required

## Important: this is an overlay pack
This ZIP contains the application files to copy into your existing Laravel project. It does **not** contain Laravel's vendor dependencies or a complete Laravel framework installation.

## Install into your existing `laravel-learning` project

1. Stop the development server with `Ctrl+C` if it is running.
2. Make a backup of these existing files before replacing them:
   - `routes/web.php`
   - `routes/api.php` (if it exists)
   - `app/Http/Controllers/StudentController.php`
   - `app/Models/Student.php`
3. Copy the folders from this ZIP into the root of your `laravel-learning` project, merging folders and allowing the included files to replace files with the same names.
4. Your existing `students` table should have these columns:
   - `id`
   - `name`
   - `email` (unique)
   - `age` (nullable)
   - `created_at`
   - `updated_at`

   You created this table earlier. **Do not run a second `create_students_table` migration** if it already exists.
5. If `routes/api.php` is missing, this pack includes it. API routing must be enabled in Laravel. If necessary, run `php artisan install:api` first; note this may generate/modify API setup files, so back up any existing API configuration.
6. Clear Laravel's cached route/config data and start the server:

   ```bash
   php artisan optimize:clear
   php artisan serve
   ```

7. Open http://127.0.0.1:8000

## Routes

### Web UI
- `/` — dashboard
- `/students` — searchable student list
- `/students/create` — create form
- `/students/{id}/edit` — edit form

### JSON API
- `GET /api/students`
- `POST /api/students`
- `GET /api/students/{id}`
- `PUT /api/students/{id}`
- `DELETE /api/students/{id}`

## Notes
- Web forms use Laravel CSRF protection.
- The API controller returns JSON and validates input.
- Search runs against name and email.
- The delete action permanently deletes a record from the local database.
- This is a learning/demo app, not a production-ready system. Add authentication/authorization before exposing it publicly.
