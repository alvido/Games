jQuery(document).ready(function ($) {
  $('#category-filter').change(function () {
    var filterValue = $(this).val(); // Получаем выбранное значение фильтра

    $.ajax({
      url: ajaxurl, // Используем стандартный WordPress ajaxurl
      type: 'POST',
      data: {
        action: 'filter_games', // Уникальное действие
        filter: filterValue, // Передаем значение фильтра
        category_id: '<?php echo get_queried_object_id(); ?>' // ID текущей категории (опционально)
      },
      success: function (data) {
        $('.games__list').html(data); // Обновляем HTML с постами
      }
    });
  });
});
