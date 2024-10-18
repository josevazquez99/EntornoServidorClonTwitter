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

// Consulta para contar el número total de seguidores
$count_sql = "SELECT COUNT(*) as follower_count
              FROM follows
              WHERE userToFollowId = $user_id;";
$count_query = $conn->query($count_sql);
$follower_count = 0;
if ($count_query) {
    $count_result = $count_query->fetch_assoc();
    $follower_count = $count_result['follower_count'];
}



// Consulta para contar el número total de seguidores
$count_sql = "SELECT COUNT(*) as following_count
              FROM follows
              WHERE users_id = $user_id;";  // El usuario logueado es el que sigue a otros
$count_query = $conn->query($count_sql);
$following_count = 0;
if ($count_query) {
    $count_result = $count_query->fetch_assoc();
    $following_count = $count_result['following_count'];
}



// Mostramos los tweets de las personas que sigue o todos los tweets
$show_all = isset($_GET['show_all']) ? true : false;

if ($show_all) {
    $sql_tweets = "SELECT p.*, u.username FROM publications p INNER JOIN users u ON p.userId = u.id ORDER BY p.createDate DESC";
} else {
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
