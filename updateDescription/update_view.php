<?php 
session_start();
include("../CRUD/connection.php");
$con = connection();

if (!isset($_GET['id'])) {
    header("Location: ../main/main.php");
    exit();
}

$user_id = $_GET['id'];
$sql = "SELECT * FROM users WHERE id='$user_id'";
$query = mysqli_query($con, $sql);
$user = mysqli_fetch_assoc($query);

if (!$user) {
    header("Location: ../main/main.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Descripción - <?php echo htmlspecialchars($user['username']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel='stylesheet' type='text/css' media='screen' href='../css/main.css'>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top border-bottom">
    <div class="container">
        <a class="navbar-brand" href="../main/main.php">
            <img src="https://img.freepik.com/vector-premium/nuevo-logotipo-twitter-x-2023-descarga-vector-logotipo-twitter-x_691560-10794.jpg" alt="Logo" height="40">
        </a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../main/main.php">Inicio</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5 pt-4">
    <h2 class="text-center">Editar Descripción</h2>

    <form action="update.php" method="POST">
        <div class="form-group">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['id']); ?>">
        </div>
        <div class="form-group">
            <textarea class="form-control" id="description" name="description" placeholder="Descripción" rows="5"><?php echo htmlspecialchars($user['description']); ?></textarea>
        </div>
        <input type="submit" class="m-3 btn btn-primary" value="Actualizar">
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
