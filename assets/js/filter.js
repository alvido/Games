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


//fullscreen mode
document.addEventListener("DOMContentLoaded", function () {
  let fullscreenBtn = document.getElementById('fullscreen-btn');
  let gameContainer = document.getElementById('game-container');

  if (fullscreenBtn) {
    fullscreenBtn.addEventListener('click', function () {
      // Проверяем, поддерживается ли полноэкранный режим
      if (!document.fullscreenElement &&
        !document.mozFullScreen &&
        !document.webkitIsFullScreen &&
        !document.msFullscreenElement) {
        // Запрашиваем полноэкранный режим
        if (gameContainer.requestFullscreen) {
          gameContainer.requestFullscreen();
        } else if (gameContainer.mozRequestFullScreen) {
          gameContainer.mozRequestFullScreen();
        } else if (gameContainer.webkitRequestFullscreen) {
          gameContainer.webkitRequestFullscreen();
        } else if (gameContainer.msRequestFullscreen) {
          gameContainer.msRequestFullscreen();
        }
      } else {
        // Выход из полноэкранного режима
        if (document.exitFullscreen) {
          document.exitFullscreen();
        } else if (document.mozCancelFullScreen) {
          document.mozCancelFullScreen();
        } else if (document.webkitExitFullscreen) {
          document.webkitExitFullscreen();
        } else if (document.msExitFullscreen) {
          document.msExitFullscreen();
        }
      }
    });
  }

  // Функция для управления классом fullscreen
  function toggleFullscreenClass() {
    // Проверяем, находится ли контейнер в полноэкранном режиме
    if (document.fullscreenElement ||
      document.mozFullScreen ||
      document.webkitIsFullScreen ||
      document.msFullscreenElement) {
      gameContainer.classList.add('fullscreen');
    } else {
      gameContainer.classList.remove('fullscreen');
    }
  }

  // Обработчики события для изменения состояния полноэкранного режима
  document.addEventListener('fullscreenchange', toggleFullscreenClass);
  document.addEventListener('mozfullscreenchange', toggleFullscreenClass);
  document.addEventListener('webkitfullscreenchange', toggleFullscreenClass);
  document.addEventListener('msfullscreenchange', toggleFullscreenClass);
});
//fullscreen mode

//theatreMod mode
document.addEventListener("DOMContentLoaded", function () {
  let theatreMod = document.getElementById('theatre-mode-btn');

  if (theatreMod) {
    theatreMod.addEventListener('click', function () {
      const gameContainer = document.getElementById('game-container');

      // Переключаем класс театрального режима
      gameContainer.classList.toggle('theatre-mode');
    });
  }
});
//theatreMod mode



//likes
document.addEventListener("DOMContentLoaded", function () {
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
});
//likes