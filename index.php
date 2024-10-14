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
		<article>
			<?php the_content(); ?>
		</article>
	</div>

</main><!-- #main -->

<?php
get_footer();
