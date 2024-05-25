<?php
class Post {
    private $conn;
    private $table_name = "posts";

    public $id;
    public $user_id;
    public $content;
    public $image_url;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET user_id=:user_id, content=:content, image_url=:image_url, created_at=:created_at";
        $stmt = $this->conn->prepare($query);

        $this->user_id=htmlspecialchars(strip_tags($this->user_id));
        $this->content=htmlspecialchars(strip_tags($this->content));
        $this->image_url=htmlspecialchars(strip_tags($this->image_url));
        $this->created_at=htmlspecialchars(strip_tags($this->created_at));

        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":content", $this->content);
        $stmt->bindParam(":image_url", $this->image_url);
        $stmt->bindParam(":created_at", $this->created_at);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function readAll() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
