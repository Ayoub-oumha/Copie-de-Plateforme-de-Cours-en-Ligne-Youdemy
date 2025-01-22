<?php
require_once '../auth/middleware.php';
requireAdminAuth();
require_once '../classes/CategoryManagement.php';

$categoryManagement = new CategoryManagement();
$categories = $categoryManagement->getAllCategories();

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add'])) {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $categoryManagement->addCategory($name, $description);
    } elseif (isset($_POST['delete'])) {
        $categoryId = $_POST['category_id'];
        $categoryManagement->deleteCategory($categoryId);
    }

    // Redirect to the same page to refresh the category list
    header("Location: manage_categories.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Catégories</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="path/to/your/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
<?php include 'nav_bar.php'; ?>

    <div class="container mx-auto mt-4">
        <h1 class="text-2xl font-bold mb-4">Gestion des Catégories</h1>
        
        <form method="POST" class="mb-4">
            <input type="text" name="name" placeholder="Nom de la catégorie" required class="border rounded p-2 mr-2">
            <input type="text" name="description" placeholder="Description" required class="border rounded p-2 mr-2">
            <button type="submit" name="add" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-3 rounded">Ajouter Catégorie</button>
        </form>

        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">ID</th>
                    <th class="py-3 px-6 text-left">Nom</th>
                    <th class="py-3 px-6 text-left">Description</th>
                    <th class="py-3 px-6 text-left">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                <?php foreach ($categories as $category): ?>
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left"><?php echo $category['id']; ?></td>
                        <td class="py-3 px-6 text-left"><?php echo $category['name']; ?></td>
                        <td class="py-3 px-6 text-left"><?php echo $category['description']; ?></td>
                        <td class="py-3 px-6 text-left">
                            <form method="POST" action="">
                                <input type="hidden" name="category_id" value="<?php echo $category['id']; ?>">
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