<?php
class adminBenevolesView {
    public function render($volunteers) {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Gérer les Bénévoles</title>
            <script src="https://cdn.tailwindcss.com"></script>
        </head>
        <body class="flex">
        <!-- Sidebar -->
            <?php
            $sidebar = new SidebarView();
            $sidebar->render();
            ?>

            <div class="container flex-1 mx-auto p-4">
                <h1 class="text-2xl font-semibold mb-4">Gérer les Bénévoles</h1>
                <table class="min-w-full bg-white  rounded-md overflow-hidden">
                    <thead class="bg-blue-900 text-white">
                        <tr>
                            <th class="py-2 px-4">Nom</th>
                            <th class="py-2 px-4">Prénom</th>
                            <th class="py-2 px-4">Email</th>
                            <th class="py-2 px-4">Titre d'Événement</th>
                            <th class="py-2 px-4">Date</th>
                            <th class="py-2 px-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($volunteers as $volunteer): ?>
                            <tr class="border-b">
                                <td class="py-2 px-4"><?php echo htmlspecialchars($volunteer['nom']); ?></td>
                                <td class="py-2 px-4"><?php echo htmlspecialchars($volunteer['prenom']); ?></td>
                                <td class="py-2 px-4"><?php echo htmlspecialchars($volunteer['email']); ?></td>
                                <td class="py-2 px-4"><?php echo htmlspecialchars($volunteer['titre']); ?></td>
                                <td class="py-2 px-4"><?php echo htmlspecialchars($volunteer['date']); ?></td>
                                <td class="py-2 px-4">
                                    <form method="POST" action="?route=admin/update-benevoles" class="inline-block">
                                        <input type="hidden" name="id" value="<?php echo $volunteer['id']; ?>">
                                        <button name="action" value="accepte" class="bg-green-600 text-white py-1 px-3 rounded">Accepter</button>
                                    </form>
                                    <form method="POST" action="?route=admin/update-benevoles" class="inline-block">
                                        <input type="hidden" name="id" value="<?php echo $volunteer['id']; ?>">
                                        <button name="action" value="refuse" class="bg-red-600 text-white py-1 px-3 rounded">Refuser</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </body>
        </html>
        <?php
    }
}
?>
