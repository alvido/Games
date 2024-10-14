<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package juegos
 */

?>


<li>
	<a href="<?php the_permalink(); ?>">
		<?php if (has_post_thumbnail()): ?>
			<img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title(); ?>">
		<?php else: ?>
			<img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/default-game.png'); ?>"
				alt="<?php the_title(); ?>">
		<?php endif; ?>
	</a>
</li>