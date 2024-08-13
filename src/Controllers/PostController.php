<?php
namespace Controllers;

use Models\Post;
use Core\Request;
use Core\Response;

class PostController {
    
    private $postModel;

    public function __construct() {
        $this->postModel = new Post();
    }

    public function getAll() {
        $posts = $this->postModel->getAllPosts();
        Response::json($posts);
    }

    public function get($id) {
        // Debug the received ID
        error_log("Received ID: $id");
        $post = $this->postModel->getPostById($id);
        // Debug the fetched post
        error_log("Fetched Post: " . print_r($post, true));
        
        if (!$post) {
            Response::error('Post not found', 404);
        }
        
        Response::json($post);
    }
    

    public function create() {
        $data = Request::getJsonBody();
        if (empty($data['title']) || empty($data['content']) || empty($data['author'])) {
            Response::error('Missing required fields', 400);
        }
        $id = $this->postModel->createPost($data);
        Response::json(['message' => 'Post created successfully!', 'id' => $id], 201);
    }

    public function update($id) {
        $data = Request::getJsonBody();
        
        $post = $this->postModel->getPostById($id);
      
        if (!$post) {
            Response::error('Post not found', 404);
        }
        $this->postModel->updatePost($id, $data);
        Response::json(['message' => 'Post updated successfully!']);
    }

    public function delete($id) {
        $post = $this->postModel->getPostById($id);
        if (!$post) {
            Response::error('Post not found', 404);
        }
        $this->postModel->deletePost($id);
        Response::json(['message' => 'Post deleted successfully!']);
    }
}
?>
