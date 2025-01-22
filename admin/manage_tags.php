<?php
require_once '../auth/middleware.php';
requireAdminAuth(); // Check if the user is authenticated and is an admin

require_once '../classes/TagManagement.php';

$tagManagement = new TagManagement();
$tags = $tagManagement->getAllTags();

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add'])) {
        $name = $_POST['name'];
        $tagManagement->addTag($name);
    } elseif (isset($_POST['delete'])) {
        $tagId = $_POST['tag_id'];
        $tagManagement->deleteTag($tagId);
    }

    // Redirect to the same page to refresh the tag list
    header("Location: manage_tags.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Tags</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="path/to/your/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
<?php include 'nav_bar.php'; ?>

    <div class="container mx-auto mt-4">
        <h1 class="text-2xl font-bold mb-4">Gestion des Tags</h1>
        
        <form method="POST" class="mb-4">
            <input type="text" name="name" placeholder="Nom du tag" required class="border rounded p-2 mr-2">
            <button type="submit" name="add" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-3 rounded">Ajouter Tag</button>
        </form>

        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">ID</th>
                    <th class="py-3 px-6 text-left">Nom</th>
                    <th class="py-3 px-6 text-left">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                <?php foreach ($tags as $tag): ?>
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left"><?php echo $tag['id']; ?></td>
                        <td class="py-3 px-6 text-left"><?php echo $tag['name']; ?></td>
                        <td class="py-3 px-6 text-left">
                            <form method="POST" action="">
                                <input type="hidden" name="tag_id" value="<?php echo $tag['id']; ?>">
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