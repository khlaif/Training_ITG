# Task 7 – Player Profile Images

## Overview

Task 7 enhances the Sport Club Management System by introducing profile image management for players.

Players can upload, replace, and remove their profile pictures through the My Profile page. Uploaded images are displayed on both the Player Dashboard and My Profile page. When a player does not have a profile image, the system displays a default avatar.

This feature uses Laravel's Storage system, Form Request validation, and Eloquent model events to manage image files securely and efficiently.

## Features

### 1. Profile Image Upload

- Players can upload their own profile images.
- Supported formats: JPG, JPEG, and PNG.
- Maximum file size: 2 MB.
- Only authenticated players can upload images.
- Uploaded files are stored using Laravel's public storage disk.

### 2. Replace Profile Image

- Players can replace their existing profile images.
- The new image is saved to storage.
- The previous image is automatically removed.
- The database is updated with the new image path.

### 3. Remove Profile Image

- Players can remove their existing profile images.
- The image file is deleted from storage.
- The `profile_image` database field is set to `NULL`.
- The default avatar is displayed automatically.

### 4. Display Profile Images

Profile images are displayed in:

- Player Dashboard
- My Profile page

If no image exists, the system displays a default avatar.

### 5. Automatic Image Cleanup

The application uses an Eloquent model event to remove a player's profile image when the player is deleted.

This cleanup applies to player deletion through both the web application and REST API when deletion is performed through the Eloquent model.

## Technologies Used

- Laravel 13
- PHP 8.4
- MySQL 8.4
- Laravel Storage
- Laravel Form Requests
- Eloquent Model Events
- Blade Templates
- HTML, CSS, and JavaScript
- Docker

## Database Changes

A new migration adds the following field to the `users` table:

| Column          | Type                   | Description                                            |
| --------------- | ---------------------- | ------------------------------------------------------ |
| `profile_image` | VARCHAR(255), nullable | Stores the relative path of the player's profile image |

Only the image path is stored in the database, not the image file itself.

Example:

```text
profile-images/example-image.jpg
```

Migration file:

```text
database/migrations/2026_10_26_190210_add_profile_image_to_users_table.php
```

## Storage Configuration

Uploaded profile images are stored in:

```text
storage/app/public/profile-images/
```

Laravel's public storage disk is used for file operations.

To make stored images accessible through the browser, run:

```bash
php artisan storage:link
```

This creates the following symbolic link:

```text
public/storage -> storage/app/public
```

Uploaded images are not stored directly inside the public directory.

The default avatar is a static application asset located at:

```text
public/images/default-avatar.svg
```

## Installation and Setup

After cloning the repository and configuring the Laravel application, complete the following steps.

### Step 1: Install Dependencies

```bash
composer install
```

### Step 2: Configure the Environment

Create the `.env` file from `.env.example` and configure the database connection.

Generate the application key:

```bash
php artisan key:generate
```

### Step 3: Start Docker

```bash
docker compose up -d
```

### Step 4: Run Migrations

```bash
php artisan migrate
```

This adds the `profile_image` field to the existing users table.

### Step 5: Create the Storage Link

```bash
php artisan storage:link
```

### Step 6: Start the Application

```bash
php artisan serve
```

Open the application in a browser and log in using a player account.

## Profile Image Routes

| Method | Route                   | Description                       | Access |
| ------ | ----------------------- | --------------------------------- | ------ |
| POST   | `/player/profile/image` | Upload or replace a profile image | Player |
| DELETE | `/player/profile/image` | Remove a profile image            | Player |

Both routes require authentication and the player role.

## Image Validation

Image uploads are validated using `UploadProfileImageRequest`.

| Validation Rule      | Description                                 |
| -------------------- | ------------------------------------------- |
| `required`           | An image must be selected                   |
| `image`              | The uploaded file must be an image          |
| `mimes:jpg,jpeg,png` | Only JPG, JPEG, and PNG formats are allowed |
| `max:2048`           | Maximum file size is 2 MB                   |

Invalid uploads are rejected with validation messages.

## Implementation Files

### Backend

```text
app/Http/Controllers/PlayerProfileImageController.php
app/Http/Requests/UploadProfileImageRequest.php
app/Models/User.php
routes/web.php
```

### Frontend

```text
resources/views/player/profile.blade.php
resources/views/dashboards/player.blade.php
resources/views/player/_styles.blade.php
public/images/default-avatar.svg
```

### Database

```text
database/migrations/2026_10_26_190210_add_profile_image_to_users_table.php
```

## Testing

The following test cases should be verified before submission:

| Test Case                             | Expected Result                             |
| ------------------------------------- | ------------------------------------------- |
| Upload a valid JPG image              | Image is uploaded and displayed             |
| Upload a valid PNG image              | Image is uploaded and displayed             |
| Replace an existing image             | New image replaces the old image            |
| Remove an existing image              | Image is deleted and default avatar appears |
| Open Player Dashboard                 | Current profile image is displayed          |
| Open My Profile                       | Current profile image is displayed          |
| Upload a PDF file                     | Validation error                            |
| Upload an image larger than 2 MB      | Validation error                            |
| Delete a player with a profile image  | Associated image is removed from storage    |
| Attempt image management as a trainer | Access is denied                            |

