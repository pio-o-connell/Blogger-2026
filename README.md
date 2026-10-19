# Blogger

A revamp of a 2014 blogging platform, using the original project as a reference to restore its functionality and develop a simple, modern graphical user interface.

### PHP Front page
<img src="Images\login.jpg" alt="PHP Blog server running " width="40%">
<img src="Images\register.jpg" alt="PHP Blog server running " width="40%">
<img src="Images\Homepage.jpg" alt="PHP Blog server running " width="40%">

<img src="Images\2-Adminstrator-allblog.png" alt="PHP Blog server running " width="40%">>
<img src="Images\2-Administator-personalblogs.png" alt="PHP Blog server running " width="40%">
<img src="Images\AdminAllUsers.jpg" alt="PHP Blog server running " width="40%">

<img src="Images\2-Alice-Allblogs.png" alt="PHP Blog server running " width="40%">
<img src="Images\2-Alice-personalblogs.png" alt="PHP Blog server running " width="40%">

<img src="Images\Guest-add-comment.jpg" alt="PHP Blog server running " width="40%">


A simple PHP/MySQL blogging application developed as part of the **Higher Diploma in Cloud Computing, 2014**.

The project is an early web application demonstrating server-side PHP programming, MySQL database interaction, user registration and authentication, blog posts, comments, and basic administration.

## Project Overview

The Blogger application allows users to:

* Register as a blogger
* Log in and out
* Create blog posts
* View blog posts
* Comment on posts
* Delete their own blog posts
* Browse other bloggers
* Manage users and blogs through an administrator account
* Suspend users

The application uses a traditional PHP MVC-like structure, with a central controller routing requests to different view classes and a database manager handling MySQL operations.

## Architecture

The basic application flow is:

```text
Browser
   |
   v
controller.php
   |
   +-- command (GET/POST)
   |
   v
View classes
   |
   v
DBManager
   |
   v
MySQL database
```

The main components are:

### `controller.php`

The main entry point for the application.

It reads the `cmd` parameter from either `$_POST` or `$_GET` and uses a `switch` statement to determine what operation should be performed.

Examples include:

```text
login
register
loginRequest
registerBlogger
addPost
openblog
openblog1
addComment
delete1
deleteUser
Suspend
logout
```

### `library.php`

Contains the application's view classes and database manager.

The view classes use descriptive names:

* `PublicBaseView` – shared layout for public-facing pages
* `AuthenticatedBaseView` – shared layout for internal/authenticated pages
* `HomeView` – public welcome page and latest posts
* `LoginView` – login form
* `PreviousPostsView` – previous posts display
* `GuestPostView` – guest posting and alternative comment handling
* `RegistrationView` – registration form
* `CreatePostView` – authenticated post creation
* `BlogPostManagementView` – alternative post-management interface
* `DeleteBlogPostsView` – blog post selection and deletion
* `AdminDashboardView` – administrator blog and comment management
* `AdminBlogManagementView` – administrator blog management interface
* `SuspendUsersView` – user suspension and restoration
* `DeleteUsersView` – user deletion
* `SinglePostView` – individual blog post display

The file also contains the `DBManager` class, which performs database operations.

> **Note:** Despite the name `library.php`, the supplied project code contains both PHP application logic and HTML output. It is not a CSS library.

### DBManager naming refactor

The DBManager methods have been renamed to describe their responsibilities more
clearly. The implementation and database behaviour were intentionally
preserved. Each renamed declaration in the PHP source has a comment containing
its former function name to make the transition easy to follow.

| Former name | Current name |
| --- | --- |
| `processLogin()` | `authenticateUser()` |
| `getBlogindex()` | `getUserBlogDetails()` |
| `addBlogger()` | `registerBlogger()` |
| `getMostRecentPostId()` | `getLatestPostId()` |
| `retrieveAdminBlogPosts()` | `displayAdminBlogPosts()` |
| `retrieveallblogsanddisplay()` | `displayAllBlogPosts()` |
| `retrieveallblogsanddisplay1()` | `displayPostsForDeletion()` |
| `outerretrieveallblogsanddisplay()` | `displayBloggerLinks()` |
| `retrieveuserblogsanddisplay()` | `displayUserPostsForDeletion()` |
| `retrievebody()` | `displayPostBodyInTextarea()` |
| `getDetailsanddisplay()` | `buildPostBloggerDetails()` |
| `deleteBloogs()` | `deleteSelectedUserPosts()` |
| `deleteBloogs1()` | `deleteSelectedPosts()` |
| `retrieveallusersdisplay()` | `displayUsersForDeletion()` |
| `retrieveallusersdisplay1()` | `displayUsersForSuspension()` |
| `retrieveuserdetails()` | `displayUserDetails()` |
| `displayUsers()` | `displayUserCheckboxes()` |
| `deleteUsers()` | `deleteSelectedUsers()` |
| `SuspendUsers()` | `updateUserSuspensionStatus()` |
| `displayPreviousBlogs()` | `displayPreviousPosts()` |
| `displayPreviousBlogs1()` | `displayPreviousPostsWithAlternativeComments()` |
| `renderPreviousBlogs()` | `renderPreviousPostsWithComments()` |
| `deleteCommentsForPost()` | `deleteSelectedCommentsForPost()` |
| `processBlog()` | `createBlogPost()` |
| `processFirstBlog()` | `createInitialBlogPost()` |

The constructor and the already-clear `getPostById()` and
`getCommentsForPost()` methods retain their existing names.

### View class naming refactor

The numbered legacy view class names were replaced with descriptive names.
The implementation, routing commands, and MVC behaviour were preserved. Each
renamed class declaration in `library.php` includes a comment containing its
former class name.

