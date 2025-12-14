<?php
session_start();
session_unset();
session_destroy();
header("Location: login.php"); 
$_SESSION['user_role'] = $user['role']; // 'admin' ou 'user'

exit;
