<?php
/**
 * The template for displaying all pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package juegos
 */
?>
<?php
/**
 * The template for displaying all games
 *
 * @package juegos
 */

get_header();
?>

<main id="primary" class="main site-main">
    <article>
        <?php
        $page_subtitle = get_field('page_subtitle');

        if (!empty($page_subtitle)): ?>
            <span class="subtitle center"><?php the_field('page_subtitle'); ?></span>
        <?php endif; ?>
        <h1 class="center"><?php the_title(); ?></h1>
        <p class="text center">
            <?php the_field('page_text'); ?>
        </p>
        <?php
        $thumbnail_id = get_post_thumbnail_id(); // Получаем ID миниатюры
        $thumbnail_url = wp_get_attachment_image_url($thumbnail_id, 'full');
        $alt_text = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
        if ($thumbnail_url) {
            echo '<figure>';
            echo '<img src="' . esc_url($thumbnail_url) . '" alt="' . esc_attr($alt_text) . '">';
            echo '</figure>';
        }
        ?>
        <?php if (trim(get_the_content()) != ''): ?>

            <div class="dark-bg">
                <?php the_content(); ?>
            </div>
        <?php endif; ?>
    </article>
</main><!-- #main -->

<?php get_footer(); ?>