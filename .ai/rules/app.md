---
paths:
  - 'resources/views/components/app/**'
---

# App

## Sidebar state and shared navigation data
Keep desktop sidebar state local to x-app.shell as sidebarExpanded and keep mobile drawer state in x-ui.sheet. Define navigation once in the shell, then pass it to desktop and mobile sidebar compositions. Workspace state and workspace data are intentionally absent from the application shell. Sidebar must remain Blade, Alpine, Tailwind, and existing UI primitives without Flux rendering.

## Tema aplikasi dua-state pada root
Tema hanya light atau dark. Light adalah default, termasuk saat localStorage gagal atau berisi nilai invalid. x-app.theme-controller membaca localStorage.theme secara sinkron dan hanya boleh menambah atau menghapus class dark pada html; jangan gunakan prefers-color-scheme, cookie, session, atau state tema per-komponen.

## Sidebar memakai Application Brand, bukan Workspace Switcher
Header Sidebar desktop dan mobile harus memakai x-app.brand sebagai tautan normal wire:navigate ke route dashboard. Jangan menambahkan state workspace, dropdown, chevron, atau ARIA menu pada brand tanpa instruksi eksplisit.
