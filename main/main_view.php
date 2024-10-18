<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página principal</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel='stylesheet' type='text/css' media='screen' href='../css/main.css'>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top border-bottom">
  <div class="container">
    <a class="navbar-brand" href=""><img src="https://img.freepik.com/vector-premium/nuevo-logotipo-twitter-x-2023-descarga-vector-logotipo-twitter-x_691560-10794.jpg" alt="Logo" height="40"></a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="main.php">Inicio</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-5 pt-4">
    <div class="row">
        <div class="col-md-3 d-none d-md-block">
            <div class="profile-section p-3 border">
                <h5>Bienvenido, <?php echo htmlspecialchars($user['username']); ?>!</h5>
                <a href="../profile/profile.php?id=<?php echo $user['id']; ?>" class="btn btn-outline-primary btn-sm mt-2">Ver perfil</a>
            </div>
        </div>

        <div class="col-md-6">
            <!-- Formulario para nuevo tweet -->
            <form action="main.php" method="POST" class="mb-4">
                <div class="form-group">
                    <textarea name="tweet_text" class="form-control tweet-box" placeholder="¿Qué está pasando?" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary mt-2 w-100">Twittear</button>
            </form>

            <!-- Enlace para mostrar todos los tweets o solo los de seguidos -->
            <div class="mb-3">
                <?php if ($show_all): ?>
                    <a href="main.php" class="btn btn-link">Mostrar solo tweets de las personas que sigues</a>
                <?php else: ?>
                    <a href="main.php?show_all=1" class="btn btn-link">Mostrar todos los tweets</a>
                <?php endif; ?>
            </div>

            <!-- Mostramos los tweets -->
            <h2 class="mt-4 mb-3">Inicio</h2>
            <?php while ($tweet = $result_tweets->fetch_assoc()): ?>
                <div class="tweet p-3 border-bottom">
                    <strong>
                        <a href="../profile/profile.php?id=<?php echo $tweet['userId']; ?>"><?php echo htmlspecialchars($tweet['username']); ?></a>
                    </strong>
                    <p><?php echo htmlspecialchars($tweet['text']); ?></p>
                    <small class="text-muted"><?php echo $tweet['createDate']; ?></small>
                </div>
            <?php endwhile; ?>
        </div>

        <div class="col-md-3 d-none d-md-block">
            <div class="p-3 border">
                <h5>Opciones</h5>
                <div class="btn-group-vertical w-100">
                    <a href="../session/logout.php" class="btn btn-danger">Cerrar sesión</a>
                    <a href="../followers/followers.php" class="btn btn-outline-secondary">Seguidores (<?php echo $follower_count; ?>)</a>
                    <a href="../following/following.php" class="btn btn-outline-secondary">Siguiendo (<?php echo $following_count; ?>)</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
