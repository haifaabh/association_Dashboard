<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body class="m-10">
    <nav class="flex justify-between items-center mb-14 mt-6 px-4" id="nav1">
    <div class="flex items-center">
        <h1 class="text-2xl font-bold text-blue-900">Elmontada</h1>
    </div>

    <div class="flex items-center">
        <div class="flex space-x-6 mr-8">
            <a href="https://facebook.com" class="text-blue-600 text-2xl hover:opacity-80 transition-all">
                <i class="fab fa-facebook"></i>
            </a>
            <a href="https://twitter.com" class="text-blue-400 text-2xl hover:opacity-80 transition-all">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="https://instagram.com" class="text-pink-600 text-2xl hover:opacity-80 transition-all">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="https://linkedin.com" class="text-blue-700 text-2xl hover:opacity-80 transition-all">
                <i class="fab fa-linkedin"></i>
            </a>
        </div>

        <div class="flex space-x-4">
            <button id="login" class="bg-blue-900 text-white px-6 py-2 rounded-md hover:bg-blue-800 transition-colors font-medium">
                Connexion
            </button>
            <button id="partnerLogin" class="bg-green-600 text-white px-6 py-2 rounded-md hover:bg-green-500 transition-colors font-medium">
                Partenaire Connexion
            </button>
        </div>
    </div>
