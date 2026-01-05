# Kawayanihan Web Application

## Description

Kawayanihan Web Application is a community-focused web platform inspired by the Filipino cultural value of "Bayanihan" - the spirit of communal unity and cooperation. This application aims to facilitate community engagement, resource sharing, and collaborative initiatives within Filipino communities or community-driven organizations.

The system is designed to enable communities to organize collective efforts, coordinate assistance programs, manage resources, and strengthen social bonds through digital means, embodying the traditional Filipino practice of working together for the common good.

## Features

- Community member registration and authentication
- Event coordination and management
- Resource sharing and allocation system
- Volunteer management and tracking
- Community announcements and notifications
- User profile management
- Administrative dashboard for community organizers
- Responsive design for mobile and desktop access

## Technology Stack

### Backend
- **PHP** - Server-side scripting language (67.7% of codebase)
- **MySQL/MariaDB** - Relational database management system

### Frontend
- **HTML5** - Markup structure
- **CSS3** - Styling and layout (32.3% of codebase)
- **JavaScript** - Client-side interactivity

### Server Requirements
- Apache/Nginx web server
- PHP 7.4 or higher
- MySQL 5.7 or higher / MariaDB 10.3 or higher

## Project Structure

```
Kawayanihan-Web-App/
├── SC/                      # Source Code directory
│   ├── index.php           # Main entry point
│   ├── config.php          # Configuration settings
│   ├── includes/           # Shared PHP modules
│   ├── controllers/        # Business logic handlers
│   ├── views/              # HTML templates
│   ├── assets/             # Static resources
│   │   ├── css/           # Stylesheets
│   │   ├── js/            # JavaScript files
│   │   └── images/        # Image assets
│   └── vendor/            # Third-party libraries
├── database/               # Database scripts
│   ├── schema.sql         # Database structure
│   ├── migrations/        # Database version control
│   └── seeds/             # Sample data
└── README.md              # Project documentation
```

## Requirements / Prerequisites

### System Requirements
- Web server (Apache 2.4+ or Nginx 1.18+)
- PHP 7.4 or higher with the following extensions:
  - mysqli or PDO_MySQL
  - mbstring
  - openssl
  - json
  - session
- MySQL 5.7+ or MariaDB 10.3+
- Minimum 256MB RAM
- 100MB free disk space

### Development Tools (Optional)
- Git for version control
- Composer for PHP dependency management
- Node.js and npm (if using build tools)
- Code editor (VS Code, PHPStorm, Sublime Text)

## Installation Guide

### 1. Clone the Repository

```bash
git clone https://github.com/Vigilia0511/Kawayanihan-Web-App.git
cd Kawayanihan-Web-App
```

### 2. Configure Web Server

#### Apache Configuration

Create a virtual host configuration:

```apache
<VirtualHost *:80>
    ServerName kawayanihan.local
    DocumentRoot /path/to/Kawayanihan-Web-App/SC
    
    <Directory /path/to/Kawayanihan-Web-App/SC>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
    
    ErrorLog ${APACHE_LOG_DIR}/kawayanihan-error.log
    CustomLog ${APACHE_LOG_DIR}/kawayanihan-access.log combined
</VirtualHost>
```

Enable the site and restart Apache:

```bash
sudo a2ensite kawayanihan.conf
sudo systemctl restart apache2
```

#### Nginx Configuration

```nginx
server {
    listen 80;
    server_name kawayanihan.local;
    root /path/to/Kawayanihan-Web-App/SC;
    index index.php index.html;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php7.4-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.ht {
        deny all;
    }
}
```

Restart Nginx:

```bash
sudo systemctl restart nginx
```

### 3. Set Up Database

#### Create Database

```bash
mysql -u root -p
```

```sql
CREATE DATABASE kawayanihan_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'kawayanihan_user'@'localhost' IDENTIFIED BY 'your_secure_password';
GRANT ALL PRIVILEGES ON kawayanihan_db.* TO 'kawayanihan_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

#### Import Database Schema

```bash
mysql -u kawayanihan_user -p kawayanihan_db < database/schema.sql
```

If seed data is available:

```bash
mysql -u kawayanihan_user -p kawayanihan_db < database/seeds/initial_data.sql
```

### 4. Configure Application

Copy the configuration template and edit with your settings:

```bash
cd SC
cp config.example.php config.php
nano config.php
```

Update the configuration values:

```php
<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'kawayanihan_db');
define('DB_USER', 'kawayanihan_user');
define('DB_PASS', 'your_secure_password');
define('DB_CHARSET', 'utf8mb4');

