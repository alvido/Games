<?php
/**
 * The template for displaying all taxonomy
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#taxonomy
 *
 * @package juegos
 */

get_header();
?>

<main id="primary" class="main site-main">
    <?php get_sidebar(); ?>

    <div class="content">

        <section class="games">
            <!-- Вывод названия и описания категории -->
            <span class="subtitle"><?php esc_html_e('Category:', 'your-theme-text-domain'); ?></span>
            <h2><?php single_term_title(); ?></h2>
            <p><?php echo term_description(); ?></p> <!-- Описание категории -->

            <!-- Фильтр (возможно, нужно будет добавить JavaScript для работы с фильтром) -->
            <div class="games__filter">
                <select name="filter" id="category-filter" class="filter">
                    <option value="new">New Posts</option>
                    <option value="featured">Featured Posts</option>
                    <option value="Top Games">Top Games</option>
                    <option value="Trending now">Trending now</option>
                    <option value="Recently Played">Recently Played</option>
                </select>

            </div>

            <!-- Список игр (постов) -->
            <ul class="games__list">
                <?php if (have_posts()): ?>
                    <?php while (have_posts()):
                        the_post(); ?>
                        <li>
                            <a href="<?php the_permalink(); ?>">
                                <?php if (has_post_thumbnail()): ?>
                                    <img src="<?php the_post_thumbnail_url('medium'); ?>" alt="<?php the_title(); ?>">
                                <?php else: ?>
                                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/default-game.png'); ?>"
                                        alt="<?php the_title(); ?>">
                                <?php endif; ?>
                            </a>
                        </li>
                    <?php endwhile; ?>
                <?php else: ?>
                    <li><?php esc_html_e('No games found in this category.', 'your-theme-text-domain'); ?></li>
                <?php endif; ?>
            </ul>

            <!-- Пагинация -->
            <?php
            global $wp_query;
            if ($wp_query->max_num_pages > 1): ?>
                <div class="pagination">
                    <?php
                    // Вывод пагинации
                    $pagination_links = paginate_links(array(
                        'total' => $wp_query->max_num_pages,
                        'type' => 'array',
                        'show_all' => false,
                        'end_size' => 1,
                        'mid_size' => 2,
                        'prev_text' => __('Previous', 'your-theme-text-domain'),
                        'next_text' => __('Next', 'your-theme-text-domain'),
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
            <!-- Описание категории (дополнительный блок) -->
            <div class="games__description">
                <h4><?php esc_html_e('About this category', 'your-theme-text-domain'); ?></h4>
                <p><?php echo term_description(); ?></p>
                <!-- Повторяем описание категории (или добавляем другое описание) -->

                <!-- Дополнительное описание с ссылками -->
                <h4><?php esc_html_e('Popular games in this category:', 'your-theme-text-domain'); ?></h4>
                <ul>
                    <li><a href="#"><?php esc_html_e('Sports games', 'your-theme-text-domain'); ?></a></li>
                    <li><a href="#"><?php esc_html_e('Board games', 'your-theme-text-domain'); ?></a></li>
                    <li><a href="#"><?php esc_html_e('Multiplayer battle games', 'your-theme-text-domain'); ?></a></li>
                    <li><a href="#"><?php esc_html_e('Platform games', 'your-theme-text-domain'); ?></a></li>
                    <li><a href="#"><?php esc_html_e('Fighting games', 'your-theme-text-domain'); ?></a></li>
                </ul>
            </div>
        </section>
    </div>


</main><!-- #main -->

<?php
get_footer();
