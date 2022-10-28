<?php
require "database.php";

$email = $_GET['id'];
$sql = "SELECT * FROM produts WHERE id = '$id'";
$result = mysqli_query($conn, $sql);
$nameErr = $roleErr = $passwordErr = $emailErr = "";
$valid_name = $valid_role = $valid_password = false;

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["name"])) {
                $nameErr = "Name is required";
                $valid_name = false;
            } else {
                $name = trim($_POST["name"]);
                $valid_name = true;

                // check if name only contains letters and whitespace
                if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
                    $nameErr = "Only letters and white space allowed";

                }
            }

            if (empty($_POST["password"])) {
                $passwordErr = "Password is required";
                $valid_password = false;
                $valid_passwordrepeat = false;
            } else {
                $password = trim($_POST["password"]);
                $valid_password = true;
            }

            if (empty($_POST["role"])) {
                $roleErr = "role is required";
                $valid_role = false;

            } else {
                $role = trim($_POST["role"]);
                $valid_role = true;
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
