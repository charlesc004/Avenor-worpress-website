# Architecture

The custom **block theme** owns `theme.json`, native HTML templates, header/footer template parts, editable PHP block patterns, and shared CSS layers for foundation, components, layouts, experience refinements, and the night palette. Core blocks supply page content, titles, images, Navigation, Query Loop, search, pagination, and post navigation. There is no frontend framework or external font dependency.

**avenor-core** owns business behavior under `Avenor\Core`. `Content/Models` registers four public types, two taxonomies, protected REST metadata, and a private inquiry type. `Blocks/BlockRegistrar` supplies bounded database collections and one renderer per card variant; three additional focused blocks cover team, testimonials, and business details. The editor uses the same PHP output through ServerSideRender. `blocks/index.js` also adds a document settings panel for featured status, role, company, social URL, and related IDs.

The Services and Work URLs are native CPT archives rather than competing Pages with identical slugs. Their taxonomy views use the same archive patterns. Content survives theme switching because it belongs to the plugin. Archive introductions and layouts are editable in the Site Editor. Home and About contain expanded, ordinary blocks that can be rearranged in the page editor.

The unenhanced form posts to a native anonymous admin-post action, using the same validation and persistence service, then redirects to feedback on Contact.

Contact processing follows `ContactController → Validation → ContactService`. The public REST route intentionally permits anonymous submissions. Size/type/length validation, service validation, privacy acknowledgment, a honeypot, a per-network hourly limit, and a unique database option lock protect writes. Only `REMOTE_ADDR` is used; forwarded headers are ignored. Five submissions per hour share the same network allowance. Duplicates return the original acknowledgment for 24 hours. The network lock expires after 30 seconds if a PHP worker crashes; it is otherwise released in `finally`.

Inquiries are private, have no public REST representation, and require custom capabilities granted only to administrators on activation. They store normalized form fields, the message, acknowledgment time, a workflow status, and mail delivery state. WordPress handles admin nonces and the Settings API. The inquiry status metabox additionally checks its own nonce and the mapped post capability.

Persistence precedes `wp_mail()`. Notifications contain an admin link, not the message body. A failed notification does not roll back the inquiry. An administrator can see the delivery flag in the inquiry detail screen. Configure a reliable mail transport before production use.

Retention defaults to 365 days. WP-Cron permanently deletes up to 100 expired records daily; configure a real system scheduler for predictable production execution. Privacy export/erasure uses WordPress email-verification workflows. Uninstall preserves content and settings deliberately; removing personal data requires explicit admin deletion or privacy erasure. Database backups are outside plugin retention control.

Native core provides titles, singular canonicals and XML sitemaps. Theme metadata yields to Yoast, Rank Math and AIOSEO when detected. No review ratings or fabricated Organization claims are emitted. Inquiry content is excluded from public search and sitemaps by its private post-type registration.

## Architecture review

Patterns own editable compositions; PHP owns genuinely dynamic data. Shared service/project cards serve home, archives, taxonomy views, and related collections. Queries are bounded to 12 entries, with archive pagination. No custom tables, content repositories, DI container, page builder, frontend React app, or Node backend is required. React is used only inside the native Gutenberg editor. Filename checks in PHPCS are excluded because the requested namespaced architecture uses PascalCase files; the rest of WordPress-Core checks remain enabled.

Docker targets MySQL 8.4 and PHP 8.3. Playground is an additional local PHP/WASM preview with SQLite. Native PHPUnit tests use the real installed WordPress API with a separate, disposable SQLite database. This verifies plugin behavior but is not a substitute for MySQL execution; the CI workflow is configured to exercise a disposable MySQL WordPress installation and remains unexecuted here.

## Experience refinement

The mobile sidebar retains the core Navigation dialog and its focus trap, Escape behavior and scroll locking. The theme adds a branded header, numbered links, contact action, backdrop styling and a small script for outside-click dismissal and breakpoint cleanup. Navigation and contact details remain database-backed. The script is deliberately limited to presentation behavior.

