<?php
require_once '../connect/db.php';

$sql_cou = "SELECT * FROM course_categories";
$query_cou = mysqli_query($conn, $sql_cou);

if (isset($_POST['sbm'])) {


    $course_name = $_POST['course_name'];

    $price = $_POST['price'];

    $category_id = $_POST['category_id'];


    $image = $_FILES['image']['name'];
    $image_imp = $_FILES['image']['tmp_name'];
    move_uploaded_file($image_imp, '../img/' . $image);



    if (!empty($course_name) && !empty($price) && !empty($category_id) && !empty($image)) {
        $sql = "INSERT INTO courses (course_name,price,category_id,image)
    VALUES('$course_name','$price','$category_id','$image')";
        $query = mysqli_query($conn, $sql);

        header('Location: ../index.php');
    } else {
        echo ' Nhap du thong tin';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            margin: 0 auto;
            width: 980px;
        }
        .huy {
            background-color: red;
        }

        .huy a {
            text-decoration: none;
            color: white;
        }

        .them {
            background-color: blue;
            color: white;
        }
        
    </style>
</head>

<body>
    <h1>Thêm thông tin</h1>
    <form method="post" enctype="multipart/form-data">

        <label>course_name</label> <br>
        <input type="text" name="course_name"><br>

        <label>price</label><br>
        <input type="number" name="price"><br>

        <label for="">category_id</label><br>
        <select name="category_id">
            <?php
            while ($row_cou = mysqli_fetch_assoc($query_cou)) { ?>
                <option value="<?php echo $row_cou['category_id'] ?>">
                    <?php echo $row_cou['category_name'] ?>
                </option>
            <?php } ?>

        </select><br>
        <label for="">image</label><br>
        <input type="file" name="image"><br><br>

        <button class="them" type="submit" name="sbm">Thêm mới</button>
        <button class="huy"><a href="../index.php">Huỷ</a></button>

    </form>
</body>

</html>