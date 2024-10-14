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


//
//
document.addEventListener("DOMContentLoaded", function () {
  // Обработчик события для кнопки полноэкранного режима
  let fullscreen = document.getElementById('fullscreen-btn');

  if (fullscreen) {
    fullscreen.addEventListener('click', function () {
      let gameContainer = document.getElementById('game-container');

      // Проверяем, поддерживается ли полноэкранный режим
      if (gameContainer.requestFullscreen) {
        gameContainer.requestFullscreen();
      } else if (gameContainer.mozRequestFullScreen) { // Firefox
        gameContainer.mozRequestFullScreen();
      } else if (gameContainer.webkitRequestFullscreen) { // Chrome, Safari, and Opera
        gameContainer.webkitRequestFullscreen();
      } else if (gameContainer.msRequestFullscreen) { // IE/Edge
        gameContainer.msRequestFullscreen();
      }
    });
  }

  // Функция для управления классом fullscreen
  function toggleFullscreenClass() {
    let gameContainer = document.getElementById('game-container');

    // Проверяем, находится ли контейнер в полноэкранном режиме
    if (document.fullscreenElement ||
      document.mozFullScreen ||
      document.webkitIsFullScreen ||
      document.msFullscreenElement) {
      gameContainer.classList.add('fullscreen'); // Добавляем класс, когда в полноэкранном режиме
    } else {
      gameContainer.classList.remove('fullscreen'); // Убираем класс, когда не в полноэкранном режиме
    }
  }

  // Обработчики события для изменения состояния полноэкранного режима
  document.addEventListener('fullscreenchange', toggleFullscreenClass);
  document.addEventListener('mozfullscreenchange', toggleFullscreenClass);
  document.addEventListener('webkitfullscreenchange', toggleFullscreenClass);
  document.addEventListener('msfullscreenchange', toggleFullscreenClass);


  let theatreMod = document.getElementById('theatre-mode-btn');

  if (theatreMod) {
    theatreMod.addEventListener('click', function () {
      const gameContainer = document.getElementById('game-container');

      // Переключаем класс театрального режима
      gameContainer.classList.toggle('theatre-mode');
    });
  }

  //likes
  document.querySelectorAll('.like-button, .dislike-button').forEach(button => {
    button.addEventListener('click', function () {
      const postId = this.getAttribute('data-post-id');
      const actionType = this.classList.contains('like-button') ? 'like' : 'dislike';

      fetch(ajaxurl, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams({
          'action': 'handle_like_dislike',
          'post_id': postId,
          'action_type': actionType,
        })
      })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            if (actionType === 'like') {
              this.querySelector('.like-count').textContent = data.data.likes;
            } else {
              this.querySelector('.dislike-count').textContent = data.data.dislikes;
            }
          } else {
            console.error('Error:', data.data);
          }
        })
        .catch(error => console.error('Fetch error:', error));
    });
  });

  //likes
});
//