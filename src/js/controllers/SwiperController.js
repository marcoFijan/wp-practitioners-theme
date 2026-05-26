import Swiper from "swiper";
import { Autoplay, Navigation, Pagination } from "swiper/modules";

export default class SwiperController {
  constructor() {
    this.sliders = [];
    this.init();
  }

  init() {
    this.initStoriesSliders();
    this.initGpSliders();
    this.initAgendaSliders();
    this.initEmployeeSwipers();
  }

  initStoriesSliders() {
    const storiesSliders = document.querySelectorAll(".js-stories-slider");
    storiesSliders.forEach((slider) => {
      const wrapper = slider.closest(".js-stories-wrapper") || slider.parentElement;

      if (wrapper) {
        const initialBg = wrapper.getAttribute("data-initial-bg");
        if (initialBg) wrapper.classList.add(...initialBg.split(" "));

        const swiper = new Swiper(slider, {
          modules: [Navigation, Pagination, Autoplay],
          slidesPerView: 1,
          spaceBetween: 24,
          speed: 1000,
          loop: true,
          navigation: {
            prevEl: wrapper.querySelector(".js-stories-prev"),
            nextEl: wrapper.querySelector(".js-stories-next"),
          },
          on: {
            slideChange: function () {
              const activeSlide = this.slides[this.activeIndex];
              if (!activeSlide) return;

              const nextColor = activeSlide.getAttribute("data-bg-class");

              if (nextColor) {
                const classesToRemove = Array.from(wrapper.classList).filter((c) => c.startsWith("bg-pink") || c.startsWith("bg-yellow") || c.startsWith("bg-blue"));

                wrapper.classList.remove(...classesToRemove);
                wrapper.classList.add(...nextColor.split(" "));
              }
            },
          },
        });
        this.sliders.push(swiper);
      }
    });
  }

  initGpSliders() {
    const gpSliders = document.querySelectorAll(".js-gp-slider");
    gpSliders.forEach((slider) => {
      const container = slider.parentElement;

      const swiper = new Swiper(slider, {
        modules: [Navigation],
        loop: true,
        slidesPerView: 1,
        spaceBetween: 24,
        watchSlidesProgress: true,
        loopAdditionalSlides: 1,
        initialSlide: 1,
        breakpoints: {
          768: { slidesPerView: 1.5 },
          992: { slidesPerView: 2 },
        },
        navigation: {
          prevEl: container.querySelector(".js-gp-prev"),
          nextEl: container.querySelector(".js-gp-next"),
        },
      });
      this.sliders.push(swiper);
    });
  }

  initAgendaSliders() {
    const agendaSliders = document.querySelectorAll(".js-agenda-slider");
    agendaSliders.forEach((slider) => {
      const container = slider.parentElement;

      const swiper = new Swiper(slider, {
        modules: [Navigation],
        loop: true,
        slidesPerView: 1,
        spaceBetween: 24,
        watchSlidesProgress: true,
        loopAdditionalSlides: 1,
        initialSlide: 1,
        breakpoints: {
          768: { slidesPerView: 1.5 },
          992: { slidesPerView: 2 },
        },
        navigation: {
          prevEl: container.querySelector(".js-agenda-prev"),
          nextEl: container.querySelector(".js-agenda-next"),
        },
      });
      this.sliders.push(swiper);
    });
  }

  initEmployeeSwipers() {
    const employeeSwipers = document.querySelectorAll(".employee-swiper");
    employeeSwipers.forEach((slider) => {
      const container = slider.closest(".js-employee-container") || slider.parentElement;

      const swiper = new Swiper(slider, {
        modules: [Navigation, Pagination],
        slidesPerView: 1,
        spaceBetween: 96,
        speed: 500,
        loop: true,
        autoHeight: true,
        navigation: {
          nextEl: container.querySelector(".swiper-next"),
          prevEl: container.querySelector(".swiper-prev"),
        },
        pagination: {
          el: container.querySelector(".swiper-pagination"),
          clickable: true,
        },
      });
      this.sliders.push(swiper);
    });
  }
}
