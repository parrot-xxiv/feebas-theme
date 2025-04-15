<?php get_header(); ?>

<main>
    <?php the_content(); ?>
</main>
<footer class="bg-gray-800 text-gray-200 py-8">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <!-- Company Info -->
            <div class="mb-6 md:mb-0">
                <h3 class="text-2xl font-bold">Company Name</h3>
                <p class="text-sm">Your tagline or short description goes here.</p>
            </div>

            <!-- Social / Copyright -->
            <div class="text-sm">
                <p>&copy; 2025 Company Name. All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>

</html>