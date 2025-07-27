# 🌍 DreamTrip - A Modern Travel Planning Application

[![PHP Version](https://img.shields.io/badge/PHP-8.0%2B-777BB4?logo=php&logoColor=white)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-8.0%2B-4479A1?logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.3.0-06B6D4?logo=tailwind-css&logoColor=white)](https://tailwindcss.com/)

DreamTrip is a dynamic web application that helps travel enthusiasts manage their dream destinations. Users can create a wishlist of places they want to visit, track visited locations, and view insightful statistics about their travels. Built with modern web technologies, DreamTrip offers a seamless, responsive experience across all devices.

## ✨ Features

### 🚀 Core Features
- **User Authentication**
  - Secure registration and login system
  - Password hashing with PHP's `password_hash()`
  - Session-based authentication

- **Destination Management**
  - Add new destinations with details (name, country, type, status, notes, and image)
  - Edit existing destinations
  - Delete destinations with confirmation
  - Mark destinations as visited or move them to wishlist
  - Image uploads with server-side validation

- **Interactive Dashboard**
  - Overview of travel statistics
  - Visited vs. Wishlist destinations
  - Countries visited count
  - Destination type distribution
  - Recent destinations

- **Advanced Search & Filtering**
  - Search destinations by name or country
  - Filter by status (visited/wishlist)
  - Filter by destination type (city, beach, mountain, etc.)
  - Real-time filtering with JavaScript

- **Data Export**
  - Export destinations to CSV format
  - Filtered export based on current search/filters

### 🎨 User Experience
- **AJAX-Powered Navigation** - Smooth, single-page application feel
- **Responsive Design** - Works on desktop, tablet, and mobile devices
- **Modern UI** - Built with Tailwind CSS for a clean, professional look
- **Interactive Elements** - Tooltips, modals, and loading indicators
- **Form Validation** - Client-side and server-side validation

## 🛠️ Tech Stack

### Backend
- **PHP 8.0+** - Server-side scripting
- **MySQL 8.0+** - Database management
- **Apache** - Web server

### Frontend
- **HTML5** - Structure
- **Tailwind CSS 3.3.0** - Styling
- **Vanilla JavaScript** - Interactivity and AJAX
- **Alpine.js** - Minimal JavaScript framework for reactive components

### Development Tools
- **XAMPP** - Local development environment
- **Composer** - PHP dependency management
- **VS Code** - Recommended code editor

## 🚀 Installation Guide

### Prerequisites
- PHP 8.0 or higher
- MySQL 8.0 or higher
- Apache web server
- Composer (for development)

### Setup Instructions

1. **Clone the repository**
   ```bash
   git clone [repository-url].git
   cd dreamtrip-app
   ```

2. **Set up the database**
   - Create a new MySQL database named `dreamtrip`
   - Import the database schema from `scripts/database-setup.sql`
   - Update database credentials in `includes/db.php`

3. **Configure the application**
   - Ensure the `uploads/` directory is writable by the web server
   - Configure your web server to point to the project root directory

4. **Access the application**
   - Open your web browser and navigate to `http://localhost/dreamtrip-app`
   - Register a new account or use the demo credentials:
     - Email: demo@example.com
     - Password: password

## 🔄 AJAX / JSON Integration

DreamTrip uses AJAX for specific features to enhance user experience:

### AJAX Implementation
- **Form Submissions**: Form data is submitted asynchronously for a smoother experience
- **Dynamic Filtering**: Search and filter operations update results without page reloads
- **Status Messages**: User feedback is displayed via AJAX-powered notifications

### JSON API
- **RESTful Endpoints**: Core data operations are available via API endpoints
- **Response Format**:
  ```json
  [
    {
      "id": 1,
      "name": "Tokyo",
      "country": "Japan",
      "type": "city",
      "status": "wishlist"
    }
  ]
  ```
- **Error Handling**: Basic error responses with appropriate HTTP status codes

## 🧭 Navigation Guide

### Client-Side Navigation
- **SPA-like Experience**: Smooth transitions between pages using AJAX
- **History Management**: Browser back/forward buttons work as expected
- **Loading States**: Visual feedback during content loading
- **Error Handling**: Graceful handling of navigation errors

### Key Navigation Components
1. **Main Navigation**
   - Dashboard
   - Add Destination
   - Logout

2. **Dashboard Navigation**
   - Filter destinations by status (All/Visited/Wishlist)
   - Search functionality
   - Sort options

3. **Form Navigation**
   - Form validation feedback
   - Success/error messages
   - Loading states during submission

## 🗃️ Database Overview

### Database Schema
```sql
-- Users Table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Destinations Table
CREATE TABLE destinations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    country VARCHAR(50) NOT NULL,
    type ENUM('city', 'beach', 'mountain', 'cultural', 'adventure', 'nature') NOT NULL,
    status ENUM('wishlist', 'visited') DEFAULT 'wishlist',
    notes TEXT,
    image VARCHAR(255) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

### Key Relationships
- One-to-Many: `users` → `destinations`
- Each user can have multiple destinations
- Cascading deletes ensure referential integrity

### Indexes
- Primary keys on all tables
- Foreign key indexes for performance
- Indexes on frequently queried columns (user_id, status, type)

## 🔒 Security Measures

### 1. Database Security
- **PDO (PHP Data Objects)**
  - All database interactions use PDO for secure database access
  - Prepared statements prevent SQL injection attacks
  - Parameterized queries ensure data integrity

- **Data Validation**
  - Input validation on all user-submitted data
  - Type checking and sanitization using `htmlspecialchars()` and `strip_tags()`
  - Whitelist validation for enum fields (status, type)

### 2. Session Security
- **Session Management**
  - Session-based authentication
  - Session validation on each request
  - Session variables store minimal user data (user_id, username, csrf_token)

### 3. CSRF Protection
- **Token-based Protection**
  - Unique CSRF token generated per session
  - Token required for all state-changing requests (POST, PUT, DELETE)
  - Server-side token validation

### 4. Input/Output Security
- **Input Sanitization**
  - `htmlspecialchars()` for all user-generated content
  - `strip_tags()` to remove HTML/JS tags
  - Custom sanitization function in `auth.php`

- **File Upload Security**
  - Basic file type checking
  - Files stored with randomized names
  - Upload directory outside web root (recommended but not implemented)

### 5. Authentication Security
- **Password Security**
  - `password_hash()` with `PASSWORD_DEFAULT`
  - `password_verify()` for password validation
  - No plain text password storage

### Security Recommendations
For production use, consider implementing:
- HTTPS enforcement
- Rate limiting on authentication endpoints
- More robust file upload validation
- Session regeneration after login
- Password complexity requirements

## 📂 Project Structure

```
dreamtrip-app/
├── api/                    # API endpoints
│   ├── add_destination.php
│   ├── delete_destination.php
│   ├── destinations.php
│   ├── get_stats.php
│   └── update_destination.php
├── assets/                 # Static assets
│   └── custom.css          # Custom CSS overrides
├── classes/                # PHP classes
│   ├── Destination.php     # Destination model
│   └── User.php            # User model
├── includes/               # PHP includes
│   ├── auth.php            # Authentication functions
│   ├── db.php              # Database connection
│   ├── footer.php          # Footer template
│   └── header.php          # Header template
├── uploads/                # User-uploaded images
├── scripts/                # JavaScript files
│   └── app.js              # Main application script
├── views/                  # View templates
├── add_destination.php     # Add destination page
├── dashboard.php          # Dashboard page
├── edit_destination.php    # Edit destination page
├── export.php             # Export functionality
├── index.php              # Entry point
├── login.php              # Login page
├── logout.php             # Logout handler
└── register.php           # Registration page
```

## 🔒 Security Features

### Authentication & Authorization
- Secure password hashing with `password_hash()` and `password_verify()`
- Session management with proper timeouts
- Protected routes with authentication middleware

### Data Protection
- Prepared statements to prevent SQL injection
- Input validation and sanitization
- CSRF protection for all state-changing operations
- Content Security Policy (CSP) headers

### File Upload Security
- File type validation (images only)
- File size restrictions
- Secure file naming to prevent directory traversal
- MIME type verification

## 🛠️ API Endpoints

### GET `/api/destinations`
- **Description**: Get all destinations for the authenticated user
- **Parameters**: 
  - `status` (optional): Filter by status (visited/wishlist)
  - `type` (optional): Filter by destination type
  - `search` (optional): Search query for name/country
- **Response**: JSON array of destination objects

### POST `/api/add_destination`
- **Description**: Add a new destination
- **Request Body**: Form data with destination details
- **Response**: JSON response with status and message

### PUT `/api/update_destination/:id`
- **Description**: Update an existing destination
- **URL Parameters**: `id` - Destination ID
- **Request Body**: Form data with updated fields
- **Response**: JSON response with status and message

### DELETE `/api/delete_destination/:id`
- **Description**: Delete a destination
- **URL Parameters**: `id` - Destination ID
- **Response**: JSON response with status and message

### GET `/api/get_stats`
- **Description**: Get user statistics
- **Response**: JSON object with travel statistics

## 🌟 Contributing

1. Fork the repository
2. Create a new branch for your feature (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🙏 Acknowledgments

- [Tailwind CSS](https://tailwindcss.com/) for the utility-first CSS framework
- [Alpine.js](https://alpinejs.dev/) for minimal JavaScript interactivity
- [Font Awesome](https://fontawesome.com/) for icons
- [Chart.js](https://www.chartjs.org/) for data visualization
