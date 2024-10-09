<?php
include("../CRUD/connection.php");
$con = connection();

if (!isset($_POST['id'])) {
    header("Location: ../main/main.php");
    exit();
}

$user_id = $_POST['id'];
$description = mysqli_real_escape_string($con, $_POST['description']);

$sql = "UPDATE users SET description='$description' WHERE id='$user_id'";
$res_user = mysqli_query($con, $sql);

if ($res_user) {
    header("Location: ./update_view.php?id=$user_id");
    exit();
} else {
    echo "Error al actualizar los datos.";
}
?>
