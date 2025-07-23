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

<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Edit Destination</h1>
            <p class="text-gray-600">Update your destination information.</p>
        </div>

        <div class="bg-white p-8 rounded-lg shadow-md">
            <div id="statusMessage" class="hidden mb-6"></div>
            <?php if ($error): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>
            
            <?php if ($success): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    <?php echo htmlspecialchars($success); ?>
                </div>
            <?php endif; ?>

            <form id="editForm" class="space-y-6">
                <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
                <input type="hidden" name="id" value="<?php echo $destination['id']; ?>">
                
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Destination Name *</label>
                    <input type="text" id="name" name="name" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                           placeholder="e.g., Tokyo, Santorini, Machu Picchu"
                           value="<?php echo htmlspecialchars($_POST['name'] ?? $destination['name']); ?>">
                </div>

                <div>
                    <label for="country" class="block text-sm font-medium text-gray-700 mb-2">Country *</label>
                    <input type="text" id="country" name="country" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                           placeholder="e.g., Japan, Greece, Peru"
                           value="<?php echo htmlspecialchars($_POST['country'] ?? $destination['country']); ?>">
                </div>

                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Type *</label>
                    <select id="type" name="type" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                        <option value="">Select a type</option>
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
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                    <select id="status" name="status" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                        <option value="">Select status</option>
                        <?php
                        $selected_status = $_POST['status'] ?? $destination['status'];
                        ?>
                        <option value="wishlist" <?php echo $selected_status === 'wishlist' ? 'selected' : ''; ?>>Wishlist</option>
                        <option value="visited" <?php echo $selected_status === 'visited' ? 'selected' : ''; ?>>Visited</option>
                    </select>
                </div>

                <div>
                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Notes</label>
                    <textarea id="notes" name="notes" rows="4"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                              placeholder="Add any notes about this destination..."><?php echo htmlspecialchars($_POST['notes'] ?? $destination['notes']); ?></textarea>
                </div>

                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Change Image</label>
                    <?php if ($destination['image']): ?>
                        <div class="mb-4">
                            <img src="<?php echo htmlspecialchars($destination['image']); ?>" alt="Current image" class="w-32 h-32 object-cover rounded-md">
                        </div>
                    <?php endif; ?>
                    <input type="file" id="image" name="image" accept="image/jpeg, image/png, image/gif"
                           class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-blue-600">
                </div>

                <div class="flex gap-4">
                    <button type="submit" 
                            class="flex-1 bg-primary text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                        Update Destination
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
document.getElementById('editForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);
    const statusDiv = document.getElementById('statusMessage');

    fetch('api/update_destination.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            statusDiv.className = 'bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6';
            statusDiv.textContent = data.message + ' Redirecting to dashboard...';

            // Update image preview if a new image was uploaded
            if (formData.get('image').name) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    let img = document.querySelector('.w-32.h-32.object-cover');
                    if (img) {
                        img.src = e.target.result;
                    } else {
                        // If no image was there before, create one
                        const imgContainer = document.querySelector('label[for="image"]').parentElement;
                        const newImg = document.createElement('img');
                        newImg.src = e.target.result;
                        newImg.alt = 'Current image';
                        newImg.className = 'w-32 h-32 object-cover rounded-md mb-4';
                        imgContainer.insertBefore(newImg, imgContainer.children[1]);
                    }
                }
                reader.readAsDataURL(formData.get('image'));
            }

            setTimeout(() => {
                window.location.href = 'dashboard.php';
            }, 1000);
        } else {
            statusDiv.className = 'bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6';
            statusDiv.textContent = data.message || 'An error occurred.';
        }
        statusDiv.classList.remove('hidden');
    })
    .catch(error => {
        statusDiv.className = 'bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6';
        statusDiv.textContent = 'An unexpected error occurred.';
        statusDiv.classList.remove('hidden');
        console.error('Error:', error);
    });
});
</script>
