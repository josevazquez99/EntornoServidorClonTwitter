<?php
// Iniciar la sesión
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['id'])) {
    header("Location: ../index.php");
    exit();
}

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "social_network"; // Reemplaza con el nombre de tu base de datos

$conn = new mysqli($servername, $username, $password, $dbname);

// Obtener la información del usuario logueado
$user_id = $_SESSION['id'];
$sql_user = "SELECT * FROM users WHERE id = $user_id";
$result_user = $conn->query($sql_user);
$user = $result_user->fetch_assoc();

// Manejar el formulario para un nuevo tweet
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tweet_text = $_POST['tweet_text'];
    if (!empty($tweet_text)) {
        $stmt = $conn->prepare("INSERT INTO publications (userId, text, createDate) VALUES (?, ?, NOW())");
        $stmt->bind_param("is", $user_id, $tweet_text);
        $stmt->execute();
        $stmt->close();
    }
}

// Mostrar los tweets de las personas que sigue o todos los tweets
$show_all = isset($_GET['show_all']) ? true : false;

if ($show_all) {
    // Obtener todos los tweets de todos los usuarios
    $sql_tweets = "SELECT p.*, u.username FROM publications p INNER JOIN users u ON p.userId = u.id ORDER BY p.createDate DESC";
} else {
    // Obtener los tweets de las personas que sigue el usuario
    $sql_tweets = "SELECT p.*, u.username FROM follows f
                   INNER JOIN publications p ON f.userToFollowId = p.userId
                   INNER JOIN users u ON p.userId = u.id
                   WHERE f.users_id = $user_id ORDER BY p.createDate DESC";
}

$result_tweets = $conn->query($sql_tweets);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página principal</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 20px;
        }
        .tweet {
            background: white;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

<div class="container">
    <h1 class="text-center">Bienvenido, <?php echo htmlspecialchars($user['username']); ?>!</h1>

    <!-- Formulario para nuevo tweet -->
    <form action="main.php" method="POST" class="mb-4">
        <div class="form-group">
            <textarea name="tweet_text" class="form-control" placeholder="Escribe un nuevo tweet..." rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Publicar</button>
    </form>

    <!-- Enlace para ver todos los tweets o solo los seguidos -->
    <div class="mb-3">
        <?php if ($show_all): ?>
            <a href="main.php" class="btn btn-link">Mostrar solo tweets de las personas que sigues</a>
        <?php else: ?>
            <a href="main.php?show_all=1" class="btn btn-link">Mostrar todos los tweets</a>
        <?php endif; ?>
    </div>

    <!-- Mostrar los tweets -->
    <h2>Tweets</h2>
    <?php while ($tweet = $result_tweets->fetch_assoc()): ?>
        <div class="tweet">
            <strong><a href="profile.php?id=<?php echo $tweet['userId']; ?>"><?php echo htmlspecialchars($tweet['username']); ?></a></strong><br>
            <p><?php echo htmlspecialchars($tweet['text']); ?></p>
            <small class="text-muted"><?php echo $tweet['createDate']; ?></small>
        </div>
    <?php endwhile; ?>

    <!-- Enlace para cerrar sesión -->
    <a href="../session/logout.php" class="btn btn-danger">Cerrar sesión</a>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
