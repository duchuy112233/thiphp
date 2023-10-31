<?php
require_once '../connect/db.php';
$id = $_GET['id'];

$sql = "DELETE FROM courses WHERE id = $id";
$query = mysqli_query($conn, $sql);

header('Location: ../index.php');
