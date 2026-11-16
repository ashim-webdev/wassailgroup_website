# Wassail Group — website handover

## Ready to use

Open `index.html` to preview the website, or upload the contents of this folder to your web host's public directory. The website retains its static HTML architecture and existing page URLs. No Node.js, npm installation, or build step is required to run it.

For the enquiry form, use a PHP-capable web host with a configured mail transport. A static-only host or opening files directly will display the website but cannot send form submissions.

## Contact form setup

- Recipient: `info@wassailgroup.com`, taken from the supplied contact page.
- Optional server environment variable: `WASSAIL_CONTACT_TO` overrides the recipient.
- Sender: `noreply@wassailgroup.com`. Configure the host to permit this sender and configure the domain's mail authentication with your hosting provider.
- The endpoint uses PHP `mail()`. Have the host enable its mail transport, or adapt that transport to your existing authenticated email service.
- PHP sessions must be available for the per-session submission interval.
- Before launch, send a real test enquiry from the hosted site and confirm receipt and replies. A mail-service acceptance response does not guarantee inbox delivery.
- Client validation, server validation, a honeypot, input limits, and a per-session submission interval are included. Network/service errors retain the user's message and show direct email contact details.

The old form recipient was an unrelated template address. It has been replaced with the email already displayed on the supplied website. No real emails were sent during development.

## Files and maintenance

- `assets/css/wassail.css`: the shared visual system and responsive layouts.
- `assets/js/wassail.js`: navigation, slideshow, scroll reveals, counters, and enquiries.
- `contact.php`: contact form endpoint.
- Existing Bootstrap CSS, local Themify outline icons, original logos, and selected photography remain in use.
- All pages contain complete HTML. Content and navigation work without a client-rendering framework.
- Manrope is loaded from the existing Google Fonts service with a system font fallback.
- `assets/img/optimized/`: responsive WebP versions of the supplied hero images. Original images remain available in the source project and backup.
- Legacy libraries are retained in the working source, but unused libraries are not loaded by redesigned pages.

## Content decisions

Company descriptions, vision, mission, values, address, email, telephone, and business hours were based on the supplied content. Unsupported template counters, fictitious testimonials, staff profiles, placeholder partners, template articles, and non-working newsletter/social links were removed from the public pages.

The homepage's nine areas count petroleum and gas separately; they are grouped into eight navigation categories. The three named group companies and one shared group are the only other counts.

Wassail Insights contains three original editorial perspectives. These are presented as explorations of ideas, not company announcements, reported projects, or achievements. All sector photography is illustrative; it is not represented as a Wassail-owned site or operation.

Existing `team.html`, `casestudy.html`, `chemical.html`, `mining.html`, `blog_sidebar.html`, and `blog_single.html` URLs remain accessible with relevant, non-fabricated content. The old template-only names, statistics, and filler are not carried forward.

No verified social URLs were supplied, so no speculative social links were added.

## Verification

See `QA-NOTES.md` for the completed checks and hosting-dependent limitations.
