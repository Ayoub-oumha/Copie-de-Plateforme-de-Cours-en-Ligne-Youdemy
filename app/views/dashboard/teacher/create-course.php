
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un cours - Enseignant</title>
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
                        <a href="/teachers/courses" class="flex items-center p-2 rounded hover:bg-gray-700">
                            <i class="fas fa-book mr-3"></i>
                            <span>Mes cours</span>
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="/teachers/courses/create" class="flex items-center p-2 rounded hover:bg-gray-700 bg-gray-700">
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
            <h1 class="text-3xl font-bold mb-8">Ajouter un nouveau cours</h1>

            <div class="bg-white rounded-lg shadow-lg p-6">
                <form action="/teachers/courses/create" method="POST" enctype="multipart/form-data" class="space-y-6">
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
                            <?php  foreach($allCategorys ?? [] as $category): ?>
                                <option value="<?= $category["id"]?>" > <?= $category["name"] ?></option>
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
                           
                           <?php foreach($allTags ?? [] as $tag): ?>
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
                               required 
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
                               required 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <p class="mt-1 text-sm text-gray-500">Formats acceptés : PDF, MP4, ZIP (max 500MB)</p>
                    </div>

                    <!-- Prix -->
                    

                    <!-- Bouton de soumission -->
                    <div class="flex justify-end">
                        <button type="submit" name="createnewcoursebtn"
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            Créer le cours
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html> 