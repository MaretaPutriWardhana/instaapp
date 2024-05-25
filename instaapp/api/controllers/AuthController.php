<?php
include_once '../config/Database.php';
include_once '../models/User.php';

class AuthController {
    private $db;
    private $user;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->user = new User($this->db);
    }

    public function register($username, $email, $password) {
        $this->user->username = $username;
        $this->user->email = $email;
        $this->user->password = $password;

        if($this->user->register()) {
            return array('message' => 'User registered successfully.');
        } else {
            return array('message' => 'User registration failed.');
        }
    }

    public function login($email, $password) {
        $this->user->email = $email;
        $this->user->password = $password;

        if($this->user->login()) {
            return array('message' => 'Login successful.', 'user_id' => $this->user->id);
        } else {
            return array('message' => 'Login failed.');
        }
    }
}
