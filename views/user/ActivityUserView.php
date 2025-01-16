<?php
class ActivityUserView {
public function renderVolunteerActivities($benevolats) {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Mes Bénévolats</title>
            <script src="https://cdn.tailwindcss.com"></script>
        </head>
        <body class="flex">
            <!-- Sidebar -->
            <?php
            $sidebar = new SidebarUserView();
            $sidebar->render();
            ?>

            <!-- Main Content -->
            <main class="container mx-auto px-4 py-6">
                <h1 class="text-2xl font-bold text-gray-800 mb-6">Liste de mes activités de bénévolat</h2>         
                <?php if (empty($benevolats)): ?>
                    <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4">
                        <p>Vous n'avez participé à aucune activité de bénévolat pour le moment.</p>
                    </div>
                <?php else: ?>
                    <div class="space-y-4">
                        <?php foreach ($benevolats as $activity): ?>
                            <div class="bg-white shadow rounded-lg p-4">
                                <h3 class="text-lg font-medium mb-2"><?php echo htmlspecialchars($activity->titre); ?></h3>
                                <p class="text-gray-600 mb-2"><?php echo htmlspecialchars($activity->description); ?></p>
                                <p class="text-sm text-gray-500 mb-2">Lieu: <?php echo htmlspecialchars($activity->location); ?></p>
                                <p class="text-sm text-gray-500 mb-4">Date: <?php echo htmlspecialchars($activity->date); ?></p>
                                <p class="font-semibold text-sm">
                                    Statut: 
                                    <?php
                                        if ($activity->status == 'en attente') {
                                            echo '<span class="text-yellow-500">En attente</span>';
                                        } elseif ($activity->status == 'accepté') {
                                            echo '<span class="text-green-500">Accepté</span>';
                                        } else {
                                            echo '<span class="text-red-500">Refusé</span>';
                                        }
                                    ?>
                                </p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </main>

        
        </body>
        </html>
        <?php
    }
}
?>