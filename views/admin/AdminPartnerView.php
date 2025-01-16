<?php
require_once 'SidebarView.php';

class AdminPartnerView {
    public function render($partners = [], $filters = []) {
        $search = isset($filters['search']) ? $filters['search'] : '';
        $category = isset($filters['category']) ? $filters['category'] : '';
        $city = isset($filters['city']) ? $filters['city'] : '';
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Gestion des Partenaires</title>
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
                <h1 class="text-2xl font-semibold mb-4">Gestion des Partenaires</h1>
                <!-- Search and Filter Form -->
                <form method="GET" action="" class="bg-white p-4 flex flex-wrap justify-between items-center">
                    <input 
                        type="text" 
                        id="search" 
                        placeholder="Rechercher un partenaire..." 
                        class="w-full md:w-1/3 p-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-300"
                        name="search"
                        value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>"
                    >
                    <div class="flex gap-4 mt-4 md:mt-0">
                        <select 
                            id="filter-category" 
                            class="p-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-300"
                            name="category"
                        >
                            <option value="">Toutes les catégories</option>
                            <option value="Hôtels" <?= isset($_GET['category']) && $_GET['category'] == 'Hôtels' ? 'selected' : '' ?>>Hôtels</option>
                            <option value="Cliniques" <?= isset($_GET['category']) && $_GET['category'] == 'Cliniques' ? 'selected' : '' ?>>Cliniques</option>
                            <option value="Écoles" <?= isset($_GET['category']) && $_GET['category'] == 'Écoles' ? 'selected' : '' ?>>Écoles</option>
                            <option value="Agences de Voyage" <?= isset($_GET['category']) && $_GET['category'] == 'Agences de Voyage' ? 'selected' : '' ?>>Agences de Voyage</option>
                        </select>
                        <select 
                            id="filter-city" 
                            class="p-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-300"
                            name="city"
                        >
                            <option value="">Toutes les villes</option>
                            <option value="Alger" <?= isset($_GET['city']) && $_GET['city'] == 'Alger' ? 'selected' : '' ?>>Alger</option>
                            <option value="Oran" <?= isset($_GET['city']) && $_GET['city'] == 'Oran' ? 'selected' : '' ?>>Oran</option>
                            <option value="Constantine" <?= isset($_GET['city']) && $_GET['city'] == 'Constantine' ? 'selected' : '' ?>>Constantine</option>
                        </select>
                    </div>
                    <button type="submit" class="hidden">Apply Filters</button>
                </form>

                <!-- Partners Table -->
                <div id="partners-container">
                      <table class="min-w-full bg-white  rounded-md overflow-hidden">
                          <thead class="bg-blue-900 text-white">
                            <tr>
                                <th class="py-2 px-4 border border-gray-300">Ville</th>
                                <th class="py-2 px-4 border border-gray-300">Category</th>
                                <th class="py-2 px-4 border border-gray-300">Name</th>
                                <th class="py-2 px-4 border border-gray-300">Reduction</th>
                                <th class="py-2 px-4 border border-gray-300">Modifier</th>
                                <th class="py-2 px-4 border border-gray-300">Supprimer</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($partners as $partner): ?>
                            <tr>
                                <td class="py-2 px-4 border border-gray-300"><?php echo htmlspecialchars($partner->ville); ?></td>
                                <td class="py-2 px-4 border border-gray-300"><?php echo htmlspecialchars($partner->categorie); ?></td>
                                <td class="py-2 px-4 border border-gray-300"><?php echo htmlspecialchars($partner->nom); ?></td>
                                <td class="py-2 px-4 border border-gray-300"><?php echo htmlspecialchars($partner->detail_reduction); ?></td>
                                <td class="py-2 px-4 border border-gray-300">
                                  <a href="?route=admin/gestion-partenaire/edit&id=<?= $partner->id ?>" class="text-blue-600 hover:text-blue-800">Modifier</a>
                                </td>
                                <td class="py-2 px-4 border border-gray-300">
                                    <a href="?route=admin/delete-partner&id=<?php echo $partner->id; ?>"  
                                        class="text-red-600 hover:text-red-800">Supprimer</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <button id="addPartnerButton" class="mt-4 inline-block bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700">Ajouter un nouveau partenaire</button>
            </div>
            <script>
                document.getElementById('addPartnerButton').addEventListener('click', function(event) {
                    window.location.href = '?route=admin/gestion-partenaire/add';  
                });

                function debounce(func, wait) {
                    let timeout;
                    return function(...args) {
                        clearTimeout(timeout);
                        timeout = setTimeout(() => func.apply(this, args), wait);
                    };
                }

                // Function to update URL parameters
                function updateURLParameters(params) {
                    const url = new URL(window.location.href);
                    Object.keys(params).forEach(key => {
                        if (params[key]) {
                            url.searchParams.set(key, params[key]);
                        } else {
                            url.searchParams.delete(key);
                        }
                    });
                    window.history.pushState({}, '', url);
                }

                // Function to fetch filtered partners
                function fetchFilteredPartners() {
                    const search = document.getElementById('search').value;
                    const category = document.getElementById('filter-category').value;
                    const city = document.getElementById('filter-city').value;

                    // Update URL parameters
                    updateURLParameters({
                        search: search,
                        category: category,
                        city: city
                    });

                    // Fetch updated results via AJAX
                    const params = new URLSearchParams({
                        search: search,
                        category: category,
                        city: city
                    });

                    fetch(`index.php?route=admin/gestion-partenaire&${params.toString()}`)
                        .then(response => response.text())
                        .then(html => {
                            const parser = new DOMParser();
                            const doc = parser.parseFromString(html, 'text/html');
                            const newContent = doc.getElementById('partners-container').innerHTML;
                            document.getElementById('partners-container').innerHTML = newContent;
                        })
                        .catch(error => console.error('Error:', error));
                }

                // Event listeners
                document.getElementById('search').addEventListener('input', debounce(fetchFilteredPartners, 300));
                document.getElementById('filter-category').addEventListener('change', fetchFilteredPartners);
                document.getElementById('filter-city').addEventListener('change', fetchFilteredPartners);

            </script>
        </body>
        </html>
        <?php
    }

