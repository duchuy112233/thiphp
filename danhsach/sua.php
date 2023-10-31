<?php
require_once '../connect/db.php';

$sql_cou = "SELECT * FROM course_categories";
$query_cou = mysqli_query($conn, $sql_cou);

$id = $_GET['id'];

$sql_up = "SELECT * FROM courses WHERE id = $id";
$query_up = mysqli_query($conn, $sql_up);
$row_up = mysqli_fetch_assoc($query_up);

$course_name = $row_up['course_name'] ?? '';
$price = $row_up['price'] ?? '';
$category_id = $row_up['category_id'] ?? '';
$image = $row_up['image'] ?? '';


if (isset($_POST['sbm'])) {


    $course_name = $_POST['course_name'];

    $price = $_POST['price'];

    $category_id = $_POST['category_id'];

    $image_imp = $_FILES['image']['tmp_name'];
    
    if ($_FILES['image']['name'] == "") {
        $image = $row_up['image'];
    } else {
        $image = $_FILES['image']['name'];
        $image_imp = $_FILES['image']['tmp_name'];
        move_uploaded_file($image_imp, '../img/' . $image);
    }

    if (!empty($course_name) && !empty($price) && !empty($category_id) && !empty($image)) {
        $sql = "UPDATE courses SET course_name = '$course_name',price = '$price',category_id = '$category_id',image = '$image' WHERE id = $id";
        $query = mysqli_query($conn, $sql);

        header('Location: ../index.php');
    } else {
        echo 'Nhập đủ thông tin';
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
      
       

        .sua {
            background-color: blue;
            color: white;
        }
        
    </style>
</head>

<body>
    <h1>Sửa</h1>
    <form method="post" enctype="multipart/form-data">

        <label>course_name</label> <br>
        <input type="text" name="course_name" value="<?= $course_name ?>"><br>

        <label>price</label><br>
        <input type="number" name="price" value="<?= $price ?>"><br>

        <label for="">category_id</label><br>
        <select name="category_id">
            <?php
            while ($row_cou = mysqli_fetch_assoc($query_cou)) {

                $selected = ($row_cou['category_id'] == $category_id) ? 'selected' : '';
                echo "<option value='{$row_cou['category_id']}' $selected> 
                    {$row_cou['category_name']}
                </option>";
            }
            ?>

        </select><br>
        <label for="">image</label><br>
        <?php
        if (!empty($image)) : ?>
            <img src="../img/<?= $image ?>" width="100px">
        <?php endif; ?> <br>

        <input type="file" name="image"><br><br>

        <button class="sua" type="submit" name="sbm">Sửa</button>

    </form>
</body>

</html>