# Laravel Project Task Manager

A simple task manager app forked from https://github.com/jcadima/Laravel-Project-mgmt updated for Laravel 8.x and Twitter Bootstrap 5.x

Demo site of the original can be found here: https://project.jcadima.dev/login

### How to install 🤔
(1). Simply [download](https://github.com/http-tom/Laravel-Project-mgmt/archive/master.zip) or clone the repo:
```
git clone https://github.com/http-tom/Laravel-Project-mgmt.git
```

(2) Run composer install to get all the dependencies specified in the composer.lock file
```
composer install
```

(3) Import database and modify your .env file
[Task Management DB](https://github.com/http-tom/Laravel-Project-mgmt/blob/master/laraproject.sql)

(4) Run migrations
```
php artisan migrate
```
OR

(4b) Run the database seeder:

```
php artisan db:seed
```


The project already includes a UsersTableSeeder.php class with the following:

```php
        App\User::create([
            'admin' => 1,
            'name' => 'Demo User',
            'email' => 'demo@test.com',
            'password' => bcrypt('demo2017') 
        ]);
```

(5) Install NPM packages:
```
npm install
```

(6) Fire it up:

```
php artisan serve
```


### ROUTES

```
 >  php artisan route:list
```
Or can be found in this file [Routes List](https://github.com/http-tom/Laravel-Project-mgmt/blob/master/routes.list)

### Database table schemas
**migrations**

```
+-----------+------------------+------+-----+---------+----------------+
| Field     | Type             | Null | Key | Default | Extra          |
+-----------+------------------+------+-----+---------+----------------+
| id        | int(10) unsigned | NO   | PRI | NULL    | auto_increment |
| migration | varchar(191)     | NO   |     | NULL    |                |
| batch     | int(11)          | NO   |     | NULL    |                |
+-----------+------------------+------+-----+---------+----------------+
```

**projects**

```
+--------------+------------------+------+-----+---------+----------------+
| Field        | Type             | Null | Key | Default | Extra          |
+--------------+------------------+------+-----+---------+----------------+
| id           | int(10) unsigned | NO   | PRI | NULL    | auto_increment |
| project_name | varchar(191)     | NO   |     | NULL    |                |
| created_at   | timestamp        | YES  |     | NULL    |                |
| updated_at   | timestamp        | YES  |     | NULL    |                |
+--------------+------------------+------+-----+---------+----------------+
```

**task_files**

```
+------------+------------------+------+-----+---------+----------------+
| Field      | Type             | Null | Key | Default | Extra          |
+------------+------------------+------+-----+---------+----------------+
| id         | int(10) unsigned | NO   | PRI | NULL    | auto_increment |
| task_id    | int(10) unsigned | NO   | MUL | NULL    |                |
| filename   | varchar(191)     | NO   |     | NULL    |                |
| created_at | timestamp        | YES  |     | NULL    |                |
| updated_at | timestamp        | YES  |     | NULL    |                |
+------------+------------------+------+-----+---------+----------------+
```

**tasks**

```
+------------+------------------+------+-----+---------+----------------+
| Field      | Type             | Null | Key | Default | Extra          |
+------------+------------------+------+-----+---------+----------------+
| id         | int(10) unsigned | NO   | PRI | NULL    | auto_increment |
| user_id    | int(10) unsigned | NO   | MUL | NULL    |                |
| project_id | int(10) unsigned | NO   | MUL | NULL    |                |
| task_title | varchar(191)     | NO   |     | NULL    |                |
| task       | text             | NO   |     | NULL    |                |
| priority   | int(11)          | NO   |     | 0       |                |
| completed  | tinyint(1)       | NO   |     | 0       |                |
| created_at | timestamp        | YES  |     | NULL    |                |
| updated_at | timestamp        | YES  |     | NULL    |                |
| duedate    | datetime         | YES  |     | NULL    |                |
+------------+------------------+------+-----+---------+----------------+
```

**users**

```
+----------------+------------------+------+-----+---------+----------------+
| Field          | Type             | Null | Key | Default | Extra          |
+----------------+------------------+------+-----+---------+----------------+
| id             | int(10) unsigned | NO   | PRI | NULL    | auto_increment |
| admin          | tinyint(1)       | NO   |     | 0       |                |
| name           | varchar(191)     | NO   |     | NULL    |                |
| email          | varchar(191)     | NO   | UNI | NULL    |                |
| password       | varchar(191)     | NO   |     | NULL    |                |
| remember_token | varchar(100)     | YES  |     | NULL    |                |
| created_at     | timestamp        | YES  |     | NULL    |                |
| updated_at     | timestamp        | YES  |     | NULL    |                |
+----------------+------------------+------+-----+---------+----------------+
```


### Todos && Features
* [X] Create Models
* [X] Create blade includes
* [X] Assign Tasks to Project
* [X] Assign Task Priority
* [X] Assign Task Status
* [X] Add Toastr Notifications
* [X] Implement Cascade down on delete
* [X] Delete associated tasks that belong to a user
* [X] Add/Edit/Delete Tasks
* [X] Sort by column
* [X] Multiple File Upload
* [X] Demo Login
* [X] Added Summernote WYSIWYG editor for Task view
* [X] Add Pagination
* [X] Restrict new user registration (Admin approval)
* [X] Add Modal box for Projects and User creation
* [X] Add lightbox to image gallery
* [X] Clean filenames before uploading: blank spaces, dots
* [X] Add FileManager package for file uploads
* [X] Add custom class options for uploaded images

### Screenshots


![alt AllTasks](https://jcadima.dev/images/projects.png)
<br/>
![alt CreateTask](https://jcadima.dev/images/tasks.png)

