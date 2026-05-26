module.exports = (ctx) => ({
  plugins: [require("postcss-import-ext-glob") /* Keeps the wildcard @import-glob working */, require("@tailwindcss/postcss") /* Tailwind v4 now handles all regular @imports natively! */, require("autoprefixer"), ...(ctx.env === "production" ? [require("cssnano")] : [])],
});
