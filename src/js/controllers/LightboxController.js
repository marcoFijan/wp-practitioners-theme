export default class LightboxController {
  constructor(selector = "[data-lightbox]") {
    this.selector = selector;
    this.triggers = document.querySelectorAll(this.selector);
    this.lightboxes = document.querySelectorAll("[data-lightbox-id]");
    this.init();
  }

  init() {
    if (!this.triggers.length && !this.lightboxes.length) return;

    this.triggers.forEach((btn) => {
      btn.addEventListener("click", (e) => {
        e.preventDefault();
        this.toggle(btn.dataset.lightbox, true);
      });
    });

    this.lightboxes.forEach((modal) => {
      const id = modal.dataset.lightboxId;
      const closers = modal.querySelectorAll("[data-lightbox-close]");

      closers.forEach((c) => {
        c.addEventListener("click", () => this.toggle(id, false));
      });
    });

    document.addEventListener("keydown", (e) => {
      if (e.key === "Escape") {
        const activeModal = document.querySelector('[data-lightbox-id][aria-hidden="false"]');
        if (activeModal) this.toggle(activeModal.dataset.lightboxId, false);
      }
    });
  }

  toggle(id, isOpen) {
    const modal = document.querySelector(`[data-lightbox-id="${id}"]`);
    if (!modal) return;

    if (isOpen && modal.parentElement !== document.body) {
      document.body.appendChild(modal);
    }

    modal.setAttribute("aria-hidden", String(!isOpen));
    document.body.style.overflow = isOpen ? "hidden" : "";

    if (isOpen) {
      const closeBtn = modal.querySelector("[data-lightbox-close]");
      closeBtn?.focus();
    }
  }
}
