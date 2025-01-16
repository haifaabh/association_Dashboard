<?php
class ActivityView {
    public function render($activities = [], $status = null) {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Liste des Activités</title>
            <script src="https://cdn.tailwindcss.com"></script>
        </head>
        <body class="bg-gray-100">
            <!-- Header -->
            <header class="bg-blue-900 text-white py-4">
                <div class="container mx-auto px-4">
                    <h1 class="text-2xl font-bold">Activités</h1>
                </div>
            </header>

            <!-- Main Content -->
            <main class="container mx-auto px-4 py-6">
                <h2 class="text-xl font-semibold mb-4">Explorez les activités disponibles</h2>
                
                <!-- Display Status Message -->
                <?php if ($status === 'success'): ?>
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
                        <p>Inscription réussie à l'activité.</p>
                    </div>
                <?php elseif ($status === 'error'): ?>
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
                        <p>Une erreur s'est produite. Veuillez réessayer.</p>
                    </div>
                <?php elseif ($status === 'already_signed_up'): ?>
                     <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-4">
                         <p>Vous êtes déjà inscrit(e) à cette activité.</p>
                         </div>
                <?php endif; ?>

                <!-- Activities List -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php if (empty($activities)): ?>
                        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4">
                            <p>Aucune activité disponible pour le moment.</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($activities as $activity): ?>
                            <div class="bg-white shadow rounded-lg p-4">
                                <img src="../uploads/<?php echo htmlspecialchars($activity->image); ?>" alt="<?php echo htmlspecialchars($activity->titre); ?>" class="w-full h-48 object-cover rounded-md mb-4">
                                <h3 class="text-lg font-medium mb-2"><?php echo htmlspecialchars($activity->titre); ?></h3>
                                <p class="text-gray-600 mb-2"><?php echo htmlspecialchars($activity->description); ?></p>
                                <p class="text-sm text-gray-500 mb-2">Lieu: <?php echo htmlspecialchars($activity->location); ?></p>
                                <p class="text-sm text-gray-500 mb-4">Date: <?php echo htmlspecialchars($activity->date); ?></p>
                                
                                <?php if (isset($_SESSION['user_id'])): ?>  
                                    <a href="?route=activity/signup&id=<?php echo $activity->id; ?>" class="block bg-blue-900 text-white text-center py-2 rounded hover:bg-blue-600">
                                        S'inscrire comme bénévole
                                    </a>
                                <?php else: ?>
                                    <p class="text-center text-sm text-blue-600 text italic ">
                                        Connectez-vous pour vous inscrire comme bénévole.
                                    </p>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </main>

            <!-- Footer -->
            <footer class="mt-14 px-8">
                <div class="mt-12 py-6">
                    <div class="container mx-auto flex flex-col md:flex-row justify-between items-center">
                        <!-- Logo et description -->
                        <div>
                            <h3 class="text-xl text-blue-900 font-bold mb-2">Nom de l'Association</h3>
                            <p class="text-sm">Créer des connexions et offrir des opportunités uniques pour tous nos membres.</p>
                        </div>

                        <!-- Liens rapides -->
                        <div class="mt-4 md:mt-0 text-blue-900">
                            <ul class="flex space-x-4">
                                <li><a href="#" class="hover:underline">Accueil</a></li>
                                <li><a href="#" class="hover:underline">Activités</a></li>
                                <li><a href="#" class="hover:underline">Événements</a></li>
                                <li><a href="#" class="hover:underline">Contact</a></li>
                            </ul>
                        </div>

                        <!-- Réseaux sociaux -->
                        <div class="mt-4 md:mt-0 flex space-x-4 mx-4">
                            <a href="https://facebook.com" class="text-xl hover:text-gray-300"><i class="fab fa-facebook"></i></a>
                            <a href="https://twitter.com" class="text-xl hover:text-gray-300"><i class="fab fa-twitter"></i></a>
                            <a href="https://instagram.com" class="text-xl hover:text-gray-300"><i class="fab fa-instagram"></i></a>
                            <a href="https://linkedin.com" class="text-xl hover:text-gray-300"><i class="fab fa-linkedin"></i></a>
                        </div>
                    </div>
                </div>
            </footer>
        </body>
        <script type="text/javascript"> //to delete the params+success/error messages after reloading page
        window.onload = function() {
        const urlParams = new URLSearchParams(window.location.search);
        const status = urlParams.get('status');
        if (status) {
          const route = window.location.pathname + window.location.search;        
            // Remove the 'status' parameter from the URL
        const newUrl = window.location.pathname + window.location.search.replace(/([&\?])status=[^&]+/, '');
        history.replaceState(null, null, newUrl);
        }
        }
        </script>
        </html>
        <?php
    }

}
?>
