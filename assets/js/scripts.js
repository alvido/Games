document.addEventListener("DOMContentLoaded", function () {
  // Выбираем элементы ссылок в меню
  let categories = document.querySelector(".categories");
  let categoriesList = document.querySelector(".categories__list");

  // Если элементы существуют, добавляем обработчик события
  if (categories) {
    categories.addEventListener("click", function (e) {
      e.preventDefault(); // Отменяем стандартное поведение ссылки

      this.classList.toggle("active");
      categoriesList.classList.toggle("active");

    });
  }
});

document.addEventListener("DOMContentLoaded", function () {
  // Выбираем элементы ссылок в меню
  let sidebar = document.querySelector(".sidebar");

  // Если элементы существуют, добавляем обработчик события
  if (sidebar) {
    sidebar.addEventListener("click", function (e) {
      e.preventDefault(); // Отменяем стандартное поведение ссылки
      this.classList.add("active");
    });

     // Обработчик клика по документу
  document.addEventListener("click", function (e) {
    // Проверяем, если клик произошел вне бургер-кнопки и навигации
    if (!sidebar.contains(e.target)) {
      // Убираем активные классы, если они были добавлены
      sidebar.classList.remove("active");
    }
  });
  }
});
//


// select2
// In your Javascript (external .js resource or <script> tag)
$(document).ready(function () {
  if (typeof $.fn.select2 !== "undefined") {
    $("#category-filter").select2({
      minimumResultsForSearch: Infinity,
    });
  }
});

//

//swiper
document.addEventListener("DOMContentLoaded", function () {
  // Функция для инициализации слайдера
  function initSwiper(selector, paginationClass, nextButtonClass, prevButtonClass) {
    if (document.querySelector(selector)) {
      new Swiper(selector, {
        observer: true,
        observeParents: true,
        loop: true,
        autoplay: {
          delay: 3000,
          disableOnInteraction: false,
        },
        pagination: {
          el: paginationClass,
          clickable: true,
        },
        navigation: {
          nextEl: nextButtonClass,
          prevEl: prevButtonClass,
        },
        breakpoints: {
          320: {
            slidesPerView: 2,
            slidesPerGroup: 2,
            spaceBetween: 8,
          },
          768: {
            slidesPerView: 3,
            slidesPerGroup: 3,
            spaceBetween: 8,
          },
          1024: {
            slidesPerView: 6,
            slidesPerGroup: 2,
            spaceBetween: 8,
          },
        },
      });
    }
  }

  // Инициализация слайдеров
  if (document.querySelector("#featured")) {
    new Swiper("#featured", {
      observer: true,
      observeParents: true,
      loop: true,
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
      },
      pagination: {
        // el: ".featured-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".featured-button-next",
        prevEl: ".featured-button-prev",
      },
      breakpoints: {
        320: {
          slidesPerView: 1,
          spaceBetween: 8,
          grid: {
            rows: 1,
          },
        },
        768: {
          slidesPerView: 2,
          spaceBetween: 8,
          grid: {
            rows: 2,
          },
        },
        1024: {
          slidesPerView: 3,
          spaceBetween: 8,
          grid: {
            rows: 2,
          },
        },
      },
    });
  }

  // Инициализация слайдеров для других секций
  initSwiper("#popular", "", ".popular-button-next", ".popular-button-prev");
  initSwiper("#multiplayer", "", ".multiplayer-button-next", ".multiplayer-button-prev");
  initSwiper("#io", "", ".io-button-next", ".io-button-prev");
});

// swiper




// recently post 
// Добавляем этот код в файл вашего JavaScript
document.addEventListener('DOMContentLoaded', function () {
  const gameItems = document.querySelectorAll('.game-item'); // Убедитесь, что у вас есть класс game-item для постов

  gameItems.forEach(item => {
    item.addEventListener('click', function () {
      const postId = this.getAttribute('data-post-id'); // Получаем ID поста из атрибута
      let recentlyViewed = JSON.parse(localStorage.getItem('recently_viewed_games')) || [];

      if (!recentlyViewed.includes(postId)) {
        recentlyViewed.push(postId);
        localStorage.setItem('recently_viewed_games', JSON.stringify(recentlyViewed));
      }
    });
  });
});
//