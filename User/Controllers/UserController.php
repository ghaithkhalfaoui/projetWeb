<?php
class UserController
{
    private $userModel;

    public function __construct()
    {
        // Use absolute paths from project root
        $conn = require_once __DIR__ . '/../../config/database.php';
        require_once __DIR__ . '/../Models/User.php';
        $this->userModel = new User($conn);
    }

    public function index()
    {
        $users = $this->userModel->getAll();
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
                header('Location: /user/create?msg=empty');
                exit;
            }
            
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                header('Location: /user/create?msg=email');
                exit;
            }
            
            if ($this->userModel->create($username, $email)) {
                header('Location: /user?msg=add_ok');
                exit;
            } else {
                header('Location: /user/create?msg=error');
                exit;
            }
        }
    }

    public function edit($id = null)
    {
        if (!$id || !is_numeric($id)) {
            header('Location: /user');
            exit;
        }
        
        $user = $this->userModel->find($id);
        if (!$user) {
            header('Location: /user');
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
                header("Location: /user/edit/$id?msg=empty");
                exit;
            }
            
            if ($this->userModel->emailExists($email, $id)) {
                header("Location: /user/edit/$id?msg=exists");
                exit;
            }
            
            if ($this->userModel->update($id, $username, $email)) {
                header('Location: /user?msg=update_ok');
                exit;
            } else {
                header("Location: /user/edit/$id?msg=error");
                exit;
            }
        }
    }

    public function delete($id = null)
    {
        if ($id && is_numeric($id)) {
            if ($this->userModel->delete($id)) {
                header('Location: /user?msg=delete_ok');
                exit;
            } else {
                header('Location: /user');
                exit;
            }
        }
    }
}