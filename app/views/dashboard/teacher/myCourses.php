<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Cours - Enseignant</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="flex">
        <!-- Sidebar -->
        <nav class="w-64 min-h-screen bg-gray-800 text-white">
            <div class="p-4">
                <h2 class="text-2xl font-bold mb-6">Dashboard</h2>
                <ul>
                    <li class="mb-3">
                        <a href="/teachers/dashboard" class="flex items-center p-2 rounded hover:bg-gray-700">
                            <i class="fas fa-home mr-3"></i>
                            <span>Tableau de bord</span>
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="/teachers/courses" class="flex items-center p-2 rounded hover:bg-gray-700 bg-gray-700">
                            <i class="fas fa-book mr-3"></i>
                            <span>Mes cours</span>
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="/teachers/courses/create" class="flex items-center p-2 rounded hover:bg-gray-700">
                            <i class="fas fa-plus mr-3"></i>
                            <span>Ajouter un cours</span>
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="/teachers/statistics" class="flex items-center p-2 rounded hover:bg-gray-700">
                            <i class="fas fa-chart-bar mr-3"></i>
                            <span>Statistiques</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold">Mes Cours</h1>
                <a href="/teachers/courses/create" 
                   class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 flex items-center">
                    <i class="fas fa-plus mr-2"></i>
                    Nouveau cours
                </a>
            </div>

            <!-- Filtres -->
            <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
                <form class="flex gap-4 items-end">
                    <div class="flex-1">
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-2">
                            Rechercher
                        </label>
                        <input type="text" 
                               id="search" 
                               name="search" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md"
                               placeholder="Rechercher un cours...">
                    </div>
                    <div class="flex-1">
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                            Catégorie
                        </label>
                        <select id="category" 
                                name="category" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md">
                            <option value="">Toutes les catégories</option>
                            <?php foreach($data['categories'] ?? [] as $category): ?>
                                <option value="<?= $category->id ?>"><?= $category->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" 
                            class="bg-gray-800 text-white px-4 py-2 rounded-md hover:bg-gray-700">
                        Filtrer
                    </button>
                </form>
            </div>

            <!-- Liste des cours -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php if(isset($data['courses']) && !empty($data['courses'])): ?>
                    <?php foreach($data['courses'] as $course): ?>
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                            <!-- Image du cours -->
                            <img src="<?= $course->thumbnail ?>" 
                                 alt="<?= $course->title ?>" 
                                 class="w-full h-48 object-cover">
                            
                            <div class="p-6">
                                <!-- Informations du cours -->
                                <h3 class="text-xl font-bold mb-2"><?= $course->title ?></h3>
                                <p class="text-gray-600 mb-4 line-clamp-2"><?= $course->description ?></p>
                                
                                <!-- Statistiques -->
                                <div class="flex justify-between items-center mb-4">
                                    <span class="text-sm text-gray-500">
                                        <i class="fas fa-users mr-1"></i>
                                        <?= $course->enrolled_students ?> étudiants
                                    </span>
                                    <span class="text-sm text-gray-500">
                                        <i class="fas fa-euro-sign mr-1"></i>
                                        <?= $course->price ?> €
                                    </span>
                                </div>

                                <!-- Actions -->
                                <div class="flex justify-between items-center">
                                    <a href="/teachers/courses/edit/<?= $course->id ?>" 
                                       class="text-blue-600 hover:text-blue-800">
                                        <i class="fas fa-edit mr-1"></i>
                                        Modifier
                                    </a>
                                    <div class="flex gap-2">
                                        <a href="/teachers/courses/students/<?= $course->id ?>" 
                                           class="text-green-600 hover:text-green-800">
                                            <i class="fas fa-users mr-1"></i>
                                            Étudiants
                                        </a>
                                        <button onclick="deleteCourse(<?= $course->id ?>)" 
                                                class="text-red-600 hover:text-red-800">
                                            <i class="fas fa-trash mr-1"></i>
                                            Supprimer
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-span-full text-center py-12">
                        <i class="fas fa-book-open text-gray-400 text-5xl mb-4"></i>
                        <p class="text-gray-500">Vous n'avez pas encore créé de cours.</p>
                        <a href="/teachers/courses/create" 
                           class="inline-block mt-4 bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                            Créer mon premier cours
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script>
        function deleteCourse(courseId) {
            if(confirm('Êtes-vous sûr de vouloir supprimer ce cours ?')) {
                fetch(`/teachers/courses/delete/${courseId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if(data.success) {
                        window.location.reload();
                    } else {
                        alert('Une erreur est survenue lors de la suppression du cours');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Une erreur est survenue lors de la suppression du cours');
                });
            }
        }
    </script>
</body>
</html> 