<?php
class SidebarView {
    public function render() {
        $currentRoute = isset($_GET['route']) ? $_GET['route'] : '';

        ?>
        <div class="w-64 min-h-screen bg-gray-800 text-white p-6 flex-shrink-0">
            <h2 class="text-2xl font-semibold mb-6 text-white">Admin Dashboard</h2>
            <ul class="space-y-4">
                <li>
                    <a href="?route=admin/gestion-partenaire" 
                       class="block p-3 rounded-md text-white hover:bg-blue-700 <?= ($currentRoute == 'admin/gestion-partenaire' || $currentRoute == 'admin/gestion-partenaire/add') ? 'bg-blue-900' : 'bg-gray-800' ?>"> 
                       Gestion des Partenaires
                    </a>
                </li>
                <li>
                    <a href="?route=admin/gestion-membres" 
                       class="block p-3 rounded-md text-white hover:bg-blue-700 <?= ($currentRoute == 'admin/gestion-membres') ? 'bg-blue-900' : 'bg-gray-800' ?>"> 
                       Gestion des demandes
                    </a>
                </li>
                <li>
                    <a href="?route=admin/liste-membres" 
                       class="block p-3 rounded-md text-white hover:bg-blue-700 <?= ($currentRoute == 'admin/liste-membres') ? 'bg-blue-900' : 'bg-gray-800' ?>"> 
                       Liste des Membres
                    </a>
                </li>
                <li>
                    <a href="?route=admin/dons" 
                       class="block p-3 rounded-md text-white hover:bg-blue-700 <?= ($currentRoute == 'admin/dons') ? 'bg-blue-900' : 'bg-gray-800' ?>"> 
                       Gestion des Dons
                    </a>
                </li>
                <li>
                    <a href="?route=admin/benevoles" 
                       class="block p-3 rounded-md text-white hover:bg-blue-700 <?= ($currentRoute == 'admin/benevoles'  || $currentRoute == 'admin/update-benevoles' ) ? 'bg-blue-900' : 'bg-gray-800' ?>"> 
                       Gestion des Benevoles
                    </a>
                </li>
                
                <li>
                  <a href="index.php?route=admin/logout" 
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
