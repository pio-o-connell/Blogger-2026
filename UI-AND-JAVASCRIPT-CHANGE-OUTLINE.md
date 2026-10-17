# UI and JavaScript Change Outline

## Purpose

This document describes the proposed presentation and browser-interaction
updates for Blogger. The application is already functional, so the changes
should improve clarity, responsiveness, and usability without changing the
existing PHP routes, database model, authentication flow, or administrator
permissions.

The current implementation is a server-rendered PHP application. No
JavaScript file is currently loaded by the application, so JavaScript should
be introduced as a progressive enhancement rather than as a replacement for
server-side behavior.

## Current baseline

The application currently provides:

- A public home page with recent posts and links to registration and login.
- Blogger registration, cookie-based login, logout, post creation, and
  comments.
- Individual post viewing and post deletion flows.
- Administrator blog, comment, user, and suspension management.
- Shared public and authenticated layouts rendered by `library.php`.
- Request routing through the `cmd` value in `controller.php`.
- Separate public and authenticated stylesheets:
  `myStyles.css` and `insidestyles.css`.

The current front end already uses semantic landmarks in several views,
responsive sizing rules, accessible navigation labels, form labels, and
visually hidden labels for checkbox controls. These patterns should be
retained and applied consistently to older views.

## Implemented changes

### 1. Cosmetic and layout consistency

- Keep the existing visual direction: a restrained green accent, light
  surfaces, readable typography, and a centered content container.
- Normalize headings, spacing, links, buttons, form controls, post metadata,
  notices, and empty states across public, authenticated, and administrator
  pages.
- Ensure long post titles, usernames, and comment text wrap without breaking
  the layout.
- Keep the public and authenticated layouts visually related while preserving
  their different navigation and administrative purposes.
- Improve small-screen behavior for navigation, forms, two-column dashboard
  content, post lists, and deletion tables.
- Preserve the existing image assets and use meaningful alternative text.
- Prefer shared CSS classes and existing layout patterns over adding
  page-specific overrides.

### 2. Form and feedback improvements

- Make required fields and validation feedback clear before a form is
  submitted where that can be done without changing server-side validation.
- Keep server-side validation as the source of truth.
- Provide consistent success, warning, empty, and error presentation for
  actions such as creating posts, adding comments, deleting content, and
  managing users.
- Keep destructive actions visually distinct and require an intentional
  confirmation before browser-side submission.
- Do not expose database errors, credentials, or other sensitive server
  details in browser messages.

### 3. Progressive JavaScript enhancements

The dedicated `app.js` browser script improves existing flows without
replacing server-side behavior:

- Confirm destructive post, comment, and user deletion actions.
- Add select-all and clear-all behavior to grouped checkbox lists.
- Prevent accidental duplicate submissions by disabling a submit control after
  a valid submission begins and providing a visible busy state.
- Support dismissible, non-critical feedback messages where the corresponding
  server-rendered message remains available without JavaScript.
- Keep navigation, authentication, post creation, comments, and moderation
  fully usable when JavaScript is disabled.

The script uses event listeners and a data attribute for dismissible messages.
It does not duplicate routing, authorization, validation, or database
operations already performed by PHP.

## Constraints and non-goals

- Do not replace the PHP controller/view structure as part of the visual
  update.
- Do not change the MySQL schema or existing `cmd` route names.
- Do not change the cookie-based authentication behavior in this cosmetic
  scope.
- Do not treat client-side validation or confirmation as a security control.
- Do not introduce a framework or a build pipeline for a small progressive
  enhancement.
- Do not remove legacy behavior merely because a newer presentation is
  preferred.
- Do not claim production readiness; the security and modernization
  limitations documented in `README.md` remain applicable.

## Implementation order

1. Established shared visual rules and responsive behavior in the existing
   stylesheets.
2. Applied those rules to the shared layouts and the most visible public,
   authentication, and dashboard views.
3. Added the dedicated JavaScript file with progressive enhancements only.
4. Verify every affected flow with JavaScript enabled and disabled.
5. Check desktop and narrow-screen rendering, then update screenshots or
   documentation only when the visible behavior has actually changed.

## Acceptance criteria

- Existing public, blogger, comment, and administrator flows continue to
  submit to the same PHP routes and produce the same server-side results.
- Pages remain usable with JavaScript disabled.
- Destructive actions require deliberate confirmation but can still be
  completed through the existing server-side handlers.
- Forms and lists remain readable and usable on narrow screens.
- No new browser behavior silently hides server errors or changes
  authorization decisions.
- The README and this document accurately describe what is implemented versus
  what is planned.
