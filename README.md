# Custom WordPress Theme

A modern, highly optimized WordPress theme built with a CSS-first approach utilizing **Tailwind CSS v4**, **PostCSS**, and lightning-fast **esbuild** for JavaScript. It includes seamless integration with Advanced Custom Fields (ACF) via local JSON syncing.

## 📂 Project Structure

This project is divided into two main environments: the source files (where development happens) and the compiled WordPress theme (what WordPress actually runs).

    royal/
    ├── src/                          # Development Source Files
    │   ├── css/
    │   │   ├── main.css              # Frontend Tailwind entry
    │   │   ├── editor.css            # Gutenberg/TinyMCE editor entry
    │   │   ├── tailwind/             # Core theme tokens and base layers
    │   │   └── modules/              # Vanilla CSS components
    │   ├── js/
    │   │   └── main.js               # Frontend JavaScript entry
    │   └── tailwind.config.js        # Config specifically for WYSIWYG typography
    └── theme/                        # Output WordPress Theme
        ├── acf-json/                 # ACF field group sync directory
        ├── assets/                   # Compiled CSS, JS, Fonts, and Images
        ├── components/               # PHP Template parts
        ├── functions.php             # Enqueues, hooks, and WP logic
        ├── index.php                 # Fallback template
        └── style.css                 # Theme declaration

## 🚀 Getting Started

### Prerequisites

- [Node.js](https://nodejs.org/) (v18 or higher recommended)
- A local WordPress environment (e.g., Local by Flywheel, DDEV, or XAMPP)

### Installation

1. Clone the repository into your WordPress `wp-content/themes/` directory.
2. Navigate to the project root in your terminal:
   `cd wp-content/themes/royal`
3. Install the required NPM dependencies:
   `npm install`
4. Activate the "Royal" theme from your WordPress admin dashboard.

## 🛠️ Development Commands

This project uses native NPM scripts to handle asset compilation—no Webpack or Gulp required.

### `npm run watch`

Initiates the development environment. It concurrently watches your `src/` files and PHP templates. When a change is detected, it instantly recompiles Tailwind CSS and bundles your JavaScript via esbuild.

### `npm run build`

Prepares the theme for production. This command compiles, minifies, and optimizes both the CSS and JavaScript files for maximum performance. Run this before deploying to a staging or production server.

## 🎨 Tailwind v4 Architecture

This theme leverages the new CSS-first engine in Tailwind v4.

- Standard configuration and design tokens are handled natively inside `src/css/tailwind/theme.css`.
- A minimal `tailwind.config.js` is retained strictly to power the `@tailwindcss/typography` plugin for the WordPress visual editor (prose).
- We use `postcss-import-ext-glob` to allow dynamic wildcard imports (e.g., `@import-glob "./modules/**/*.css";`) directly within the CSS structure.

## 🗃️ ACF JSON Syncing

Advanced Custom Fields is configured to automatically save and load field groups from the `theme/acf-json/` directory. This allows field groups to be tracked in version control and easily synchronized across local, staging, and production environments without needing database migrations.

## 📄 License

This project is licensed under the [MIT License](LICENSE).
