<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel='stylesheet' type='text/css' media='screen' href='./css/index.css'>
</head>
<body>
    <div class="login-container">
        <img src="https://abs.twimg.com/icons/apple-touch-icon-192x192.png" alt="Twitter Logo" width="50" height="50">
        
        <h1>Inicia sesión en Twitter</h1>

        <?php 
        session_start(); 
        if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger" role="alert">
                <?php 
                echo $_SESSION['error']; 
                unset($_SESSION['error']); 
                ?>
            </div>
        <?php endif; ?>

        <form action="./login/login.php" method="POST"> 
            <div class="form-group mb-3">
                <input type="text" class="form-control" id="username" name="username" placeholder="Nombre de usuario" required />
            </div>
            <div class="form-group mb-3">
                <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required 
                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                title="Debe contener al menos un número, una mayúscula y una minúscula, y al menos 8 o más caracteres"/>
            </div>
            <div class="form-group mb-3">
                <input id="sendBttn" type="submit" value="Iniciar sesión" class="btn btn-primary" name="submit"/>
            </div>
        </form>

        <div class="register-link">
            <a href="./registro/registroform.php">¿No tienes cuenta? Regístrate</a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