| Former class name | Current class name |
| --- | --- |
| `OutsideView` | `PublicBaseView` |
| `InsideView` | `AuthenticatedBaseView` |
| `View1` | `HomeView` |
| `View2` | `LoginView` |
| `View3` | `PreviousPostsView` |
| `View31` | `GuestPostView` |
| `View4` | `RegistrationView` |
| `View5` | `CreatePostView` |
| `View51` | `BlogPostManagementView` |
| `View6` | `DeleteBlogPostsView` |
| `ViewSinglePost` | `SinglePostView` |
| `AdminViewMessages` | `AdminBlogManagementView` |
| `View8` | `SuspendUsersView` |
| `View9` | `DeleteUsersView` |

`AdminBaseView`, `AdminDashboardView`, and `AdminUsersView` were intentionally
kept unchanged because their names already describe their responsibilities.

### CSS

Two stylesheets are used:

* `mystyles.css` – public pages
* `insidestyles.css` – logged-in/inside pages

The original layout uses a simple fixed-width, float-based CSS design.

### UI and JavaScript updates

The front-end work is intentionally incremental because the application is
already functional. The current update improves responsive layout behavior,
selection controls, destructive-action confirmation, and duplicate-submit
prevention. Administrator blog and personal-blog screens now use a 40/60
two-pane layout: posts can be selected into an editor, posts and comments can
be updated, and delete actions remain confirmation-protected. User management
now presents users as styled rows with visible active/suspended state and
existing suspend, reinstate, delete, and registration actions.

The existing PHP routes, database behavior, authentication flow, and
administrator permissions remain the source of truth. JavaScript must not be
required for core navigation or form submission, and server-side validation
must remain in place.

The implementation details, constraints, and acceptance criteria are
documented in
[UI-AND-JAVASCRIPT-CHANGE-OUTLINE.md](UI-AND-JAVASCRIPT-CHANGE-OUTLINE.md).

## Database

The application connects to a MySQL database named:

```text
blogger
```

The original connection configuration is:

```php
mysql:host=localhost:3306;dbname=blogger
```

with the MySQL `root` account and an empty password in the original code.

The application expects three principal tables:

```text
user
post
comments
```

### `user`

Stores blogger and administrator information, including:

* `id`
* `username`
* `password`
* `blogtitle`
* `email`
* `suspend`

### `post`

Stores blog posts:

* `id`
* `bloggerid`
* `title`
* `body`

`bloggerid` associates a post with a user.

### `comments`

Stores comments associated with posts:

* `id`
* `postid`
* `body`
* `author`

The basic relationship is:

```text
user
  |
  | id
  v
post
  |
  | id
  v
comments.postid
```

## Authentication

The original application uses a simple cookie-based login mechanism.

After successful login, the username is stored in a cookie:

```text
username
```

The administrator account is identified by the username:

```text
rmiller
```

The original application therefore distinguishes between the administrator and ordinary bloggers through application logic rather than a modern role/permission framework.

## Main User Flows

### Registration

```text
Register
   |
   v
View4
   |
   v
addBlogger
   |
   v
DBManager::registerBlogger()
   |
   v
user table
```

### Login

```text
Login
   |
   v
View2
   |
   v
loginRequest
   |
   v
handleLogin()
   |
   v
DBManager::authenticateUser()
```

### Creating a Post

```text
Add Post
   |
   v
View51
   |
   v
addPost
   |
   v
handleAddpost()
   |
   v
DBManager::createBlogPost()
   |
   v
post table
```

### Comments

Comments are submitted through:

```text
addComment
```

or:

```text
addComment1
```

depending on whether the post is being viewed through the public or logged-in interface.

## Administrator Functions

The original administrator interface provides functionality for:

* Viewing all blogs
* Deleting blogs
* Viewing users
* Deleting users
* Suspending users
* Restoring users

The administrator interface is reached when the username `rmiller` successfully authenticates.

## Technology

The project represents the web development technology and programming style used during the **2014 Higher Diploma in Cloud Computing** course.

Primary technologies include:

* PHP
* MySQL
* HTML
* CSS
* Apache/PHP web hosting environment
* SQL
* PDO

The application predates modern PHP frameworks and uses direct PHP classes, HTML generation and SQL queries.

## Historical Context

This project was created in **2014 as part of a Higher Diploma in Cloud Computing**.

It is preserved as a snapshot of an earlier stage of web development and of the programming techniques used during the course.

The intention of preserving the project is to document and understand the original implementation rather than retrospectively rewrite it as a modern application.

## Modernisation Considerations

The application is an educational/historical project and should **not be considered production-ready software**.

The original implementation contains practices that would normally be changed in a modern PHP application, including:

* Plain-text password handling
* SQL constructed using string interpolation
* Limited input validation
* Cookie-based authentication rather than modern session/authentication mechanisms
* No prepared SQL statements
* Minimal error handling
* HTML generated directly from PHP classes
* Older CSS layout techniques
* Some duplicated and unused code
* Some inconsistent naming and legacy code

These characteristics are retained in the source because they form part of the original 2014 implementation.

If the application is modernised, the preferred approach would be to first preserve the original behaviour and then make changes incrementally.

## Project Structure

The original project follows a structure broadly similar to:

```text
Blogger/
│
├── controller.php
├── library.php
│
├── mystyles.css
├── insidestyles.css
│
└── database/
    └── ...
```

Additional files may be present in the original project, including database setup scripts and supporting resources.

## Status

**Historical / educational project – 2014**

The project is being reconstructed and documented from its original source code.

The priority is to understand and preserve the original application behaviour before making any significant changes or modernisation.

---

**Author:** Pio O'Connell
**Course:** Higher Diploma in Cloud Computing
**Year:** 2014
