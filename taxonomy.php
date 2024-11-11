<?php
/**
 * The template for displaying all taxonomy
 *
 * @package juegos
 */

get_header();
?>

<main id="primary" class="main site-main">
    <?php get_sidebar(); ?>

    <div class="content">

        <?php
        // Получаем выбранный фильтр (из GET-запроса)
        $filter = isset($_GET['filter']) ? sanitize_text_field($_GET['filter']) : 'new';

        // Задаем параметры для WP_Query
        $args = array(
            'post_type' => 'games',
            'posts_per_page' => 30, // Количество игр на странице
            'paged' => get_query_var('paged') ? get_query_var('paged') : 1, // Для пагинации
            'tax_query' => array(
                array(
                    'taxonomy' => 'categoria', // Ваша таксономия
                    'field' => 'slug',
                    'terms' => get_queried_object()->slug, // Получаем текущую категорию
                ),
            ),
        );

        // Модифицируем запрос в зависимости от фильтра
        if ($filter === 'new') {
            // Фильтр по играм, опубликованным за последнюю неделю
            $args['date_query'] = array(
                array(
                    'after' => '1 week ago',
                ),
            );
            $args['orderby'] = 'date';
            $args['order'] = 'DESC';
        } elseif ($filter === 'featured') {
            // Фильтрация по играм с метаполем is_featured
            $args['meta_key'] = 'is_featured';
            $args['meta_value'] = '1';
        } elseif ($filter === 'trending-now') {
            // Сортировка по количеству просмотров
            $args['meta_key'] = 'views'; // Метаполе с количеством просмотров
            $args['orderby'] = 'meta_value_num'; // Сортировка по числовому значению метаполя
            $args['order'] = 'DESC'; // По убыванию
        } elseif ($filter === 'popular') {
            // Сортировка по количеству лайков
            $args['meta_key'] = 'like_count'; // Метаполе с количеством лайков
            $args['orderby'] = 'meta_value_num'; // Сортировка по числовому значению метаполя
            $args['order'] = 'DESC'; // По убыванию
        }

        // Запрос игр с учетом фильтра
        $games_query = new WP_Query($args);
        ?>

        <section class="games">
            <!-- Вывод названия и описания категории -->
            <?php
            $term = get_queried_object(); // Получаем текущий объект таксономии
            $category_subtitle = get_field('category_subtitle', $term); // Получаем значение поля для данного термина
            
            if (!empty($category_subtitle)): ?>
                <span class="subtitle"><?php echo ($category_subtitle); ?></span>
            <?php endif; ?>

            <h1><?php single_term_title(); ?></h1>
            <div><?php echo term_description(); ?></div> <!-- Описание категории -->

            <!-- Фильтр -->
            <div class="games__filter">
                <form method="get" action="">
                    <select name="filter" id="category-filter" class="filter" onchange="this.form.submit()">
                        <option value="new" <?php selected($filter, 'new'); ?>>
                            <?php _e('New Games', 'juegos'); ?>
                        </option>
                        <option value="featured" <?php selected($filter, 'featured'); ?>>
                            <?php _e('Featured Games', 'juegos'); ?>
                        </option>
                        <option value="trending-now" <?php selected($filter, 'trending-now'); ?>>
                            <?php _e('Trending now', 'juegos'); ?>
                        </option>
                        <option value="popular" <?php selected($filter, 'popular'); ?>>
                            <?php _e('Popular Games', 'juegos'); ?>
                        </option>
                    </select>
                </form>
            </div>

            <!-- Список игр -->
            <ul class="games__list">
                <?php if ($games_query->have_posts()): ?>
                    <?php while ($games_query->have_posts()):
                        $games_query->the_post(); ?>
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
                    <?php endwhile; ?>
                <?php else: ?>
                    <li><?php _e('No Games', 'juegos'); ?></li>
                <?php endif; ?>
            </ul>

            <!-- Пагинация -->
            <?php if ($games_query->max_num_pages > 1): ?>
                <div class="pagination">
                    <?php
                    // Вывод пагинации
                    $pagination_links = paginate_links(array(
                        'total' => $games_query->max_num_pages,
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
            $category_content = get_field('category_content', $term);
            if (!empty($category_content)): ?>
                <div class="games__description">
                    <?php echo ($category_content); ?>
                </div>
            <?php endif; ?>
        </section>

        <?php
        // Сброс глобальных данных после WP_Query
        wp_reset_postdata();
        ?>

    </div>
</main><!-- #main -->

<?php
get_footer();
