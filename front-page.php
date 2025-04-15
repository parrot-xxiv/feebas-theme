<?php get_header(); ?>

<main>
    <!-- Parallax Image Banner -->
    <?php
    // Retrieve the saved banner image ID
    $banner_image_id = get_option('_banner_image_id');

    // Get the image URL using the image ID
    if ($banner_image_id) {
        $banner_image_url = wp_get_attachment_url($banner_image_id); // Retrieve the full-size image URL
    } else {
        $banner_image_url = 'https://placehold.co/600x400'; // Default image if none is set
    }
    ?>
    <div class="bg-fixed bg-center bg-no-repeat bg-cover h-[500px]"
        style="background-image: url('<?php echo esc_url($banner_image_url); ?>');">
        <div class="relative inset-0 flex flex-col items-center justify-center h-full">
            <h1 class="text-white text-4xl font-bold">Welcome to My Site</h1>
            <p class="text-white text-lg mt-4">Experience the parallax effect with centered content.</p>
            <button class="mt-6 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                Learn More
            </button>
        </div>
    </div>
    <!-- Additional content to demonstrate scrolling -->
        <section>
            <div class="w-5xl py-10 mx-auto flex">
                <div class="p-10 w-4/6">
                    <h1 class="text-4xl mb-4">Capture your vision</h1>
                    <h2 class="text-xl mb-2">Rent high-end camera gear</h2>
                    <p>
                        At Feebas Camera Rental, we empower photographers and filmmakers in Makati City with access to top-tier camera equipment.
                        Our extensive selection of professional gear ensures you have the tools needed to turn your creative ideas into reality.
                        Whether you’re shooting a commercial project or capturing a special moment, we provide the perfect gear to elevate your work.
                        Rent with us today and experience the difference in quality and performance that high-end equipment can bring to your craft.
                    </p>
                </div>
                <div class="w-2/6">
                    <img src="https://placehold.co/600x400" />
                </div>
            </div>
        </section>

        <?php //echo do_shortcode('[camera_list]'); ?>
        <?php get_template_part('template-parts/camera-list'); ?>

        <section id="contact" class="bg-gray-50 py-16">
            <div class="max-w-5xl mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Contact Form (Two-Thirds Width) -->
                    <div class="md:col-span-2">
                        <h2 class="text-3xl font-bold mb-4">Get in Touch</h2>
                        <p class="mb-8 text-gray-600">Reach out for your rental needs!</p>
                        <form>
                            <div class="mb-4">
                                <label for="name" class="block text-gray-700 mb-2">Name *</label>
                                <input type="text" id="name" name="name" value="Jane Smith" placeholder="Your Name" class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:border-blue-500">
                            </div>
                            <div class="mb-4">
                                <label for="email" class="block text-gray-700 mb-2">Email address *</label>
                                <input type="email" id="email" name="email" value="email@website.com" placeholder="Your Email" class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:border-blue-500">
                            </div>
                            <div class="mb-4">
                                <label for="phone" class="block text-gray-700 mb-2">Phone number *</label>
                                <input type="tel" id="phone" name="phone" value="555-555-5555" placeholder="Your Phone Number" class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:border-blue-500">
                            </div>
                            <div class="mb-4">
                                <label for="message" class="block text-gray-700 mb-2">Message</label>
                                <textarea id="message" name="message" rows="4" placeholder="Write your message here..." class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:border-blue-500"></textarea>
                            </div>
                            <div class="mb-4 flex items-center">
                                <input type="checkbox" id="consent" name="consent" class="mr-2">
                                <label for="consent" class="text-gray-700 text-sm">I allow this website to store my submission so they can respond to my inquiry. *</label>
                            </div>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-6 rounded">
                                Submit
                            </button>
                        </form>
                    </div>

                    <!-- Contact Info (One-Third Width) -->
                    <div class="text-sm">
                        <h3 class="text-2xl font-bold mb-4">Contact Info</h3>
                        <div class="mb-4">
                            <h4 class="font-semibold">Email</h4>
                            <p class="text-gray-600">johnsmith@gmail.com</p>
                        </div>
                        <div class="mb-4">
                            <h4 class="font-semibold">Location</h4>
                            <p class="text-gray-600">Makati City, 00 PH</p>
                        </div>
                        <div>
                            <h4 class="font-semibold mb-2">Hours</h4>
                            <ul class="text-gray-600 space-y-1">
                                <li>Monday: 9:00am – 10:00pm</li>
                                <li>Tuesday: 9:00am – 10:00pm</li>
                                <li>Wednesday: 9:00am – 10:00pm</li>
                                <li>Thursday: 9:00am – 10:00pm</li>
                                <li>Friday: 9:00am – 10:00pm</li>
                                <li>Saturday: 9:00am – 6:00pm</li>
                                <li>Sunday: 9:00am – 12:00pm</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>


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