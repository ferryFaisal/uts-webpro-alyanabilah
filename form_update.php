<?php
require "database.php";

// define variables and set to empty values
$nameErr = $descErr = $priceErr = "";
$name = $desc = $price = $nama_file = "";
$valid_name = $valid_desc = $valid_price = $valid_image = false;

$sql = "SELECT * FROM products WHERE id = '$_GET[id]'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $name = $row['name'];
        $desc = $row['description'];
        $price = $row['price'];
        $nama_file = $row['photo'];
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //product section
    if (empty($_POST["name"])) {
        $nameErr = "Product Name is Required";
        $valid_name = false;
    } else {

        $valid_name = true;

    }

    // descript section
    if (empty($_POST["desc"])) {
        $descErr = "Description is required";
        $valid_desc = false;
    } else {

        $valid_desc = true;
    }

    //price section
    if (empty($_POST["price"])) {
        $priceErr = "Product Price is required";
        $valid_price = false;
    } else {

        $valid_price = true;
    }

    $nama_file = $_FILES['file']['name'];
    $dir_upload = "images/";
    $target_file = $dir_upload . basename($_FILES["file"]["name"]);

    // Select file type
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Valid file extensions
    $extensions_arr = array("jpg", "jpeg", "png", "gif");

    // Check extension
    if (in_array($imageFileType, $extensions_arr)) {
        // Upload file
        if (move_uploaded_file($_FILES['file']['tmp_name'], $dir_upload . $nama_file)) {
            // Insert record
            include 'update_data.php';
            $valid_image = true;
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <style>
    body {
        height: 100%;
    }

    body {
        display: flex;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
    }
    </style>
</head>

<body class='text-left'>
    <main class="form w-1000 m-auto">
        <h1> Update Form</h1>
        <p><span class="error">* required field</span></p>
        <form method="post">

            Name: <input type="text" name="name" value="<?php echo $row['name']; ?>">
            <span class="error">* <?php echo $nameErr; ?></span>
            <br><br>
            E-mail: <input type="text" name="email" value="<?php echo $email; ?>"readonly>
            <span class="error">* <?php echo $emailErr; ?></span>
            <br><br>
            Password: <input type="password" name="password" value="<?php echo $row['password']; ?>">
            <span class="error">* <?php echo $passwordErr; ?></span>
            <br><br>
            <input type="hidden" name="email" value="<?php echo $row['email']; ?>">

            Role:
            <select name='role'>
                <option value="">--SELECT--</option>
                <option value="Admin" <?php echo $attrAdmin; ?>>Admin</option>
                <option value="Operator" <?php echo $attrOperator; ?>>Operator</option>
                <option value="Editor" <?php echo $attrEditor; ?>>Editor</option>
            </select>
            <span class="error">* <?php echo $roleErr; ?></span>


            <br><br>
            <input type="submit" name="submit" value="Update">
        </form>

        <?php

    } //END OF WHILE

} //END OF IF

if ($valid_name && $valid_role && $valid_password == true) {
    include 'update_data3.php';
}

?>

    </main>
</body>

</html>
