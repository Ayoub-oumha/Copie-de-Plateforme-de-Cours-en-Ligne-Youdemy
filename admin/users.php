<?php
require_once '../auth/middleware.php';
requireAdminAuth();
require_once '../classes/UserManagementAdmin.php';

$userManagement = new UserManagementAdmin();
$users = $userManagement->getAllUsers();

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_POST['user_id'];

    if (isset($_POST['activate'])) {
        $userManagement->activateUser($userId);
    } elseif (isset($_POST['suspend'])) {
        $userManagement->suspendUser($userId);
    } elseif (isset($_POST['delete'])) {
        $userManagement->deleteUser($userId);
    }

    // Redirect to the same page to refresh the user list
    header("Location: users.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Utilisateurs</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="path/to/your/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
        <?php include 'nav_bar.php'; ?>

    <div class="container mx-auto mt-4">
        <h1 class="text-2xl font-bold mb-4">Gestion des Utilisateurs</h1>
        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">ID</th>
                    <th class="py-3 px-6 text-left">Nom d'utilisateur</th>
                    <th class="py-3 px-6 text-left">Email</th>
                    <th class="py-3 px-6 text-left">Rôle</th>
                    <th class="py-3 px-6 text-left">Statut</th>
                    <th class="py-3 px-6 text-left">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                <?php foreach ($users as $user): ?>
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left"><?php echo $user['id']; ?></td>
                        <td class="py-3 px-6 text-left"><?php echo $user['name']; ?></td>
                        <td class="py-3 px-6 text-left"><?php echo $user['email']; ?></td>
                        <td class="py-3 px-6 text-left"><?php echo $user['role']; ?></td>
                        <td class="py-3 px-6 text-left"><?php echo $user['status']; ?></td>
                        <td class="py-3 px-6 text-left">
                            <form method="POST" action="">
                                <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                <?php if ($user['status'] == 'active'): ?>
                                    <button type="submit" name="suspend" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 px-3 rounded">Suspendre</button>
                                <?php else: ?>
                                    <button type="submit" name="activate" class="bg-green-500 hover:bg-green-600 text-white font-bold py-1 px-3 rounded">Activer</button>
                                <?php endif; ?>
                                <button type="submit" name="delete" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>