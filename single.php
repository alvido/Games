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

        <section class="games single__post">
            <div class="game">
                <div class="game__block">
                    <div class="top">
                        <iframe
                            src="https://html5.gamedistribution.com/5370293cd9434e4abe9084397f091ed6/?gd_sdk_referrer_url=https://gamedistribution.com/games/cards-2048/?gd_sdk_referrer_url=https://7007juegos.com/juego/drift-io"
                            width="800" height="600" scrolling="none" frameborder="0">
                        </iframe>
                    </div>
                    <div class="bottom">
                        <h3><?php the_title(); ?></h3>

                        <div class="actions">

                        </div>
                    </div>
                </div>
                <div class="banner">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/baner-long.png" alt="">
                </div>
                <ul class="game__list">
                    <li><a href="#"><img
                                src="<?php echo get_template_directory_uri(); ?>/assets/images/multiplayer/image17.png"
                                alt=""></a></li>
                    <li><a href="#"><img
                                src="<?php echo get_template_directory_uri(); ?>/assets/images/multiplayer/image18.png"
                                alt=""></a></li>
                    <li><a href="#"><img
                                src="<?php echo get_template_directory_uri(); ?>/assets/images/multiplayer/image19.png"
                                alt=""></a></li>
                    <li><a href="#"><img
                                src="<?php echo get_template_directory_uri(); ?>/assets/images/multiplayer/image20.png"
                                alt=""></a></li>
                    <li><a href="#"><img
                                src="<?php echo get_template_directory_uri(); ?>/assets/images/multiplayer/image21.png"
                                alt=""></a></li>
                    <li><a href="#"><img
                                src="<?php echo get_template_directory_uri(); ?>/assets/images/multiplayer/image22.png"
                                alt=""></a></li>
                    <li><a href="#"><img
                                src="<?php echo get_template_directory_uri(); ?>/assets/images/multiplayer/image23.png"
                                alt=""></a></li>
                    <li><a href="#"><img
                                src="<?php echo get_template_directory_uri(); ?>/assets/images/multiplayer/image24.png"
                                alt=""></a></li>
                </ul>
                <div class="dark-bg">
                    <article>
                        <?php the_content(); ?>
                        <ul class="categories__list">
                            <?php
                            // Получаем категории таксономии 'categoria'
                            $categories = get_terms(array(
                                'taxonomy' => 'categoria', // Указываем таксономию
                                'orderby' => 'name',
                                'order' => 'ASC',
                                'hide_empty' => true, // Показывать только категории с постами
                            ));

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
                                echo '<li>' . pll__('No categories found.') . '</li>';
                            endif;
                            ?>
                        </ul>
                    </article>
                </div>
                <ul class="game__list">
                    <li><a href="#"><img
                                src="<?php echo get_template_directory_uri(); ?>/assets/images/multiplayer/image1.png"
                                alt=""></a></li>
                    <li><a href="#"><img
                                src="<?php echo get_template_directory_uri(); ?>/assets/images/multiplayer/image2.png"
                                alt=""></a></li>
                    <li><a href="#"><img
                                src="<?php echo get_template_directory_uri(); ?>/assets/images/multiplayer/image3.png"
                                alt=""></a></li>
                    <li><a href="#"><img
                                src="<?php echo get_template_directory_uri(); ?>/assets/images/multiplayer/image4.png"
                                alt=""></a></li>
                    <li><a href="#"><img
                                src="<?php echo get_template_directory_uri(); ?>/assets/images/multiplayer/image5.png"
                                alt=""></a></li>
                    <li><a href="#"><img
                                src="<?php echo get_template_directory_uri(); ?>/assets/images/multiplayer/image6.png"
                                alt=""></a></li>
                    <li><a href="#"><img
                                src="<?php echo get_template_directory_uri(); ?>/assets/images/multiplayer/image7.png"
                                alt=""></a></li>
                    <li><a href="#"><img
                                src="<?php echo get_template_directory_uri(); ?>/assets/images/multiplayer/image8.png"
                                alt=""></a></li>
                </ul>
            </div>
            <aside class="aside">
                <ul class="aside__list">
                    <li><a href="#"><img
                                src="<?php echo get_template_directory_uri(); ?>/assets/images/multiplayer/image1.png"
                                alt=""></a></li>
                    <li><a href="#"><img
                                src="<?php echo get_template_directory_uri(); ?>/assets/images/multiplayer/image2.png"
                                alt=""></a></li>
                    <li><a href="#"><img
                                src="<?php echo get_template_directory_uri(); ?>/assets/images/multiplayer/image3.png"
                                alt=""></a></li>
                    <li><a href="#"><img
                                src="<?php echo get_template_directory_uri(); ?>/assets/images/multiplayer/image4.png"
                                alt=""></a></li>

                    <li><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/banner.png"
                                alt=""></a></li>

                    <li><a href="#"><img
                                src="<?php echo get_template_directory_uri(); ?>/assets/images/multiplayer/image5.png"
                                alt=""></a></li>
                    <li><a href="#"><img
                                src="<?php echo get_template_directory_uri(); ?>/assets/images/multiplayer/image6.png"
                                alt=""></a></li>
                    <li><a href="#"><img
                                src="<?php echo get_template_directory_uri(); ?>/assets/images/multiplayer/image7.png"
                                alt=""></a></li>
                    <li><a href="#"><img
                                src="<?php echo get_template_directory_uri(); ?>/assets/images/multiplayer/image8.png"
                                alt=""></a></li>
                    <li><a href="#"><img
                                src="<?php echo get_template_directory_uri(); ?>/assets/images/multiplayer/image9.png"
                                alt=""></a></li>
                    <li><a href="#"><img
                                src="<?php echo get_template_directory_uri(); ?>/assets/images/multiplayer/image10.png"
                                alt=""></a></li>
                    <li><a href="#"><img
                                src="<?php echo get_template_directory_uri(); ?>/assets/images/multiplayer/image11.png"
                                alt=""></a></li>
                    <li><a href="#"><img
                                src="<?php echo get_template_directory_uri(); ?>/assets/images/multiplayer/image12.png"
                                alt=""></a></li>
                    <li><a href="#"><img
                                src="<?php echo get_template_directory_uri(); ?>/assets/images/multiplayer/image13.png"
                                alt=""></a></li>
                    <li><a href="#"><img
                                src="<?php echo get_template_directory_uri(); ?>/assets/images/multiplayer/image14.png"
                                alt=""></a></li>
                    <li><a href="#"><img
                                src="<?php echo get_template_directory_uri(); ?>/assets/images/multiplayer/image15.png"
                                alt=""></a></li>
                    <li><a href="#"><img
                                src="<?php echo get_template_directory_uri(); ?>/assets/images/multiplayer/image16.png"
                                alt=""></a></li>
                </ul>
            </aside>
        </section>
    </div>


</main><!-- #main -->

<?php
get_footer();