</nav>

    <!-- Hero Section -->
    <section class="flex justify-between items-center mb-16">
        <div class="w-[50%]">
            <h2 class="text-2xl font-bold mb-6">Rejoignez notre communauté et faites une différence</h2>
            <p class="text-lg mb-8">Participez à des actions solidaires, bénéficiez d'avantages exclusifs et découvrez comment vous pouvez contribuer à notre cause.</p>
            <div class="flex space-x-10">
                <button id="effectuerDon" class="bg-blue-200 text-black px-6 py-2 rounded-md font-semibold">effectuer un don</button>
                <button id="devenirMembre" class="bg-blue-900 text-white px-4 py-2 rounded-md font-semibold">Devenir un membre</button>
            </div>
        </div>

        <!-- Image slider  -->
        <div class="relative w-1/2 h-[300px] rounded-xl overflow-hidden">
            <div class="flex transition-transform duration-500 rounded-md" id="slider" style="width: 200%;">
                <div class="w-full flex-shrink-0">
                    <img src="../assets/image1.jpg" alt="Image 1" class="w-full object-cover">
                </div>
                <div class="w-full flex-shrink-0">
                    <img src="../assets/image1.jpg" alt="Image 2" class="w-full object-cover">
                </div>
                <div class="w-full flex-shrink-0">
                    <img src="../assets/image1.jpg" alt="Image 3" class="w-full object-cover">
                </div>
            </div>
        </div>
    </section>

    <!-- Secondary Navbar -->
    <nav class="sticky top-2 z-10" id="nav2">
        <div class="z-10 flex space-x-[50px] justify-center items-center mt-10 bg-blue-100 rounded-md py-4 px-10">
            <a class="cursor-pointer font-semibold hover:text-blue-600">Acceuille</a>
            <a class="cursor-pointer font-semibold hover:text-blue-600" id="catalogue">Catalogue</a>
            <a class="cursor-pointer font-semibold hover:text-blue-600">contact</a>
            <a class="cursor-pointer font-semibold hover:text-blue-600" href="?route=remise">Remises</a>
            <a class="cursor-pointer font-semibold hover:text-blue-600" href="?route=activity">Activités</a>
            <a class="cursor-pointer font-semibold hover:text-blue-600" href="?route=partenaire/login">Partenaire connexion</a>
        </div>
    </nav>

    <!-- Activity Section -->
    <section class="my-16">
        <div class="flex justify-between items-center mb-12">
            <div class="w-[50%] pr-8">
                <?php if (!empty($activities)) : ?>
                    <h2 class="text-2xl font-bold mb-6"><?= htmlspecialchars($activities[0]->titre) ?></h2>
                    <p class="mb-6"><?= htmlspecialchars($activities[0]->description) ?></p>
                    <p class="mb-3"><strong>Date:</strong> <?= htmlspecialchars($activities[0]->date) ?></p>
                    <p class="mb-3"><strong>Location:</strong> <?= htmlspecialchars($activities[0]->location) ?></p>
                <?php else : ?>
                    <p>Aucune activité disponible.</p>
                <?php endif; ?>
            </div>
            <div class="w-[50%] rounded-md flex justify-end">
                <?php if (!empty($activities)) : ?>
                    <img src="../uploads/<?php echo htmlspecialchars($activities[0]->image); ?>" alt="<?php echo htmlspecialchars($activities[0]->titre); ?>" class="rounded-md w-[400px] h-[300px]">
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Events Section -->
    <section class="my-16">
        <div class="flex justify-between items-center mb-12">
            <div class="w-[50%] pr-8">
                <h1 class="text-2xl font-bold mb-6">Nos prochains événements</h1>
                <?php if (!empty($events)) : ?>
                    <h2 class="text-xl font-bold mb-4"><?= htmlspecialchars($events[0]->titre) ?></h2>
                    <p class="mb-6"><?= htmlspecialchars($events[0]->description) ?></p>
                    <p class="mb-3"><strong>Date:</strong> <?= htmlspecialchars($events[0]->date) ?></p>
                    <p class="mb-3"><strong>Location:</strong> <?= htmlspecialchars($events[0]->location) ?></p>
                <?php else : ?>
                    <p>Aucun événement disponible pour le moment.</p>
                <?php endif; ?>
            </div>
            <div class="w-[50%] rounded-md flex justify-end">
                <?php if (!empty($events)) : ?>
                    <img src="../uploads/<?php echo htmlspecialchars($events[0]->image); ?>" alt="<?php echo htmlspecialchars($events[0]->titre); ?>" class="rounded-md w-[400px] h-[300px]">
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- News Section -->
    <section class="my-16">
        <div class="flex justify-between items-center mb-12">
            <div class="w-[50%] pr-8">
                <h1 class="text-2xl font-bold mb-6">Nos annonces</h1>
                <ul class="space-y-3">
                    <?php if (!empty($news)) : ?>
                        <h2 class="text-xl font-bold mb-4"><?= htmlspecialchars($news[0]->titre) ?></h2>
                    <p class="mb-6"><?= htmlspecialchars($news[0]->description) ?></p>
                    <p class="mb-3"><strong>Date:</strong> <?= htmlspecialchars($news[0]->date) ?></p>
                    <p class="mb-3"><strong>Location:</strong> <?= htmlspecialchars($news[0]->location) ?></p>
                    <?php else : ?>
                        <li>Aucune actualité disponible pour le moment.</li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="w-[50%] rounded-md flex justify-end">

                <?php if (!empty($news)) : ?>
                    <img src="../uploads/<?php echo htmlspecialchars($news[0]->image); ?>" alt="<?php echo htmlspecialchars($news[0]->titre); ?>" class="rounded-md w-[400px] h-[300px]">
                <?php endif; ?>
            </div>
        </div>
    </section>

 
    <!-- aventages Section -->
    <section class="my-16">
        <h2 class="text-3xl font-bold mb-6 text-center">Les avantages offerts aux membres</h2>
        <p class="text-center mb-8">En rejoignant notre association, vous bénéficiez d'une gamme d'avantages spécialement conçus pour répondre à vos besoins.</p>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse border border-gray-200">
                <thead>
                    <tr class="bg-blue-100">
                        <th class="border border-gray-300 px-6 py-3 font-semibold">Avantage</th>
                        <th class="border border-gray-300 px-6 py-3 font-semibold">Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border border-gray-300 px-6 py-3">Accès exclusif aux événements</td>
                        <td class="border border-gray-300 px-6 py-3">Participez à nos événements réservés aux membres tels que des conférences, ateliers, et sorties culturelles.</td>
                    </tr>
                    <tr class="bg-gray-50">
                        <td class="border border-gray-300 px-6 py-3">Réseautage et communauté</td>
                        <td class="border border-gray-300 px-6 py-3">Connectez-vous avec d'autres membres partageant vos intérêts et élargissez votre réseau personnel et professionnel.</td>
                    </tr>
                    <tr>
                        <td class="border border-gray-300 px-6 py-3">Réductions exclusives</td>
                        <td class="border border-gray-300 px-6 py-3">Profitez de réductions sur nos services, activités et partenariats avec des organisations locales.</td>
                    </tr>
                    <tr class="bg-gray-50">
                        <td class="border border-gray-300 px-6 py-3">Formation et développement</td>
                        <td class="border border-gray-300 px-6 py-3">Accédez à des cours et formations organisés par l'association pour développer vos compétences.</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="flex justify-center mt-8">
            <button id="catalogue2" class="bg-blue-200 font-bold text-black px-16 py-4 rounded-md">Explorer les réductions</button>
        </div>
    </section>

    <footer class="bg-gray-50">
    <div class="py-12 px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
            <div class="flex flex-col items-start">
                <div>
                    <h3 class="text-xl text-blue-900 font-bold mb-4">Elmontada</h3>
                    <p class="text-sm text-gray-600 max-w-xs">Créer des connexions et offrir des opportunités uniques pour tous nos membres.</p>
                </div>
                <div class="mt-6">
                    <p class="text-sm text-gray-600">Email: contact@association.com</p>
                    <p class="text-sm text-gray-600">Tel: +33 1 23 45 67 89</p>
                    <p class="text-sm text-gray-600">Adresse: 123 Rue de Paris, 75000 Paris</p>
                </div>
            </div>

            <div class="flex flex-col">
                <h4 class="text-lg text-blue-900 font-semibold mb-4">Liens Rapides</h4>
                <ul class="space-y-3">
                    <li><a href="?route=home" class="text-gray-600 hover:text-blue-900 transition-colors">Accueil</a></li>
                    <li><a href="?route=activity" class="text-gray-600 hover:text-blue-900 transition-colors">Activités</a></li>
                    <li><a href="?route=home" class="text-gray-600 hover:text-blue-900 transition-colors">Contact</a></li>
                    <li><a href="?route=remise" class="text-gray-600 hover:text-blue-900 transition-colors">Remises</a></li>
                    <li><a href="?route=catalogue" class="text-gray-600 hover:text-blue-900 transition-colors">Partenaires</a></li>
                </ul>
            </div>

            <div class="flex flex-col">
                <h4 class="text-lg text-blue-900 font-semibold mb-4">Suivez-nous</h4>
                <div class="flex flex-col space-y-3">
                    <a href="https://facebook.com" class="flex items-center text-gray-600 hover:text-blue-600 transition-colors">
                        <i class="fab fa-facebook text-xl w-8"></i>
                        <span>Facebook</span>
                    </a>
                    <a href="https://twitter.com" class="flex items-center text-gray-600 hover:text-blue-400 transition-colors">
                        <i class="fab fa-twitter text-xl w-8"></i>
                        <span>Twitter</span>
                    </a>
                    <a href="https://instagram.com" class="flex items-center text-gray-600 hover:text-pink-600 transition-colors">
                        <i class="fab fa-instagram text-xl w-8"></i>
                        <span>Instagram</span>
                    </a>
                    <a href="https://linkedin.com" class="flex items-center text-gray-600 hover:text-blue-700 transition-colors">
                        <i class="fab fa-linkedin text-xl w-8"></i>
                        <span>LinkedIn</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="mt-12 pt-8 border-t border-gray-200">
            <p class="text-center text-sm text-gray-600">© 2024 Nom de l'Association. Tous droits réservés.</p>
        </div>
    </div>
</footer>

    <script>
        let currentIndex = 0;
        const images = document.querySelectorAll('#slider img');
        setInterval(() => {
            currentIndex = (currentIndex + 1) % images.length;
            document.getElementById('slider').style.transform = `translateX(-${currentIndex * 100}%)`;
        }, 3000);

        document.getElementById('devenirMembre').addEventListener('click', function() {
            window.location.href = '?route=register';  
        });

        document.getElementById('effectuerDon').addEventListener('click', function() {
            window.location.href = '?route=don';  
        });

        document.getElementById('catalogue').addEventListener('click', function() {
            window.location.href = '?route=catalogue';  
        });

        document.getElementById('catalogue2').addEventListener('click', function() {
            window.location.href = '?route=catalogue';  
        });

        document.getElementById('login').addEventListener('click', function() {
            window.location.href = '?route=user/login';  
        });

        document.getElementById('partnerLogin').addEventListener('click', function() {
            window.location.href = '?route=partenaire/login';  
        });
    </script>
</body>

</html>