    public function renderAddPartnerForm() {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Ajouter un nouveau partenaire</title>
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
                <h1 class="text-2xl font-semibold mb-4">Ajouter un nouveau partenaire</h1>
                <form method="POST" action="?route=admin/gestion-partenaire/add" class="space-y-4">
                    <div>
                        <label for="nom" class="block">Nom :</label>
                        <input type="text" name="nom" id="nom" class="p-2 border border-gray-300 rounded-md w-full" required>
                    </div>
                    <div>
                        <label for="categorie" class="block">Category:</label>
                        <input type="text" name="categorie" id="categorie" class="p-2 border border-gray-300 rounded-md w-full" required>
                    </div>
                    <div>
                        <label for="ville" class="block">City:</label>
                        <input type="text" name="ville" id="ville" class="p-2 border border-gray-300 rounded-md w-full" required>
                    </div>
                    <div>
                        <label for="detail_reduction" class="block">Description:</label>
                        <textarea name="detail_reduction" id="detail_reduction" class="p-2 border border-gray-300 rounded-md w-full" required></textarea>
                    </div>
                    <div>
                        <label for="lien_site_web" class="block">Website:</label>
                        <input type="text" name="lien_site_web" id="lien_site_web" class="p-2 border border-gray-300 rounded-md w-full" required>
                    </div>
                    <div>
                        <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-md">Ajouter partenaire</button>
                    </div>
                </form>
            </div>
        </body>
        </html>
        
        <?php
    }

public function renderEditPartnerForm($partner)
{
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Modifier un partenaire</title>
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
            <h1 class="text-2xl font-semibold mb-4">Modifier un partenaire</h1>
            <form method="POST" action="?route=admin/gestion-partenaire/edit" class="space-y-4">
                <input type="hidden" name="id" value="<?= htmlspecialchars($partner->id) ?>">
                <div>
                    <label for="nom" class="block">Nom :</label>
                    <input type="text" name="nom" id="nom" class="p-2 border border-gray-300 rounded-md w-full" value="<?= htmlspecialchars($partner->nom) ?>" required>
                </div>
                <div>
                    <label for="categorie" class="block">Catégorie :</label>
                    <input type="text" name="categorie" id="categorie" class="p-2 border border-gray-300 rounded-md w-full" value="<?= htmlspecialchars($partner->categorie) ?>" required>
                </div>
                <div>
                    <label for="ville" class="block">Ville :</label>
                    <input type="text" name="ville" id="ville" class="p-2 border border-gray-300 rounded-md w-full" value="<?= htmlspecialchars($partner->ville) ?>" required>
                </div>
                <div>
                    <label for="detail_reduction" class="block">Description :</label>
                    <textarea name="detail_reduction" id="detail_reduction" class="p-2 border border-gray-300 rounded-md w-full" required><?= htmlspecialchars($partner->detail_reduction) ?></textarea>
                </div>
                <div>
                    <label for="lien_site_web" class="block">Site Web :</label>
                    <input type="text" name="lien_site_web" id="lien_site_web" class="p-2 border border-gray-300 rounded-md w-full" value="<?= htmlspecialchars($partner->lien_site_web) ?>" required>
                </div>
                <div>
                    <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-md">Modifier partenaire</button>
                </div>
            </form>
        </div>
    </body>
    </html>
    <?php
}

}
