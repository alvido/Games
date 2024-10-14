<?php
/**
 * The template for displaying search results pages
 *
 * @package juegos
 */

get_header();

// Устанавливаем параметры для запроса
$args = array(
	'post_type' => $post_type,
	's' => get_search_query(),
	'posts_per_page' => -1, // Количество постов на странице
	'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
);

// Создаем новый запрос
$query = new WP_Query($args);
?>

<main id="primary" class="main site-main">
	<?php get_sidebar(); ?>

	<div class="content">
		<section class="search__section">
			<?php if ($query->have_posts()): ?>
				<h1 class="decor-left">
					<?php printf(esc_html__('Search Results for: %s', 'juegos'), '<span>' . get_search_query() . '</span>'); ?>
				</h1>

				<!-- Объединенная форма поиска -->
				<div class="search">
					<form class="search__form" role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
						<input class="search__field" type="text" name="s" id="s"
							placeholder="<?php _e('Search', 'juegos') ?>" />
						<button class="search__submit icon" id="searchButton" type="submit">
							<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path
									d="M16.5 16.5L12.8807 12.8807M12.8807 12.8807C14.0871 11.6743 14.8333 10.0076 14.8333 8.16667C14.8333 4.48477 11.8486 1.5 8.16667 1.5C4.48477 1.5 1.5 4.48477 1.5 8.16667C1.5 11.8486 4.48477 14.8333 8.16667 14.8333C10.0076 14.8333 11.6743 14.0871 12.8807 12.8807Z"
									stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
							</svg>
						</button>
					</form>
				</div>

				<ul class="games__list">
					<?php
					// Начало цикла
					while ($query->have_posts()):
						$query->the_post();

						get_template_part('template-parts/content', 'search');

					endwhile;
					?>
				</ul>

				<!-- Пагинация -->

				<?php if ($query->max_num_pages > 1): ?>
					<div class="pagination">
						<!-- Список страниц -->
						<?php
						 $pagination_links = paginate_links(array(
							'total' => $query->max_num_pages,
							'type' => 'array',
							'show_all' => false,
							'end_size' => 1,
							'mid_size' => 2,
							'prev_text' => __('Previous', 'juegos'),
							'next_text' => __('Next', 'juegos'),
						));

						if ($pagination_links) {
							echo '<ul class="pagination__list">';
							foreach ($pagination_links as $link) {
								echo '<li>' . $link . '</li>';
							}
							echo '</ul>';
						}
						?>
					</div>
				<?php endif; ?>
				<?php
				the_posts_navigation(); // или the_posts_pagination();
				?>
				<?php
			else:
				get_template_part('template-parts/content', 'none');
			endif;
			?>
		</section>
	</div>

</main><!-- #main -->

<?php
// Сброс запросов после использования пользовательского WP_Query
wp_reset_postdata();

get_footer();
