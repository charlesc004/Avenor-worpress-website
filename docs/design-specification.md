# AVENOR visual specification

The current direction is a dark editorial identity for digital consulting, business transformation and technology. Graphite backgrounds and petroleum surfaces establish depth; sage highlights, light typography and restrained copper details create hierarchy.

## Shared palette

| Token | Color | Purpose |
| --- | --- | --- |
| Paper | #0C1517 | Main background |
| Soft | #111F22 | Alternating sections |
| Surface | #18272A | Cards and forms |
| Deep | #080F11 | Footer |
| Ink | #E8EFEA | Primary text |
| Muted | #A7B8B4 | Secondary text |
| Accent | #A8C9AB | Actions and highlights |
| Line | #2C4143 | Boundaries |
| Copper | #C3A886 | Supporting details |

The palette lives in theme.json and applies to the front end and editor. The internal white token remains the existing Surface identifier for compatibility with saved blocks; it now resolves to a dark surface. Primary actions use dark text on sage. Outlined actions and field controls remain visible on dark backgrounds.

## Composition

System Georgia headlines and Arial body text avoid external font requests. The maximum container is 1328px, with 56px desktop and 20px mobile side margins. An asymmetric hero, architectural photography, focused service cards and alternating surfaces establish the visual rhythm. These are authored design decisions, not measurements from reference screenshots.

The homepage includes expertise, solution architectures, a working process, engagement choices, Insights, FAQs, delivery standards, industry contexts and platform foundations. Public content avoids unsupported client claims, invented staff identities and endorsements. Photos are illustrative stock assets; credits are recorded separately.

## Responsive behavior

Below 782px, core Navigation becomes a right-side drawer with a dark backdrop, numbered links, an explicit close control and contact action. WordPress retains focus trapping, Escape and focus return. A small script adds backdrop dismissal and desktop breakpoint cleanup. Decorative numbering has an empty CSS speech alternative so accessible link names remain unchanged.

Grids reduce to two columns on tablets and stack on mobile. Forms use visible labels, focus outlines, loading states, server validation and native submission. FAQs use native Details blocks. Reduced motion preferences disable decorative transitions.

## Review limits

The original three reference images were not available; exact visual-reference comparison remains unverified. Browser checks capture Home, Services, Solutions, About and Contact at 1440px, 768px and 390px, verify decoded images and horizontal overflow, and review the mobile menu separately. Local artifacts are stored under artifacts/visual-review/ and excluded from version control.
