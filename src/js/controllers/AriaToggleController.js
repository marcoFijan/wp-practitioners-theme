export default class AriaToggleController {
  constructor(selector = "[data-toggle-trigger]") {
    this.selector = selector;
    this.init();
  }

  init() {
    const triggers = document.querySelectorAll(this.selector);
    if (!triggers.length) return;

    triggers.forEach((trigger) => {
      trigger.addEventListener("click", (e) => {
        e.preventDefault();

        const container = trigger.closest("[data-toggle-container]");
        if (container) {
          const isExpanded = container.getAttribute("aria-expanded") === "true";
          container.setAttribute("aria-expanded", String(!isExpanded));
        }
      });
    });
  }
}
