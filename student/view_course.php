<?php
require_once '../auth/middleware.php';
requireAuth(); // Check if the user is authenticated

require_once '../classes/CourseManagement.php';
$courseManagement = new CourseManagement();

// Get the course ID from the URL
$courseId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if (!$courseId) {
    header('Location: available_courses.php');
    exit();
}

// Get course details
$course = $courseManagement->getCourseDetails($courseId);
$tags = $courseManagement->getCourseTags($courseId);

// Check if the course exists
if (!$course) {
    header('Location: available_courses.php');
    exit();
}

// Check if the student is enrolled
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

                    <!-- Content Display -->
                    <div class="border-t pt-6">
                        <h2 class="text-xl font-semibold mb-2">Contenu du cours</h2>
                        <?php if ($course['content_type'] === 'video'): ?>
                            <div class="aspect-w-16 aspect-h-9 mb-4">
                                <iframe width="560" height="315" src="<?php echo htmlspecialchars($course['vedio']); ?>" 
                                        title="YouTube video player" frameborder="0" 
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                        allowfullscreen></iframe>
                            </div>
                        <?php elseif ($course['content_type'] === 'text'): ?>
                            <div class="bg-gray-100 p-4 rounded">
                                <h3 class="font-semibold">Texte du document:</h3>
                                <p class="text-gray-600">
                                    <?php echo nl2br(htmlspecialchars($course['content'])); ?>
                                </p>
                            </div>
                        <?php endif; ?>
                    </div>

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
