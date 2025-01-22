<?php
require_once '../auth/middleware.php';
requireAuth(); // Check if the user is authenticated

require_once '../classes/CourseManagement.php';
$courseManagement = new CourseManagement();

// Fetch enrolled courses for the logged-in student
$studentId = $_SESSION['user_id'];
$enrolledCourses = $courseManagement->getEnrolledCourses($studentId);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Cours</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body class="bg-gray-100 flex">
    <?php include 'nav_student.php'; ?>

    <div class="flex-1 p-8">
        <h1 class="text-2xl font-bold mb-6">Mes Cours</h1>

        <?php if (empty($enrolledCourses)): ?>
            <div class="bg-white rounded-lg shadow p-6 text-center">
                <p class="text-gray-500">Vous n'êtes inscrit à aucun cours pour le moment.</p>
                <a href="available_courses.php" class="inline-block mt-4 bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
                    Explorer les cours disponibles
                </a>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($enrolledCourses as $course): ?>
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <?php if ($course['photo_cover']): ?>
                            <img src="data:image/jpeg;base64,<?php echo base64_encode($course['photo_cover']); ?>" 
                                 alt="<?php echo htmlspecialchars($course['title']); ?>" 
                                 class="w-full h-48 object-cover">
                        <?php endif; ?>
                        <div class="p-6">
                            <h3 class="font-bold text-xl mb-2"><?php echo htmlspecialchars($course['title']); ?></h3>
                            <p class="text-gray-600 mb-4"><?php echo htmlspecialchars($course['description']); ?></p>
                            
                            <!-- Progress Bar -->
                            <div class="w-full bg-gray-200 rounded-full h-2.5 mb-4">
                                <div class="bg-blue-600 h-2.5 rounded-full" style="width: 0%"></div>
                            </div>
                            

                            <!-- Action Buttons -->
                            <div class="flex justify-between items-center">
                                <a href="view_course.php?id=<?php echo $course['id']; ?>" 
                                   class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                    Continuer le cours
                                </a>
                                <button onclick="downloadCertificate(<?php echo $course['id']; ?>)" 
                                        class="text-gray-500 hover:text-gray-700"
                                        title="Télécharger le certificat"
                                        disabled>
                                    <i class="fas fa-certificate"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <script>
        function downloadCertificate(courseId) {
            // Add certificate download logic here
            alert('Fonctionnalité à venir: Téléchargement du certificat pour le cours ' + courseId);
        }
    </script>
</body>
</html> 