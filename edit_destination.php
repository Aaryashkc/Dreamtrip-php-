<?php
require_once 'includes/auth.php';
require_once 'classes/Destination.php';

requireLogin();

$destination_obj = new Destination();
$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: dashboard.php');
    exit();
}

$destination = $destination_obj->getById($id, $_SESSION['user_id']);

if (!$destination) {
    header('Location: dashboard.php');
    exit();
}

$error = '';
$success = '';

$page_title = 'Edit Destination';
include 'includes/header.php';
?>

<div class="min-h-screen bg-gray-50 flex items-center justify-center p-6">
    <div class="w-full max-w-5xl">
        <!-- Clean Header -->
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-gray-900 mb-2">Edit Destination</h1>
            <p class="text-gray-600">Update your destination information</p>
        </div>

        <!-- Main Card -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div id="statusMessage" class="hidden"></div>
            
            <?php if ($error): ?>
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>
            
            <?php if ($success): ?>
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4">
                    <?php echo htmlspecialchars($success); ?>
                </div>
            <?php endif; ?>
            
            <!-- Form Content -->
            <div class="p-8">
                <form id="editForm" class="space-y-6">
                    <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
                    <input type="hidden" name="id" value="<?php echo $destination['id']; ?>">
                    
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
                                       value="<?php echo htmlspecialchars($_POST['name'] ?? $destination['name']); ?>">
                            </div>

                            <div>
                                <label for="country" class="block text-sm font-medium text-gray-700 mb-2">
                                    Country *
                                </label>
                                <input type="text" id="country" name="country" required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                       placeholder="Japan, France, Indonesia..."
                                       value="<?php echo htmlspecialchars($_POST['country'] ?? $destination['country']); ?>">
                            </div>

                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700 mb-2">
                                    Category *
                                </label>
                                <select id="type" name="type" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 bg-white">
                                    <option value="">Choose category</option>
                                    <?php
                                    $types = ['city', 'beach', 'mountain', 'cultural', 'adventure', 'nature'];
                                    $selected_type = $_POST['type'] ?? $destination['type'];
                                    foreach ($types as $type_option):
                                    ?>
                                        <option value="<?php echo $type_option; ?>" <?php echo $selected_type === $type_option ? 'selected' : ''; ?>>
                                            <?php echo ucfirst($type_option); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                                    Status *
                                </label>
                                <select id="status" name="status" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 bg-white">
                                    <option value="">Select status</option>
                                    <?php $selected_status = $_POST['status'] ?? $destination['status']; ?>
                                    <option value="wishlist" <?php echo $selected_status === 'wishlist' ? 'selected' : ''; ?>>Wishlist</option>
                                    <option value="visited" <?php echo $selected_status === 'visited' ? 'selected' : ''; ?>>Visited</option>
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
                                          placeholder="Share your experiences, plans, or why this place is special to you..."><?php echo htmlspecialchars($_POST['notes'] ?? $destination['notes']); ?></textarea>
                            </div>
                        </div>

                        <!-- Column 3: Image & Actions -->
                        <div class="space-y-5">
                            <div class="border-b border-gray-200 pb-3">
                                <h3 class="text-lg font-semibold text-gray-900">Image & Actions</h3>
                            </div>
                            
                            <!-- Current Image Preview -->
                            <?php if ($destination['image']): ?>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Current Image</label>
                                    <div class="border rounded-lg p-4 bg-gray-50">
                                        <img src="<?php echo htmlspecialchars($destination['image']); ?>" 
                                             alt="Current destination image" 
                                             class="w-full h-32 object-cover rounded-md">
                                    </div>
                                </div>
                            <?php endif; ?>
                            
                            <div>
                                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                                    <?php echo $destination['image'] ? 'Change Photo' : 'Upload Photo'; ?>
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
                                    Update Destination
                                </button>
                                <a href="dashboard.php" 
                                   class="w-full block bg-gray-100 text-gray-700 py-3 px-6 rounded-lg font-medium hover:bg-gray-200 focus:outline-none focus:ring-4 focus:ring-gray-300 text-center transition duration-200">
                                    Cancel
                                </a>
                            </div>

                            <!-- Update Info -->
                            <div class="bg-blue-50 rounded-lg p-4 mt-6">
                                <h4 class="text-sm font-medium text-blue-700 mb-2">Update Tips</h4>
                                <ul class="text-xs text-blue-600 space-y-1">
                                    <li>• Changes are saved immediately</li>
                                    <li>• New images replace the current one</li>
                                    <li>• All fields are preserved on errors</li>
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
document.getElementById('editForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);
    const statusDiv = document.getElementById('statusMessage');
    const submitBtn = form.querySelector('button[type="submit"]');
    
    // Add loading state
    const originalText = submitBtn.textContent;
    submitBtn.textContent = 'Updating...';
    submitBtn.disabled = true;
    submitBtn.classList.add('opacity-75');

    fetch('api/update_destination.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            statusDiv.className = 'bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6';
            statusDiv.textContent = data.message + ' Redirecting to dashboard...';

            // Update image preview if a new image was uploaded
            if (formData.get('image').name) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    let img = document.querySelector('img[alt="Current destination image"]');
                    if (img) {
                        img.src = e.target.result;
                    } else {
                        // If no image was there before, create one
                        const imageContainer = document.querySelector('label[for="image"]').parentElement;
                        const newImgDiv = document.createElement('div');
                        newImgDiv.innerHTML = `
                            <label class="block text-sm font-medium text-gray-700 mb-2">Current Image</label>
                            <div class="border rounded-lg p-4 bg-gray-50">
                                <img src="${e.target.result}" alt="Current destination image" class="w-full h-32 object-cover rounded-md">
                            </div>
                        `;
                        imageContainer.parentNode.insertBefore(newImgDiv, imageContainer);
                    }
                }
                reader.readAsDataURL(formData.get('image'));
            }

            setTimeout(() => {
                window.location.href = 'dashboard.php';
            }, 1000);
        } else {
            statusDiv.className = 'bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6';
            statusDiv.textContent = data.message || 'An error occurred.';
        }
        statusDiv.classList.remove('hidden');
    })
    .catch(error => {
        statusDiv.className = 'bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6';
        statusDiv.textContent = 'An unexpected error occurred.';
        statusDiv.classList.remove('hidden');
        console.error('Error:', error);
    })
    .finally(() => {
        submitBtn.textContent = originalText;
        submitBtn.disabled = false;
        submitBtn.classList.remove('opacity-75');
    });
});
</script>

<?php include 'includes/footer.php'; ?>