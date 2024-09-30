<?php
// Добавление скриптов и стилей
add_action('wp_enqueue_scripts', function () {

    wp_enqueue_style('googleapis', 'https://fonts.googleapis.com');
    wp_enqueue_style('gstatic', 'https://fonts.gstatic.com');
    wp_enqueue_style('fonts', 'https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap');

    wp_enqueue_style('select2.css', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css');
    wp_enqueue_style('swiper.css', 'https://cdn.jsdelivr.net/npm/swiper@11.1.4/swiper-bundle.min.css');

    wp_enqueue_style('main-style', get_stylesheet_directory_uri() . '/assets/css/style.css');

    // Дерегистрация встроенной jQuery и регистрация пользовательской версии
    wp_deregister_script('jquery');
    wp_register_script('jquery', get_stylesheet_directory_uri() . '/assets/js/jquery.min.js', array(), null, true);
    wp_enqueue_script('jquery');

    wp_enqueue_script('select2', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js', array('jquery'), null, true);
    wp_enqueue_script('swiper.js', 'https://cdn.jsdelivr.net/npm/swiper@11.1.4/swiper-bundle.min.js', array('jquery'), null, true);

    wp_enqueue_script('custom', get_stylesheet_directory_uri() . '/assets/js/scripts.js', array('jquery'), null, true);


});
// Добавление скриптов и стилей


// Support
add_theme_support('post-thumbnails');
add_theme_support('title-tag');
add_theme_support('custom-logo');
//

//Nav menu
register_nav_menus([
    'header-menu' => 'Верхняя область',
    'language-menu' => 'Выбор языка',
    'footer-menu' => 'Нижняя область',
]);
//

// custom logo//
function mytheme_customize_register($wp_customize)
{
    // Настройка для логотипа хедера
    $wp_customize->add_setting('header_logo');

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'header_logo', array(
        'label' => __('Header Logo', 'mytheme'),
        'section' => 'title_tagline',
        'settings' => 'header_logo',
    )));

    // Настройка для логотипа футера
    $wp_customize->add_setting('footer_logo');

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'footer_logo', array(
        'label' => __('Footer Logo', 'mytheme'),
        'section' => 'title_tagline',
        'settings' => 'footer_logo',
    )));
}
add_action('customize_register', 'mytheme_customize_register');
// custom logo//


