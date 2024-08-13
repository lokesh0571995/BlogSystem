# Blog System

## Overview

This project is a simple RESTful API for a blog platform built using core PHP. The API supports basic blog functionalities such as creating, reading, updating, and deleting blog posts. The project follows principles of security, scalability, and maintainability.

## Project Structure

The project directory is organized as follows:

    1. Config/ Config.php = Add your Database name
    2. src/Core/

        1. Router.php # Handles routing of requests to appropriate controllers.
        2. Database.php # Manages database connections and queries.
        3. Request.php # Handles incoming HTTP requests.
        4. Response.php # Manages HTTP responses.

    3. Models/
        1. Post.php # Represents the blog post model and its interactions with the database.

    4. Controllers/
        1. PostController.php # Manages the logic for handling blog post requests.

    5. public/
        1. index.php # The entry point of the application, handles incoming requests.

    5. vendor/
        1. autoload.php (if using Composer) # Composer autoloader if using Composer for dependencies.

    6. .htaccess (if using Apache) # Apache configuration for URL rewriting and other settings.


## Installation

1. **Clone the repository:**

  1. git clone <repository-url>
  2. cd BlogSystem

2. Install dependencies:

   1. composer install

3. Set up your environment:

    1. Configure your database connection in src/Core/Database.php.
    2. Update any necessary configuration files.

4. Set up Apache (if using):

    1. Ensure that your .htaccess file is properly configured for URL rewriting.

5. Usage

    Start the Apache server (or use PHP's built-in server for development):

    1. php -S localhost:8000 -t public
    2. Run project url http://localhost:8000 

6. Access the API by sending HTTP requests to the following endpoints:

    1. GET api/posts: Retrieve a list of blog posts.
    2. GET api/posts/{id}: Retrieve a specific blog post by ID.
    3. POST api/posts: Create a new blog post.
    4. PUT api/posts/{id}: Update an existing blog post.
    5. DELETE api/posts/{id}: Delete a blog post.


Security

Input Sanitization: Ensure that all user inputs are sanitized to prevent SQL injection and other attacks.
Prepared Statements: Use prepared statements for database queries to enhance security.

Testing

Unit and integration testing can be performed using your preferred PHP testing framework. Ensure that all functionalities are thoroughly tested to maintain robustness. 


