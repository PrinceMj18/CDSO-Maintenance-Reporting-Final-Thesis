# CDSO Mobile UI and Logout Alignment Fix

## Changes
- Added a responsive mobile navigation button in the shared header.
- Converted role sidebars into slide-in mobile drawers with a dimmed backdrop and Escape-key close behavior.
- Moved logout confirmation dialogs into the document body using Alpine teleport so they remain centered in the viewport rather than being constrained by a transformed sidebar.
- Centered logout controls and improved their touch target.
- Added phone-specific spacing, full-width rectangular content surfaces, safer form controls, and responsive table containers.

## Notes
- Existing controllers, routes, database schema, notification rules, and request workflows were not intentionally changed.
- Test the UI in the project's normal Laravel environment after installing its dependencies and rebuilding Vite assets.
