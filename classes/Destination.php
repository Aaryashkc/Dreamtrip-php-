<?php
require_once __DIR__ . '/../includes/db.php';

class Destination {
    private $conn;
    private $table = 'destinations';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function create($user_id, $name, $country, $type, $status, $notes, $image_path = null) {
        try {
            $query = "INSERT INTO " . $this->table . " (user_id, name, country, type, status, notes, image) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($query);
            return $stmt->execute([$user_id, $name, $country, $type, $status, $notes, $image_path]);
        } catch (PDOException $e) {
            // For debugging, you might want to log the error
            // error_log($e->getMessage());
            return false;
        }
    }

    public function getByUserId($user_id, $filters = []) {
        try {
            $query = "SELECT * FROM " . $this->table . " WHERE user_id = ?";
            $params = [$user_id];

            if (!empty($filters['country'])) {
                $query .= " AND country = ?";
                $params[] = $filters['country'];
            }

            if (!empty($filters['type'])) {
                $query .= " AND type = ?";
                $params[] = $filters['type'];
            }

            if (!empty($filters['status'])) {
                $query .= " AND status = ?";
                $params[] = $filters['status'];
            }

            if (!empty($filters['search'])) {
                $query .= " AND (name LIKE ? OR country LIKE ? OR notes LIKE ?)";
                $search = '%' . $filters['search'] . '%';
                $params[] = $search;
                $params[] = $search;
                $params[] = $search;
            }

            $query .= " ORDER BY created_at DESC";
            
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return [];
        }
    }

    public function getById($id, $user_id) {
        try {
            $query = "SELECT * FROM " . $this->table . " WHERE id = ? AND user_id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$id, $user_id]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function update($id, $user_id, $name, $country, $type, $status, $notes, $image_path) {
        try {
            $query = "UPDATE " . $this->table . " SET name = ?, country = ?, type = ?, status = ?, notes = ?, image = ? WHERE id = ? AND user_id = ?";
            $stmt = $this->conn->prepare($query);
            return $stmt->execute([$name, $country, $type, $status, $notes, $image_path, $id, $user_id]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function delete($id, $user_id) {
        try {
            $query = "DELETE FROM " . $this->table . " WHERE id = ? AND user_id = ?";
            $stmt = $this->conn->prepare($query);
            return $stmt->execute([$id, $user_id]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getStats($user_id) {
        try {
            $query = "SELECT 
                        COUNT(*) as total,
                        SUM(CASE WHEN status = 'visited' THEN 1 ELSE 0 END) as visited,
                        SUM(CASE WHEN status = 'wishlist' THEN 1 ELSE 0 END) as wishlist
                      FROM " . $this->table . " WHERE user_id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$user_id]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            return ['total' => 0, 'visited' => 0, 'wishlist' => 0];
        }
    }

    public function getCountries($user_id) {
        try {
            $query = "SELECT DISTINCT country FROM " . $this->table . " WHERE user_id = ? ORDER BY country";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$user_id]);
            return $stmt->fetchAll(PDO::FETCH_COLUMN);
        } catch (PDOException $e) {
            return [];
        }
    }
}
?>
