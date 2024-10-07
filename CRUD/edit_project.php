<?php
include("connection.php");
$con = connection();

$idAlumnos = $_POST["idAlumnos"];
$nombreAlumnos = $_POST['nombreAlumnos'];
$edad = $_POST['edad'];

$sql = "UPDATE alumnos SET nombreAlumnos='$nombreAlumnos', edad='$edad' WHERE idAlumnos='$idAlumnos'";
$query = mysqli_query($con, $sql);

if ($query) {
    Header("Location: ../index.php");
} else {
    echo "Error al actualizar los datos.";
}
?>
