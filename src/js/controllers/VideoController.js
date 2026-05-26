export default class VideoController {
  constructor(selector = "[data-media-player]") {
    this.selector = selector;
    this.init();
  }

  init() {
    document.querySelectorAll(this.selector).forEach((player) => {
      const config = this.parseConfig(player);
      if (!config || !config.autoplay || config.type !== "video") return;

      const video = player.querySelector("[data-autoplay-video]");
      if (!video) return;

      video.querySelectorAll("source[data-src]").forEach((source) => {
        source.src = source.dataset.src;
        delete source.dataset.src;
      });

      video.load();
      video.play().catch(() => {});
    });

    // Observer for videos inside lightboxes
    document.querySelectorAll("[data-lightbox-id]").forEach((lightbox) => {
      const player = lightbox.querySelector(this.selector);
      if (!player) return;

      new MutationObserver(() => {
        const isOpen = lightbox.getAttribute("aria-hidden") === "false";
        isOpen ? this.playPlayer(player) : this.stopPlayer(player);
      }).observe(lightbox, {
        attributes: true,
        attributeFilter: ["aria-hidden"],
      });
    });
  }

  parseConfig(player) {
    try {
      return JSON.parse(player.dataset.mediaPlayer);
    } catch (e) {
      console.warn("[VideoController] Invalid config:", player, e);
      return null;
    }
  }

  hasMarketingConsent() {
    if (typeof Cookiebot !== "undefined") {
      return Cookiebot.consent.marketing;
    }
    return false;
  }

  embedYouTube(player, config, forceLoad = false) {
    const target = player.querySelector("[data-video-target]");
    const overlay = player.querySelector("[data-overlay]");

    if (!forceLoad && !this.hasMarketingConsent()) {
      const warning = player.querySelector("[data-consent-warning]");
      if (warning) warning.hidden = false;
      return;
    }
    if (target.querySelector("iframe")) return;

    const iframe = document.createElement("iframe");
    iframe.src = `https://www.youtube-nocookie.com/embed/${config.src}?autoplay=1&rel=0`;
    iframe.allow = "autoplay; encrypted-media; picture-in-picture";
    iframe.allowFullscreen = true;
    iframe.style.cssText = "position:absolute;inset:0;width:100%;height:100%;border:0;z-index:5;";

    if (overlay) overlay.style.display = "none";
    target.appendChild(iframe);
  }

  embedLocalVideo(player, config) {
    const target = player.querySelector("[data-video-target]");
    const overlay = player.querySelector("[data-overlay]");
    const video = document.createElement("video");

    video.src = config.src;
    video.controls = true;
    video.autoplay = true;
    video.style.cssText = "position:absolute;inset:0;width:100%;height:100%;";

    if (overlay) overlay.remove();
    target.appendChild(video);
    video.play().catch(() => {});
  }

  stopPlayer(player) {
    const target = player.querySelector("[data-video-target]");
    const overlay = player.querySelector("[data-overlay]");
    if (!target) return;

    target.querySelectorAll("iframe").forEach((el) => el.remove());
    if (overlay) {
      overlay.style.display = "";
      const warning = overlay.querySelector("[data-consent-warning]");
      if (warning) warning.hidden = false;
    }
  }

  playPlayer(player) {
    const config = this.parseConfig(player);
    if (!config || !config.src) return;

    if (config.type === "youtube") {
      if (this.hasMarketingConsent()) {
        this.embedYouTube(player, config);
      } else {
        const warning = player.querySelector("[data-consent-warning]");
        if (warning) {
          warning.hidden = false;
          if (!warning.dataset.hasListener) {
            warning.addEventListener("click", (e) => {
              e.stopPropagation();
              e.preventDefault();
              if (typeof Cookiebot === "undefined") {
                console.warn("[VideoController] Cookiebot not found. Loading video...");
              }
              this.embedYouTube(player, config, true);
            });
            warning.dataset.hasListener = "true";
          }
        }
      }
    } else if (config.type === "video") {
      this.embedLocalVideo(player, config);
    }
  }
}
