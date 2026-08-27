---
paths:
  - 'resources/views/components/app/**'
---

# App

## Sidebar state and shared navigation data
Keep desktop sidebar state local to x-app.shell as sidebarExpanded and keep mobile drawer state in x-ui.sheet. Define navigation and workspace data once in the shell, then pass the same data to desktop and mobile sidebar compositions. Sidebar must remain Blade, Alpine, Tailwind, and existing UI primitives without Flux rendering.
