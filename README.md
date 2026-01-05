# Kawayanihan Web App

## Short Description

Kawayanihan Web App is a PHP-based web application designed for user authentication and management within a community or organizational context. It provides features for user registration, login, verification, and a basic dashboard, catering to users who need secure access to personalized content or services. The application is suitable for small to medium-sized communities or businesses requiring simple user role-based access control.

## Features

- **User Registration**: Allows new users to sign up with a username and password.
- **User Login**: Secure authentication for existing users.
- **Email/Phone Verification**: Verification processes for signup and login to enhance security.
- **Dashboard**: A personalized dashboard for logged-in users, displaying user-specific information.
- **Logout Functionality**: Secure session termination.
- **Role-Based Access**: Supports different user roles (e.g., 'user' and 'Admin') for access control.
- **Responsive Design**: Styled with CSS for a user-friendly interface across devices.

## Technology Stack

- **Backend**: PHP 8.2+
- **Database**: MySQL (MariaDB 10.4+)
- **Frontend**: HTML5, CSS3
- **Server**: Apache or Nginx (with PHP support)
- **Version Control**: Git

## Project Structure

```
Kawayanihan-Web-App/
├── README.md
├── database/
│   └── kawayanihan.sql          # Database schema and sample data
└── SC/                          # Source Code directory
    ├── dashboard.php            # User dashboard page
    ├── index.php                # Main login page
    ├── logout.php               # Logout functionality
    ├── signup.php               # User registration page
    ├── verifyindex.php          # Login verification page
    ├── verifysignup.php         # Signup verification page
    ├── img/                     # Image assets (e.g., logos, icons)
    └── include/
        ├── connect.php          # Database connection configuration
        ├── style.css            # Main stylesheet
        └── style1.css           # Additional stylesheet
```

- `database/kawayanihan.sql`: Contains the SQL dump for setting up the database, including the `users` table.
- `SC/`: Houses all PHP scripts and static assets for the web application.
- `include/`: Shared resources like database connection and stylesheets.

## Requirements / Prerequisites

- PHP 8.2 or higher
- MySQL or MariaDB 10.4+
- A web server (e.g., Apache, Nginx) with PHP support
- Composer (optional, for dependency management if extended)
- Git for cloning the repository

## Installation Guide

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/Vigilia0511/Kawayanihan-Web-App.git
   cd Kawayanihan-Web-App
   ```

2. **Set Up the Database**:
   - Create a new MySQL database named `kawayanihan`.
   - Import the provided SQL file:
     ```bash
     mysql -u your_username -p kawayanihan < database/kawayanihan.sql
     ```
   - Update database credentials in `SC/include/connect.php` (see Configuration section).

3. **Configure Web Server**:
   - Ensure the `SC/` directory is accessible via your web server (e.g., point document root to `SC/` or create a virtual host).
   - For Apache, add a `.htaccess` file if needed for URL rewriting (not included; add based on requirements).

4. **Install Dependencies** (if any future extensions use Composer):
   ```bash
   composer install
   ```

5. **Verify Installation**:
   - Access the application via your web browser (e.g., `http://localhost/SC/index.php`).
   - Test registration, login, and dashboard access.

## Configuration

- **Database Connection**: Edit `SC/include/connect.php` to match your database credentials:
  ```php
  <?php
  $servername = "localhost";
  $username = "your_db_username";
  $password = "your_db_password";
  $dbname = "kawayanihan";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  ?>
  ```
- Ensure the database user has appropriate permissions (SELECT, INSERT, UPDATE, DELETE on `kawayanihan` database).
- For production, use environment variables or a secure config file instead of hardcoding credentials.

## Usage Instructions

1. **Access the Application**: Navigate to the main page (`index.php`) in your web browser.
2. **Register a New User**: Click on the signup link, fill in username and password, and complete verification.
3. **Login**: Enter credentials on the login page and verify if required.
4. **Dashboard**: After login, access personalized content on `dashboard.php`.
5. **Logout**: Use the logout link to end the session securely.

