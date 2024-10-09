<?php
session_start(); // Asegúrate de que la sesión esté iniciada

if (isset($_POST["submit"])) {
    require_once("../CRUD/connection.php");
    $connect = connection();

    $username = mysqli_real_escape_string($connect, $_POST["username"]);
    $password = mysqli_real_escape_string($connect, $_POST["password"]);
    $email = mysqli_real_escape_string($connect, $_POST["email"]);
    $description = mysqli_real_escape_string($connect, $_POST["description"]);
    $createDate = mysqli_real_escape_string($connect, $_POST["createDate"]);

    $checkUserSql = "SELECT * FROM users WHERE username='$username' OR email='$email'";
    $checkUserResult = mysqli_query($connect, $checkUserSql);

    if (mysqli_num_rows($checkUserResult) > 0) {
        $_SESSION['error'] = 'Error: El usuario o el correo electrónico ya están registrados.'; 
        header("Location: ./registro.php"); 
        exit();
    }

    if ($username && $username !== "" && $password && $password !== "") {
        $pass = password_hash($password, PASSWORD_BCRYPT, ["cost" => 4]);
        $sql = "INSERT INTO users VALUES(null, '$username','$email', '$pass','$description','$createDate');";
        $guardar = mysqli_query($connect, $sql);

        if ($guardar) {
            header("Location: ../index.php");
            exit();
        } else {
            $_SESSION['error'] = 'Error: No se pudo guardar el usuario.'; 
            header("Location: ./registro.php");
            exit();
        }
    }
}
?>
