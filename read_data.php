<?php
require 'database.php';

$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read Data Products</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <style>
    body {
        margin-left: 100px;
        margin-right: 100px;
        margin-top: 50px;
        background-color: #fbe0c3;
    }
    </style>
</head>

<body>
    <caption>
        <h2><b>TABLE PRODUCTS</h2></b>
    </caption>
    <h5>
        <a href="upload.php" >ADD PRODUCT</a>
    </h5>
    <table class="table table-striped table-hover m-auto">


    <thead>
            <tr>
                <th>Id</th>
                <th>Product Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Photo</th>
                <th>Date Created</th>
                <th>Date Modified</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        ?>
            <tr>
                <td><?php echo $row['id'] ?></td>
                <td><?php echo $row['name'] ?></td>
                <td><?php echo $row['description'] ?></td>
                <td><?php echo $row['price'] ?></td>
                <td><a href="images/<?php echo $row['photo'] ?>"><img src="images/<?php echo $row['photo'] ?>" alt=""
                width='100px' ;></td></a>
                <td><?php echo $row['created'] ?></td>
                <td><?php echo $row['modified'] ?></td>

                <td>
                    <a href='form_update.php?id=<?php echo $row['id']; ?>'><i class="bi bi-pen"></i></a> |
                    <a onclick="return confirm ('Anda yakin akan menghapus record ini ?')"
                        href='delete_data.php?id=<?php echo $row['id'] ?>'><i class="bi bi-trash"></i></a>
                </td>


            </tr>
            <?php
} //end of while

    ?>

        </tbody>
    </table>
    <?php

} else {
    echo "0 results";
}
mysqli_close($conn);
?>
</body>

</html>