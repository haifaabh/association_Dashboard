<?php
class cardVerificationView {
    public function render($data = []) {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Vérification de Carte</title>
            <script src="https://cdn.tailwindcss.com"></script>
        </head>
        <body class="flex bg-gray-100">

        <?php
            $sidebar = new SidebarPartenaireView();
            $sidebar->render();
        ?>

        <div class="flex-1 p-6 bg-white">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Vérification de Carte</h1>

            <?php if (!empty($data['error'])): ?>
                <p class="text-red-500 mb-4"><?= htmlspecialchars($data['error']) ?></p>
            <?php endif; ?>

            <?php if (!empty($data['membre']) && !empty($data['carte'])): ?>
                <div class="bg-gray-50 p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4 ">Informations du Membre</h2>
                    <div class="space-y-4">
                    <p><strong>Nom:</strong> <?= htmlspecialchars($data['membre']->nom) ?></p>
                    <p><strong>Prénom:</strong> <?= htmlspecialchars($data['membre']->prenom) ?></p>
                    <p><strong>Téléphone:</strong> <?= htmlspecialchars($data['membre']->telephone) ?></p>
                    <p><strong>Type de Carte:</strong> <?= htmlspecialchars($data['carte']->type_carte) ?></p>
                    <p><strong>Date d'Émission:</strong> <?= htmlspecialchars($data['carte']->date_emission) ?></p>
                    <p><strong>Date d'Expiration:</strong> <?= htmlspecialchars($data['carte']->date_expiration) ?></p>
                    </div>
                </div>
            <?php else: ?>
                <form action="?route=partenaire/verifyCard" method="POST" class="mt-6">
                    <div class="mb-4">
                        <label for="qr_code" class="block text-gray-700 font-medium">Code de la Carte:</label>
                        <input type="text" id="qr_code" name="qr_code" class="w-full p-3 border border-gray-300 rounded-md mt-2" required>
                    </div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Vérifier</button>
                </form>
            <?php endif; ?>
        </div>

        </body>
        </html>
        <?php
    }
}
?>
