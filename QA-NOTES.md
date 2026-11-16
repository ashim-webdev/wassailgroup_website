# Completed checks

- 27 HTML pages checked in Chromium at widths 1440, 1024, 768, 390, and 320 pixels.
- No horizontal page overflow, broken image loads, or JavaScript runtime errors found in the final pass.
- One H1 per page; local link destinations, fragment targets, asset references, and image alt attributes checked.
- Desktop and mobile dropdowns, Escape dismissal, slide controls, and enquiry prefilling verified.
- Form success and server-failure UI paths tested with mocked responses. Failure retains the user's message. No email was sent.
- Automated axe WCAG A/AA checks passed on the homepage, About, Contact, Industries, Ecosystem, and an Insight article at desktop size. Automated checks do not replace a complete human accessibility audit.
- Desktop and mobile screenshots visually reviewed. Photography uses appropriate cropping and aspect ratios; hero images have responsive WebP variants.
- Reduced-motion preferences disable animation and automatic slideshow rotation.

## Hosting-dependent verification

PHP was not installed in the development environment, so the PHP endpoint was reviewed but not runtime-tested here. Configure the host's mail transport and verify actual email delivery before launch. The Google Maps embed and Google Fonts require an internet connection; a fallback font is provided.

## Package

The ready-to-use ZIP includes all HTML pages, the PHP endpoint, required stylesheet/script/icon/font dependencies, used imagery, and handover notes. Unused template assets, working screenshots, and videos are kept in the source workspace and original backup rather than being shipped in the production ZIP.