define('BASE_URL', 'http://kawayanihan.local');
define('SITE_NAME', 'Kawayanihan Community Portal');

// Security settings
define('SESSION_LIFETIME', 3600);
define('HASH_ALGORITHM', 'sha256');
?>
```

### 5. Set File Permissions

```bash
# Set appropriate ownership
sudo chown -R www-data:www-data /path/to/Kawayanihan-Web-App/SC

# Set directory permissions
find /path/to/Kawayanihan-Web-App/SC -type d -exec chmod 755 {} \;

# Set file permissions
find /path/to/Kawayanihan-Web-App/SC -type f -exec chmod 644 {} \;

# Make specific directories writable
chmod -R 775 /path/to/Kawayanihan-Web-App/SC/uploads
chmod -R 775 /path/to/Kawayanihan-Web-App/SC/cache
```

### 6. Verify Installation

Navigate to `http://kawayanihan.local` (or your configured domain) in your web browser. You should see the application landing page.

## Configuration

### Environment Variables

Create a `.env` file in the SC directory for environment-specific configurations:

```env
# Database Configuration
DB_HOST=localhost
DB_PORT=3306
DB_NAME=kawayanihan_db
DB_USER=kawayanihan_user
DB_PASS=your_secure_password

# Application Settings
APP_ENV=production
APP_DEBUG=false
APP_URL=http://kawayanihan.local

# Security
SESSION_SECURE=false
SESSION_HTTPONLY=true
CSRF_TOKEN_LENGTH=32

# Email Configuration (if applicable)
MAIL_HOST=smtp.example.com
MAIL_PORT=587
MAIL_USERNAME=noreply@example.com
MAIL_PASSWORD=your_email_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@example.com
MAIL_FROM_NAME=Kawayanihan

# Upload Settings
MAX_UPLOAD_SIZE=5242880
ALLOWED_FILE_TYPES=jpg,jpeg,png,pdf,doc,docx
```

### Application Configuration

Edit `SC/config.php` to customize:

```php
<?php
// Timezone
date_default_timezone_set('Asia/Manila');

// Error reporting
if (APP_ENV === 'development') {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}

// Session configuration
ini_set('session.cookie_httponly', 1);
ini_set('session.use_strict_mode', 1);
ini_set('session.cookie_lifetime', SESSION_LIFETIME);

// Security headers
header("X-Frame-Options: SAMEORIGIN");
header("X-Content-Type-Options: nosniff");
header("X-XSS-Protection: 1; mode=block");
?>
```

## Usage Instructions

### For Community Members

#### Registration
1. Navigate to the registration page
2. Fill in required information (name, email, contact details)
3. Submit the registration form
4. Verify your email address (if email verification is enabled)
5. Log in with your credentials

#### Participating in Community Activities
1. Log in to your account
2. Browse available events and initiatives
3. Register for events you wish to participate in
4. View your dashboard to track your contributions
5. Communicate with community organizers through the messaging system

### For Community Organizers/Administrators

#### Creating Events
1. Log in with administrative credentials
2. Navigate to the Events Management section
3. Click "Create New Event"
4. Fill in event details (title, description, date, location, requirements)
5. Set volunteer requirements and resource needs
6. Publish the event

#### Managing Users
1. Access the User Management dashboard
2. View registered community members
3. Approve or suspend user accounts
4. Assign roles and permissions
5. View user activity logs

#### Generating Reports
1. Navigate to Reports section
2. Select report type (participation, resources, events)
3. Set date range and filters
4. Export reports in CSV or PDF format

## API Endpoints

While the application is primarily a traditional PHP web application, the following internal endpoints handle AJAX requests:

### Authentication
- `POST /api/auth/login` - User login
- `POST /api/auth/logout` - User logout
- `POST /api/auth/register` - User registration
- `POST /api/auth/reset-password` - Password reset

### Events
- `GET /api/events/list` - Retrieve all events
- `GET /api/events/{id}` - Get specific event details
- `POST /api/events/create` - Create new event (Admin only)
- `PUT /api/events/{id}/update` - Update event (Admin only)
- `DELETE /api/events/{id}` - Delete event (Admin only)
- `POST /api/events/{id}/register` - Register for event

