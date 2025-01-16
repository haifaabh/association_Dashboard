<?php
class SidebarPartenaireView {
    public function render() {
        // Get current route from the query string
        $currentRoute = isset($_GET['route']) ? $_GET['route'] : '';
        ?>
        <div class="w-64 min-h-screen bg-gray-800 text-white p-6 flex-shrink-0">
            <h2 class="text-2xl font-semibold mb-6 text-white">Partenaire Dashboard</h2>
            <ul class="space-y-4">
                <li>
                    <a href="?route=partenaire/profile" 
                       class="block p-3 rounded-md text-white hover:bg-blue-700 <?= ($currentRoute == 'partenaire/profile' || $currentRoute == 'partenaire/updatePartenaireProfile' ) ? 'bg-blue-900' : 'bg-gray-800' ?>"> 
                       Profile
                    </a>
                </li>
                <li>
                    <a href="?route=partenaire/carte" 
                       class="block p-3 rounded-md text-white hover:bg-blue-700 <?= ($currentRoute == 'partenaire/carte'|| $currentRoute == 'partenaire/verifyCard') ? 'bg-blue-900' : 'bg-gray-800' ?>"> 
                       Verification Carte
                    </a>
                </li>
                  <a href="index.php?route=partenaire/logout" 
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