## Screenshots

Screenshots demonstrating the implemented functionality are included in:

```text
ScreenShot/Task7/
```

Required screenshots:

1. `01-upload-profile-image.png` – Successfully uploading a profile image.
2. `02-replace-profile-image.png` – Replacing an existing profile image.
3. `03-remove-profile-image.png` – Removing the current profile image.
4. `04-default-avatar.png` – Displaying the default avatar.

Additional screenshots may demonstrate image validation and the Player Dashboard.

## Security Considerations

- Profile image management is restricted to authenticated players.
- Players can manage only their own profile images.
- File types and sizes are validated on the server.
- Images are stored using Laravel's Storage facade.
- Only image paths are saved in the database.
- Existing images are deleted when replaced or removed.
- Profile images are cleaned up when player records are deleted through Eloquent model deletion events.

## Conclusion

Task 7 extends the Sport Club Management System with profile image management while preserving the existing authentication, player management, match management, and REST API functionality developed in previous tasks.

The implementation demonstrates Laravel file storage, image validation, database migrations, reusable controllers, and automatic file cleanup.

# Task 8 – Search, Filtering, Sorting & Pagination

## Overview

Task 8 enhances the Sport Club Management System by implementing search, filtering, sorting, and pagination for player and match management.

These features improve usability and performance by allowing trainers to find records efficiently without loading all players or matches at once.

## Features

### Player Management

- Search players by first name, last name, or email.
- Support partial text matching.
- Filter players by registration date.
- Sort players by first name or registration date.
- Support ascending and descending sorting.
- Display 10 players per page.
- Preserve search, filtering, and sorting parameters when navigating between pages.
- Display a message when no matching players are found.
- Provide a Clear Filters option.

### Match Management

- Search matches by match name or location.
- Support partial text matching.
- Filter matches by match date or location.
- Sort matches by match name or match date.
- Support ascending and descending sorting.
- Display 10 matches per page.
- Preserve selected search, filtering, and sorting parameters across pages.
- Display a message when no matching matches are found.
- Provide a Clear Filters option.

## Technical Implementation

The implementation uses Laravel Eloquent Query Builder with conditional `when()` clauses to construct dynamic database queries.

The following Laravel features are used:

- `where()` and `orWhere()` for searching.
- `whereDate()` for date filtering.
- `orderBy()` for sorting.
- `paginate(10)` for server-side pagination.
- `withQueryString()` to preserve selected filters across pages.
- `withCount('players')` to retrieve assigned player counts efficiently.
- Laravel request validation to restrict accepted sorting fields and directions.

## Pagination Information

The application displays:

- Current page number.
- Total number of pages.
- Total number of matching records.
- Previous and Next navigation controls.

Pagination maintains the current search and filter parameters.

## Updated Files

**Controllers**

- `app/Http/Controllers/PlayerController.php`
- `app/Http/Controllers/MatchController.php`

**Views**

- `resources/views/players/index.blade.php`
- `resources/views/matches/index.blade.php`
- `resources/views/matches/_styles.blade.php`

## Example URLs

Player search:

`/players?search=ali`

Player sorting:

`/players?sort=first_name&direction=asc`

Player registration date filter:

`/players?registration_date=2026-10-26`

Match search:

`/matches?search=football`

Match date filter:

`/matches?match_date=2026-11-15`

Match location filter:

`/matches?location=stadium`

Match sorting:

`/matches?sort=name&direction=desc`

Combined search and pagination:

`/matches?search=football&sort=match_date&direction=asc&page=2`

## Testing Checklist

- [ ] Search players by first name, last name, and email.
- [ ] Search matches by name and location.
- [ ] Filter players by registration date.
- [ ] Filter matches by match date and location.
- [ ] Sort players and matches in ascending and descending order.
- [ ] Verify pagination with more than 10 records.
- [ ] Verify search and filter values persist across pages.
- [ ] Verify Clear Filters functionality.
- [ ] Verify empty search results.
- [ ] Verify existing Edit, Delete, and Details functionality.
- [ ] Verify trainer-only access remains enforced.

## Screenshots

Screenshots are stored in `ScreenShot/Task8/` and demonstrate:

1. Player search.
2. Match search.
3. Filtering.
4. Sorting.
5. Pagination.
6. Empty search results.

## Authorization and Compatibility

The existing role-based authorization remains unchanged. Search, filtering, sorting, and pagination are available through the trainer management pages.

All previously implemented features, including player management, match management, REST APIs, and player profile images, are preserved.

## Conclusion

Task 8 improves the usability and scalability of the Sport Club Management System by introducing efficient, database-driven search, filtering, sorting, and pagination while maintaining the existing application design and functionality.
