<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    require_once "../CRUD/connection.php";
    $connect = connection();

    // Verifica si las claves existen en $_POST
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
            header("Location: ../error/error.php?error=contraseña_incorrecta");
            exit();
        }
    } else {
        header("Location: ../error/error.php?error=usuario_no_encontrado");
        exit();
    }
}
?>
