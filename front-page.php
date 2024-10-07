<?php
/**
 * The Front Page template file
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

        <section class="games">
            <span class="subtitle">Try them NOW!</span>
            <h2>Featured games</h2>
            <button class="button small">All Games</button>
            <div class="swiper" id="featured">
                <ul class="swiper-wrapper swiper-grid">
                    <?php
                    // Получаем посты с мета-полем 'is_featured'
                    $args = array(
                        'post_type' => 'games',
                        'meta_key' => 'is_featured',
                        'meta_value' => '1',
                        'posts_per_page' => 12,
                    );
                    $featured_games = new WP_Query($args);



                    if ($featured_games->have_posts()):
                        while ($featured_games->have_posts()):
                            $featured_games->the_post();
                            ?>
                            <li class="swiper-slide">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('full'); ?>
                                </a>
                            </li>
                            <?php
                        endwhile;
                        wp_reset_postdata();
                    else:
                        ?>
                        <li class="swiper-slide">No Featured Games</li>
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

        <section class="games">
            <span class="subtitle">Community choice</span>
            <h2>Popular games</h2>
            <button class="button small">All Games</button>
            <div class="swiper" id="popular">
                <ul class="swiper-wrapper swiper-grid">
                    <?php
                    // Получаем игры, отсортированные по количеству просмотров
                    $args = array(
                        'post_type' => 'games',
                        'meta_key' => 'views', // Мета-поле, в котором хранится количество просмотров
                        'orderby' => 'meta_value_num', // Сортировка по числовому значению мета-поля
                        'order' => 'DESC', // От большего к меньшему (по убыванию)
                        'posts_per_page' => 10 // Количество популярных постов
                    );
                    $popular_games = new WP_Query($args);

                    if ($popular_games->have_posts()):
                        while ($popular_games->have_posts()):
                            $popular_games->the_post();
                            ?>
                            <li class="swiper-slide">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('full'); ?>
                                </a>
                            </li>
                            <?php
                        endwhile;
                        wp_reset_postdata();
                    else:
                        ?>
                        <li class="swiper-slide">No Popular Games</li>
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


        <section class="games">
            <span class="subtitle"><?php esc_html_e('to play with friends', 'your-theme-text-domain'); ?></span>
            <h2><?php esc_html_e('Multiplayer games', 'your-theme-text-domain'); ?></h2>
            <button class="button small"><?php esc_html_e('All Games', 'your-theme-text-domain'); ?></button>

            <div class="swiper" id="multiplayer">
                <ul class="swiper-wrapper swiper-grid">
                    <?php
                    // Создаем новый запрос для постов в категории "Мультиплеер"
                    $args = array(
                        'post_type' => 'games', // Указываем ваш кастомный тип постов
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'categoria', // Таксономия
                                'field' => 'slug',
                                'terms' => 'multiplayer' // Слаг категории
                            ),
                        ),
                        'posts_per_page' => 10, // Количество постов для вывода
                    );
                    $multiplayer_games = new WP_Query($args);

                    // Проверяем, есть ли посты
                    if ($multiplayer_games->have_posts()):
                        while ($multiplayer_games->have_posts()):
                            $multiplayer_games->the_post(); ?>
                            <li class="swiper-slide">
                                <a href="<?php the_permalink(); ?>">
                                    <?php if (has_post_thumbnail()): ?>
                                        <img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title(); ?>">
                                    <?php else: ?>
                                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/featured/default-image.png"
                                            alt="<?php the_title(); ?>">
                                    <?php endif; ?>
                                </a>
                            </li>
                        <?php endwhile;
                        wp_reset_postdata(); // Сбрасываем данные запроса
                    else: ?>
                        <li><?php esc_html_e('No games found in this category.', 'your-theme-text-domain'); ?></li>
                    <?php endif; ?>
                </ul>
            </div>

            <div class="swiper__navigation">
                <div class="swiper-pagination multiplayer-pagination"></div>
                <div class="swiper__navigation-button">
                    <div class="swiper-button-prev multiplayer-button-prev"></div>
                    <div class="swiper-button-next multiplayer-button-next"></div>
                </div>
            </div>
        </section>

        <section class="games">
            <span class="subtitle">top category</span>
            <h2>.io games</h2>
            <button class="button small">All Games</button>
            <div class="swiper" id="io">
                <ul class="swiper-wrapper swiper-grid">
                    <?php
                    // Создаем новый запрос для постов в категории "Мультиплеер"
                    $args = array(
                        'post_type' => 'games', // Указываем ваш кастомный тип постов
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'categoria', // Таксономия
                                'field' => 'slug',
                                'terms' => 'io' // Слаг категории
                            ),
                        ),
                        'posts_per_page' => 10, // Количество постов для вывода
                    );
                    $multiplayer_games = new WP_Query($args);

                    // Проверяем, есть ли посты
                    if ($multiplayer_games->have_posts()):
                        while ($multiplayer_games->have_posts()):
                            $multiplayer_games->the_post(); ?>
                            <li class="swiper-slide">
                                <a href="<?php the_permalink(); ?>">
                                    <?php if (has_post_thumbnail()): ?>
                                        <img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title(); ?>">
                                    <?php else: ?>
                                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/featured/default-image.png"
                                            alt="<?php the_title(); ?>">
                                    <?php endif; ?>
                                </a>
                            </li>
                        <?php endwhile;
                        wp_reset_postdata(); // Сбрасываем данные запроса
                    else: ?>
                        <li><?php esc_html_e('No games found in this category.', 'your-theme-text-domain'); ?></li>
                    <?php endif; ?>
            </div>
            <div class="swiper__navigation">
                <div class="swiper-pagination io-pagination"></div>
                <div class="swiper__navigation-button">
                    <div class="swiper-button-prev io-button-prev"></div>
                    <div class="swiper-button-next io-button-next"></div>
                </div>
            </div>
        </section>

        <!-- <div class="new">
            <?php
            function display_new_games()
            {
                $args = array(
                    'post_type' => 'games',
                    'posts_per_page' => 5, // Количество постов для отображения
                    'orderby' => 'date',
                    'order' => 'DESC',
                    'date_query' => array(
                        array(
                            'after' => '1 week ago', // Посты, созданные за последнюю неделю
                        ),
                    ),
                );

                $query = new WP_Query($args);

                if ($query->have_posts()) {
                    echo '<h2>New Games</h2>';
                    echo '<div class="games-list">';
                    while ($query->have_posts()) {
                        $query->the_post();
                        echo '<div class="game-item">';
                        if (has_post_thumbnail()) {
                            the_post_thumbnail('full');
                        }
                        echo '<a  href="' . get_the_permalink() . '"><h3>' . get_the_title() . '</h3></a>';
                        echo '<div class="game-excerpt">' . get_the_excerpt() . '</div>';
                        echo '</div>';
                    }
                    echo '</div>';
                } else {
                    echo '<p>No new games found.</p>';
                }

                wp_reset_postdata();
            }

            display_new_games(); // Выводим новые игры
            ?>
        </div>
        <div class="recently">
            <?php
            function display_recently_played_games()
            {
                // Получаем ID постов из Local Storage
                echo '<script>
            const recentlyViewed = JSON.parse(localStorage.getItem("recently_viewed_games")) || [];
        </script>';

                // Затем вы можете использовать PHP для получения постов на основе ID, сохраненных в Local Storage
                // Однако нужно учитывать, что PHP выполняется на сервере, а JavaScript на клиенте, поэтому вам нужно передать эти ID на сервер.
            }

            ?>
        </div> -->

        <div class="buttons">
            <button class="button">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon/game-die.svg" alt="">
                Random game</button>
            <a href="#header" class="button button__transparent">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon/arrow-button.svg" alt="">
                Back to top
            </a>
        </div>

        <div class="games__description">
            <h4>2-player games online</h4>
            <p>
                Two-player games are even more exciting if you join matches with other players online. You
                can compete with your friends or against others from around the world in epic 2-player
                multiplayer action. Examples of these 2-player games include <a href="#">Rooftop
                    Snipers</a>, <a href="#">House of
                    Hazards</a>, and <a href="#">8-Ball Billiards</a>.
            </p>
            <h4>
                What can you expect from two-player games?
            </h4>
            <p>
                This genre is expansive - players and friends can shoot hoops on the court in <a href="#">Basketball
                    Stars</a>, chase each other around in <span>Tag 2 3 4 Players</span>, or play together
                co-operatively
                in <span>Fireboy and Watergirl 6</span>. The following are some common types of two-player
                games
                available:
            </p>
            <ul>
                <li>
                    <a href="#">Sports games</a>
                </li>
                <li>
                    <a href="#">Board games</a>
                </li>
                <li>
                    <a href="#">Multiplayer battle games</a>
                </li>
                <li>
                    <a href="#">Platform games</a>
                </li>
                <li>
                    <a href="#">Fighting games</a>
                </li>
            </ul>
        </div>
    </div>


</main><!-- #main -->



<?php

get_footer();
