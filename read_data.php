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
    <title>Document</title>
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
        <h2><b>USERS ACCOUNT</h2></b>
    </caption>
    <h5>
        <a href="register.php" >ADD USER</a>
    </h5>
    <table class="table table-striped table-hover m-auto">


        <thead>
            <tr>

                <th>Name</th>
                <th>Role</th>
                <th>Email</th>
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
                <td><?php echo $row['name'] ?></td>
                <td><?php echo $row['role'] ?></td>
                <td><?php echo $row['email'] ?></td>
                <td><?php echo $row['date_created'] ?></td>
                <td><?php echo $row['date_modified'] ?></td>

                <td>
                    <a href='form_update.php?email=<?php echo $row['email'] ?>'><i class="bi bi-pen"></i></a> |
                    <a onclick="return confirm ('Anda yakin akan menghapus record ini ?')"
                        href='delete_data.php?email=<?php echo $row['email'] ?>'><i class="bi bi-trash"></i></a>
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