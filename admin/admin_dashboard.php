<?php
require_once '../auth/middleware.php';
requireAdminAuth();
require_once '../Config/config.php';

require_once "../classes/admin-class.php" ;



$dashboard = new AdminDashboard();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord Administrateur</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="path/to/your/css/styles.css">
</head>
<body>
    <?php include 'nav_bar.php'; ?>

    <div class="container mt-4">
        <h1>Tableau de Bord Administrateur</h1>
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Total Utilisateurs</h5>
                        <p class="card-text"><?php echo $dashboard->getTotalUsers(); ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Total Cours</h5>
                        <p class="card-text"><?php echo $dashboard->getTotalCourses(); ?></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Ajoutez d'autres sections ou cartes pour plus de statistiques -->
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html> 