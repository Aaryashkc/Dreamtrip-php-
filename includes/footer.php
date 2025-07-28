</main>

<footer class="bg-white border-t">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="text-center text-gray-600">
                <p>&copy; <?php echo date('Y'); ?> DreamTrip. Built with ❤️ for travelers. BY Team DreamTrip.</p>
            </div>
        </div>
    </footer>
    <script>
        // Debug: Check if app.js is loaded
        console.log('Footer script running');
        
        // Try loading app.js with a cache-busting parameter
        var script = document.createElement('script');
        script.src = 'scripts/app.js?v=' + new Date().getTime();
        script.onload = function() {
            console.log('app.js loaded successfully');
        };
        script.onerror = function() {
            console.error('Failed to load app.js');
        };
        document.body.appendChild(script);
    </script>
</body>
</html>
