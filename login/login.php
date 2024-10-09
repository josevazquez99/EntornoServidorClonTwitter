<?php
session_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "../CRUD/connection.php";
    $connect = connection();

    $username = isset($_POST["username"]) ? trim($_POST["username"]) : '';
    $pass = isset($_POST["password"]) ? $_POST["password"] : '';

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $res = mysqli_query($connect, $sql);

    if ($res && mysqli_num_rows($res) == 1) {
        $usuario = mysqli_fetch_assoc($res);

        if (password_verify($pass, $usuario["password"])) {
            $_SESSION["usuario"] = $usuario["username"];
            $_SESSION["id"] = $usuario["id"];
            header("Location: ../main/main.php");
            exit(); 
        } else {
            // Mensaje de error si la contraseña no coincide
            $_SESSION['error'] = 'Error: Contraseña incorrecta.';
        }
    } else {
        $_SESSION['error'] = 'Error: Usuario no encontrado.';
    }

    // Redirigir de nuevo a la página de inicio de sesión
    header("Location: ../index.php");
    exit();
}
?>
