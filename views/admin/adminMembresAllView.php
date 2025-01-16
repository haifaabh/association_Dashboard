<?php
require_once 'SidebarView.php';

class adminMembresAllView {
    public function render($membres = []) {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Liste des Membres</title>
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
                <h1 class="text-2xl font-semibold mb-4">Liste des Membres</h1>
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

                <!-- Table des membres -->
                <div id="partners-container">
                <?php if (empty($membres)): ?>
                    <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4">
                        <p>La liste des membres est vide.</p>
                    </div>
                <?php else: ?>
                    <table class="min-w-full bg-white  rounded-md overflow-hidden">
                        <thead class="bg-blue-900 text-white">
                            <tr>
                                <th class="py-2 px-4 border border-gray-300">Nom</th>
                                <th class="py-2 px-4 border border-gray-300">Prénom</th>
                                <th class="py-2 px-4 border border-gray-300">email</th>
                                <th class="py-2 px-4 border border-gray-300">piece d'identité</th>
                                <th class="py-2 px-4 border border-gray-300">reçu</th>
                                <th class="py-2 px-4 border border-gray-300">carte</th>
                                <th class="py-2 px-4 border border-gray-300">photo</th>
                                <th class="py-2 px-4 border border-gray-300">date d'inscription</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($membres as $membre): ?>
                            <tr>
                                <td class="py-2 px-4 border border-gray-300"><?php echo htmlspecialchars($membre->nom); ?></td>
                                <td class="py-2 px-4 border border-gray-300"><?php echo htmlspecialchars($membre->prenom); ?></td>
                                <td class="py-2 px-4 border border-gray-300"><?php echo htmlspecialchars($membre->email); ?></td>
                                <td class="py-2 px-4 border border-gray-300"><?php echo htmlspecialchars($membre->piece_identite); ?></td>
                                <?php
                                    $recuUrl = '../uploads/' . htmlspecialchars($membre->recu); // Relative path to the image
                                ?>
                                <td class="py-2 px-4 border border-gray-300">
                                     <?php if (!empty($membre->recu)): ?>
                                        <a href="<?php echo $recuUrl; ?>" target="_blank">
                                            <img src="<?php echo $recuUrl; ?>" alt="Recu de <?php echo htmlspecialchars($membre->nom); ?>" class="w-16 h-16 object-cover rounded-md">
                                        </a>
                                     <?php else: ?>
                                            <span class="text-gray-500">Non disponible</span>
                                     <?php endif; ?>
                                </td> 

                                <td class="py-2 px-4 border border-gray-300"><?php echo htmlspecialchars($membre->type_carte); ?></td>
                                <?php
                                    $photoUrl = '../uploads/' . htmlspecialchars($membre->photo); // Relative path to the image
                                ?>
                                <td class="py-2 px-4 border border-gray-300">
                                     <?php if (!empty($membre->photo)): ?>
                                        <a href="<?php echo $recuUrl; ?>" target="_blank">
                                            <img src="<?php echo $photoUrl; ?>" alt="Photo de <?php echo htmlspecialchars($membre->nom); ?>" class="w-16 h-16 object-cover rounded-md">
                                        </a>
                                     <?php else: ?>
                                            <span class="text-gray-500">Non disponible</span>
                                     <?php endif; ?>
                                </td>
                                <td class="py-2 px-4 border border-gray-300"><?php echo htmlspecialchars($membre->date_inscription); ?></td>    
                                               
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
