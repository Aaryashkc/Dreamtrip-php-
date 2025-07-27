<?php
$is_ajax = isset($_GET['ajax']);

if (!$is_ajax) {
    require_once 'includes/auth.php';
    requireLogin();
    $page_title = 'Add Destination';
    include 'includes/header.php';
} else {
    require_once 'includes/auth.php';
    requireLogin();
}
?>

<div class="min-h-screen bg-gray-50 flex items-center justify-center p-6">
    <div class="w-full max-w-5xl">
        <!-- Clean Header -->
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-gray-900 mb-2">Add New Destination</h1>
            <p class="text-gray-600">Create a new entry for your travel collection</p>
        </div>

        <!-- Main Card -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div id="statusMessage" class="hidden"></div>
            
            <!-- Form Content -->
            <div class="p-8">
                <form id="addForm" class="space-y-6">
                    <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
                    
                    <!-- Three Column Grid -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        
                        <!-- Column 1: Basic Info -->
                        <div class="space-y-5">
                            <div class="border-b border-gray-200 pb-3">
                                <h3 class="text-lg font-semibold text-gray-900">Basic Information</h3>
                            </div>
                            
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                    Destination Name *
                                </label>
                                <input type="text" id="name" name="name" required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                       placeholder="Tokyo, Paris, Bali..."
                                       value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>">
                            </div>

                            <div>
                                <label for="country" class="block text-sm font-medium text-gray-700 mb-2">
                                    Country *
                                </label>
                                <input type="text" id="country" name="country" required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                       placeholder="Japan, France, Indonesia..."
                                       value="<?php echo htmlspecialchars($_POST['country'] ?? ''); ?>">
                            </div>

                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700 mb-2">
                                    Category *
                                </label>
                                <select id="type" name="type" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 bg-white">
                                    <option value="">Choose category</option>
                                    <option value="city" <?php echo ($_POST['type'] ?? '') === 'city' ? 'selected' : ''; ?>>City</option>
                                    <option value="beach" <?php echo ($_POST['type'] ?? '') === 'beach' ? 'selected' : ''; ?>>Beach</option>
                                    <option value="mountain" <?php echo ($_POST['type'] ?? '') === 'mountain' ? 'selected' : ''; ?>>Mountain</option>
                                    <option value="cultural" <?php echo ($_POST['type'] ?? '') === 'cultural' ? 'selected' : ''; ?>>Cultural</option>
                                    <option value="adventure" <?php echo ($_POST['type'] ?? '') === 'adventure' ? 'selected' : ''; ?>>Adventure</option>
                                    <option value="nature" <?php echo ($_POST['type'] ?? '') === 'nature' ? 'selected' : ''; ?>>Nature</option>
                                </select>
                            </div>

                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                                    Status *
                                </label>
                                <select id="status" name="status" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 bg-white">
                                    <option value="">Select status</option>
                                    <option value="wishlist" <?php echo ($_POST['status'] ?? '') === 'wishlist' ? 'selected' : ''; ?>>Wishlist</option>
                                    <option value="visited" <?php echo ($_POST['status'] ?? '') === 'visited' ? 'selected' : ''; ?>>Visited</option>
                                </select>
                            </div>
                        </div>

                        <!-- Column 2: Notes -->
                        <div class="space-y-5">
                            <div class="border-b border-gray-200 pb-3">
                                <h3 class="text-lg font-semibold text-gray-900">Personal Notes</h3>
                            </div>
                            
                            <div class="flex flex-col h-80">
                                <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                                    Your thoughts and memories
                                </label>
                                <textarea id="notes" name="notes"
                                          class="flex-1 w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 resize-none"
                                          placeholder="Share your experiences, plans, or why this place is special to you..."><?php echo htmlspecialchars($_POST['notes'] ?? ''); ?></textarea>
                            </div>
                        </div>

                        <!-- Column 3: Image & Actions -->
                        <div class="space-y-5">
                            <div class="border-b border-gray-200 pb-3">
                                <h3 class="text-lg font-semibold text-gray-900">Image & Actions</h3>
                            </div>
                            
                            <div>
                                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                                    Upload Photo
                                </label>
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-400 transition duration-200">
                                    <input type="file" id="image" name="image" accept="image/jpeg, image/png, image/gif"
                                           class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                    <p class="text-xs text-gray-500 mt-2">PNG, JPG or GIF (max 10MB)</p>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="space-y-3 pt-8">
                                <button type="submit" 
                                        class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg font-medium hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 transition duration-200 shadow-sm">
                                    Add Destination
                                </button>
                                <a href="dashboard.php" 
                                   class="nav-link w-full block bg-gray-100 text-gray-700 py-3 px-6 rounded-lg font-medium hover:bg-gray-200 focus:outline-none focus:ring-4 focus:ring-gray-300 text-center transition duration-200">
                                    Cancel
                                </a>
                            </div>

                            <!-- Quick Stats -->
                            <div class="bg-gray-50 rounded-lg p-4 mt-6">
                                <h4 class="text-sm font-medium text-gray-700 mb-2">Quick Tips</h4>
                                <ul class="text-xs text-gray-600 space-y-1">
                                    <li>• Be specific with destination names</li>
                                    <li>• Add personal notes for better memories</li>
                                    <li>• Upload high-quality images</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function initializeAddDestination() {
    const addForm = document.getElementById('addForm');
    if (addForm && !addForm.dataset.listenerAttached) {
        addForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const form = e.target;
            const formData = new FormData(form);
            const statusDiv = document.getElementById('statusMessage');
            const submitBtn = form.querySelector('button[type="submit"]');
            
            // Add loading state
            const originalText = submitBtn.textContent;
            submitBtn.textContent = 'Adding...';
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-75');

            fetch('api/add_destination.php', {
                method: 'POST',
                body: formData,
                credentials: 'same-origin'  // Ensures cookies are sent with the request
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    statusDiv.className = 'bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6';
                    statusDiv.textContent = data.message || 'Destination added successfully!';
                    form.reset();
                    // Redirect after 1.5 seconds
                    setTimeout(() => {
                        window.location.href = 'dashboard.php';
                    }, 1500);
                } else {
                    statusDiv.className = 'bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6';
                    statusDiv.textContent = data.message || 'Failed to add destination. Please try again.';
                }
                statusDiv.classList.remove('hidden');
            })
            .catch(error => {
                console.error('Error:', error);
                statusDiv.className = 'bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6';
                statusDiv.textContent = 'An error occurred while adding the destination. Please check the console for more details.';
                statusDiv.classList.remove('hidden');
            })
            .finally(() => {
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
                submitBtn.classList.remove('opacity-75');
            });
        });
        addForm.dataset.listenerAttached = 'true';
    }
}

// Initialize the form handler when the DOM is fully loaded
document.addEventListener('DOMContentLoaded', function() {
    initializeAddDestination();
});

initializeAddDestination();
</script>

<?php if (!$is_ajax) { include 'includes/footer.php'; } ?>