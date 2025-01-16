<?php
require_once 'SidebarPartenaireView.php';

class profilePartenaireView {
    public function render($partenaire) {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Profil Partenaire</title>
            <script src="https://cdn.tailwindcss.com"></script>
        </head>
        <body class="flex">
            <!-- Sidebar -->
            <?php
            $sidebar = new SidebarPartenaireView();
            $sidebar->render();
            ?>

            <!-- Main Content -->
            <div class="flex-1 p-6">
                <h1 class="text-2xl font-bold text-gray-800 mb-6">Profil Partenaire</h1>

                <?php if (isset($_GET['status']) && $_GET['status'] === 'success'): ?>
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
                        <p>Profil mis à jour avec succès.</p>
                    </div>
                <?php endif; ?>

                <?php if (isset($_GET['error']) && $_GET['error'] === 'empty_fields'): ?>
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
                        <p>Veuillez remplir tous les champs requis.</p>
                    </div>
                <?php endif; ?>

                <form action="index.php?route=partenaire/updatePartenaireProfile" method="POST" enctype="multipart/form-data" class="space-y-4">
                    <div>
                        <label for="nom" class="block font-medium">Nom</label>
                        <input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($partenaire->nom); ?>" class="w-full p-2 border rounded-md">
                    </div>
                    <div>
                        <label for="categorie" class="block font-medium">Catégorie</label>
                        <input type="text" id="categorie" name="categorie" value="<?php echo htmlspecialchars($partenaire->categorie); ?>" class="w-full p-2 border rounded-md">
                    </div>
                    <div>
                        <label for="ville" class="block font-medium">Ville</label>
                        <input type="text" id="ville" name="ville" value="<?php echo htmlspecialchars($partenaire->ville); ?>" class="w-full p-2 border rounded-md">
                    </div>
                    <div>
                        <label for="detail_reduction" class="block font-medium">Détails de Réduction</label>
                        <textarea id="detail_reduction" name="detail_reduction" rows="3" class="w-full p-2 border rounded-md"><?php echo htmlspecialchars($partenaire->detail_reduction); ?></textarea>
                    </div>
                    <div>
                        <label for="lien_site_web" class="block font-medium">Lien du Site Web</label>
                        <input type="url" id="lien_site_web" name="lien_site_web" value="<?php echo htmlspecialchars($partenaire->lien_site_web); ?>" class="w-full p-2 border rounded-md">
                    </div>
                    <div>
                        <label for="email" class="block font-medium">Email</label>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($partenaire->email); ?>" class="w-full p-2 border rounded-md">
                    </div>
                    <div>
                        <label for="mot_de_passe" class="block font-medium">Mot de Passe</label>
                        <input type="password" id="mot_de_passe" name="mot_de_passe" class="w-full p-2 border rounded-md">
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
