<?php
class DemandeAideView
{
    public function render($categories = [], $message = '')
    {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Demande Aide</title>
            <script src="https://cdn.tailwindcss.com"></script>
        </head>
        <body class="bg-gray-100 font-sans antialiased">
            <div class="max-w-lg mx-auto p-6 bg-white rounded-lg shadow-lg mt-10">
                <h1 class="text-2xl font-semibold text-center mb-6">Demande Aide</h1>

                <?php if ($message): ?>
                    <p class="text-center text-green-500"><?= htmlspecialchars($message) ?></p>
                <?php endif; ?>

                <form action="index.php?route=user/demande-aide/submit" method="POST" enctype="multipart/form-data">
                    <div class="mb-4">
                        <label for="category_id" class="block text-gray-700 font-medium">Catégorie</label>
                        <select name="category_id" id="category_id" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                           <option value="">Select a category</option>
                            <?php foreach ($categories as $category): ?>
                             <option value="<?= htmlspecialchars($category->id) ?>" data-description="<?= htmlspecialchars($category->description) ?>">
                                <?= htmlspecialchars($category->nom) ?>
                             </option>
                           <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-gray-700 font-medium">Description des fichiers nécessaires</label>
                        <textarea
                             name="description"
                              id="description"
                              placeholder="La description sera affichée ici"
                              class="w-full h-32 px-4 py-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 resize"
                              readonly
                        ></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="date_naissance" class="block text-gray-700 font-medium">Date de Naissance</label>
                        <input type="date" name="date_naissance" id="date_naissance" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>

                    <div class="mb-4">
                        <label for="piece_jointe" class="block text-gray-700 font-medium">Pièce Jointe</label>
                        <input type="file" name="piece_jointe" id="piece_jointe" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>


                    

                    <div class="mt-6">
                        <button type="submit" class="w-full px-4 py-2 bg-blue-900 text-white font-semibold rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Submit</button>
                    </div>
                </form>
            </div>
            <script>
                document.getElementById('category_id').addEventListener('change', function () {
                const selectedOption = this.options[this.selectedIndex];
                const description = selectedOption.getAttribute('data-description') || 'Please select a category.';
                document.getElementById('description').value = description;
                 });
             </script>
        </body>
        </html>
        <?php
    }
}
