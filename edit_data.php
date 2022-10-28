<?php
require "database.php";

$sql = "UPDATE products SET name='fira' WHERE email='safiranatasya@gmail.com'";

if (mysqli_query($conn,$sql)) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}
mysqli_close($conn);
header('Location: read_data.php');
?>