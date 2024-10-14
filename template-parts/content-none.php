<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package juegos
 */

?>

<h1 class="page-title"><?php _e('Nothing Found', 'juegos'); ?></h1>

<div class="page-content">
	<?php
	if (is_home() && current_user_can('publish_posts')):

		printf(
			'<p>' . wp_kses(
				/* translators: 1: link to WP admin new post page. */
				__('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'juegos'),
				array(
					'a' => array(
						'href' => array(),
					),
				)
			) . '</p>',
			esc_url(admin_url('post-new.php'))
		);

	elseif (is_search()):
		?>

		<p>
			<?php _e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'juegos'); ?>
		</p>
		<!-- Объединенная форма поиска -->
		<div class="search">
			<form class="search__form" role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
				<input class="search__field" type="text" name="s" id="s" placeholder="<?php _e('Search', 'textdomen') ?>" />
				<button class="search__submit icon" id="searchButton" type="submit">
					<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path
							d="M16.5 16.5L12.8807 12.8807M12.8807 12.8807C14.0871 11.6743 14.8333 10.0076 14.8333 8.16667C14.8333 4.48477 11.8486 1.5 8.16667 1.5C4.48477 1.5 1.5 4.48477 1.5 8.16667C1.5 11.8486 4.48477 14.8333 8.16667 14.8333C10.0076 14.8333 11.6743 14.0871 12.8807 12.8807Z"
							stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
					</svg>
				</button>
			</form>
		</div>
		<?php

	else:
		?>

		<p>
			<?php _e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'juegos'); ?>
		</p>
		<!-- Объединенная форма поиска для постов и новостей -->
		<div class="search">
			<form class="search__form" role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
				<input class="search__field" type="text" name="s" id="s" placeholder="<?php _e('Search', 'textdomen') ?>" />
				<button class="search__submit icon" id="searchButton" type="submit">
					<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path
							d="M16.5 16.5L12.8807 12.8807M12.8807 12.8807C14.0871 11.6743 14.8333 10.0076 14.8333 8.16667C14.8333 4.48477 11.8486 1.5 8.16667 1.5C4.48477 1.5 1.5 4.48477 1.5 8.16667C1.5 11.8486 4.48477 14.8333 8.16667 14.8333C10.0076 14.8333 11.6743 14.0871 12.8807 12.8807Z"
							stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
					</svg>
				</button>
			</form>
		</div>
		<?php

	endif;
	?>
</div><!-- .page-content -->