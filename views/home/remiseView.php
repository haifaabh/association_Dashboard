<?php

class remiseView {
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
            <title>Table des remises</title>
            <script src="https://cdn.tailwindcss.com"></script>
        </head>
        <body >
        <header class="bg-blue-900 text-white py-4">
                <div class="container mx-auto px-4">
                    <h1 class="text-2xl font-bold">Table des remises</h1>
                </div>
            </header>
            <!-- Main Content -->
            <div class="flex-1 p-6">
              
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

                
                <div id="partners-container">
                    <table class="min-w-full table-auto border-collapse border border-gray-300">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border border-gray-300">Ville</th>
                                <th class="py-2 px-4 border border-gray-300">Category</th>
                                <th class="py-2 px-4 border border-gray-300">Nom</th>
                                <th class="py-2 px-4 border border-gray-300">Reduction</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($partners as $partner): ?>
                            <tr>
                                <td class="py-2 px-4 border border-gray-300"><?php echo htmlspecialchars($partner->ville); ?></td>
                                <td class="py-2 px-4 border border-gray-300"><?php echo htmlspecialchars($partner->categorie); ?></td>
                                <td class="py-2 px-4 border border-gray-300"><?php echo htmlspecialchars($partner->nom); ?></td>
                                <td class="py-2 px-4 border border-gray-300"><?php echo htmlspecialchars($partner->detail_reduction); ?></td>
                                
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            </div>
         
            <script>
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

                    fetch(`index.php?route=remise&${params.toString()}`)
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

                document.getElementById('acceuil').addEventListener('click', function() {
                window.location.href = 'http://localhost/PROJECT_WEB/public/index.php';  // Redirect to the index page
                });

                document.getElementById('catalogue').addEventListener('click', function() {
                window.location.href = '?route=catalogue';  // Redirect to the catalogue page
                });
                
            </script>
        </body>
        </html>
        <?php
    }

    
}
