<?php
require_once 'SidebarView.php';

class adminDonView {
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
        <body class="flex">
            <!-- Sidebar -->
            <?php
            $sidebar = new SidebarView();
            $sidebar->render();
            ?>

            <!-- Main Content -->
            <div class="flex-1 p-6">
                <h1 class="text-2xl font-semibold mb-4">Liste des Dons</h1>
                <?php if (isset($_GET['status'])): ?>
                    <?php if ($_GET['status'] === 'success'): ?>
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
                            <p>L'action a été effectuée avec succès.</p>
                        </div>
                    <?php elseif ($_GET['status'] === 'error'): ?>
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
                            <p>Une erreur s'est produite. Veuillez réessayer.</p>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>

                <!-- Table des dons -->
                <div id="donations-container">
                <?php if (empty($dons)): ?>
                    <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4">
                        <p>La liste des dons est vide.</p>
                    </div>
                <?php else: ?>
                    <table class="min-w-full bg-white  rounded-md overflow-hidden">
                        <thead class="bg-blue-900 text-white">
                            <tr>
                                <th class="py-2 px-4 border border-gray-300">Nom</th>
                                <th class="py-2 px-4 border border-gray-300">Prénom</th>
                                <th class="py-2 px-4 border border-gray-300">Montant</th>
                                <th class="py-2 px-4 border border-gray-300">Date de Don</th>
                                <th class="py-2 px-4 border border-gray-300">Reçu</th>
                                <th class="py-2 px-4 border border-gray-300">Catégorie</th>
                                <th class="py-2 px-4 border border-gray-300">Actions</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dons as $don): ?>
                            <tr>
                                <td class="py-2 px-4 border border-gray-300"><?php echo htmlspecialchars($don->nom); ?></td>
                                <td class="py-2 px-4 border border-gray-300"><?php echo htmlspecialchars($don->prenom); ?></td>
                                <td class="py-2 px-4 border border-gray-300"><?php echo htmlspecialchars($don->montant); ?> DA</td>
                                <td class="py-2 px-4 border border-gray-300"><?php echo htmlspecialchars($don->date_don); ?></td>
                                <td class="py-2 px-4 border border-gray-300">
                                     <?php if (!empty($don->recu)): ?>
                                        <a href="../uploads/<?php echo htmlspecialchars($don->recu); ?>" target="_blank">
                                            <img src="../uploads/<?php echo htmlspecialchars($don->recu); ?>" alt="Reçu de <?php echo htmlspecialchars($don->nom); ?>" class="w-16 h-16 object-cover rounded-md">
                                        </a>
                                     <?php else: ?>
                                            <span class="text-gray-500">Non disponible</span>
                                     <?php endif; ?>
                                </td> 
                                <td class="py-2 px-4 border border-gray-300"><?php echo htmlspecialchars($don->categorie); ?></td>

                                <td class="py-2 px-4 border border-gray-300">
                                <form method="post" action="index.php?route=admin/gestion-don-action">
                                 <input type="hidden" name="don_id" value="<?php echo $don->id; ?>">
                                 <button type="submit" name="action" value="valider" class="px-2 py-1 bg-green-500 text-white rounded-md">valider</button>
                                </form>
                                </td> 
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php endif; ?>
                </div>
            </div>
        </body>
        </html>
        <?php
    }
}
?>
