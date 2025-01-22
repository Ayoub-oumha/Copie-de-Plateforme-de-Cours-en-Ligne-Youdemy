<?php
require_once '../auth/middleware.php';
requireAuth(); // Check if the user is authenticated

require_once '../classes/CourseManagement.php';
$courseManagement = new CourseManagement();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $courseId = $_POST['course_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $categoryId = $_POST['category_id']; // Assuming you have a category selection
    $tags = $_POST['tags']; // Assuming tags are sent as an array
    $thumbnail = $_FILES['thumbnail'];
    $content = $_FILES['content'];

    if ($courseManagement->updateCourse($courseId, $title, $description, $categoryId, $tags, $thumbnail, $content)) {
        header("Location: courses.php"); // Redirect to the courses page
        exit();
    } else {
        $error = "Failed to update course.";
    }
}

// Fetch the course details for editing
$courseId = $_GET['id']; // Get the course ID from the URL
$course = $courseManagement->getCourseById($courseId); // Implement this method

// Fetch categories for the dropdown (implement this in CategoryManagement)
require_once '../classes/CategoryManagement.php';
$categoryManagement = new CategoryManagement();
$categories = $categoryManagement->getAllCategories(); // Implement this method

// Fetch tags for the dropdown (implement this in TagManagement)
require_once '../classes/TagManagement.php';
$tagManagement = new TagManagement();
$allTags = $tagManagement->getAllTags(); // Implement this method

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Cours</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex">
    <?php include 'nav_teacher.php'; ?> <!-- Include the navigation bar -->

    <div class="container mx-auto mt-4">
        <h1 class="text-2xl font-bold mb-4">Modifier un Cours</h1>
        <?php if (isset($error)): ?>
            <p class="text-red-500"><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="" method="POST" enctype="multipart/form-data" class="space-y-6">
            <input type="hidden" name="course_id" value="<?php echo $course['id']; ?>">

            <!-- Titre du cours -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                    Titre du cours
                </label>
                <input type="text" 
                       id="title" 
                       name="title" 
                       value="<?php echo htmlspecialchars($course['title']); ?>" 
                       required 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="Entrez le titre du cours">
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                    Description
                </label>
                <textarea id="description" 
                          name="description" 
                          rows="4" 
                          required 
                          class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                          placeholder="Décrivez votre cours"><?php echo htmlspecialchars($course['description']); ?></textarea>
            </div>

            <!-- Catégorie -->
            <div>
                <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                    Catégorie
                </label>
                <select id="category" 
                        name="category_id" 
                        required 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Sélectionnez une catégorie</option>
                    <?php foreach($categories as $category): ?>
                        <option value="<?= $category["id"]?>" <?php echo $category["id"] == $course['category_id'] ? 'selected' : ''; ?>><?= $category["name"] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Tags -->
            <div>
                <label for="tags" class="block text-sm font-medium text-gray-700 mb-2">
                    Tags
                </label>
                <select id="tags" 
                        name="tags[]" 
                        multiple 
                        required 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <?php foreach($allTags as $tag): ?>
                        
                        <option value="<?= $tag["id"]?>"><?= $tag["name"] ?></option>
                    <?php endforeach; ?>
                </select>
                <p class="mt-1 text-sm text-gray-500">Maintenez Ctrl (Cmd sur Mac) pour sélectionner plusieurs tags</p>
            </div>

            <!-- Image du cours -->
            <div>
                <label for="thumbnail" class="block text-sm font-medium text-gray-700 mb-2">
                    Image du cours
                </label>
                <input type="file" 
                       id="thumbnail" 
                       name="thumbnail" 
                       accept="image/*"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <p class="mt-1 text-sm text-gray-500">Format recommandé : JPG, PNG (max 2MB)</p>
            </div>

            <!-- Contenu du cours -->
            <div>
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                    Contenu du cours
                </label>
                <input type="file" 
                       id="content" 
                       name="content" 
                       accept=".pdf,.mp4,.zip"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <p class="mt-1 text-sm text-gray-500">Formats acceptés : PDF, MP4, ZIP (max 500MB)</p>
            </div>

            <!-- Bouton de soumission -->
            <div class="flex justify-end">
                <button type="submit" name="updatecoursebtn"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Modifier le cours
                </button>
            </div>
        </form>
    </div>
</body>
</html> 