// Отображение SVG
add_filter('upload_mimes', 'svg_upload_allow');
# Добавляет SVG в список разрешенных для загрузки файлов.
function svg_upload_allow($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('wp_check_filetype_and_ext', 'fix_svg_mime_type', 10, 5);
# Исправление MIME типа для SVG файлов.
function fix_svg_mime_type($data, $file, $filename, $mimes, $real_mime = '')
{
    // WP 5.1 +
    if (version_compare($GLOBALS['wp_version'], '5.1.0', '>=')) {
        $dosvg = in_array($real_mime, ['image/svg', 'image/svg+xml']);
    } else {
        $dosvg = ('.svg' === strtolower(substr($filename, -4)));
    }
    // mime тип был обнулен, поправим его
    // а также проверим право пользователя
    if ($dosvg) {
        // разрешим
        if (current_user_can('manage_options')) {
            $data['ext'] = 'svg';
            $data['type'] = 'image/svg+xml';
        }
        // запретим
        else {
            $data['ext'] = false;
            $data['type'] = false;
        }
    }
    return $data;
}
// Отображение SVG

//excerpt for page
function add_excerpt_to_pages()
{
    add_post_type_support('page', 'excerpt');
}
add_action('init', 'add_excerpt_to_pages');
//

// Регистрация кастомного типа постов "games"
function create_custom_post_type()
{
    register_post_type(
        'games',
        array(
            'labels' => array(
                'name' => __('Games'),
                'singular_name' => __('Game'),
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'juego'),
            'show_in_rest' => true, // Включаем поддержку REST API и Gutenberg
            'taxonomies' => array('game_tag'), // Добавляем поддержку меток
            'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
            'pll_the_language' => true, // Добавляем поддержку Polylang
        )
    );
}

add_action('init', 'create_custom_post_type');

// Додати таксономію "Category" для типу постів "games"
function create_custom_taxonomy()
{
    $labels = array(
        'name' => __('Games Categories'),
        'singular_name' => __('Game Category'),
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'hierarchical' => true, // Ієрархічна таксономія (схожа на категорії)
        'rewrite' => array('slug' => 'categoria'), // Власний slug для URL
        'show_admin_column' => true, // Показувати колонку в адмінці
        'show_in_rest' => true, // Включаем поддержку REST API
    );

    register_taxonomy('categoria', 'games', $args);
}

add_action('init', 'create_custom_taxonomy');
//

// Регистрация таксономии "Метки" для постов 'games'
function add_tags_to_games()
{
    $labels = array(
        'name' => __('Tags'),
        'singular_name' => __('Tag'),
        'search_items' => __('Search Tags'),
        'all_items' => __('All Tags'),
        'edit_item' => __('Edit Tag'),
        'update_item' => __('Update Tag'),
        'add_new_item' => __('Add New Tag'),
        'new_item_name' => __('New Tag Name'),
        'menu_name' => __('Tags'),
    );

    $args = array(
        'hierarchical' => false, // false для меток (tags)
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var' => true,
        'rewrite' => array('slug' => 'game-tag'),
        'show_in_rest' => true, // Для поддержки Gutenberg и REST API
    );

    register_taxonomy('game_tag', array('games'), $args);
}
add_action('init', 'add_tags_to_games');

//


// register sidebar
function custom_footer_widget()
{
    register_sidebar(array(
        'name' => __('Sidebar', 'juegos'),
        'id' => 'sidebar',
        'description' => __('Sidebar navigation', 'juegos'),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => '',
    ));
    register_sidebar(array(
        'name' => __('Footer contact', 'juegos'),
        'id' => 'footer_contact',
        'description' => __('Widgets for the footer', 'juegos'),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<div class="widget-title"><h4>',
        'after_title' => ' </h4></div>',
    ));
}
add_action('widgets_init', 'custom_footer_widget');
//

// отключение обертки <p> в Contact Gorm 7
add_filter('wpcf7_autop_or_not', '__return_false');
// отключение обертки <p> в Contact Gorm 7

// Регистрация строки для перевода
// function my_register_strings()
// {
//     pll_register_string('reviews_name', 'Reviews', 'Custom Post Types');
//     pll_register_string('button_text', 'Посмотреть все', 'Theme Texts');
//     pll_register_string('Please choose an option', 'Please choose an option', 'Contact Form 7');
// }
// add_action('init', 'my_register_strings');

add_filter('wpcf7_form_elements', function ($content) {
    $content = str_replace('Please choose an option', __('Please choose an option', 'juegos'), $content);
    return $content;
});
;
//


// Icon for category

// Добавление пользовательского поля для изображения в форму добавления категории
function add_category_image_field($taxonomy)
{
    ?>
    <div class="form-field">
        <label for="category_image"><?php _e('Category Image', 'your-text-domain'); ?></label>
        <input type="hidden" name="category_image" id="category_image" value="">
        <div id="category-image-preview" style="margin-bottom: 10px;"></div>
        <button class="upload_image_button button"><?php _e('Upload/Add Image', 'your-text-domain'); ?></button>
        <button class="remove_image_button button hidden"><?php _e('Remove Image', 'your-text-domain'); ?></button>
        <p class="description"><?php _e('Select an image for this category.', 'your-text-domain'); ?></p>
    </div>
    <?php
}
add_action('categoria_add_form_fields', 'add_category_image_field');

// Поле для редактирования категории
function edit_category_image_field($term, $taxonomy)
{
    $image_url = get_term_meta($term->term_id, 'category_image', true);
    ?>
    <tr class="form-field">
        <th scope="row" valign="top"><label for="category_image"><?php _e('Category Image', 'your-text-domain'); ?></label>
        </th>
        <td>
            <input type="hidden" name="category_image" id="category_image" value="<?php echo esc_attr($image_url); ?>">
            <div id="category-image-preview" style="margin-bottom: 10px;">
                <?php if ($image_url) { ?>
                    <img src="<?php echo esc_url($image_url); ?>" style="max-width: 150px; height: auto;">
                <?php } ?>
            </div>
            <button class="upload_image_button button"><?php _e('Upload/Add Image', 'your-text-domain'); ?></button>
            <button
                class="remove_image_button button <?php echo $image_url ? '' : 'hidden'; ?>"><?php _e('Remove Image', 'your-text-domain'); ?></button>
            <p class="description"><?php _e('Select an image for this category.', 'your-text-domain'); ?></p>
        </td>
    </tr>
    <?php
}
add_action('categoria_edit_form_fields', 'edit_category_image_field', 10, 2);

// Сохранение изображения при сохранении категории
function save_category_image($term_id)
{
    if (isset($_POST['category_image'])) {
        update_term_meta($term_id, 'category_image', sanitize_text_field($_POST['category_image']));
    }
}
add_action('created_categoria', 'save_category_image');
add_action('edited_categoria', 'save_category_image');

// Добавление изображения в колонки списка категорий в админке (опционально)
function add_category_image_column($columns)
{
    $columns['category_image'] = __('Image', 'your-text-domain');
    return $columns;
}
add_filter('manage_edit-categoria_columns', 'add_category_image_column');

function display_category_image_column($content, $column_name, $term_id)
{
    if ($column_name === 'category_image') {
        $image_url = get_term_meta($term_id, 'category_image', true);
        if ($image_url) {
            $content = '<img src="' . esc_url($image_url) . '" style="max-width: 50px; height: auto;" />';
        } else {
            $content = __('No Image', 'your-text-domain');
        }
    }
    return $content;
}
add_filter('manage_categoria_custom_column', 'display_category_image_column', 10, 3);

// Подключение медиазагрузчика на страницах редактирования категорий
function load_wp_media_files_for_taxonomy()
{
    if (isset($_GET['taxonomy']) && $_GET['taxonomy'] == 'categoria') {
        wp_enqueue_media(); // Подключаем скрипт медиазагрузчика
    }
}
add_action('admin_enqueue_scripts', 'load_wp_media_files_for_taxonomy');

// Добавление скрипта для загрузки изображения через медиабиблиотеку
function add_media_uploader_script()
{
    ?>
    <script>
        jQuery(document).ready(function ($) {
            var mediaUploader;

            // Открыть медиазагрузчик при клике на кнопку загрузки изображения
            $('.upload_image_button').click(function (e) {
                e.preventDefault();

                if (mediaUploader) {
                    mediaUploader.open();
                    return;
                }

                mediaUploader = wp.media({
                    title: 'Choose Image',
                    button: {
                        text: 'Choose Image'
                    },
                    multiple: false
                });

                mediaUploader.on('select', function () {
                    var attachment = mediaUploader.state().get('selection').first().toJSON();
                    $('#category_image').val(attachment.url);
                    $('#category-image-preview').html('<img src="' + attachment.url + '" style="max-width: 150px; height: auto;" />');
                    $('.remove_image_button').removeClass('hidden');
                });

                mediaUploader.open();
            });

            // Удаление изображения при клике на кнопку удаления
            $('.remove_image_button').click(function (e) {
                e.preventDefault();
                $('#category_image').val('');
                $('#category-image-preview').html('');
                $(this).addClass('hidden');
            });
        });
    </script>
    <?php
}
add_action('admin_footer', 'add_media_uploader_script');

//