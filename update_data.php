<?php
require 'database.php';
$name = $_POST['name'];
$password = sha1($_POST['password']);
$role = $_POST['role'];
$date_modified = date('d/m/Y', time());
$email1 = $_POST['email'];

$sql1 = "UPDATE user SET
        name = '$name',
        password = '$password',
        role = '$role',
        date_modified = '$date_modified'
        where email = '$email1'";

if (mysqli_query($conn, $sql1)) {
    echo "data berhasil dimasukkan ke database";
    header('Location: read_data.php');
} else {
    echo "gagal memasukkan data: " . mysqli_error($conn);
}
mysqli_close($conn);