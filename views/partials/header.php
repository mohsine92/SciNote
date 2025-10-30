<link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">

<header class="bg-gray-800 text-white p-4 flex justify-between items-center">
    <h1 class="text-xl font-bold">SciNote Admin</h1>
    
    <?php if(isset($_SESSION['admin'])): ?>
        <a href="logout.php" class="bg-gray-500 px-3 py-1 rounded hover:bg-gray-600">Déconnexion</a>
    <?php endif; ?>
</header>