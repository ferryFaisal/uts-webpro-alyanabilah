<?php
require 'database.php';
$name = $_POST['name'];
$password = sha1($_POST['password']);
$role = $_POST['role'];
$date_modified = date('d/m/Y', time());
$email1 = $_POST['email'];

$sql1 = "UPDATE products SET name='$name',
description='$desc',
price='$price',
photo='$nama_file',
modified = sysdate()
WHERE id='$id'";

if (mysqli_query($conn, $sql1)) {
    echo "data berhasil dimasukkan ke database";
    header('Location: read_data.php');
} else {
    echo "gagal memasukkan data: " . mysqli_error($conn);
}
mysqli_close($conn);