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
        if ($_GET['error'] === 'usuario_inexistente') {
            echo "<p>No existe un usuario con ese nombre de usuario. Por favor, prueba con otro.</p>";
        } elseif ($_GET['error'] === 'contraseña_incorrecta') {
            echo "<p>La contraseña es incorrecta. Por favor, inténtalo de nuevo.</p>";
        }
    }
    ?>
</body>
</html>
