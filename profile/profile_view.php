<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de <?php echo htmlspecialchars($user['username']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel='stylesheet' type='text/css' media='screen' href='../css/main.css'>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top border-bottom">
    <div class="container">
        <a class="navbar-brand" href="">
            <img src="https://img.freepik.com/vector-premium/nuevo-logotipo-twitter-x-2023-descarga-vector-logotipo-twitter-x_691560-10794.jpg" alt="Logo" height="40">
        </a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../main/main.php">Inicio</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5 pt-4">
    <h2 class="text-center">Perfil</h2>

    <div class="profile-info border p-4 mb-4 rounded bg-light">
        <h5>Información del usuario</h5>
        <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
        <p><strong>Correo electrónico:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        <p><strong>Descripción:</strong> <?php echo htmlspecialchars($user['description']); ?></p>
        
        <div class="d-flex justify-content-between mt-3">
            <?php if (isset($_SESSION['id']) && $_SESSION['id'] == $user['id']): ?>
                <a href="../updateDescription/update.php" class="btn btn-outline-primary">Editar descripción</a>
            <?php else: ?>
                <form action="profile.php?id=<?php echo $user['id']; ?>" method="POST" class="d-inline">
                    <button type="submit" name="follow" class="btn btn-outline-<?php echo $is_following ? 'danger' : 'primary'; ?>">
                        <?php echo $is_following ? 'Dejar de seguir' : 'Seguir'; ?>
                    </button>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <h3>Tweets de <?php echo htmlspecialchars($user['username']); ?></h3>
    <?php if (mysqli_num_rows($res_tweets) > 0): ?>
        <?php while ($tweet = mysqli_fetch_assoc($res_tweets)): ?>
            <div class="tweet p-3 border-bottom">
                <strong><a href="profile.php?id=<?php echo $tweet['userId']; ?>"><?php echo htmlspecialchars($user['username']); ?></a></strong>
                <p><?php echo htmlspecialchars($tweet['text']); ?></p>
                <small class="text-muted"><?php echo $tweet['createDate']; ?></small>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No hay tweets para mostrar.</p>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
