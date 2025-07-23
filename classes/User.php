<?php
require_once 'includes/db.php';

class User {
    private $conn;
    private $table = 'users';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function register($username, $email, $password) {
        try {
            // Check if user already exists
            $query = "SELECT id FROM " . $this->table . " WHERE username = ? OR email = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$username, $email]);
            
            if ($stmt->rowCount() > 0) {
                return ['success' => false, 'message' => 'Username or email already exists'];
            }

            // Hash password and insert user
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO " . $this->table . " (username, email, password) VALUES (?, ?, ?)";
            $stmt = $this->conn->prepare($query);
            
            if ($stmt->execute([$username, $email, $hashed_password])) {
                return ['success' => true, 'message' => 'Registration successful'];
            }
            
            return ['success' => false, 'message' => 'Registration failed'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Database error'];
        }
    }

    public function login($username, $password) {
        try {
            $query = "SELECT id, username, password FROM " . $this->table . " WHERE username = ? OR email = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$username, $username]);
            
            if ($stmt->rowCount() === 1) {
                $user = $stmt->fetch();
                if (password_verify($password, $user['password'])) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    return ['success' => true, 'message' => 'Login successful'];
                }
            }
            
            return ['success' => false, 'message' => 'Invalid credentials'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Database error'];
        }
    }
}
?>
