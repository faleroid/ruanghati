<?php
session_start();
require_once '../../../db/connect.php';
require_once '../../validator/UserPayloadValidator.php';
require_once '../../models/UserModel.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../index.php');
    exit;
}

$email = $_POST['email'];
$password = $_POST['password'];

if (UserPayloadValidator::areEmpty([$email, $password])) {
    header('Location: ../../../public/login.php?error_login=Email dan password tidak boleh kosong');
    exit;
}

if (!UserPayloadValidator::isValidEmail($email)) {
    header('Location: ../../../public/login.php?error_login=Email tidak valid');
    exit;
}

$userModel = new UserModel($conn);
$user = $userModel->findUser($email);

if ($user && password_verify($password, $user['password_hash'])) {
    $_SESSION['user_id'] = $user['user_id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role'];

    header('Location: ../../../public/journal.php');
} else {
    header('Location: ../../../public/login.php?error_login=Email atau password salah');
}

mysqli_close($conn);
exit;