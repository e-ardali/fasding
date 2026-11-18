# Fasding

Fasding is a WordPress theme for building Elementor landing pages. It uses [Roots Sage](https://github.com/roots/sage), Acorn, Blade, Vite, and Tailwind CSS. The frontend loads Tailwind utilities without Preflight so Elementor retains control over its element styles.

## Setup

Use WordPress 6.6+, PHP 8.3+, Composer, and Node.js 20.19+ in the 20.x series or 22.12+.

1. Clone the repository into `wp-content/themes/fasding`.
2. From the theme directory, run `composer install`, `npm ci`, and `npm run build`.
3. Activate Fasding and Elementor in WordPress.

Deploy the built `public/build` assets and Composer's `vendor` directory with the theme. For development, set `APP_URL` to your local WordPress URL if needed and run `npm run dev`. Allow WordPress to write to its content/cache directory for Acorn.

## Landing pages

Use **Fasding Landing Page** for a full-width content area with the site's header and footer, or **Elementor Canvas** for a standalone landing page. **Elementor Full Width** also uses the theme's header and footer. Elementor can edit the default page template as well.

Elementor Pro Theme Builder can supply the header and footer. Where no matching Pro template exists, Fasding uses the latest published template part of the corresponding type under **Appearance → Template Parts**. Enable **Template Parts** under **Elementor → Settings → Post Types** to edit them with Elementor. Existing template parts and oEmbed widgets retain their stored identifiers.

The legacy **Contact** page template now renders the page's editable content. Add any contact details that were previously hardcoded to the page itself before deploying if a site still uses that template.

## Updating Sage

[`SAGE_VERSION`](SAGE_VERSION) records the stable Sage release imported into Fasding. Fasding keeps its own theme identity and consumes upstream changes through a three-way Git patch. Use a clean branch from Fasding's main branch and pick a stable tag from [Sage releases](https://github.com/roots/sage/releases).

```sh
git switch -c update/sage-vX.Y.Z
upstream_version=$(cat SAGE_VERSION)
target_version=vX.Y.Z
git fetch --no-tags https://github.com/roots/sage.git \
    "refs/tags/$upstream_version:refs/sage/$upstream_version" \
    "refs/tags/$target_version:refs/sage/$target_version"
git diff --binary "refs/sage/$upstream_version" "refs/sage/$target_version" -- \
    . ':(exclude).github' ':(exclude).gitattributes' \
    ':(exclude)README.md' ':(exclude)screenshot.png' |
    git apply --3way --index
```

If Git reports conflicts or a patch it could not apply, reconcile those files against the release diff before changing `SAGE_VERSION`. Preserve Fasding's theme metadata, Elementor integration, and Vite base when reconciling shared files. Update dependencies and the npm lockfile as needed, build the assets, and check the landing template, Elementor editor, Canvas, and Full Width in a staging WordPress site before merging the update.

## License

Fasding and Sage are MIT-licensed. See [Fasding's license](LICENSE) and [Sage's license](LICENSE.md).
