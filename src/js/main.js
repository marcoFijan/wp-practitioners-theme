import SwiperController from "./controllers/SwiperController";
import LightboxController from "./controllers/LightboxController";
import NavController from "./controllers/NavController";
import FlexibleFormController from "./controllers/FlexibleFormController";
import VideoController from "./controllers/VideoController";
import AriaToggleController from "./controllers/AriaToggleController";
import FormHandlerController from "./controllers/FormHandlerController";

class App {
  constructor() {
    window.app = this;

    this.initControllers([
      {
        name: "lightboxController",
        class: LightboxController,
        selector: "[data-lightbox]",
      },
      {
        name: "videoController",
        class: VideoController,
        selector: "[data-media-player]",
      },
      {
        name: "swiperController",
        class: SwiperController,
        selector: ".swiper",
      },
      {
        name: "navController",
        class: NavController,
        selector: "#nav",
      },
      {
        name: "ariaToggleController",
        class: AriaToggleController,
        selector: "[data-toggle-trigger]",
      },
      {
        name: "flexibleFormController",
        class: FlexibleFormController,
        selector: "[data-flex-form-target]",
      },
      {
        name: "formHandlerController",
        class: FormHandlerController,
        selector: ".wpcf7-form",
      },
    ]);
  }

  initController(name, ControllerClass, selector, options = {}) {
    if (this[name]) {
      return this[name];
    }

    this[name] = new ControllerClass(selector, options);
    return this[name];
  }

  initControllers(controllers) {
    controllers.forEach(({ name, class: ControllerClass, selector, options }) => {
      this.initController(name, ControllerClass, selector, options);
    });
  }
}

document.addEventListener("DOMContentLoaded", () => {
  new App();
});
