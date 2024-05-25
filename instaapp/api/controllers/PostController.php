<?php
include_once '../config/Database.php';
include_once '../models/Post.php';

class PostController {
    private $db;
    private $post;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->post = new Post($this->db);
    }

    public function createPost($user_id, $content, $image_url) {
        $this->post->user_id = $user_id;
        $this->post->content = $content;
        $this->post->image_url = $image_url;
        $this->post->created_at = date('Y-m-d H:i:s');

        if($this->post->create()) {
            return array('message' => 'Post created successfully.');
        } else {
            return array('message' => 'Post creation failed.');
        }
    }

    public function getPosts() {
        $result = $this->post->readAll();
        $posts = array();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            array_push($posts, $row);
        }
        return $posts;
    }
}
