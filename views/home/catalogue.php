<?php

class catalogue {
    public function render($partenaires = [], $filters = []) {
        $search = isset($filters['search']) ? $filters['search'] : '';
        $category = isset($filters['category']) ? $filters['category'] : '';
        $city = isset($filters['city']) ? $filters['city'] : '';
    
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue des Partenaires</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
            <header class="bg-blue-900 text-white py-4">
                <div class="container mx-auto px-4">
                    <h1 class="text-2xl font-bold">Catalogue de Nos Partenaires</h1>
                </div>
            </header>
<div class="bg-white shadow-md p-4 flex flex-wrap justify-between items-center">
    <input 
        type="text" 
        id="search" 
        placeholder="Rechercher un partenaire..." 
        class="w-full md:w-1/3 p-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-300"
        value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>"
    >
    <div class="flex gap-4 mt-4 md:mt-0">
        <select 
            id="filter-category" 
            class="p-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-300"
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
        >
            <option value="">Toutes les villes</option>
            <option value="Alger" <?= isset($_GET['city']) && $_GET['city'] == 'Alger' ? 'selected' : '' ?>>Alger</option>
            <option value="Oran" <?= isset($_GET['city']) && $_GET['city'] == 'Oran' ? 'selected' : '' ?>>Oran</option>
            <option value="Constantine" <?= isset($_GET['city']) && $_GET['city'] == 'Constantine' ? 'selected' : '' ?>>Constantine</option>
        </select>
    </div>
    <button type="submit" class="hidden">Apply Filters</button>
</div>

<div id="catalogue-container" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
    <?php if (!empty($partenaires)): ?>
        <?php foreach ($partenaires as $partenaire): ?>
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <img 
                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSRbFL8Fj2PE1N6ifLJNXhoavbBg23_kE_-2g&s/300x150" 
                    alt="Image partenaire" 
                    class="w-full h-40 object-cover"
                >
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-800"><?= htmlspecialchars($partenaire->nom) ?></h3>
                    <p class="text-sm text-gray-600"><strong>Catégorie:</strong> <?= htmlspecialchars($partenaire->categorie) ?></p>
                    <p class="text-sm text-gray-600"><strong>Ville:</strong> <?= htmlspecialchars($partenaire->ville) ?></p>
                    <p class="text-sm text-gray-600"><strong>Réduction:</strong> <?= htmlspecialchars($partenaire->detail_reduction) ?></p>
                    <a 
                        href="<?= htmlspecialchars($partenaire->lien_site_web) ?>" 
                        target="_blank" 
                        class="mt-4 inline-block py-2 w-full text-center text-white bg-blue-900 rounded-md hover:bg-blue-600"
                    >
                        Voir plus
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="col-span-full text-center text-gray-500">Aucun partenaire trouvé.</p>
    <?php endif; ?>
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

    // Fetch updated results
    const params = new URLSearchParams({ 
        search: search,
        category: category,
        city: city
    });

    fetch(`index.php?route=catalogue&${params.toString()}`)
        .then(response => response.text())
        .then(html => {
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const newContent = doc.getElementById('catalogue-container').innerHTML;
            document.getElementById('catalogue-container').innerHTML = newContent;
        })
        .catch(error => console.error('Error:', error));
}

// Event listeners
document.getElementById('search').addEventListener('input', 
    debounce(() => fetchFilteredPartners(), 300)
);

document.getElementById('filter-category').addEventListener('change', fetchFilteredPartners);
document.getElementById('filter-city').addEventListener('change', fetchFilteredPartners);
</script>
</body>
</html>
<?php
}
}