<?php
session_start();
require_once '../../../db/connect.php';
require_once '../../validator/UserPayloadValidator.php';
require_once '../../models/UserModel.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../public/index.php');
    exit;
}

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

if (UserPayloadValidator::areEmpty([$username, $email, $password])) {
    header('Location: ../../../public/register.php?error=Data tidak boleh kosong');
    exit;
}

if (!UserPayloadValidator::isValidEmail($email)) {
    header('Location: ../../../public/register.php?error=Email tidak valid');
    exit;
}

$userModel = new UserModel($conn);
$existingUser = $userModel->findUser($email, $username);

if ($existingUser) {
    header('Location: ../../../public/register.php?error=Email atau Username sudah terdaftar');
    exit;
}

$result = $userModel->createNewUser($username, $email, $password);

if ($result) {
    header('Location: ../../../public/register.php?status=reg_success');
} else {
    header('Location: ../../../public/register.php?error=Registrasi gagal, silakan coba lagi');
}

mysqli_close($conn);
exit;