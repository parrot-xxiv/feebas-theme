<?php get_header(); ?>

<main>
    <h1 class="bg-red-200">Welcome to My Custom Theme</h1>
    <p>This is the main content area.</p>

    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <div><?php the_excerpt(); ?></div>
            <div><?php the_content(); ?></div>
        <?php endwhile; ?>
    <?php else : ?>
        <p>No posts found.</p>
    <?php endif; ?>
</main>

<?php get_footer(); ?>