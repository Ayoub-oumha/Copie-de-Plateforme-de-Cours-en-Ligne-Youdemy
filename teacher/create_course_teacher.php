<?php
require_once '../auth/middleware.php';
requireAuth(); // Check if the user is authenticated

require_once '../classes/CourseManagement.php';
$courseManagement = new CourseManagement();

require_once "../classes/document_course.php" ;
require_once "../classes/vedio_course.php" ;

// Handle form submission
if ( isset($_POST["createnewcoursebtn"])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $teacherId = $_SESSION['user_id']; 
    $categoryId = $_POST['category_id']; 
    $tags = $_POST['tags']; 
    $thumbnail = $_FILES['thumbnail'];
    $content = $_POST['content'];
    $contentType = $_POST['content_type']; 

    if ($contentType === 'document') {
        
        $type = "text";
        $addcCourse = new Document ($content , $type  ,$title, $description, $teacherId, $categoryId, $tags, $thumbnail) ;
    } elseif ($contentType === 'video') {
      
        $type = "video";
        $videoUrl = $_POST['video_url']; 
        $addcCourse = new Vedio  ($videoUrl , $type  ,$title, $description, $teacherId, $categoryId, $tags, $thumbnail) ;
    }

    if ($addcCourse->addCourse()) {
        header("Location: courses.php");
        exit();
    } else {
        $error = "Failed to add course.";
    }
    echo $content ;
}


require_once '../classes/CategoryManagement.php';
$categoryManagement = new CategoryManagement();
$categories = $categoryManagement->getAllCategories(); // Implement this method


require_once '../classes/TagManagement.php';
$tagManagement = new TagManagement();
$allTags = $tagManagement->getAllTags(); // Implement this method

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Cours</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script>
        function toggleContentInput() {
            const contentType = document.getElementById('content_type').value;
            const documentInput = document.getElementById('document_input');
            const videoInput = document.getElementById('video_input');

            if (contentType === 'document') {
                documentInput.style.display = 'block';
                videoInput.style.display = 'none';
            } else if (contentType === 'video') {
                documentInput.style.display = 'none';
                videoInput.style.display = 'block';
            }
        }
    </script>
</head>
<body class="bg-gray-100 flex">
    <?php include 'nav_teacher.php'; ?> <!-- Include the navigation bar -->

    <div class="container mx-auto mt-4">
        <h1 class="text-2xl font-bold mb-4">Ajouter un Cours</h1>
        <?php if (isset($error)): ?>
            <p class="text-red-500"><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="" method="POST" enctype="multipart/form-data" class="space-y-6">
            <!-- Titre du cours -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                    Titre du cours
                </label>
                <input type="text" 
                       id="title" 
                       name="title" 
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
                          placeholder="Décrivez votre cours"></textarea>
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
                        <option value="<?= $category["id"]?>"><?= $category["name"] ?></option>
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

            <!-- Content Type Selection -->
            <div>
                <label for="content_type" class="block text-sm font-medium text-gray-700 mb-2">
                    Type de contenu
                </label>
                <select id="content_type" 
                        name="content_type" 
                        required 
                        onchange="toggleContentInput()"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="document">Document</option>
                    <option value="video">Vidéo</option>
                </select>
            </div>

            <!-- Document Input -->
            <div id="document_input" style="display: block;">
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                    Contenu du cours (Document)
                </label>
                <textarea 
                placeholder="Write your course here..."
                       id="content" 
                       name="content" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                <p class="mt-1 text-sm text-gray-500">Text</p>
            </div>

            <!-- Video Input -->
            <div id="video_input" style="display: none;">
                <label for="video_url" class="block text-sm font-medium text-gray-700 mb-2">
                    URL de la Vidéo
                </label>
                <input type="text" 
                       id="video_url" 
                       name="video_url" 
                       
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="Entrez l'URL de la vidéo">
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
                       required 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <p class="mt-1 text-sm text-gray-500">Format recommandé : JPG, PNG (max 2MB)</p>
            </div>

            <!-- Bouton de soumission -->
            <div class="flex justify-end">
                <button type="submit" name="createnewcoursebtn"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Créer le cours
                </button>
            </div>
        </form>
    </div>
</body>
</html> 