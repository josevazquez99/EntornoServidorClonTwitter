<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
</head>
<body>
    <h1>Error</h1>
    <?php
    if (isset($_GET['error'])) {
        $error = $_GET['error'];
        if ($error === 'contraseña_incorrecta') {
            echo "<p>La contraseña es incorrecta. Por favor, inténtalo de nuevo.</p>";
        } elseif ($error === 'usuario_no_encontrado') {
            echo "<p>El nombre de usuario no se encuentra registrado. Por favor, verifica tu nombre de usuario o regístrate.</p>";
        } elseif ($error === 'usuario_existente') {
            echo "<p>El nombre de usuario o el correo electrónico ya están registrados. Por favor, prueba con otros.</p>";
        }
    }
    ?>
</body>
</html>
