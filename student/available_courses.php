<?php
require_once '../auth/middleware.php';
requireAuth(); 
require_once '../classes/CourseManagement.php';
$courseManagement = new CourseManagement();


$allCourses = $courseManagement->getAllCourses();


$studentId = $_SESSION['user_id'];
$enrolledCourses = $courseManagement->getEnrolledCourses($studentId);
$enrolledCourseIds = array_column($enrolledCourses, 'id');


require_once '../classes/CategoryManagement.php';
$categoryManagement = new CategoryManagement();
$categories = $categoryManagement->getAllCategories();


$searchTerm = isset($_GET['search']) ? trim($_GET['search']) : '';
$categoryId = isset($_GET['category']) && !empty($_GET['category']) ? $_GET['category'] : null;



$allCourses = $courseManagement->searchCourses($searchTerm, $categoryId);


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['enroll'])) {
    $courseId = $_POST['course_id'];
    
    try {
        if ($courseManagement->enrollStudent($studentId, $courseId)) {
            header("Location: view_course.php?id=" . $courseId);
            exit();
        } else {
            $error = "L'inscription au cours a échoué. Vous êtes peut-être déjà inscrit à ce cours.";
        }
    } catch (Exception $e) {
        $error = "Une erreur est survenue lors de l'inscription. Veuillez réessayer.";
    }
}


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cours Disponibles</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body class="bg-gray-100 flex">
    <?php include 'nav_student.php'; ?>

    <div class="flex-1 p-8">
        <h1 class="text-2xl font-bold mb-6">Cours Disponibles</h1>

        <?php if (isset($error)): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <!-- Search and Filter Section -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <form method="GET" class="flex flex-wrap gap-4">
                <input type="text" 
                       name="search"
                       value="<?php echo htmlspecialchars($searchTerm); ?>"
                       placeholder="Rechercher un cours..." 
                       class="flex-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                
                <select name="category" 
                        class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Toutes les catégories</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category['id']; ?>"
                                <?php echo $categoryId == $category['id'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($category['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                
                <button type="submit" 
                        class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                    <i class="fas fa-search mr-2"></i>
                    Rechercher
                </button>

                <?php if (!empty($searchTerm) || !empty($categoryId)): ?>
                    <a href="available_courses.php" 
                       class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
                        <i class="fas fa-times mr-2"></i>
                        Réinitialiser
                    </a>
                <?php endif; ?>
            </form>

            <!-- Afficher le nombre de résultats -->
            <?php if (!empty($searchTerm) || !empty($categoryId)): ?>
                <div class="mt-4 text-gray-600">
                    <?php echo count($allCourses); ?> cours trouvé(s)
                </div>
            <?php endif; ?>
        </div>

        <!-- Courses Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($allCourses as $course): 
                $tags = $courseManagement->getCourseTags($course['id']);
            ?>
                <div class="bg-white border border-gray-200 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                    <!-- Course Image -->
                    <figure class="relative">
                        <?php if ($course['photo_cover']): ?>
                            <img src="data:image/jpeg;base64,<?php echo base64_encode($course['photo_cover']) ?>" 
                                 alt="<?php echo htmlspecialchars($course['title']) ?>" 
                                 class="w-full h-48 object-cover rounded-t-lg">
                        <?php endif; ?>

                        <!-- Category Badge -->
                        <?php if ($course['category_name']): ?>
                            <div class="absolute top-4 left-4 bg-blue-500 text-white text-xs font-semibold px-3 py-1 rounded-full shadow">
                                <?php echo htmlspecialchars($course['category_name']) ?>
                            </div>
                        <?php endif; ?>
                    </figure>

                    <!-- Card Content -->
                    <div class="p-6">
                        <!-- Tags -->
                        <?php if (!empty($tags)): ?>
                            <div class="flex flex-wrap gap-2 mb-3">
                                <?php foreach ($tags as $tag): ?>
                                    <span class="bg-gray-100 text-gray-700 text-xs font-medium px-2 py-1 rounded-full">
                                        <?php echo htmlspecialchars($tag['name']) ?>
                                    </span>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <!-- Course Title -->
                        <h3 class="text-lg font-bold text-gray-900 mb-2">
                            <?php echo htmlspecialchars($course['title']) ?>
                        </h3>

                        <!-- Teacher Name -->
                        <div class="flex items-center text-gray-600 text-sm mb-3">
                            <i class="fas fa-user-tie mr-2"></i>
                            <span><?php echo htmlspecialchars($course['teacher_name'] ?? 'Professeur') ?></span>
                        </div>

                        <!-- Course Description -->
                        <p class="text-gray-700 text-sm mb-4 line-clamp-2">
                            <?php echo htmlspecialchars($course['description']) ?>
                        </p>

                        <!-- Course Stats -->
                        <div class="flex justify-between items-center mb-4">
                            <div class="flex items-center text-yellow-400">
                                <?php for($i = 0; $i < 5; $i++): ?>
                                    <i class="fas fa-star"></i>
                                <?php endfor; ?>
                                <span class="text-gray-600 text-xs ml-2">(5.0)</span>
                            </div>
                            <div class="flex items-center text-gray-600 text-sm">
                                <i class="fas fa-users mr-1"></i>
                                <span>0 étudiants</span>
                            </div>
                        </div>

                        <!-- Enrollment Button -->
                        <?php if (in_array($course['id'], $enrolledCourseIds)): ?>
                            <button class="w-full bg-gray-500 text-white text-sm font-semibold px-4 py-2 rounded-lg cursor-not-allowed" disabled>
                                Déjà inscrit
                            </button>
                        <?php else: ?>
                            <form method="POST" action="">
                                <input type="hidden" name="course_id" value="<?php echo $course['id']; ?>">
                                <button type="submit" 
                                        name="enroll" 
                                        class="w-full bg-blue-500 hover:bg-blue-600 text-white text-sm font-semibold px-4 py-2 rounded-lg transition-colors">
                                    S'inscrire au cours
                                </button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</body>
</html> 