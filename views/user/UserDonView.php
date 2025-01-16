<?php
require_once 'SidebarUserView.php';

class UserDonView {
    public function render($dons = []) {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Liste des Dons</title>
            <script src="https://cdn.tailwindcss.com"></script>
        </head>
        <body class="flex bg-gray-100">
            <!-- Sidebar -->
            <?php
            $sidebar = new SidebarUserView();
            $sidebar->render();
            ?>

            <!-- Main Content -->
            <div class="flex-1 p-6">
                <h1 class="text-2xl font-bold text-gray-800 mb-6">Liste des Dons</h1>

                <!-- Status Messages -->
                <?php if (isset($_GET['status'])): ?>
                    <?php if ($_GET['status'] === 'success'): ?>
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-md mb-4">
                            <p>L'action a été effectuée avec succès.</p>
                        </div>
                    <?php elseif ($_GET['status'] === 'error'): ?>
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-md mb-4">
                            <p>Une erreur s'est produite. Veuillez réessayer.</p>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>

                <!-- dons Section -->
                <div id="donations-container" class="bg-white shadow rounded-lg pt-4 px-6 pb-6">
                    <?php if (empty($dons)): ?>
                        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-md">
                            <p>La liste des dons est vide.</p>
                        </div>
                    <?php else: ?>
                        <h2 class="text-lg font-medium text-gray-700 mb-4">Détails des Dons</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            <?php foreach ($dons as $don): ?>
                                <div class="border border-gray-300 rounded-lg shadow-sm bg-gray-50 hover:shadow-md transition p-4">
                                    <div class="mb-2">
                                        <p class="text-gray-600 text-sm font-medium">Nom:</p>
                                        <p class="text-gray-800 font-semibold"><?php echo htmlspecialchars($don->nom); ?></p>
                                    </div>
                                    <div class="mb-2">
                                        <p class="text-gray-600 text-sm font-medium">Prénom:</p>
                                        <p class="text-gray-800 font-semibold"><?php echo htmlspecialchars($don->prenom); ?></p>
                                    </div>
                                    <div class="mb-2">
                                        <p class="text-gray-600 text-sm font-medium">Montant:</p>
                                        <p class="text-green-600 font-semibold"><?php echo htmlspecialchars($don->montant); ?> DA</p>
                                    </div>
                                    <div class="mb-2">
                                        <p class="text-gray-600 text-sm font-medium">Date de Don:</p>
                                        <p class="text-gray-800"><?php echo htmlspecialchars($don->date_don); ?></p>
                                    </div>
                                    <div class="mb-2">
                                        <p class="text-gray-600 text-sm font-medium">Catégorie:</p>
                                        <p class="text-gray-800"><?php echo htmlspecialchars($don->categorie); ?></p>
                                    </div>
                                    <div>
                                        <p class="text-gray-600 text-sm font-medium">Reçu:</p>
                                        <?php if (!empty($don->recu)): ?>
                                            <a href="../uploads/<?php echo htmlspecialchars($don->recu); ?>" target="_blank">
                                                <img src="../uploads/<?php echo htmlspecialchars($don->recu); ?>" alt="Reçu" class="w-16 h-16 object-cover rounded-md border border-gray-300">
                                            </a>
                                        <?php else: ?>
                                            <span class="text-gray-500">Non disponible</span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mb-2">
                                        <p class="text-gray-600 text-sm font-medium">Status:</p>
                                        <p class="text-gray-800"><?php echo htmlspecialchars($don->status); ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </body>
        </html>
        <?php
    }
}
?>
