<?php
require_once '../auth/middleware.php';
requireAuth();

require_once '../classes/CourseManagement.php';
$courseManagement = new CourseManagement();

// Récupérer l'ID du cours depuis l'URL
$courseId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if (!$courseId) {
    header('Location: available_courses.php');
    exit();
}

// Récupérer les détails du cours
$course = $courseManagement->getCourseDetails($courseId);
$tags = $courseManagement->getCourseTags($courseId);

// Vérifier si le cours existe
if (!$course) {
    header('Location: available_courses.php');
    exit();
}

// Vérifier si l'étudiant est inscrit
$studentId = $_SESSION['user_id'];
$enrolledCourses = $courseManagement->getEnrolledCourses($studentId);
$isEnrolled = in_array($courseId, array_column($enrolledCourses, 'id'));
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($course['title']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body class="bg-gray-100 flex">
    <?php include 'nav_student.php'; ?>

    <div class="flex-1 p-8">
        <div class="max-w-4xl mx-auto">
            <!-- Course Header -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
                <div class="relative">
                    <?php if ($course['photo_cover']): ?>
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($course['photo_cover']); ?>"
                             alt="<?php echo htmlspecialchars($course['title']); ?>"
                             class="w-full h-64 object-cover">
                    <?php endif; ?>
                    <div class="absolute top-4 left-4">
                        <span class="bg-blue-500 text-white px-3 py-1 rounded-full text-sm">
                            <?php echo htmlspecialchars($course['category_name']); ?>
                        </span>
                    </div>
                </div>

                <div class="p-6">
                    <h1 class="text-3xl font-bold mb-4">
                        <?php echo htmlspecialchars($course['title']); ?>
                    </h1>

                    <!-- Tags -->
                    <?php if (!empty($tags)): ?>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <?php foreach ($tags as $tag): ?>
                                <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded-full text-sm">
                                    <?php echo htmlspecialchars($tag['name']); ?>
                                </span>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <!-- Teacher Info -->
                    <div class="flex items-center mb-6">
                        <i class="fas fa-user-tie text-gray-400 text-xl mr-3"></i>
                        <div>
                            <p class="font-semibold"><?php echo htmlspecialchars($course['teacher_name']); ?></p>
                            <p class="text-sm text-gray-500"><?php echo htmlspecialchars($course['teacher_email']); ?></p>
                        </div>
                    </div>

                    <!-- Course Description -->
                    <div class="prose max-w-none mb-6">
                        <h2 class="text-xl font-semibold mb-2">Description du cours</h2>
                        <p class="text-gray-600">
                            <?php echo nl2br(htmlspecialchars($course['description'])); ?>
                        </p>
                    </div>

                    <!-- Enrollment Section -->
                    <div class="border-t pt-6">
                        <?php if ($isEnrolled): ?>
                            <a href="view_course.php?id=<?php echo $course['id']; ?>"
                               class="block w-full bg-green-500 text-white text-center py-3 rounded-lg hover:bg-green-600 transition-colors">
                                Accéder au cours
                            </a>
                        <?php else: ?>
                            <form method="POST" action="available_courses.php">
                                <input type="hidden" name="course_id" value="<?php echo $course['id']; ?>">
                                <button type="submit" 
                                        name="enroll"
                                        class="w-full bg-blue-500 text-white py-3 rounded-lg hover:bg-blue-600 transition-colors">
                                    S'inscrire au cours
                                </button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 