<?php
$is_ajax = isset($_GET['ajax']);

if (!$is_ajax) {
    require_once 'includes/auth.php';
    require_once 'classes/Destination.php';
    requireLogin();

    $destination = new Destination();
    $stats = $destination->getStats($_SESSION['user_id']);
    $countries = $destination->getCountries($_SESSION['user_id']);

    $page_title = 'Dashboard';
    include 'includes/header.php';
} else {
    // For AJAX requests, we still need the session and data
    require_once 'includes/auth.php';
    require_once 'classes/Destination.php';
    requireLogin();

    $destination = new Destination();
    $stats = $destination->getStats($_SESSION['user_id']);
    $countries = $destination->getCountries($_SESSION['user_id']);
}
?>

<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">
            Welcome back, <?php echo htmlspecialchars($_SESSION['username']); ?>! 👋
        </h1>
        <p class="text-gray-600">Manage your travel destinations and track your adventures.</p>
    </div>

    <!-- Statistics Cards -->
    <div id="statsContainer" class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="flex items-center">
                <div class="text-3xl mr-4">🌍</div>
                <div>
                    <p class="text-sm text-gray-600">Total Destinations</p>
                    <p id="statsTotal" class="text-2xl font-bold text-gray-900"><?php echo $stats['total']; ?></p>
                </div>
            </div>
        </div>
        
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="flex items-center">
                <div class="text-3xl mr-4">✅</div>
                <div>
                    <p class="text-sm text-gray-600">Visited</p>
                    <p id="statsVisited" class="text-2xl font-bold text-green-600"><?php echo $stats['visited']; ?></p>
                </div>
            </div>
        </div>
        
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="flex items-center">
                <div class="text-3xl mr-4">💭</div>
                <div>
                    <p class="text-sm text-gray-600">Wishlist</p>
                    <p id="statsWishlist" class="text-2xl font-bold text-blue-600"><?php echo $stats['wishlist']; ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters and Search -->
    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
            <div class="flex flex-col md:flex-row gap-4 flex-1">
                <input type="text" id="searchInput" placeholder="Search destinations..." 
                       class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                
                <select id="countryFilter" class="px-7 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                    <option value="">All Countries</option>
                    <?php foreach ($countries as $country): ?>
                        <option value="<?php echo htmlspecialchars($country); ?>"><?php echo htmlspecialchars($country); ?></option>
                    <?php endforeach; ?>
                </select>
                
                <select id="typeFilter" class="px-7 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                    <option value="">All Types</option>
                    <option value="city">City</option>
                    <option value="beach">Beach</option>
                    <option value="mountain">Mountain</option>
                    <option value="cultural">Cultural</option>
                    <option value="adventure">Adventure</option>
                    <option value="nature">Nature</option>
                </select>

                <select id="statusFilter" class="px-7 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                    <option value="">All Statuses</option>
                    <option value="wishlist">Wishlist</option>
                    <option value="visited">Visited</option>
                </select>
            </div>
            
            <div class="flex gap-2">
                <a href="add_destination.php" class="bg-primary text-white px-4 py-2 rounded-md hover:bg-blue-600">
                    Add Destination
                </a>
                <a href="export.php" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">
                    Export XML
                </a>
            </div>
        </div>
    </div>

    <!-- Destinations List -->
    <div id="destinationsList" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Destinations will be loaded here via AJAX -->
    </div>
    
    <div id="noResults" class="text-center py-8 hidden">
        <div class="text-gray-400 text-6xl mb-4">🔍</div>
        <p class="text-gray-600">No destinations found matching your criteria.</p>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-xl max-w-md w-full mx-4">
        <h3 class="text-lg font-semibold mb-4">Confirm Delete</h3>
        <p class="text-gray-600 mb-6">Are you sure you want to delete this destination? This action cannot be undone.</p>
        <div class="flex gap-4 justify-end">
            <button id="cancelDelete" class="px-4 py-2 text-gray-600 border border-gray-300 rounded hover:bg-gray-50">
                Cancel
            </button>
            <button id="confirmDelete" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                Delete
            </button>
        </div>
    </div>
</div>

<script>
let currentDeleteId = null;

