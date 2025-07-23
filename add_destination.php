<?php
require_once 'includes/auth.php';
requireLogin();

$page_title = 'Add Destination';
include 'includes/header.php';
?>

<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Add New Destination</h1>
            <p class="text-gray-600">Add a new place to your travel wishlist or mark a visited destination.</p>
        </div>

        <div class="bg-white p-8 rounded-lg shadow-md">
            <div id="statusMessage" class="hidden mb-6"></div>

            <form id="addForm" class="space-y-6">
                <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
                
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Destination Name *</label>
                    <input type="text" id="name" name="name" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                           placeholder="e.g., Tokyo, Santorini, Machu Picchu"
                           value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>">
                </div>

                <div>
                    <label for="country" class="block text-sm font-medium text-gray-700 mb-2">Country *</label>
                    <input type="text" id="country" name="country" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                           placeholder="e.g., Japan, Greece, Peru"
                           value="<?php echo htmlspecialchars($_POST['country'] ?? ''); ?>">
                </div>

                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Type *</label>
                    <select id="type" name="type" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                        <option value="">Select a type</option>
                        <option value="city" <?php echo ($_POST['type'] ?? '') === 'city' ? 'selected' : ''; ?>>City</option>
                        <option value="beach" <?php echo ($_POST['type'] ?? '') === 'beach' ? 'selected' : ''; ?>>Beach</option>
                        <option value="mountain" <?php echo ($_POST['type'] ?? '') === 'mountain' ? 'selected' : ''; ?>>Mountain</option>
                        <option value="cultural" <?php echo ($_POST['type'] ?? '') === 'cultural' ? 'selected' : ''; ?>>Cultural</option>
                        <option value="adventure" <?php echo ($_POST['type'] ?? '') === 'adventure' ? 'selected' : ''; ?>>Adventure</option>
                        <option value="nature" <?php echo ($_POST['type'] ?? '') === 'nature' ? 'selected' : ''; ?>>Nature</option>
                    </select>
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                    <select id="status" name="status" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                        <option value="">Select status</option>
                        <option value="wishlist" <?php echo ($_POST['status'] ?? '') === 'wishlist' ? 'selected' : ''; ?>>Wishlist</option>
                        <option value="visited" <?php echo ($_POST['status'] ?? '') === 'visited' ? 'selected' : ''; ?>>Visited</option>
                    </select>
                </div>

                <div>
                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Notes</label>
                    <textarea id="notes" name="notes" rows="4"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                              placeholder="Add any notes about this destination..."><?php echo htmlspecialchars($_POST['notes'] ?? ''); ?></textarea>
                </div>

                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Image</label>
                    <input type="file" id="image" name="image" accept="image/jpeg, image/png, image/gif"
                           class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-blue-600">
                </div>

                <div class="flex gap-4">
                    <button type="submit" 
                            class="flex-1 bg-primary text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                        Add Destination
                    </button>
                    <a href="dashboard.php" 
                       class="flex-1 bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-600 text-center">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

<script>
document.getElementById('addForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);
    const statusDiv = document.getElementById('statusMessage');

    fetch('api/add_destination.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            statusDiv.className = 'bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6';
            form.reset(); // Clear the form fields
        } else {
            statusDiv.className = 'bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6';
        }
        statusDiv.textContent = data.message;
        statusDiv.classList.remove('hidden');
    })
    .catch(error => {
        statusDiv.className = 'bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6';
        statusDiv.textContent = 'An unexpected error occurred. Please try again.';
        statusDiv.classList.remove('hidden');
        console.error('Error:', error);
    });
});
</script>
