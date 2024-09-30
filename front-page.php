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

    <div class="content">
        <?php
        // Вывод постов с меткой "Recently Played"
        display_games_by_tag('recently-played');

        // Вывод постов с меткой "New"
        display_games_by_tag('new');

        // Вывод постов с меткой "Trending Now"
        display_games_by_tag('trending-now');

        ?>
    </div>
    <div class="new">
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
                        the_post_thumbnail('medium');
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
    </div>
    <!-- <div class="page">
            <section class="game">
                <span class="subtitle">try them NOW!</span>
                <h2>Featured games</h2>
                <button class="button small">All Games</button>
                <div class="swiper" id="featured">
                    <ul class="swiper-wrapper swiper-grid">
                        <li class="swiper-slide">
                            <img src="assets/images/featured/image1.png" alt="namelogo">
                        </li>
                        <li class="swiper-slide">
                            <img src="assets/images/featured/image3.png" alt="namelogo">
                        </li>
                        <li class="swiper-slide">
                            <img src="assets/images/featured/image5.png" alt="namelogo">
                        </li>
                        <li class="swiper-slide">
                            <img src="assets/images/featured/image4.png" alt="namelogo">
                        </li>
                        <li class="swiper-slide">
                            <img src="assets/images/featured/image6.png" alt="namelogo">
                        </li>
                        <li class="swiper-slide">
                            <img src="assets/images/featured/image2.png" alt="namelogo">
                        </li>

                        <li class="swiper-slide">
                            <img src="assets/images/featured/image1.png" alt="namelogo">
                        </li>
                        <li class="swiper-slide">
                            <img src="assets/images/featured/image3.png" alt="namelogo">
                        </li>
                        <li class="swiper-slide">
                            <img src="assets/images/featured/image5.png" alt="namelogo">
                        </li>
                        <li class="swiper-slide">
                            <img src="assets/images/featured/image4.png" alt="namelogo">
                        </li>
                        <li class="swiper-slide">
                            <img src="assets/images/featured/image6.png" alt="namelogo">
                        </li>
                        <li class="swiper-slide">
                            <img src="assets/images/featured/image2.png" alt="namelogo">
                        </li>
                    </ul>
                </div>
                <div class="swiper__navigation">
                    <div class="swiper-pagination"></div>
                    <div class="swiper__navigation-button">
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                </div>
            </section>
        </div> -->

</main><!-- #main -->

<?php

get_footer();
