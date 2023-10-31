<?php

require_once 'connect/db.php';
$sql = "SELECT * FROM course_categories inner join courses on course_categories.category_id = courses.category_id";
$query = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .them{
            background-color: blue;
        }
        .them a{
            text-decoration: none;
            color: white;
        }
        .sua{
            background-color: blue;
        }
        .sua a{
            text-decoration: none;
            color: white;
        }
        .xoa{
            background-color: red;
        }
        .xoa a{
            text-decoration: none;
            color: white;
        }
    </style>
</head>

<body>
    <table border="1">
        <thead>
            <th>UID</th>
            <th>Course_name</th>
            <th>Price</th>
            <th>Category_id</th>
            <th>Image</th>
            <th>Sua/Xoa</th>
        </thead>
        <tbody>

            <?php
            $i = 1;
            while ($row = mysqli_fetch_assoc($query)) { ?>
                <tr>
                    <td><?php echo $i++ ?></td>
                    <td><?php echo $row['course_name'] ?></td>
                    <td><?php echo $row['price'] ?></td>
                    <td><?php echo $row['category_name'] ?></td>
                    <td>
                        <img src="img/<?php echo $row['image'] ?>" width="100px">
                    </td>

                    <td>
                        <button class="sua"><a href="danhsach/sua.php?id=<?= $row['id'] ?>">Sửa</a></button>
                        <button class="xoa"><a href="javascript:;" onclick="del(<?= $row['id'] ?>)">Xoá</a></button>
                    </td>

                </tr>

            <?php   } ?>

        </tbody>
    </table>
    <button class="them"><a href="danhsach/them.php">Thêm mới</a></button>
    <script>
        function del(id) {
            if (confirm("Bạn có chắc chắn muốn xoá không ?")) {
                window.location.href = 'danhsach/xoa.php?id=' + id;
            }
        }
    </script>
</body>

</html>