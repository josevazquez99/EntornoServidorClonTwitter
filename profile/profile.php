<?php
session_start();
require_once "../CRUD/connection.php";
$connect = connection();

// Verificamos si se ha proporcionado un ID de usuario
if (!isset($_GET['id'])) {
    header("Location: ../main/main.php");
    exit();
}

// Obtenemos información del usuario
$user_id = $_GET['id'];
$sql_user = "SELECT * FROM users WHERE id = $user_id";
$res_user = mysqli_query($connect, $sql_user);
$user = mysqli_fetch_assoc($res_user);

// Verificamos si el usuario existe
if (!$user) {
    header("Location: ../error/error.php?error=usuario_no_encontrado");
    exit();
}

// Verificamos si el usuario logueado está siguiendo al perfil
$is_following = false;
if (isset($_SESSION['id'])) {
    $user_id_actual = $_SESSION['id'];
    $sql_following = "SELECT * FROM follows WHERE users_id = $user_id_actual AND userToFollowId = $user_id";
    $res_following = mysqli_query($connect, $sql_following);
    $is_following = mysqli_num_rows($res_following) > 0;
}

// Manejamos el seguimiento
if (isset($_POST['follow'])) {
    if ($is_following) {
        // Dejar de seguir
        $sql_unfollow = "DELETE FROM follows WHERE users_id = $user_id_actual AND userToFollowId = $user_id";
        mysqli_query($connect, $sql_unfollow);
        $is_following = false;
    } else {
        // Seguir
        $sql_follow = "INSERT INTO follows (users_id, userToFollowId) VALUES ($user_id_actual, $user_id)";
        mysqli_query($connect, $sql_follow);
        $is_following = true;
    }
}

// Obtenemos los tweets del usuario
$sql_tweets = "SELECT * FROM publications WHERE userId = $user_id ORDER BY createDate DESC";
$res_tweets = mysqli_query($connect, $sql_tweets);

include 'profile_view.php'; 
mysqli_close($connect);
?>