`tools/upgrade-experience.php` adds the hero note, expertise rail, ways of working, native Insights Query Loop, keyboard-accessible Details FAQs and contact next steps to the seeded pages once. Existing blocks and copy are preserved. Newly added sections remain ordinary Gutenberg blocks. Source patterns make the same compositions available for reuse.

The npm test command resets only loopback rate-limit transients in this project’s local Playground database before browser tests. It does not expose a reset endpoint or change production anti-spam settings, and skips external test targets.

## Business content release

The public solution library contains technical architectures with scope and acceptance criteria, rather than unsupported client-delivery claims. Publishing models for approved staff and testimonials remain available in administration, but no invented people or endorsements are initialized or published. Initialization creates services, solution architectures, an explicitly identified in-house platform case study, editorial articles, pages, and navigation. Browser fixtures are created during tests and removed from the local database in teardown.

The brand palette is managed by theme.json: graphite and deep petroleum surfaces, sage highlights, light text and restrained copper details. The same palette is used by the block editor. Default contact details are retained at the owner’s request.

`avenor_entry_kind` distinguishes architecture guides from delivered projects within the existing case content type. The collection block selects architecture (default, including legacy records without metadata), project, or all; every selection still excludes unpublished records and combines with featured/category filters. Native editor controls expose both entry type and collection selection. Team and testimonial blocks show an editorial contact invitation until approved records are published. `tools/publish-sections.php` adds editable discipline, partnership, and portfolio sections once while preserving existing page content.

Local Playground startup checks the WordPress REST index for the contact route before announcing application readiness; an initial bootstrap response can precede plugin-route availability in the preview runtime.

## Frontend motion

The theme enqueues a small deferred native motion script and a frontend-only stylesheet. Web Animations and IntersectionObserver provide once-per-element staggered entrances; unenhanced content remains visible. A passive scroll listener schedules one animation frame to update the reading indicator and bounded hero-image parallax. Fine-pointer devices also receive a card spotlight and small magnetic button movement. Touch devices omit pointer-dependent effects. System reduced-motion changes disconnect observers, cancel owned animations and hide the reading indicator immediately; keyboard focus cancels a reveal on the focused content. No animation framework, scroll interception, content duplication or additional page sections are introduced.

Page-entry headlines on Home and native page introductions (including Solutions) animate individual word spans while preserving the original text nodes' whitespace, emphasis and line breaks. Only the visible heading is segmented, and long headings use the generic entrance. Scroll entrances combine a 48px translation and small scale change; card images settle from a modest zoom. The hero adds a one-time clipped reveal and stronger scroll parallax, bounded to the available image overscan to prevent exposed edges. These animations use transform/opacity plus one hero clip, with no blur filters, permanent animation loop or new dependency.

The clean-code revision separates these responsibilities into versioned native modules under `assets/js/motion`, `assets/js/navigation` and `assets/js/shared`. Animation ownership and media queries are shared, rather than reimplemented by each entry point. Interactive containers fade without translating their click targets; their clipped imagery still animates. This avoids a scroll-entry race where a link could move between pointer positioning and activation. Non-interactive sections keep the deeper translation.

CSS source order is explicit in `assets/css/manifest.json`; the build generates one frontend and one editor stylesheet. Do not edit `assets/build` by hand. `npm run check:architecture` validates registered components, import-map dependencies and source-size boundaries. Server-side block callbacks remain compatible through a thin `BlockRegistrar` facade; focused query, renderer, card, icon, profile and form components own the implementation. Archive collections inherit the native main-query batch size so custom pagination cannot drift from WordPress's route handling.

The mobile menu reuses the native Navigation dialog inside a floating rounded panel, with the same capsule and active-link styling as desktop. A class observer triggers bounded panel/backdrop and staggered-link entrances. Close-button, Escape and backdrop dismissal animate out for 220ms before invoking the native close action; focus restoration, focus containment, ARIA and scroll locking remain owned by WordPress. Interrupted entrances exit from the current visual state. Desktop resizing and reduced-motion changes cancel the decorative animations and close immediately where appropriate. Short screens scroll inside the panel; no duplicate dialog or animation dependency is created.
