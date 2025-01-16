<?php
require_once 'SidebarUserView.php';

class profileView {
    public function render($user) {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Profile</title>
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
                <h1 class="text-2xl font-bold text-gray-800 mb-6">Mon Profil</h1>
                <?php if (isset($_GET['status']) && $_GET['status'] === 'success'): ?>
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
                        <p>Profil mis à jour avec succès.</p>
                    </div>
                <?php endif; ?>

                <?php
                if (isset($_GET['error'])):
                    if ($_GET['error'] === 'empty_fields'):
                        ?>
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
                            <p>Veuillez remplir tous les champs.</p>
                        </div>
                    <?php elseif ($_GET['error'] === 'invalid_credentials'): ?>
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
                            <p>Email ou mot de passe incorrect.</p>
                        </div>
                    <?php elseif ($_GET['error'] === 'unauthorized'): ?>
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
                            <p>Vous devez vous connecter pour accéder à cette page.</p>
                        </div>
                    <?php endif;
                endif;
                ?>
                <div class="mt-6 flex justify-end">
                    <a href="index.php?route=user/demande-aide" class="px-4 py-2 bg-green-500 text-white rounded-md inline-block">Demande d'aide</a>
                </div>
                <form action="index.php?route=user/profile" method="POST" enctype="multipart/form-data" class="space-y-4">
                    <div>
                        <label for="nom" class="block font-medium">Nom</label>
                        <input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($user->nom); ?>" class="w-full p-2 border rounded-md">
                    </div>
                    <div>
                        <label for="prenom" class="block font-medium">Prénom</label>
                        <input type="text" id="prenom" name="prenom" value="<?php echo htmlspecialchars($user->prenom); ?>" class="w-full p-2 border rounded-md">
                    </div>
                    <div>
                        <label for="email" class="block font-medium">Email</label>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user->email); ?>" class="w-full p-2 border rounded-md">
                    </div>
                    <div>
                        <label for="telephone" class="block font-medium">Téléphone</label>
                        <input type="text" id="telephone" name="telephone" value="<?php echo htmlspecialchars($user->telephone); ?>" class="w-full p-2 border rounded-md">
                    </div>
                    <div>
                        <label for="photo" class="block font-medium">Photo</label>
                        <?php if (!empty($user->photo)): ?>
                        <a href="<?php echo "../uploads/$user->photo"  ; ?>" target="_blank">
                            <img src="../uploads/<?php echo htmlspecialchars($user->photo); ?>" alt="Photo de profil" class="w-16 h-16 object-cover rounded-md mb-2">
                        </a>
                        <?php endif; ?>
                        <input type="file" id="photo" name="photo" value="<?php echo htmlspecialchars($user->photo); ?>"  class="w-full p-2 border rounded-md" >
                    </div>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Mettre à jour</button>
                </form>
            </div>
        </body>
        </html>
        <?php
    }
}
?>
