<?php
class SidebarUserView {
    public function render() {
        // Get current route from the query string
        $currentRoute = isset($_GET['route']) ? $_GET['route'] : '';
        ?>
        <div class="w-64 min-h-screen bg-gray-800 text-white p-6 flex-shrink-0">
            <h2 class="text-2xl font-semibold mb-6 text-white">User Dashboard</h2>
            <ul class="space-y-4">
                <li>
                    <a href="?route=user/profile" 
                       class="block p-3 rounded-md text-white hover:bg-blue-700 <?= ($currentRoute == 'user/profile') ? 'bg-blue-900' : 'bg-gray-800' ?>"> 
                       Profile
                    </a>
                </li>
                <li>
                    <a href="?route=user/carte" 
                       class="block p-3 rounded-md text-white hover:bg-blue-700 <?= ($currentRoute == 'user/carte') ? 'bg-blue-900' : 'bg-gray-800' ?>"> 
                       Carte
                    </a>
                </li>
                <li>
                    <a href="?route=user/dons" 
                       class="block p-3 rounded-md text-white hover:bg-blue-700 <?= ($currentRoute == 'user/dons') ? 'bg-blue-900' : 'bg-gray-800' ?>"> 
                       Gestion des Dons
                    </a>
                </li>
                <li>
                    <a href="?route=user/benevolats" 
                       class="block p-3 rounded-md text-white hover:bg-blue-700 <?= ($currentRoute == 'user/benevolats') ? 'bg-blue-900' : 'bg-gray-800' ?>"> 
                       Gestion des Bénévolats
                    </a>
                </li>

                <li>
                  <a href="index.php?route=user/logout" 
                      class="mt-20 block p-3 rounded-md text-white  hover:bg-red-800">
                      Déconnexion
                  </a>
                </li>

            </ul>
        </div>
        <?php
    }
}
?>
