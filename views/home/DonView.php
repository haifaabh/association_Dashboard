<?php

class DonView
{
    public function render($data = [])
    {
        $message = $data['message'] ?? '';
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Effectuer un don</title>
            <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        </head>
        <body class="bg-gray-100 font-sans antialiased">
            <div class="max-w-lg mx-auto p-6 bg-white rounded-lg shadow-lg mt-10">
                <h1 class="text-2xl font-semibold text-center mb-6">Effectuer un don</h1>

                <!-- Success or Error message -->
                <?php if (!empty($message)) : ?>
                    <p class="text-center text-green-500"><?= htmlspecialchars($message) ?></p>
                <?php endif; ?>

                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="mb-4">
                        <label for="nom" class="block text-gray-700 font-medium">Nom</label>
                        <input type="text" name="nom" id="nom" placeholder="Nom"
                               class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label for="prenom" class="block text-gray-700 font-medium">Prénom</label>
                        <input type="text" name="prenom" id="prenom" placeholder="Prénom"
                               class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label for="montant" class="block text-gray-700 font-medium">Montant</label>
                        <input type="text" name="montant" id="montant" placeholder="Montant"
                               class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                               required>
                    </div>
                    
                    

                    <div class="mb-4">
                        <label for="recu" class="block text-gray-700 font-medium">Reçu</label>
                        <input type="file" name="recu" id="recu"
                               class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                               required>
                    </div>

                    <div class="mb-4">
                        <label for="category" class="block text-gray-700 font-medium">Category</label>
                        <input type="text" name="category" id="category" placeholder="Category"
                               class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                               required>
                    </div>

                    <button type="submit"
                            class="w-full bg-blue-900 text-white py-2 px-4 rounded-md hover:bg-blue-600">
                        Soumettre
                    </button>
                </form>
            </div>
        </body>
        </html>
        <?php
    }
}
?>
