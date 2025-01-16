<?php
require_once 'SidebarUserView.php';

class UserCarteView {
    public function render($carte, $noCarte = false) {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Ma Carte</title>
            <script src="https://cdn.tailwindcss.com"></script>
        </head>
        <body class="flex">
            <!-- Sidebar -->
            <?php
            $sidebar = new SidebarUserView();
            $sidebar->render();
            ?>

            <!-- Main Content -->
            <div class="flex-1 p-6">
                <h1 class="text-2xl font-bold text-gray-800 mb-6">Ma Carte</h1>

                <?php if ($noCarte): ?>
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
                        <p>Vous n'avez pas de carte associée à votre compte.</p>
                    </div>
                <?php else: ?>
                    <div class="bg-white shadow rounded-lg p-6">
                        <h2 class="text-lg font-medium mb-4">Informations sur la Carte</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <p class="font-medium">Numéro de Carte:</p>
                                <p class="text-gray-600"><?php echo htmlspecialchars($carte->qr_code); ?></p>
                            </div>
                            <div>
                                <p class="font-medium">Type Carte:</p>
                                <p class="text-gray-600"><?php echo htmlspecialchars($carte->type_carte); ?></p>
                            </div>
                            <div>
                                <p class="font-medium">Date emission:</p>
                                <p class="text-gray-600"><?php echo htmlspecialchars($carte->date_emission); ?></p>
                            </div>
                            <div>
                                <p class="font-medium">Date d'expiration:</p>
                                <p class="text-gray-600"><?php echo htmlspecialchars($carte->date_expiration); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </body>
        </html>
        <?php
    }
}
?>
