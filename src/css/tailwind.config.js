module.exports = {
  plugins: [require("@tailwindcss/typography")],
  theme: {
    extend: {
      typography: () => ({
        DEFAULT: {
          css: [
            {
              "--tw-prose-body": "theme(--color-black)",
              "--tw-prose-headings": "theme(--color-black)",
              "--tw-prose-links": "theme(--color-black)",
              "--tw-prose-bold": "theme(--color-black)",
              maxWidth: null,
              fontSize: "0.9375rem",
              lineHeight: "1.5",
              a: {
                fontWeight: "400",
                transition: "text-decoration-color 0.15s cubic-bezier(0.4, 0, 0.2, 1)",
                "@media (hover: hover)": {
                  "&:hover": {
                    textDecorationColor: "transparent",
                  },
                },
              },
              h1: {
                marginTop: "0",
                marginBottom: "2rem",
                fontSize: "4rem",
                lineHeight: "1.1428",
                letterSpacing: "-0.02em",
                fontFamily: "theme(--font-heading)",
                fontWeight: "400",
                "@media (width < theme(--breakpoint-md))": {
                  marginBottom: "1.5rem",
                  fontSize: "2.5rem",
                },
              },
              h2: {
                marginTop: "2.5rem",
                marginBottom: "2rem",
                fontSize: "3rem",
                fontFamily: "theme(--font-heading)",
                lineHeight: "1.1428",
                letterSpacing: "-0.02em",
                fontWeight: "400",
                "@media (width < theme(--breakpoint-md))": {
                  marginBottom: "1.5rem",
                  fontSize: "1.8rem",
                },
              },
              h3: {
                marginTop: "2.5rem",
                marginBottom: "2rem",
                fontSize: "1.5rem",
                lineHeight: "1.1428",
                letterSpacing: "-0.02em",
                fontFamily: "theme(--font-heading)",
                fontWeight: "400",
                "@media (width < theme(--breakpoint-md))": {
                  marginBottom: "1.5rem",
                },
              },
              ".not-prose + *": {
                marginTop: "0",
              },
            },
          ],
        },
        white: {
          css: [
            {
              "--tw-prose-body": "theme(--color-white)",
              "--tw-prose-headings": "theme(--color-white)",
              "--tw-prose-links": "theme(--color-white)",
              "--tw-prose-bold": "theme(--color-white)",
            },
          ],
        },
      }),
    },
  },
};
