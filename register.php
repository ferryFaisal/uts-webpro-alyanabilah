<!DOCTYPE HTML>
<html>

<head>
    <style>
    .error {
        color: #FF0000;
    }
    
    </style>
</head>

<body>

    <?php

// define variables and set to empty values
$nameErr = $emailErr = $roleErr = $passwordErr = $repeatpasswordErr = "";
$name = $email = $role = $password = $repeatpassword = "";
$valid_name = $valid_email = $valid_role = $valid_password = $valid_passwordrepeat = false;

$created = date('d/m/Y', time());
$modified = $created;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
        $valid_name = false;
    } else {
        $name = test_input($_POST["name"]);
        $valid_name = true;

        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $nameErr = "Only letters and white space allowed";

        }
    }

    if (empty($_POST["email"])) {

        $emailErr = "Email is required";
        $valid_email = false;

    } else {
        $email = test_input($_POST["email"]);
        $valid_email = true;
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
            $valid_email = false;

        } else {
            require 'database.php';

            $sql = 'SELECT email FROM user';
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                // output data of each row
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($row['email'] == $email) {
                        $emailErr = "Email already exist!";
                        $valid_email = false;
                        break;
                    } else {

                        $valid_email = true;
                    }
                }
            } else {
                echo "0 result!";
            }
            mysqli_close($conn);
        }
    }

    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
        $valid_password = false;
        $valid_passwordrepeat = false;
    } else {
        $password = test_input($_POST["password"]);
        if ($_POST['password'] == $_POST['repeatpassword']) {

            $valid_password = true;
            $valid_passwordrepeat = true;
        } else {
            $repeatpasswordErr = "Password harus sama";
            $repeatpassword = test_input($_POST["repeatpassword"]);
        }

    }

    if (empty($_POST["role"])) {
        $roleErr = "role is required";
        $valid_role = false;

    } else {
        $role = test_input($_POST["role"]);
        $valid_role = true;
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
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
        html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #fbe0c3;
        }
        </style>
        
    </head>

    <body class="text-left">

        <main class="form w-1000 m-auto">
            <h1> Register Form </h1>
            <p><span class="error">* required field</span></p>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                Name: <input type="text" name="name" value="<?php echo $name; ?>">
                <span class="error">* <?php echo $nameErr; ?></span>
                <br><br>
                E-mail: <input type="text" name="email" value="<?php echo $email; ?>">
                <span class="error">* <?php echo $emailErr; ?></span>
                <br><br>
                Password: <input type="password" name="password" value="<?php echo $password; ?>">
                <span class="error">* <?php echo $passwordErr; ?></span>
                <br><br>
                Repeat Password: <input type="password" name="repeatpassword" value="<?php echo $repeatpassword; ?>">
                <span class="error">* <?php echo $repeatpasswordErr; ?></span>

                <br><br>
                Role:

                <select name='role'>
                    <option value="">--SELECT--</option>
                    <option value="Admin">Admin</option>
                    <option value="Operator">Operator</option>
                    <option value="Editor">Editor</option>
                </select>

                <span class="error">* <?php echo $roleErr; ?></span>
                <br><br>
                <input type="submit" name="submit" value="Submit"> <input type="reset" name="reset" value="Reset">
            </form>
        </main>
    </body>

    </html>



    <?php

if (isset($_POST['reset'])) {

    unset($email, $password, $role, $repeatpassword, $name);
}

if ($valid_name && $valid_email && $valid_role && $valid_password && $valid_passwordrepeat = true) {
    include 'insert_data.php';

}

?>

</body>

</html>
