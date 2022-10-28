<?php
require "database.php";

$sql = "DELETE FROM products WHERE id= '$_GET[id]'";

if (mysqli_query($conn, $sql)) {
    echo "Record deleted successfully";
    header('Location: read_data.php');
  } else {
    echo "Error deleting record: " . mysqli_error($conn);
  }
  
  mysqli_close($conn);
?>