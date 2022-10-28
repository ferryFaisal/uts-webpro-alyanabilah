<?php
$nameErr = $descErr = $priceErr = $imageErr = "";
$name = $desc = $price = $image = "";
$valid_name = $valid_desc = $valid_price = $valid_image = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameErr = "Product name is Required";
        $valid_name = false;
    } else {
        $name = test_input($_POST["name"]);
        $valid_name = true;
    }

    // descript section
    if (empty($_POST["desc"])) {
        $descErr = "Description is required";
        $valid_desc = false;
    } else {
        $desc = test_input($_POST["desc"]);
        $valid_desc = true;
    }

    //price section
    if (empty($_POST["price"])) {
        $priceErr = "Price is required";
        $valid_price = false;
    } else {
        $price = test_input($_POST["price"]);
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

            $valid_image = true;
        } else {
            $imageErr = "File photo is required";
            $valid_image = false;
        }
    } else {
        $imageErr = "File photo is required";
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
<!DOCTYPE HTML>
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

    .error {
        color: #FF0000;
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
        <h1>Add Product</h1>
        <p><span class="error">* required field</span></p>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
            ENCTYPE="multipart/form-data">

            Product Name : <input type="text" name="name" value="<?php echo $name; ?>">
            <span class="error">* <?php echo $nameErr; ?></span>
            <br><br>
            <label for="textarea">Description:</label>
            <br>
            <textarea name="desc" id="" cols="40" rows="5" value="<?php echo $desc ?>"></textarea>
            <span class="error">* <?php echo $descErr; ?></span>
            <br><br>

            Price: <input type="number" min="1" step="any" name='price' value="<?php echo $price ?>">
            <span class="error">* <?php echo $priceErr; ?></span>
            <br><br>

            Upload Photo : <input type="file" name="file"><br>
            <span class="error">* <?php echo $imageErr; ?></span>
            <br><br>
            <input type="submit" name="submit" value="Submit">
        </form>


        <?php
if ($valid_name && $valid_desc && $valid_price && $valid_image == true) {

    include 'upload_data.php';
}
?>
    </main>
</body>

</html>