### Users
- `GET /api/users/profile` - Get current user profile
- `PUT /api/users/profile` - Update user profile
- `GET /api/users/{id}` - Get specific user (Admin only)

### Resources
- `GET /api/resources/list` - List available resources
- `POST /api/resources/request` - Request resource allocation
- `PUT /api/resources/{id}/status` - Update resource status (Admin only)

**Note:** All API endpoints require authentication via session cookies. Admin endpoints require administrative privileges.

## Database Schema

### Core Tables

#### users
```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    phone VARCHAR(20),
    role ENUM('member', 'organizer', 'admin') DEFAULT 'member',
    status ENUM('active', 'inactive', 'suspended') DEFAULT 'active',
    email_verified BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_email (email),
    INDEX idx_role (role)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

#### events
```sql
CREATE TABLE events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    description TEXT,
    event_date DATETIME NOT NULL,
    location VARCHAR(255),
    organizer_id INT NOT NULL,
    max_participants INT,
    current_participants INT DEFAULT 0,
    status ENUM('draft', 'published', 'ongoing', 'completed', 'cancelled') DEFAULT 'draft',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (organizer_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_event_date (event_date),
    INDEX idx_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

#### event_participants
```sql
CREATE TABLE event_participants (
    id INT AUTO_INCREMENT PRIMARY KEY,
    event_id INT NOT NULL,
    user_id INT NOT NULL,
    registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    attendance_status ENUM('registered', 'attended', 'absent') DEFAULT 'registered',
    FOREIGN KEY (event_id) REFERENCES events(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    UNIQUE KEY unique_participation (event_id, user_id),
    INDEX idx_event_id (event_id),
    INDEX idx_user_id (user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

#### resources
```sql
CREATE TABLE resources (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(200) NOT NULL,
    description TEXT,
    quantity INT NOT NULL,
    available_quantity INT NOT NULL,
    unit VARCHAR(50),
    category VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_category (category)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

### Data Flow

```
User Registration → Email Verification → Login
    ↓
Dashboard Access
    ↓
    ├─→ Browse Events → Register for Event → Participation Tracking
    ├─→ Request Resources → Approval Process → Resource Allocation
    ├─→ View Profile → Update Information → Save Changes
    └─→ Community Feed → Announcements → Notifications

Admin Flow:
Login → Admin Dashboard
    ↓
    ├─→ User Management → Approve/Suspend Users
    ├─→ Event Management → Create/Edit/Delete Events
    ├─→ Resource Management → Allocate Resources
    └─→ Reports → Generate Analytics
```

## Security Notes

### Implemented Security Measures

1. **Password Security**
   - Passwords are hashed using PHP's `password_hash()` with bcrypt algorithm
   - Minimum password requirements: 8 characters, including uppercase, lowercase, and numbers
   - Password reset functionality with time-limited tokens

2. **SQL Injection Prevention**
   - All database queries use prepared statements with parameterized inputs
   - Input validation on all user-submitted data

3. **Cross-Site Scripting (XSS) Prevention**
   - Output escaping using `htmlspecialchars()` on all user-generated content
   - Content Security Policy headers configured

4. **Cross-Site Request Forgery (CSRF) Protection**
   - CSRF tokens generated for all state-changing operations
   - Token validation on form submissions

5. **Session Security**
   - Session cookies configured with httponly and secure flags
   - Session timeout after 1 hour of inactivity
   - Session ID regeneration on authentication

6. **Access Control**
   - Role-based access control (RBAC) implementation
   - Authorization checks on all sensitive operations
   - User session validation on every request

### Security Best Practices

1. **Keep Software Updated**
   - Regularly update PHP to the latest stable version
   - Apply security patches to web server software
   - Update dependencies and third-party libraries

2. **Environment Configuration**
   - Never commit sensitive credentials to version control
   - Use environment variables for configuration
   - Disable error display in production environments

3. **File Upload Security**
   - Validate file types and sizes
   - Store uploaded files outside the web root when possible
   - Generate unique filenames to prevent overwrites

4. **Database Security**
   - Use dedicated database user with minimal privileges
   - Regular database backups
   - Enable database query logging for audit trails

5. **HTTPS Enforcement**
   - Deploy application over HTTPS in production
   - Redirect all HTTP traffic to HTTPS
   - Use HSTS headers to enforce secure connections

## Screenshots or Demo

### Landing Page
```
[Screenshot placeholder: Home page showing community banner and featured events]
Location: /docs/screenshots/homepage.png
```

### User Dashboard
```
[Screenshot placeholder: User dashboard displaying upcoming events and participation history]
Location: /docs/screenshots/dashboard.png
```

### Event Management
```
[Screenshot placeholder: Admin interface for creating and managing community events]
Location: /docs/screenshots/event-management.png
```

### Resource Allocation
```
[Screenshot placeholder: Resource management interface showing available and allocated resources]
Location: /docs/screenshots/resources.png
```

### Live Demo
A live demonstration of the application is available at:
```
Demo URL: [To be configured]
Demo Admin Credentials:
  Username: admin@demo.com
  Password: Demo@2026

Demo User Credentials:
  Username: user@demo.com
  Password: DemoUser@2026
```

Note: Demo data is reset every 24 hours.

## Deployment Guide

### Production Deployment Checklist

#### Pre-Deployment
- [ ] Update all dependencies to stable versions
- [ ] Run security audit on codebase
- [ ] Test all functionality in staging environment
- [ ] Prepare database migration scripts
- [ ] Document environment-specific configurations
- [ ] Create database backups

#### Server Setup

1. **Provision Server**
   - Minimum 2GB RAM, 2 CPU cores
   - Ubuntu 20.04 LTS or later (recommended)
   - Static IP address or domain name

2. **Install Required Software**

```bash
# Update system packages
sudo apt update && sudo apt upgrade -y

# Install Apache
sudo apt install apache2 -y

# Install PHP and required extensions
sudo apt install php php-mysql php-mbstring php-xml php-curl php-gd -y

# Install MySQL
sudo apt install mysql-server -y
sudo mysql_secure_installation

# Enable required Apache modules
sudo a2enmod rewrite ssl headers
sudo systemctl restart apache2
```

3. **Configure SSL Certificate**

Using Let's Encrypt (Certbot):

```bash
sudo apt install certbot python3-certbot-apache -y
sudo certbot --apache -d yourdomain.com -d www.yourdomain.com
```

4. **Deploy Application Files**

```bash
# Create application directory
sudo mkdir -p /var/www/kawayanihan

# Copy application files
sudo rsync -avz --exclude='.git' /path/to/local/Kawayanihan-Web-App/ /var/www/kawayanihan/

# Set ownership
sudo chown -R www-data:www-data /var/www/kawayanihan

# Set permissions
find /var/www/kawayanihan -type d -exec chmod 755 {} \;
find /var/www/kawayanihan -type f -exec chmod 644 {} \;
```

5. **Configure Apache Virtual Host**

Create `/etc/apache2/sites-available/kawayanihan.conf`:

```apache
<VirtualHost *:80>
    ServerName yourdomain.com
    ServerAlias www.yourdomain.com
    Redirect permanent / https://yourdomain.com/
</VirtualHost>

<VirtualHost *:443>
    ServerName yourdomain.com
    ServerAlias www.yourdomain.com
    DocumentRoot /var/www/kawayanihan/SC
    
    SSLEngine on
    SSLCertificateFile /etc/letsencrypt/live/yourdomain.com/fullchain.pem
    SSLCertificateKeyFile /etc/letsencrypt/live/yourdomain.com/privkey.pem
    
    <Directory /var/www/kawayanihan/SC>
        Options -Indexes +FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
    
    # Security headers
    Header always set X-Frame-Options "SAMEORIGIN"
    Header always set X-Content-Type-Options "nosniff"
    Header always set X-XSS-Protection "1; mode=block"
    Header always set Strict-Transport-Security "max-age=31536000; includeSubDomains"
    
    ErrorLog ${APACHE_LOG_DIR}/kawayanihan-error.log
    CustomLog ${APACHE_LOG_DIR}/kawayanihan-access.log combined
</VirtualHost>
```

Enable the site:

```bash
sudo a2ensite kawayanihan.conf
sudo a2dissite 000-default.conf
sudo systemctl reload apache2
```

6. **Set Up Database**

```bash
mysql -u root -p
```

```sql
CREATE DATABASE kawayanihan_prod CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'kawayanihan_prod'@'localhost' IDENTIFIED BY 'strong_random_password';
GRANT ALL PRIVILEGES ON kawayanihan_prod.* TO 'kawayanihan_prod'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

Import database:

```bash
mysql -u kawayanihan_prod -p kawayanihan_prod < /var/www/kawayanihan/database/schema.sql
```

7. **Configure Application**

```bash
cd /var/www/kawayanihan/SC
sudo nano .env
```

Update production values:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_HOST=localhost
DB_NAME=kawayanihan_prod
DB_USER=kawayanihan_prod
DB_PASS=strong_random_password

SESSION_SECURE=true
```

8. **Set Up Automated Backups**

Create backup script `/usr/local/bin/backup-kawayanihan.sh`:

```bash
#!/bin/bash
BACKUP_DIR="/var/backups/kawayanihan"
DATE=$(date +%Y%m%d_%H%M%S)
DB_NAME="kawayanihan_prod"
DB_USER="kawayanihan_prod"
DB_PASS="strong_random_password"

# Create backup directory
mkdir -p $BACKUP_DIR

# Backup database
mysqldump -u $DB_USER -p$DB_PASS $DB_NAME | gzip > $BACKUP_DIR/db_backup_$DATE.sql.gz

# Backup application files
tar -czf $BACKUP_DIR/files_backup_$DATE.tar.gz /var/www/kawayanihan

# Keep only last 30 days of backups
find $BACKUP_DIR -type f -mtime +30 -delete

echo "Backup completed: $DATE"
```

Make executable and schedule:

```bash
sudo chmod +x /usr/local/bin/backup-kawayanihan.sh
sudo crontab -e
```

Add cron job (daily at 2 AM):

```
0 2 * * * /usr/local/bin/backup-kawayanihan.sh >> /var/log/kawayanihan-backup.log 2>&1
```

9. **Configure Firewall**

```bash
# Enable UFW
sudo ufw enable

# Allow SSH, HTTP, and HTTPS
sudo ufw allow OpenSSH
sudo ufw allow 'Apache Full'

# Check status
sudo ufw status
```

10. **Set Up Monitoring**

Install and configure monitoring tools:

```bash
# Install monitoring agent (example: New Relic, Datadog, or simple logging)
# Configure application logging
# Set up uptime monitoring
# Configure error alerting
```

#### Post-Deployment

- [ ] Verify SSL certificate is working
- [ ] Test all critical functionality
- [ ] Verify database connections
- [ ] Check file upload functionality
- [ ] Test email notifications (if configured)
- [ ] Monitor error logs for issues
- [ ] Verify backup system is running
- [ ] Document deployment details
- [ ] Set up monitoring dashboards
- [ ] Configure alerting for critical errors

### Docker Deployment (Alternative)

Create `Dockerfile`:

```dockerfile
FROM php:7.4-apache

# Install PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql mbstring

# Enable Apache modules
RUN a2enmod rewrite headers

# Copy application files
COPY ./SC /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

EXPOSE 80
```

Create `docker-compose.yml`:

```yaml
version: '3.8'

services:
  web:
    build: .
    ports:
      - "80:80"
    volumes:
      - ./SC:/var/www/html
    depends_on:
      - db
    environment:
      DB_HOST: db
      DB_NAME: kawayanihan_db
      DB_USER: kawayanihan_user
      DB_PASS: kawayanihan_pass

  db:
    image: mysql:8.0
    environment:
      MYSQL_ROOT_PASSWORD: root_password
      MYSQL_DATABASE: kawayanihan_db
      MYSQL_USER: kawayanihan_user
      MYSQL_PASSWORD: kawayanihan_pass
    volumes:
      - db_data:/var/lib/mysql
      - ./database/schema.sql:/docker-entrypoint-initdb.d/schema.sql

volumes:
  db_data:
```

Deploy with Docker:

```bash
docker-compose up -d
```

## Troubleshooting

### Common Issues and Solutions

#### 1. Database Connection Errors

**Error:** "Could not connect to database" or "Access denied for user"

**Solutions:**
```bash
# Verify database credentials
mysql -u kawayanihan_user -p

# Check if database exists
mysql -u root -p -e "SHOW DATABASES;"

# Verify user permissions
mysql -u root -p -e "SHOW GRANTS FOR 'kawayanihan_user'@'localhost';"

# Reset user password if needed
mysql -u root -p -e "ALTER USER 'kawayanihan_user'@'localhost' IDENTIFIED BY 'new_password';"
```

#### 2. 500 Internal Server Error

**Possible Causes:**
- PHP syntax errors
- Missing PHP extensions
- Incorrect file permissions
- .htaccess configuration issues

**Solutions:**
```bash
# Check Apache error logs
sudo tail -f /var/log/apache2/error.log

# Check PHP errors (temporarily enable in development)
# Edit php.ini
display_errors = On
error_reporting = E_ALL

# Verify PHP extensions
php -m | grep -i mysqli

# Check file permissions
ls -la /var/www/kawayanihan/SC/

# Test .htaccess by temporarily renaming it
sudo mv .htaccess .htaccess.bak
```

#### 3. Session Issues

**Error:** "Session data not persisting" or "User logged out unexpectedly"

**Solutions:**
```bash
# Check session directory permissions
ls -la /var/lib/php/sessions/

# Ensure correct ownership
sudo chown -R www-data:www-data /var/lib/php/sessions/

# Check session configuration in php.ini
session.save_path = "/var/lib/php/sessions"
session.cookie_lifetime = 3600
session.gc_maxlifetime = 3600

# Verify session directory is writable
php -r "echo session_save_path();"
```

#### 4. File Upload Failures

**Error:** "Failed to upload file" or "File too large"

**Solutions:**
```bash
# Check PHP upload settings in php.ini
upload_max_filesize = 10M
post_max_size = 12M
max_execution_time = 300
max_input_time = 300

# Verify upload directory exists and is writable
sudo mkdir -p /var/www/kawayanihan/SC/uploads
sudo chown -R www-data:www-data /var/www/kawayanihan/SC/uploads
sudo chmod -R 775 /var/www/kawayanihan/SC/uploads

# Restart Apache after php.ini changes
sudo systemctl restart apache2
```

#### 5. CSS/JavaScript Not Loading

**Error:** "Styles not applied" or "Scripts not working"

**Solutions:**
```bash
# Check console for 404 errors
# Verify file paths are correct in HTML

# Clear browser cache
Ctrl + Shift + R (Chrome/Firefox)

# Check .htaccess rewrite rules
# Ensure mod_rewrite is enabled
sudo a2enmod rewrite
sudo systemctl restart apache2

# Verify MIME types are configured correctly
```

#### 6. Email Notifications Not Sending

**Error:** "Failed to send email" or no emails received

**Solutions:**
```php
// Check email configuration in config.php
// Test email functionality
<?php
$to = "test@example.com";
$subject = "Test Email";
$message = "This is a test email.";
$headers = "From: noreply@yourdomain.com";

if (mail($to, $subject, $message, $headers)) {
    echo "Email sent successfully";
} else {
    echo "Email failed to send";
}
?>
```

```bash
# Check mail logs
sudo tail -f /var/log/mail.log

# Verify SMTP settings
# Consider using PHPMailer or similar library for better reliability
```

#### 7. Slow Performance

**Symptoms:** Pages loading slowly, timeouts

**Solutions:**
```bash
# Enable PHP OpCache (add to php.ini)
opcache.enable=1
opcache.memory_consumption=128
opcache.max_accelerated_files=10000

# Optimize MySQL queries
# Add indexes to frequently queried columns
# Use EXPLAIN on slow queries

# Enable Apache compression
sudo a2enmod deflate
sudo systemctl restart apache2

# Implement caching strategy
# Consider using Redis or Memcached
```

#### 8. Permission Denied Errors

**Error:** "Permission denied" when accessing files or directories

**Solutions:**
```bash
# Fix ownership
sudo chown -R www-data:www-data /var/www/kawayanihan

# Set correct permissions
find /var/www/kawayanihan -type d -exec chmod 755 {} \;
find /var/www/kawayanihan -type f -exec chmod 644 {} \;

# Writable directories
chmod -R 775 /var/www/kawayanihan/SC/uploads
chmod -R 775 /var/www/kawayanihan/SC/cache
```

#### 9. CSRF Token Mismatch

**Error:** "Invalid CSRF token" on form submission

**Solutions:**
```php
// Ensure session is started before token generation
session_start();

// Verify token is being generated and included in forms
// Check that form method is POST
// Verify token lifetime hasn't expired
```

#### 10. Apache Won't Start

**Error:** "Apache failed to start" or "Port 80 already in use"

**Solutions:**
```bash
# Check what's using port 80
sudo netstat -tulpn | grep :80

# Check Apache configuration syntax
sudo apache2ctl configtest

# View detailed Apache errors
sudo systemctl status apache2
sudo journalctl -xe

# Check for conflicting services
sudo systemctl stop nginx  # If Nginx is
