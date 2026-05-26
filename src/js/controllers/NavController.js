// Throttles a function to limit how often it can be called.
function throttle(func, limit) {
  let inThrottle;
  return function (...args) {
    const context = this;
    if (!inThrottle) {
      func.apply(context, args);
      inThrottle = true;
      setTimeout(() => (inThrottle = false), limit);
    }
  };
}

export default class NavController {
  constructor(selector = "#nav") {
    this.nav = document.querySelector(selector);
    this.menuToggle = document.getElementById("mobile-menu-toggle");
    this.lastScrollY = 0;
    this.threshold = 160;

    this.init();
  }

  init() {
    if (!this.nav || !this.menuToggle) return;

    this.menuToggle.addEventListener("change", () => {
      if (this.menuToggle.checked) {
        document.body.style.overflow = "hidden";
      } else {
        document.body.style.overflow = "";
      }
    });

    window.addEventListener(
      "resize",
      throttle(() => this.closeMenu(), 100),
    );
    window.addEventListener(
      "scroll",
      throttle(() => this.handleScroll(), 100),
    );

    window.addEventListener("keydown", (e) => {
      if (e.key === "Escape") this.closeMenu();
    });
  }

  closeMenu() {
    if (this.menuToggle.checked) {
      this.menuToggle.checked = false;
      document.body.style.overflow = "";
    }
  }

  handleScroll() {
    const currentScrollY = window.scrollY;

    if (currentScrollY !== this.lastScrollY) {
      this.closeMenu();
    }

    if (currentScrollY > this.threshold) {
      this.nav.setAttribute("data-scrolled", "true");
    } else {
      this.nav.setAttribute("data-scrolled", "false");
    }

    if (currentScrollY > this.lastScrollY && currentScrollY > this.threshold) {
      this.nav.setAttribute("aria-expanded", "false");
    } else {
      this.nav.setAttribute("aria-expanded", "true");
    }

    this.lastScrollY = currentScrollY;
  }
}
