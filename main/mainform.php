
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página principal</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel='stylesheet' type='text/css' media='screen' href='./css/main.css'>

</head>
<body>

<div class="container">
    <h1 class="text-center">Bienvenido, <?php echo htmlspecialchars($user['username']); ?>!</h1>

    <!-- Formulario para nuevo tweet -->
    <form action="./main.php" method="POST" class="mb-4">
        <div class="form-group">
            <textarea name="tweet_text" class="form-control" placeholder="Escribe un nuevo tweet..." rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Publicar</button>
    </form>

    <!-- Enlace para ver todos los tweets o solo los seguidos -->
    <div class="mb-3">
        <?php if ($show_all): ?>
            <a href="./main.php" class="btn btn-link">Mostrar solo tweets de las personas que sigues</a>
        <?php else: ?>
            <a href="./main.php?show_all=1" class="btn btn-link">Mostrar todos los tweets</a>
        <?php endif; ?>
    </div>

    <!-- Mostrar los tweets -->
    <h2>Tweets</h2>
    <?php while ($tweet = $result_tweets->fetch_assoc()): ?>
        <div class="tweet">
            <strong><a href="profile.php?id=<?php echo $tweet['userId']; ?>"><?php echo htmlspecialchars($tweet['username']); ?></a></strong><br>
            <p><?php echo htmlspecialchars($tweet['text']); ?></p>
            <small class="text-muted"><?php echo $tweet['createDate']; ?></small>
        </div>
    <?php endwhile; ?>

    <!-- Enlace para cerrar sesión -->
    <a href="../session/logout.php" class="btn btn-danger">Cerrar sesión</a>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
