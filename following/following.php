<?php
session_start(); 

require_once("../CRUD/connection.php");
$con = connection();

if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id']; 

    $user_id = mysqli_real_escape_string($con, $user_id);

    $sql = "SELECT u.username, u.email, u.description
            FROM follows f
            INNER JOIN users u ON f.userToFollowId = u.id 
            WHERE f.users_id = $user_id;";

    $query = mysqli_query($con, $sql);
} else {
    $error_message = "No estás autenticado. Por favor inicia sesión.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siguiendo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa; 
        }
        .card {
            border: none; 
            border-radius: 10px; 
            transition: transform 0.2s; 
        }
        .card:hover {
            transform: scale(1.05); 
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h1 class="text-center mb-4">Siguiendo</h1>

        <?php if (isset($error_message)): ?>
            <div class='alert alert-warning' role='alert'><?php echo $error_message; ?></div>
        <?php else: ?>
            <div class="row"> 
                <?php
                if (!$query) {
                    echo "<div class='alert alert-danger' role='alert'>Error en la consulta: " . mysqli_error($con) . "</div>";
                } else {
                    while ($row = mysqli_fetch_assoc($query)) {
                        echo "<div class='col-md-4'>"; 
                        echo "<div class='card mb-4 shadow-sm'>"; 
                        echo "<div class='card-body'>";
                        echo "<h5 class='card-title'>" . htmlspecialchars($row['username']) . "</h5>";
                        echo "<h6 class='card-subtitle mb-2 text-muted'>" . htmlspecialchars($row['email']) . "</h6>";
                        echo "<p class='card-text'>" . htmlspecialchars($row['description']) . "</p>";
                        echo "</div>"; 
                        echo "</div>"; 
                        echo "</div>"; 
                    }
                }
                ?>
            </div> 
        <?php endif; ?>
    </div> 
</body>
</html>
