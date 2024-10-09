<?php
session_start();
include("../CRUD/connection.php");
$con = connection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_POST['id'])) {
        header("Location: ../main/main.php");
        exit();
    }

    $user_id = $_POST['id'];
    $description = mysqli_real_escape_string($con, $_POST['description']); 

    $sql = "UPDATE users SET description='$description' WHERE id='$user_id'";
    $res_user = mysqli_query($con, $sql);

    if ($res_user) {
        header("Location: ../updateDescription/update_view.php?id=$user_id"); 
    } else {
        echo "Error al actualizar los datos.";
    }
}
?>
