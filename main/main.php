<?php
session_start();

// Verificamos si el usuario está logueado
if (!isset($_SESSION['id'])) {
    header("Location: ../index.php");
    exit();
}

// Conexión a la base de datos
require_once "../CRUD/connection.php";
$conn = connection();

// información del usuario logueado
$user_id = $_SESSION['id'];
$sql_user = "SELECT * FROM users WHERE id = $user_id";
$result_user = $conn->query($sql_user);
$user = $result_user->fetch_assoc();

//  formulario para un nuevo tweet
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

// Incluimos la vista
require_once "main_view.php";

$conn->close();
?>
