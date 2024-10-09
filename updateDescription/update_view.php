<?php 
include("../CRUD/connection.php");
$con = connection();

if (!isset($_GET['id'])) {
    header("Location: ../main/main.php");
    exit();
}

$user_id = $_GET['id'];

$sql = "SELECT * FROM users WHERE id='$user_id'";
$query = mysqli_query($con, $sql);

if (mysqli_num_rows($query) == 0) {
    echo "No se encontró el usuario.";
    exit();
}

$row = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Este es un ejemplo crud">
    <meta name="keywords" content="html, css, bootstrap, js, portfolio, proyectos, php">
    <meta name="language" content="EN">
    <meta name="author" content="joaquin.borrego@vedruna.es">
    <meta name="robots" content="index,follow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit Description</title>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Actualizar Descripcion</h1>
        <form action="./update.php" method="POST">
            <div class="form-group">
                <input type="hidden" class="form-control" name="id" value="<?= $row['id'] ?>"> 
            </div>
            <div class="form-group">
                <textarea class="form-control" id="description" name="description" placeholder="Descripción" rows="5"><?= $row['description'] ?></textarea> <!-- Corrige value por el contenido entre las etiquetas -->
            </div>
            <input type="submit" class="m-3 btn btn-primary" value="Actualizar">
        </form>
    </div>
</body>
</html>
