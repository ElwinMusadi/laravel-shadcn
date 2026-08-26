# Project Status

## Current Phase

Phase 3 — Forms, Data and Navigation Components

## Completed

- Phase 0
- Phase 1 — Amber Design System Foundation
- Phase 2 — Core UI Components
- Phase 3 — Forms, Data and Navigation Components

## Current Architecture

- Laravel, Livewire, Blade, Tailwind CSS 4, dan Alpine.js.
- Token semantik Amber dari Phase 1 adalah sumber kebenaran visual.
- Flux tetap terpasang; primitive baru berada di `resources/views/components/ui/` dan tidak bergantung pada Flux.

## Component Inventory

- Core: Button, Card, Badge, Separator, Alert, Avatar, Skeleton, dan Heading/Typography.
- Forms: Field, Field Group, Label, Input, Textarea, Select, Checkbox, Radio Group, Switch, Field Description, dan Field Error.
- Data: Table dan Pagination.
- Navigation: Breadcrumb dan Tabs.

## Latest Validation

- Phase 1: Pint, test suite (35 tests / 126 assertions), `npm run build`, `git diff --check`, dan audit token semantik lulus.
- Phase 2: `vendor/bin/pint --dirty --format agent`, test suite (45 tests / 191 assertions), `npm run build`, `git diff --check`, dan audit token/teknologi lulus.
- Phase 3: `vendor/bin/pint --dirty --format agent`, test suite (54 tests / 273 assertions), `npm run build`, `git diff --check`, serta audit token, dark mode, Livewire, Flux, responsivitas, dan teknologi terlarang lulus.

## Known Risks

- View aplikasi lama masih menggunakan Flux dan kelas warna legacy; migrasinya berada di fase berikutnya.
- Avatar fallback untuk gambar yang gagal memuat menggunakan handler error HTML minimal.
- Tabs memakai Alpine lokal untuk state aktif dan navigasi keyboard; tidak diikat ke state Livewire atau route aplikasi.
- Interaksi runtime tabs belum memiliki browser E2E otomatis karena project tidak memasang plugin browser Pest; test komponen memverifikasi markup Alpine, state ARIA, dan handler keyboard yang dirender.

## Next Phase

Phase 4 — Advanced Interaction Components.
