// Burger Menu Open //
document.addEventListener("DOMContentLoaded", function () {
  // Выбираем бургер-кнопку и навигацию
  let burgerButton = document.getElementById("burgerButton");
  // let navigation = document.querySelector(".navigation");
  // let links = document.querySelectorAll(".navigation__link");

  // Если бургер-кнопка существует, добавляем обработчик события
  if (burgerButton) {
    burgerButton.addEventListener("click", function (e) {
      e.stopPropagation(); // Остановка всплытия события
      burgerButton.classList.toggle("burger--active"); // Переключаем класс активности бургер-кнопки
      // navigation.classList.toggle("navigation--active"); // Переключаем класс активности навигации
    });
  }

  // links.forEach((link) => {
  //   link.addEventListener("click", function (e) {
  //     burgerButton.classList.remove("burger--active");
  //     // navigation.classList.remove("navigation--active");
  //   });
  // });
});
//

//
// document.addEventListener("DOMContentLoaded", function () {
//   // Выбираем элементы меню с дочерними пунктами
//   let navChildren = document.querySelectorAll(".menu-item");

//   // Если элементы существуют, добавляем обработчик события
//   if (navChildren) {
//     navChildren.forEach((nav) => {
//       nav.addEventListener("click", function (e) {
//         // Убираем класс 'active' у всех элементов меню
//         navChildren.forEach((item) => {
//           item.classList.remove("active");
//         });

//         // Переключаем активное состояние для текущего элемента
//         this.classList.toggle("active");

//         // Ищем подменю и добавляем/убираем класс активного состояния
//         let subMenu = nav.querySelector(".sub-menu");
//         if (subMenu) {
//           subMenu.classList.toggle("active");
//         }
//       });
//     });
//   }
// });

document.addEventListener("DOMContentLoaded", function () {
  // Выбираем элементы ссылок в меню
  let navChildren = document.querySelectorAll(".menu-item > a");

  // Если элементы существуют, добавляем обработчик события
  if (navChildren) {
    navChildren.forEach((nav) => {
      nav.addEventListener("click", function (e) {
        e.preventDefault(); // Отменяем стандартное поведение ссылки

        // Получаем родительский элемент текущей ссылки
        let parentMenuItem = this.parentElement;

        // Если родительский элемент уже активен, снимаем активность
        if (parentMenuItem.classList.contains("active")) {
          parentMenuItem.classList.remove("active");

          // Закрываем подменю, если оно существует
          let subMenu = parentMenuItem.querySelector(".sub-menu");
          if (subMenu) {
            subMenu.classList.remove("active");
          }
          return; // Прекращаем выполнение, если элемент уже активен
        }

        // Убираем класс 'active' у всех остальных элементов меню
        document.querySelectorAll(".menu-item").forEach((item) => {
          item.classList.remove("active");

          // Скрываем подменю у всех элементов
          let subMenu = item.querySelector(".sub-menu");
          if (subMenu) {
            subMenu.classList.remove("active");
          }
        });

        // Добавляем активное состояние для текущего элемента (родителя)
        parentMenuItem.classList.add("active");

        // Ищем подменю и добавляем класс активного состояния
        let subMenu = parentMenuItem.querySelector(".sub-menu");
        if (subMenu) {
          subMenu.classList.add("active");
        }
      });
    });
  }
});





//

// // Fixed header
// $(document).ready(function () {
//   var header = $(".header"),
//     main = $(".main"),
//     headerH = header.innerHeight(),
//     scrollOffset = $(window).scrollTop();

//   checkScroll(scrollOffset);

//   $(window).on("scroll", function () {
//     scrollOffset = $(this).scrollTop();
//     checkScroll(scrollOffset);
//   });

//   function checkScroll(scrollOffset) {
//     if (scrollOffset >= headerH) {
//       header.addClass("fixed");
//       main.css("padding-top", headerH); // Добавляем верхний отступ
//     } else {
//       header.removeClass("fixed");
//       main.css("padding-top", 0); // Убираем верхний отступ
//     }
//   }

//   // Плавная прокрутка с учетом высоты заголовка
//   $('a[href*="#"]').on("click", function (event) {
//     event.preventDefault();

//     var targetId = $(this).attr("href").split("#")[1],
//       targetOffset = $("#" + targetId).offset().top - headerH;

//     $("html, body").animate(
//       {
//         scrollTop: targetOffset,
//       },
//       300
//     );
//   });
// });
// // Fixed header end

// // select2
// // In your Javascript (external .js resource or <script> tag)
// $(document).ready(function () {
//   $("#womanInsurance, #womanStatus, #manStatus, #manInsurance").select2({
//     minimumResultsForSearch: Infinity,
//   });
// });
// //

//swiper
document.addEventListener("DOMContentLoaded", function () {
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
        el: ".swiper-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      breakpoints: {
        320: {
          slidesPerView: 1,
          spaceBetween: 10,
        },
        768: {
          slidesPerView: 2,
          spaceBetween: 8,
          grid: {
            rows: 1,
          },
        },
        1024: {
          slidesPerView: 4,
          spaceBetween: 8,
          grid: {
            rows: 2,
          },
        },
      },
    });
  }
  //   if (document.querySelector("#prior")) {
  //     new Swiper("#prior", {
  //       observer: true,
  //       observeParents: true,
  //       loop: true,
  //       autoplay: {
  //         delay: 3000,
  //         disableOnInteraction: false,
  //       },
  //       pagination: {
  //         el: ".swiper-pagination",
  //         clickable: true,
  //       },
  //       navigation: {
  //         nextEl: ".swiper-button-next",
  //         prevEl: ".swiper-button-prev",
  //       },
  //       breakpoints: {
  //         320: {
  //           slidesPerView: 1,
  //           spaceBetween: 10,
  //         },
  //         561: {
  //           slidesPerView: 2,
  //           spaceBetween: 20,
  //         },
  //         1024: {
  //           slidesPerView: 2,
  //           spaceBetween: 30,
  //         },
  //       },
  //     });
  //   }
  //   if (document.querySelector("#strategic")) {
  //     new Swiper("#strategic", {
  //       observer: true,
  //       observeParents: true,
  //       loop: true,
  //       autoplay: {
  //         delay: 3000,
  //         disableOnInteraction: false,
  //       },
  //       pagination: {
  //         el: ".swiper-pagination",
  //         clickable: true,
  //       },
  //       navigation: {
  //         nextEl: ".swiper-button-next",
  //         prevEl: ".swiper-button-prev",
  //       },
  //       breakpoints: {
  //         320: {
  //           slidesPerView: 1,
  //           spaceBetween: 10,
  //         },
  //         561: {
  //           slidesPerView: 2,
  //           spaceBetween: 20,
  //         },
  //         1024: {
  //           slidesPerView: 2,
  //           spaceBetween: 30,
  //         },
  //       },
  //     });
  //   }
});
// swiper