// Load destinations
function loadDestinations() {
    const search = document.getElementById('searchInput').value;
    const country = document.getElementById('countryFilter').value;
    const type = document.getElementById('typeFilter').value;
    const status = document.getElementById('statusFilter').value;
    
    const params = new URLSearchParams();
    if (search) params.append('search', search);
    if (country) params.append('country', country);
    if (type) params.append('type', type);
    if (status) params.append('status', status);
    
    fetch(`api/destinations.php?${params.toString()}`)
        .then(response => response.json())
        .then(data => {
            const container = document.getElementById('destinationsList');
            const noResults = document.getElementById('noResults');
            
            if (data.length === 0) {
                container.innerHTML = '';
                noResults.classList.remove('hidden');
            } else {
                noResults.classList.add('hidden');
                container.innerHTML = data.map(destination => `
                    <div id="dest-${destination.id}" class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow overflow-hidden">
                        <img src="${destination.image ? destination.image : 'https://placehold.co/600x400/E2E8F0/AAAAAA/png?text=No+Image'}" alt="${destination.name}" class="w-full h-48 object-cover">
                        <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="text-xl font-semibold text-gray-900">${destination.name}</h3>
                            <span class="px-2 py-1 text-xs rounded-full ${destination.status === 'visited' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800'}">
                                ${destination.status === 'visited' ? '✅ Visited' : '💭 Wishlist'}
                            </span>
                        </div>
                        
                        <div class="space-y-2 mb-4">
                            <p class="text-gray-600"><span class="font-medium">Country:</span> ${destination.country}</p>
                            <p class="text-gray-600"><span class="font-medium">Type:</span> ${destination.type.charAt(0).toUpperCase() + destination.type.slice(1)}</p>
                            ${destination.notes ? `<p class="text-gray-600"><span class="font-medium">Notes:</span> ${destination.notes}</p>` : ''}
                        </div>
                        
                        <div class="flex gap-2">
                            <a href="edit_destination.php?id=${destination.id}" class="flex-1 bg-blue-500 text-white text-center py-2 rounded hover:bg-blue-600">
                                Edit
                            </a>
                            <button onclick="showDeleteModal(${destination.id})" class="flex-1 bg-red-500 text-white py-2 rounded hover:bg-red-600">
                                Delete
                            </button>
                        </div>
                        </div>
                    </div>
                `).join('');
            }
        })
        .catch(error => {
            console.error('Error loading destinations:', error);
        });
}

// Event listeners
document.getElementById('searchInput').addEventListener('input', loadDestinations);
document.getElementById('countryFilter').addEventListener('change', loadDestinations);
document.getElementById('typeFilter').addEventListener('change', loadDestinations);
document.getElementById('statusFilter').addEventListener('change', loadDestinations);

// Delete modal functions
function showDeleteModal(id) {
    currentDeleteId = id;
    document.getElementById('deleteModal').classList.remove('hidden');
    document.getElementById('deleteModal').classList.add('flex');
}

document.getElementById('cancelDelete').addEventListener('click', () => {
    document.getElementById('deleteModal').classList.add('hidden');
    document.getElementById('deleteModal').classList.remove('flex');
    currentDeleteId = null;
});

document.getElementById('confirmDelete').addEventListener('click', () => {
    if (currentDeleteId) {
        // We need a reliable way to get the token, let's add it to a hidden input
        // In the main layout, you should have: <input type="hidden" id="csrf-token-for-js" value="<?php echo generateCSRFToken(); ?>">
        // For now, we'll assume it exists. Let's modify the PHP to add it.
        const csrfToken = document.getElementById('csrf-token-for-js') ? document.getElementById('csrf-token-for-js').value : '<?php echo generateCSRFToken(); ?>'; // Fallback for initial load
        const formData = new FormData();
        formData.append('id', currentDeleteId);
        formData.append('csrf_token', csrfToken);

        fetch('api/delete_destination.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                loadDestinations(); // Reload the list
                updateStats(); // Reload the stats
                document.getElementById('deleteModal').classList.add('hidden');
                document.getElementById('deleteModal').classList.remove('flex');
            } else {
                alert('Error: ' + (data.message || 'Failed to delete destination.'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An unexpected error occurred.');
        });
    }
    document.getElementById('deleteModal').classList.remove('flex');
    currentDeleteId = null;
});

function updateStats() {
    fetch('api/get_stats.php')
        .then(response => response.json())
        .then(data => {
            document.getElementById('statsTotal').textContent = data.total;
            document.getElementById('statsVisited').textContent = data.visited;
            document.getElementById('statsWishlist').textContent = data.wishlist;
        })
        .catch(error => console.error('Error updating stats:', error));
}

// Load initial data
function initializeDashboard() {
    loadDestinations();
    updateStats();

    // Re-attach event listeners if they are not delegated
    document.getElementById('searchInput').addEventListener('input', loadDestinations);
    document.getElementById('countryFilter').addEventListener('change', loadDestinations);
    document.getElementById('typeFilter').addEventListener('change', loadDestinations);
    document.getElementById('statusFilter').addEventListener('change', loadDestinations);

    document.getElementById('cancelDelete').addEventListener('click', () => {
        document.getElementById('deleteModal').classList.add('hidden');
        document.getElementById('deleteModal').classList.remove('flex');
        currentDeleteId = null;
    });

    document.getElementById('confirmDelete').addEventListener('click', () => {
        if (currentDeleteId) {
            const csrfToken = document.getElementById('csrf-token-for-js').value;
            const formData = new FormData();
            formData.append('id', currentDeleteId);
            formData.append('csrf_token', csrfToken);

            fetch('api/delete_destination.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    loadDestinations();
                    updateStats();
                    document.getElementById('deleteModal').classList.add('hidden');
                    document.getElementById('deleteModal').classList.remove('flex');
                } else {
                    alert('Error: ' + (data.message || 'Failed to delete destination.'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An unexpected error occurred.');
            });
        }
        document.getElementById('deleteModal').classList.remove('flex');
        currentDeleteId = null;
    });
}

initializeDashboard();

</script>

<?php if (!$is_ajax) { include 'includes/footer.php'; } ?>