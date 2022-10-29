<?php
require 'database.php';

$id = $_GET['id'];

$sql1 = "UPDATE products SET name='$name',
description='$desc',
price='$price',
photo='$nama_file',
modified = sysdate()
WHERE id='$id'";

if (mysqli_query($conn, $sql1)) {
    //echo "data berhasil dimasukkan ke database";
    header('Location: read_data.php');
} else {
    echo "gagal memasukkan data: " . mysqli_error($conn);
}
mysqli_close($conn);