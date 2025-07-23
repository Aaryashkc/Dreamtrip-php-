-- Create database and tables for DreamTrip application
CREATE DATABASE IF NOT EXISTS dreamtrip;
USE dreamtrip;

-- Users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Destinations table
CREATE TABLE IF NOT EXISTS destinations (
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

-- Insert sample data
INSERT INTO users (username, email, password) VALUES 
('demo_user', 'demo@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

INSERT INTO destinations (user_id, name, country, type, status, notes, image) VALUES 
(1, 'Tokyo', 'Japan', 'city', 'wishlist', 'Want to visit during cherry blossom season', NULL),
(1, 'Santorini', 'Greece', 'beach', 'visited', 'Amazing sunset views', NULL),
(1, 'Machu Picchu', 'Peru', 'cultural', 'wishlist', 'Historic Inca site', NULL),
(1, 'Bali', 'Indonesia', 'beach', 'wishlist', 'Perfect for relaxation', NULL);
