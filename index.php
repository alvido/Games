<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package juegos
 */

get_header();
?>

<main id="primary" class="main site-main">

	<?php get_sidebar(); ?>

	<div class="content">
		<h1 class="center"><?php the_title(); ?></h1>
		<div class="center decor-bottom"><?php the_excerpt(); ?></div>
		<?php $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>
		<img src="<?php echo esc_url($thumbnail_url ? $thumbnail_url : ''); ?>" alt="">
		<?php the_content(); ?>
	</div>
	</section>

</main><!-- #main -->


<?php

function display_games_by_tag($tag_slug)
{
    $args = array(
        'post_type' => 'games',
        'tax_query' => array(
            array(
                'taxonomy' => 'game_tag',
                'field' => 'slug',
                'terms' => $tag_slug, // Сюда передаем слаг метки
            ),
        ),
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        echo '<div class="games-list">';
        while ($query->have_posts()) {
            $query->the_post();
            echo '<div class="game-item">';
            if (has_post_thumbnail()) {
                the_post_thumbnail('medium');
            }
            echo '<a  href="' . the_permalink() . '"><h2>' . get_the_title() . '</h2></a>';
            echo '<div class="game-excerpt">' . get_the_excerpt() . '</div>';
            echo '</div>';
        }
        echo '</div>';
    } else {
        echo '<p>No games found for this tag.</p>';
    }

    wp_reset_postdata();
}
?>
<?php
// Вывод постов с меткой "Recently Played"
display_games_by_tag('recently-played');

// Вывод постов с меткой "New"
display_games_by_tag('new');

// Вывод постов с меткой "Trending Now"
display_games_by_tag('trending-now');

?>

<?php
get_footer();




