

 <!-- Connect Mysql DB using Mysqli Procedural -->
 <?php
require 'database.php';

// membuat database 
//  $sql = "CREATE DATABASE webPro";
// if (mysqli_query($conn, $sql)) {
//   echo "Database created successfully";
// } else {
//   echo "Error creating database: " . mysqli_error($conn);
// }

// mysqli_close($conn);

//create table
// $sql = "CREATE TABLE user(
//     email VARCHAR(20) PRIMARY KEY,
//     name VARCHAR(50) NOT NULL,
//     password VARCHAR(100) NOT NULL,
//     role VARCHAR(20) NOT NULL,
//     date_created char(10) NOT NULL,
//     date_modified char(10) NOT NULL

// )";

// if (mysqli_query($conn, $sql)) {
//   echo "table created successfully";
// } else {
//   echo "Error creating table: " . mysqli_error($conn);
// }
// mysqli_close($conn);

$encryptPassword = sha1($_POST['password']);

$sql = "INSERT INTO products (email, name, password, role, date_created, date_modified)
VALUES ('$email',
'$name',
'$encryptPassword',
'$role',
'$created',
'$modified')";





if (mysqli_query($conn, $sql)){
    echo "data berhasil dimasukkan ke database";
} else {
    echo "gagal memasukkan data: " . mysqli_error($conn);
};
mysqli_close($conn);
header('Location: read_data.php')
?>

<!-- ========================================  -->