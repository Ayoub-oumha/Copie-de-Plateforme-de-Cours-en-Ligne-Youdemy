<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques - Enseignant</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Chart.js pour les graphiques -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                        <a href="/teachers/courses/create" class="flex items-center p-2 rounded hover:bg-gray-700">
                            <i class="fas fa-plus mr-3"></i>
                            <span>Ajouter un cours</span>
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="/teachers/statistics" class="flex items-center p-2 rounded hover:bg-gray-700 bg-gray-700">
                            <i class="fas fa-chart-bar mr-3"></i>
                            <span>Statistiques</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <h1 class="text-3xl font-bold mb-8">Statistiques</h1>

            <!-- Cartes de statistiques générales -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total des cours -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                            <i class="fas fa-book text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <h2 class="text-gray-600 text-sm">Total des cours</h2>
                            <p class="text-2xl font-bold"><?= $data['totalCourses'] ?? 0 ?></p>
                        </div>
                    </div>
                </div>

                <!-- Total des étudiants -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 text-green-600">
                            <i class="fas fa-users text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <h2 class="text-gray-600 text-sm">Total des étudiants</h2>
                            <p class="text-2xl font-bold"><?= $data['totalStudents'] ?? 0 ?></p>
                        </div>
                    </div>
                </div>

                <!-- Revenus totaux -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                            <i class="fas fa-euro-sign text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <h2 class="text-gray-600 text-sm">Revenus totaux</h2>
                            <p class="text-2xl font-bold"><?= number_format($data['totalRevenue'] ?? 0, 2) ?> €</p>
                        </div>
                    </div>
                </div>

                <!-- Note moyenne -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                            <i class="fas fa-star text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <h2 class="text-gray-600 text-sm">Note moyenne</h2>
                            <p class="text-2xl font-bold"><?= number_format($data['averageRating'] ?? 0, 1) ?>/5</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Graphiques -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Graphique des inscriptions -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Inscriptions par mois</h3>
                    <canvas id="enrollmentsChart"></canvas>
                </div>

                <!-- Graphique des revenus -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Revenus par mois</h3>
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>

            <!-- Tableau des cours les plus populaires -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Cours les plus populaires</h3>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left border-b">
                                <th class="pb-4">Cours</th>
                                <th class="pb-4">Étudiants</th>
                                <th class="pb-4">Revenus</th>
                                <th class="pb-4">Note moyenne</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data['popularCourses'] ?? [] as $course): ?>
                            <tr class="border-b">
                                <td class="py-4"><?= $course->title ?></td>
                                <td class="py-4"><?= $course->students_count ?></td>
                                <td class="py-4"><?= number_format($course->revenue, 2) ?> €</td>
                                <td class="py-4">
                                    <div class="flex items-center">
                                        <?= number_format($course->average_rating, 1) ?>
                                        <i class="fas fa-star text-yellow-400 ml-1"></i>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Données pour le graphique des inscriptions
        const enrollmentsData = {
            labels: <?= json_encode($data['monthLabels'] ?? []) ?>,
            datasets: [{
                label: 'Nouvelles inscriptions',
                data: <?= json_encode($data['monthlyEnrollments'] ?? []) ?>,
                borderColor: 'rgb(59, 130, 246)',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                tension: 0.4
            }]
        };

        // Données pour le graphique des revenus
        const revenueData = {
            labels: <?= json_encode($data['monthLabels'] ?? []) ?>,
            datasets: [{
                label: 'Revenus (€)',
                data: <?= json_encode($data['monthlyRevenue'] ?? []) ?>,
                borderColor: 'rgb(16, 185, 129)',
                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                tension: 0.4
            }]
        };

        // Configuration des graphiques
        const chartConfig = {
            type: 'line',
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };

        // Création des graphiques
        new Chart(
            document.getElementById('enrollmentsChart'),
            {...chartConfig, data: enrollmentsData}
        );

        new Chart(
            document.getElementById('revenueChart'),
            {...chartConfig, data: revenueData}
        );
    </script>
</body>
</html> 