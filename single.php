<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package juegos
 */

get_header();
?>

<main id="primary" class="main site-main">
    <?php get_sidebar(); ?>

    <div class="content">

        <section class="single__game">
            <div class="game">
                <div class="game__block" id="game-container">
                    <div class="top">
                        <?php
                        $game_url = get_field('game_url'); // Получаем значение поля для данного термина
                        
                        if (!empty($game_url)): ?>
                            <iframe id="game-iframe" src="<?php echo ($game_url); ?>" width="800" height="600"
                                scrolling="none" frameborder="0">
                            </iframe>
                        <?php endif; ?>

                    </div>
                    <div class="bottom">
                        <h3><?php the_title(); ?></h3>
                        <div class="actions">
                            <?php
                            function format_number($num)
                            {
                                if ($num >= 1000000) {
                                    return number_format($num / 1000000, 1) . 'M'; // Формат для миллионов с 1 десятичной
                                } elseif ($num >= 1000) {
                                    return number_format($num / 1000, 1) . 'K'; // Формат для тысяч с 1 десятичной
                                }
                                return $num; // Возвращаем число как есть, если меньше 1000
                            }
                            ?>
                            <button class="icon like-button" data-post-id="<?php the_ID(); ?>">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_95_1573)">
                                        <path
                                            d="M17.3604 20H6C4.89543 20 4 19.1046 4 18V10H7.92963C8.59834 10 9.2228 9.6658 9.59373 9.1094L12.1094 5.3359C12.6658 4.5013 13.6025 4 14.6056 4H14.8195C15.4375 4 15.9075 4.55487 15.8059 5.1644L15 10H18.5604C19.8225 10 20.7691 11.1547 20.5216 12.3922L19.3216 18.3922C19.1346 19.3271 18.3138 20 17.3604 20Z"
                                            stroke="white" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M8 10V20" stroke="white" stroke-width="2" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_95_1573">
                                            <rect width="24" height="24" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                                <span
                                    class="like-count"><?php echo format_number(get_post_meta(get_the_ID(), 'like_count', true) ?: 0); ?></span>
                            </button>
                            <button class="icon dislike-button" data-post-id="<?php the_ID(); ?>">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_95_1592)">
                                        <path
                                            d="M17.3604 4H6C4.89543 4 4 4.89543 4 6V14H7.92963C8.59834 14 9.2228 14.3342 9.59373 14.8906L12.1094 18.6641C12.6658 19.4987 13.6025 20 14.6056 20H14.8195C15.4375 20 15.9075 19.4451 15.8059 18.8356L15 14H18.5604C19.8225 14 20.7691 12.8453 20.5216 11.6078L19.3216 5.60777C19.1346 4.67292 18.3138 4 17.3604 4Z"
                                            stroke="white" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M8 14V4" stroke="white" stroke-width="2" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_95_1592">
                                            <rect width="24" height="24" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                                <span
                                    class="dislike-count"><?php echo format_number(get_post_meta(get_the_ID(), 'dislike_count', true) ?: 0); ?></span>

                            </button>

                            <button class="icon" id="theatre-mode-btn">
                                <svg viewBox="0 0 24 24" width="24" height="24" fill="none">
                                    <path
                                        d="M6 2H18C20.2091 2 22 3.79086 22 6V18C22 20.2091 20.2091 22 18 22H6C3.79086 22 2 20.2091 2 18V6C2 3.79086 3.79086 2 6 2ZM6 4C4.89543 4 4 4.89543 4 6V18C4 19.1046 4.89543 20 6 20H18C19.1046 20 20 19.1046 20 18V6C20 4.89543 19.1046 4 18 4H6ZM6 8C6 6.89543 6.89543 6 8 6H11C11.5523 6 12 6.44772 12 7C12 7.55228 11.5523 8 11 8H8V11C8 11.5523 7.55228 12 7 12C6.44772 12 6 11.5523 6 11V8ZM16 18C17.1046 18 18 17.1046 18 16V13C18 12.4477 17.5523 12 17 12C16.4477 12 16 12.4477 16 13V16H13C12.4477 16 12 16.4477 12 17C12 17.5523 12.4477 18 13 18H16Z"
                                        fill="white">
                                    </path>
                                </svg>
                            </button>
                            <button class="icon" id="fullscreen-btn">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <path
                                            d="M3 3L8 7.95M3 3V7.5M3 3H7.5M3 20.95L8 16M21 20.95L16.05 16M20.95 3L16 7.95M16.5 3H21V7.5M21 16.5V21H16.5M7.5 21H3V16.5"
                                            stroke="white" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </g>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="banner">
                    <a href="#">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/baner-long.png" alt="">
                    </a>
                </div>
                <!-- categories of game -->
                <ul class="game__list same-categories">
                    <?php
                    // Получаем текущий пост
                    global $post;

                    // Получаем термины (категории) текущего поста для таксономии 'categoria'
                    $terms = get_the_terms($post->ID, 'categoria');

                    if ($terms && !is_wp_error($terms)) {
                        // Получаем ID первой категории
                        $term_id = $terms[0]->term_id;

                        // Настраиваем параметры WP_Query для получения игр из той же категории, кроме текущей игры
                        $args = array(
                            'post_type' => 'games', // Укажите тип постов, если он отличается
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'categoria', // Указываем вашу таксономию
                                    'field' => 'term_id',
                                    'terms' => $term_id, // Указываем ID текущей категории
                                ),
                            ),
                            'posts_per_page' => 8, // Указываем количество постов для вывода
                            'post__not_in' => array($post->ID), // Исключаем текущую игру
                        );

                        // Создаем новый запрос
                        $games_query = new WP_Query($args);

                        // Проверяем, есть ли игры в категории
                        if ($games_query->have_posts()) {
                            while ($games_query->have_posts()) {
                                $games_query->the_post(); // Обрабатываем пост
                    
                                // Получаем ссылку на изображение игры (предполагается, что это миниатюра)
                                $game_image = get_the_post_thumbnail_url(get_the_ID(), 'full');

                                if ($game_image) {
                                    ?>
                                    <li>
                                        <a href="<?php the_permalink(); ?>">
                                            <img src="<?php echo esc_url($game_image); ?>" alt="<?php the_title_attribute(); ?>">
                                        </a>
                                    </li>
                                    <?php
                                }
                            }
                        } else {
                            echo '<li>' . __('No Games', 'text-domain') . '</li>';
                        }

                        // Восстанавливаем глобальный объект поста
                        wp_reset_postdata();
                    } else {
                        echo '<li>' . __('No Categories', 'text-domain') . '</li>';
                    }
                    ?>
                </ul><!-- categories of game -->


                <div class="dark-bg">
                    <article>
                        <?php the_content(); ?>
                        <!-- categories of game -->
                        <ul class="categories__list">
                            <?php
                            // Получаем термины, связанные с текущим постом
                            $current_post_id = get_the_ID(); // Получаем ID текущего поста
                            $categories = get_the_terms($current_post_id, 'categoria'); // Запрашиваем категории для поста
                            
                            // Проверяем, есть ли категории
                            if (!empty($categories) && !is_wp_error($categories)):
                                foreach ($categories as $category):
                                    // Получаем URL изображения категории из мета-данных
                                    $image_url = get_term_meta($category->term_id, 'category_image', true);

                                    // Получаем ссылку на термин (категорию)
                                    $term_link = get_term_link($category);
                                    ?>
                                    <li>
                                        <a href="<?php echo esc_url($term_link); ?>">
                                            <?php if ($image_url): ?>
                                                <img src="<?php echo esc_url($image_url); ?>"
                                                    alt="<?php echo esc_attr($category->name); ?>">
                                            <?php endif; ?>
                                            <span><?php echo esc_html($category->name); ?></span>
                                        </a>
                                    </li>
                                <?php endforeach;
                            else:
                                // Выводим сообщение, если нет категорий
                                echo '<li>' . __('No Categories', 'text-domain') . '</li>'; // Добавьте 'text-domain' для интернационализации
                            endif;
                            ?>
                        </ul><!-- categories of game -->

                    </article>
                </div>
                <!-- more like games -->
                <ul class="game__list more-like">
                    <?php
                    // Получаем ID текущего поста (игры)
                    $current_post_id = get_the_ID();

                    // Настройка параметров для получения игр с наибольшим количеством лайков, кроме текущей
                    $args = array(
                        'post_type' => 'games', // Указываем тип постов, если он отличается
                        'posts_per_page' => 8, // Количество выводимых игр
                        'meta_key' => 'like_count', // Мета-ключ для количества лайков
                        'orderby' => 'meta_value_num', // Сортируем по числовому значению мета-ключа
                        'order' => 'DESC', // Сортировка от большего к меньшему
                        'post__not_in' => array($current_post_id), // Исключаем текущую игру
                    );

                    // Создаем новый запрос для получения игр
                    $liked_games_query = new WP_Query($args);

                    // Проверяем, есть ли посты в запросе
                    if ($liked_games_query->have_posts()) {
                        while ($liked_games_query->have_posts()) {
                            $liked_games_query->the_post();

                            // Получаем миниатюру игры
                            $game_image = get_the_post_thumbnail_url(get_the_ID(), 'full');

                            if ($game_image) {
                                ?>
                                <li>
                                    <a href="<?php the_permalink(); ?>">
                                        <img src="<?php echo esc_url($game_image); ?>" alt="<?php the_title_attribute(); ?>">
                                    </a>
                                </li>
                                <?php
                            }
                        }
                        // Восстанавливаем глобальный объект поста
                        wp_reset_postdata();
                    } else {
                        echo '<li>' . pll__('No Games') . '</li>';
                    }
                    ?>
                </ul><!-- more like games -->
            </div>
            <aside class="aside">
                <!-- featured games -->
                <ul class="aside__list ">
                    <?php
                    // Получаем ID текущего поста (игры)
                    $current_post_id = get_the_ID();

                    // Настройка параметров для получения Featured games, кроме текущей игры
                    $args = array(
                        'post_type' => 'games', // Указываем тип постов, если он отличается
                        'posts_per_page' => 15, // Количество выводимых игр
                        'meta_key' => 'is_featured', // Указываем мета-ключ, по которому помечаем "избранные игры"
                        'meta_value' => '1', // Значение мета-ключа для избранных игр
                        'post__not_in' => array($current_post_id), // Исключаем текущую игру
                    );

                    // Создаем новый запрос для Featured games
                    $featured_query = new WP_Query($args);

                    // Счетчик для отслеживания количества элементов
                    $counter = 1;

                    // Проверяем, есть ли посты в запросе
                    if ($featured_query->have_posts()) {
                        while ($featured_query->have_posts()) {
                            $featured_query->the_post();

                            // Получаем миниатюру игры
                            $game_image = get_the_post_thumbnail_url(get_the_ID(), 'full');

                            // Пропускаем баннер на 5-й позиции
                            if ($counter == 5) {
                                ?>
                                <li class="advertising"><a href="#"><img
                                            src="<?php echo get_template_directory_uri(); ?>/assets/images/banner.png"
                                            alt="Advertisement"></a></li>
                                <?php
                                $counter++;
                            }

                            if ($game_image) {
                                ?>
                                <li>
                                    <a href="<?php the_permalink(); ?>">
                                        <img src="<?php echo esc_url($game_image); ?>" alt="<?php the_title_attribute(); ?>">
                                    </a>
                                </li>
                                <?php
                            }

                            $counter++;
                        }
                        // Восстанавливаем глобальный объект поста
                        wp_reset_postdata();
                    } else {
                        echo '<li>' . _e('No Games') . '</li>';
                    }
                    ?>
                </ul> <!-- featured games -->
            </aside>
        </section>
    </div>


</main><!-- #main -->

<?php
get_footer();
