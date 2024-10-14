<?php
/**
 * Шаблон главной страницы
 *
 * @package juegos
 */

get_header();
?>

<main id="primary" class="main site-main">
    <?php get_sidebar(); ?>

    <div class="content">

        <!-- Рекомендуемые игры -->
        <section class="games">
            <span class="subtitle"><?php esc_html_e('Try it NOW!', 'juegos') ?></span>
            <h2><?php esc_html_e('Featured Games', 'juegos') ?></h2>
            <a class="button small" href="<?php echo esc_url(add_query_arg('filter', 'featured', get_post_type_archive_link('games'))); ?>">
                <?php esc_html_e('All Games', 'juegos') ?>
            </a>

            <div class="swiper" id="featured">
                <ul class="swiper-wrapper swiper-grid">
                    <?php
                    $featured_games_args = array(
                        'post_type' => 'games',
                        'meta_key' => 'is_featured',
                        'meta_value' => '1',
                        'posts_per_page' => 12,
                    );
                    $featured_games = get_posts($featured_games_args);

                    if (!empty($featured_games)):
                        foreach ($featured_games as $post):
                            setup_postdata($post);
                            ?>
                            <li class="swiper-slide">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('full', ['alt' => get_the_title()]); ?>
                                </a>
                            </li>
                        <?php endforeach;
                        wp_reset_postdata();
                    else: ?>
                        <li class="swiper-slide"><?php esc_html_e('No Games', 'juegos') ?></li>
                    <?php endif; ?>
                </ul>
            </div>

            <div class="swiper__navigation">
                <div class="swiper-pagination featured-pagination"></div>
                <div class="swiper__navigation-button">
                    <div class="swiper-button-prev featured-button-prev"></div>
                    <div class="swiper-button-next featured-button-next"></div>
                </div>
            </div>
        </section>

        <!-- Популярные игры -->
        <section class="games">
            <span class="subtitle"><?php esc_html_e('Community Choice', 'juegos') ?></span>
            <h2><?php esc_html_e('Popular Games', 'juegos') ?></h2>
            <a class="button small" href="<?php echo esc_url(add_query_arg('filter', 'popular', get_post_type_archive_link('games'))); ?>">
                <?php esc_html_e('All Games', 'juegos'); ?>
            </a>
            <div class="swiper swiper-basic" id="popular">
                <ul class="swiper-wrapper swiper-grid">
                    <?php
                    $popular_games_args = array(
                        'post_type' => 'games',
                        'meta_key' => 'like_count',
                        'orderby' => 'meta_value_num',
                        'order' => 'DESC',
                        'posts_per_page' => 12
                    );
                    $popular_games = get_posts($popular_games_args);

                    if (!empty($popular_games)):
                        foreach ($popular_games as $post):
                            setup_postdata($post);
                            ?>
                            <li class="swiper-slide">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('full', ['alt' => get_the_title()]); ?>
                                </a>
                            </li>
                        <?php endforeach;
                        wp_reset_postdata();
                    else: ?>
                        <li class="swiper-slide"><?php esc_html_e('No Games', 'juegos') ?></li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="swiper__navigation">
                <div class="swiper-pagination popular-pagination"></div>
                <div class="swiper__navigation-button">
                    <div class="swiper-button-prev popular-button-prev"></div>
                    <div class="swiper-button-next popular-button-next"></div>
                </div>
            </div>
        </section>

        <!-- Динамический вывод всех категорий -->
        <?php
        // После определения переменной $multiplayer_games
        $categories = get_terms(array(
            'taxonomy' => 'categoria',
            'hide_empty' => true,
        ));

        foreach ($categories as $category) {
            // Получаем slug категории
            $category_slug = $category->slug;
            ?>
            <section class="games">
                <?php
                // Получаем объект термина
                $term = get_term($category->term_id); // Получаем текущий объект термина
                $category_subtitle = get_field('category_subtitle', $term); // Получаем значение поля для данного термина
            
                if (!empty($category_subtitle)): ?>
                    <span class="subtitle"><?php echo esc_html($category_subtitle); ?></span> <!-- Выводим значение ACF поля -->
                <?php endif; ?>

                <h2><?php echo esc_html($category->name); ?></h2>
                <a class="button small" href="<?php echo esc_url(get_term_link($category)); ?>">
                    <?php _e('All Games', 'juegos'); ?>
                </a>
                <div class="swiper swiper-basic" id="<?php echo esc_attr($category_slug); ?>">
                    <ul class="swiper-wrapper swiper-grid">
                        <?php
                        // Запрос игр по категории
                        $args = array(
                            'post_type' => 'games',
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'categoria',
                                    'field' => 'slug',
                                    'terms' => $category_slug, // Используем slug текущей категории
                                ),
                            ),
                            'posts_per_page' => 12,
                        );
                        $games = new WP_Query($args);

                        if ($games->have_posts()):
                            while ($games->have_posts()):
                                $games->the_post(); ?>
                                <li class="swiper-slide">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php if (has_post_thumbnail()): ?>
                                            <?php the_post_thumbnail('full'); ?>
                                        <?php else: ?>
                                            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/featured/default-image.png"
                                                alt="<?php the_title(); ?>">
                                        <?php endif; ?>
                                    </a>
                                </li>
                            <?php endwhile;
                            wp_reset_postdata();
                        else: ?>
                            <li><?php _e('No Games', 'juegos'); ?></li>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="swiper__navigation">
                    <div class="swiper-pagination <?php echo esc_attr($category_slug); ?>-pagination"></div>
                    <div class="swiper__navigation-button">
                        <div class="swiper-button-prev <?php echo esc_attr($category_slug); ?>-button-prev"></div>
                        <div class="swiper-button-next <?php echo esc_attr($category_slug); ?>-button-next"></div>
                    </div>
                </div>
            </section>
            <?php
        }

        ?>










        <div class="buttons">
            <?php
            $random_game = get_posts(array(
                'post_type' => 'games',
                'posts_per_page' => 1,
                'orderby' => 'rand',
            ));

            $random_game_link = !empty($random_game) ? esc_url(get_permalink($random_game[0]->ID)) : '#';
            ?>

            <a href="<?php echo esc_url($random_game_link); ?>" class="button">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/icon/game-die.svg" alt="">
                <?php esc_html_e('Random game', 'juegos') ?>
            </a>
            <a href="/#masthead" class="button button__transparent">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/icon/arrow-button.svg"
                    alt="">
                <?php esc_html_e('Back to top', 'juegos') ?>
            </a>
        </div>

        <?php if (trim(get_the_content()) != ''): ?>
            <div class="games__description">
                <?php the_content(); ?>
            </div>
        <?php endif; ?>

    </div>
</main><!-- #main -->

<?php get_footer(); ?>