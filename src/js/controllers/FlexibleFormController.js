export default class FlexibleFormController {
  constructor(selector = "[data-flex-form-target]") {
    this.selector = selector;
    this.init();
  }

  init() {
    const triggerButtons = document.querySelectorAll(this.selector);
    if (!triggerButtons.length) return;

    triggerButtons.forEach((button) => {
      button.addEventListener("click", () => {
        const modalId = button.getAttribute("data-flex-form-target");
        if (!modalId) return;

        const preEmailInput = document.getElementById("pre-email-" + modalId);
        const preAcceptance = document.getElementById("pre-acceptance-" + modalId);
        const cf7Wrapper = document.getElementById("cf7-wrapper-" + modalId);

        if (cf7Wrapper) {
          if (preEmailInput) {
            const cf7EmailInput = cf7Wrapper.querySelector('input[type="email"][name="e-mailadres"]');
            if (cf7EmailInput) {
              cf7EmailInput.value = preEmailInput.value;
            }
          }

          if (preAcceptance) {
            const cf7Acceptance = cf7Wrapper.querySelector('input[type="checkbox"][name="acceptance"]');
            if (cf7Acceptance) {
              cf7Acceptance.checked = preAcceptance.checked;
            }
          }
        }
      });
    });
  }
}
