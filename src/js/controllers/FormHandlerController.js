export default class FormHandlerController {
  constructor(selector = ".wpcf7-form") {
    this.selector = selector;
    this.init();
  }

  init() {
    const forms = document.querySelectorAll(this.selector);
    if (!forms.length) return;

    forms.forEach((form) => {
      form.addEventListener("submit", () => {
        const btn = form.querySelector(".wpcf7-submit");
        if (!btn) return;

        btn.disabled = true;
        if (btn.nextElementSibling) {
          btn.nextElementSibling.style.opacity = "1";
        }

        form.addEventListener(
          "wpcf7submit",
          () => {
            btn.disabled = false;
            if (btn.nextElementSibling) {
              btn.nextElementSibling.style.opacity = "0";
            }
          },
          { once: true },
        );
      });
    });
  }
}
