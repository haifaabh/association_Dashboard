<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Member</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="max-w-lg mx-auto p-6 bg-white rounded-lg shadow-lg mt-10">
        <h1 class="text-2xl font-semibold text-center mb-6">Devenir un membre</h1>

        <!-- Success or Error message -->
        <?php if (!empty($message)) : ?>
            <p class="text-center text-green-500"><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="mb-4">
                <label for="nom" class="block text-gray-700 font-medium">Nom</label>
                <input type="text" name="nom" id="nom" placeholder="Nom" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label for="prenom" class="block text-gray-700 font-medium">Prénom</label>
                <input type="text" name="prenom" id="prenom" placeholder="Prénom" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label for="piece_identite" class="block text-gray-700 font-medium">Pièce d'identité</label>
                <input type="text" name="piece_identite" id="piece_identite" placeholder="Pièce d'identité" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label for="recu" class="block text-gray-700 font-medium">Reçu</label>
                <input type="file" name="recu" id="recu" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-medium">Email</label>
                <input type="email" name="email" id="email" placeholder="Email" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label for="mot_de_passe" class="block text-gray-700 font-medium">Mot de Passe</label>
                <input type="password" name="mot_de_passe" id="mot_de_passe" placeholder="Mot de Passe" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label for="telephone" class="block text-gray-700 font-medium">Téléphone</label>
                <input type="text" name="telephone" id="telephone" placeholder="Téléphone" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label for="photo" class="block text-gray-700 font-medium">Photo</label>
                <input type="file" name="photo" id="photo" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label for="type_carte" class="block text-gray-700 font-medium">Type de Carte</label>
                <select name="type_carte" id="type_carte" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="bronze">Bronze</option>
                    <option value="silver">Silver</option>
                    <option value="gold">Gold</option>
                </select>
            </div>

            <div class="mt-6">
                <button type="submit" class="w-full px-4 py-2 bg-blue-900 text-white font-semibold rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Register</button>
            </div>
        </form>
    </div>
    <?php if (!empty($message) && strpos($message, 'successful') !== false): ?>
        <script>
            setTimeout(function() {
                window.location.href = 'index.php?route=user/login';
            }, 2000); // Redirect after 2 seconds
        </script>
    <?php endif; ?>
</body>
</html>
