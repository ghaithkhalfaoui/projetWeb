<?php
class UserController
{
    private $userModel;
    private $baseUrl = '/projects/projetWeb';

    public function __construct()
    {
        $conn = require_once __DIR__ . '/../../config/database.php';
        require_once __DIR__ . '/../Models/User.php';
        $this->userModel = new User($conn);
    }

    public function index()
    {
        // Get users from database
        $users = $this->userModel->getAll();
        
        // Debug: Check if $users is valid
        if (!$users) {
            die("Error: Unable to fetch users from database");
        }
        
        // Include the view
        require __DIR__ . '/../Views/list.php';
    }

    public function create()
    {
        require __DIR__ . '/../Views/AddUser.php';
    }

    public function store()
    {
        if ($_POST) {
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            
            if (empty($username) || empty($email)) {
                header("Location: {$this->baseUrl}/user/create?msg=empty");
                exit;
            }
            
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                header("Location: {$this->baseUrl}/user/create?msg=email");
                exit;
            }
            
            if ($this->userModel->create($username, $email)) {
                header("Location: {$this->baseUrl}/");
                exit;
            } else {
                header("Location: {$this->baseUrl}/user/create?msg=error");
                exit;
            }
        }
    }

    public function edit($id = null)
    {
        if (!$id || !is_numeric($id)) {
            header("Location: {$this->baseUrl}/user");
            exit;
        }
        
        $user = $this->userModel->find($id);
        if (!$user) {
            header("Location: {$this->baseUrl}/user");
            exit;
        }
        
        require __DIR__ . '/../Views/edit.php';
    }

    public function update($id = null)
    {
        if ($_POST && $id) {
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            
            if (empty($username) || empty($email)) {
                header("Location: {$this->baseUrl}/user/edit/$id?msg=empty");
                exit;
            }
            
            if ($this->userModel->emailExists($email, $id)) {
                header("Location: {$this->baseUrl}/user/edit/$id?msg=exists");
                exit;
            }
            
            if ($this->userModel->update($id, $username, $email)) {
                header("Location: {$this->baseUrl}/");
                exit;
            } else {
                header("Location: {$this->baseUrl}/user/edit/$id?msg=error");
                exit;
            }
        }
    }

    public function delete($id = null)
    {
        if ($id && is_numeric($id)) {
            if ($this->userModel->delete($id)) {
                header("Location: {$this->baseUrl}/");
                exit;
            } else {
                header("Location: {$this->baseUrl}/user");
                exit;
            }
        }
    }
}