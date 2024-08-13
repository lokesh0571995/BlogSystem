<?php
namespace Models;

use Core\Database;
use PDO;

class Post {
    
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance()->getConnection(); // Use getConnection() to get the PDO instance
    }

    public function getAllPosts() {
        $stmt = $this->pdo->query("SELECT * FROM posts");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPostById($id) {
        try {
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $this->pdo->prepare("SELECT * FROM posts WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Debug SQL errors if any
            if ($result === false) {
                error_log('SQL Error: ' . implode(' ', $stmt->errorInfo()));
            }
    
            return $result;
        } catch (PDOException $e) {
            // Log PDO exceptions
            error_log('Database Error: ' . $e->getMessage());
            return false;
        }
    }
    
    
    public function createPost($data) {
        $stmt = $this->pdo->prepare("INSERT INTO posts (title, content, author) VALUES (:title, :content, :author)");
        $stmt->execute([
            'title' => htmlspecialchars($data['title']),
            'content' => htmlspecialchars($data['content']),
            'author' => htmlspecialchars($data['author']),
        ]);
        return $this->pdo->lastInsertId();
    }

    public function updatePost($id, $data) {
        $stmt = $this->pdo->prepare("UPDATE posts SET title = :title, content = :content, author = :author WHERE id = :id");
        $stmt->execute([
            'title' => htmlspecialchars($data['title']),
            'content' => htmlspecialchars($data['content']),
            'author' => htmlspecialchars($data['author']),
            'id' => $id
        ]);
    }

    public function deletePost($id) {
        $stmt = $this->pdo->prepare("DELETE FROM posts WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }
}