- Sessions are managed via PHP's built-in session handling.
- Passwords are hashed using SHA-1 (noted: consider upgrading to stronger hashing like bcrypt for production).

## Environment Variables

No environment variables are currently used. For enhanced security, consider externalizing database credentials using environment variables (e.g., via `$_ENV` in PHP) or a `.env` file with a library like `vlucas/phpdotenv`.

## API Endpoints

This application does not expose RESTful APIs. All interactions are handled through PHP pages and forms. If API functionality is added in the future, endpoints would be documented here.

## Database Schema or Data Flow

- **Users Table**:
  - `user_id` (INT, Primary Key, Auto-Increment): Unique identifier for each user.
  - `username` (VARCHAR(255)): User's login name.
  - `password` (VARCHAR(255)): Hashed password (currently SHA-1; recommend upgrading).
  - `role` (VARCHAR(255), Default 'user'): User role (e.g., 'user', 'Admin').
  - `timestamp` (TIMESTAMP): Account creation time.

- **Data Flow**:
  1. User submits registration form → Data inserted into `users` table after verification.
  2. Login attempt → Query `users` table for authentication.
  3. Dashboard access → Retrieve user data based on session.

Sample data includes test users with roles. Ensure data is backed up regularly.

## Security Notes

- Passwords are hashed, but SHA-1 is deprecated; migrate to bcrypt or Argon2.
- Use HTTPS in production to encrypt data transmission.
- Implement CSRF protection and input validation to prevent common vulnerabilities.
- Regularly update PHP and MySQL for security patches.
- Limit database user privileges to necessary operations only.

## Screenshots or Demo

Screenshots are not available in the repository. Placeholder for future additions:

- [Login Page Screenshot]
- [Dashboard Screenshot]
- [Signup Page Screenshot]

For a live demo, deploy the application and provide a link (e.g., via GitHub Pages or a hosting service).

## Deployment Guide

1. **Local Development**: Follow the Installation Guide.
2. **Production Deployment**:
   - Choose a hosting provider (e.g., AWS, DigitalOcean, Heroku) with PHP and MySQL support.
   - Upload files to the server, configure database, and set up domain.
   - Enable SSL/TLS for secure connections.
   - Use tools like Docker for containerized deployment if scaling is needed.
3. **CI/CD**: Integrate with GitHub Actions for automated testing and deployment.

## Troubleshooting

- **Database Connection Errors**: Verify credentials in `connect.php` and ensure MySQL service is running.
- **Page Not Loading**: Check web server configuration and PHP errors in logs.
- **Login Issues**: Confirm password hashing matches (SHA-1); debug with error logging.
- **Permission Errors**: Ensure file permissions allow PHP execution (e.g., 755 for directories).
- **Common PHP Errors**: Enable `display_errors` in `php.ini` for debugging during development.

If issues persist, check PHP and MySQL versions against requirements.

## Roadmap / Future Improvements

- Upgrade password hashing to bcrypt or Argon2 for better security.
- Add email verification using SMTP for signup.
- Implement user profile management and password reset functionality.
- Introduce role-based permissions for dashboard features.
- Migrate to a modern framework (e.g., Laravel) for scalability.
- Add unit tests and CI/CD pipelines.
- Develop a mobile-responsive design with JavaScript enhancements.

## Contributing Guidelines

1. Fork the repository and create a feature branch.
2. Follow PHP PSR standards for code style.
3. Write clear commit messages and include tests for new features.
4. Submit a pull request with a detailed description of changes.
5. Ensure all contributions align with the project's security and quality standards.

For major changes, open an issue first to discuss.

## License

This project is licensed under the MIT License. See the LICENSE file for details (assumed; add if not present).

## Author / Credits

- **Author**: Vigilia0511
- **Repository**: https://github.com/Vigilia0511/Kawayanihan-Web-App

Credits to contributors and open-source libraries used (none specified in current codebase).
