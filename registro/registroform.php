<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel='stylesheet' type='text/css' media='screen' href='../css/registro.css'>
</head>
<body>
    <div class="register-container">
        <!-- Logo de Twitter-->
        <img src="https://abs.twimg.com/icons/apple-touch-icon-192x192.png" alt="Twitter Logo" width="50" height="50">
        
        <h1>Crea tu cuenta</h1>

        <!-- Mensajes de alerta (éxito o error) -->
        <?php 
        if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger" role="alert">
                <?php 
                echo $_SESSION['error']; 
                unset($_SESSION['error']); 
                ?>
            </div>
        <?php endif; ?>

        <form action="./registro.php" method="POST">
            <div class="form-group">
                <input type="text" class="form-control" id="username" name="username" placeholder="Nombre de usuario" required />
            </div>
            <div class="form-group">
                <input type="email" class="form-control" id="email" name="email" placeholder="Correo electrónico" required />
            </div>
            <div class="form-group">
                <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required 
                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                title="Debe contener al menos un número y una mayúscula y una minúscula, y al menos 8 o más caracteres"/>
            </div>
            <div class="form-group">
                <textarea class="form-control" id="description" name="description" placeholder="Descripción" rows="5" required></textarea>
            </div>
            <div class="form-group">
                <input type="date" class="form-control" id="createDate" name="createDate" 
                       value="<?php echo date('Y-m-d'); ?>" required hidden/>
            </div>
            <div class="form-group">
                <input id="sendBttn" type="submit" value="Regístrate" name="submit"/>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
