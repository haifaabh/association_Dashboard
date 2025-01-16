<?php
class LoginView {
    public function render() {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Login</title>
            <script src="https://cdn.tailwindcss.com"></script>
        </head>
        <body class="flex items-center justify-center min-h-screen bg-gray-100">
            <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-md">
                <h1 class="text-2xl font-bold text-center mb-4">Connexion</h1>
                <?php if (isset($_GET['error'])): ?>
                    <?php if ($_GET['error'] === 'empty_fields'): ?>
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
                            <p>Veuillez remplir tous les champs.</p>
                        </div>
                    <?php elseif ($_GET['error'] === 'invalid_credentials'): ?>
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
                            <p>Email ou mot de passe incorrect.</p>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
                <form action="index.php?route=user/login" method="POST" class="space-y-4">
                    <div>
                        <label for="email" class="block font-medium">Email</label>
                        <input type="email" id="email" name="email" required class="w-full p-2 border rounded-md">
                    </div>
                    <div>
                        <label for="password" class="block font-medium">Mot de passe</label>
                        <input type="password" id="password" name="password" required class="w-full p-2 border rounded-md">
                    </div>
                    <button type="submit" class="w-full px-4 py-2 bg-blue-500 text-white rounded-md">
                        Se connecter
                    </button>
                </form>
            </div>
        </body>
        </html>
        <?php
    }
}
?>
