# Project Status

## Current Phase

Phase 2 — Core UI Components

## Completed

- Phase 0
- Phase 1 — Amber Design System Foundation
- Phase 2 — Core UI Components

## Current Architecture

- Laravel, Livewire, Blade, Tailwind CSS 4, dan Alpine.js.
- Token semantik Amber dari Phase 1 adalah sumber kebenaran visual.
- Flux tetap terpasang; primitive baru berada di `resources/views/components/ui/` dan tidak bergantung pada Flux.

## Component Inventory

- Button, Card, Badge, Separator, Alert, Avatar, Skeleton, dan Heading/Typography.

## Latest Validation

- Phase 1: Pint, test suite (35 tests / 126 assertions), `npm run build`, `git diff --check`, dan audit token semantik lulus.
- Phase 2: `vendor/bin/pint --dirty --format agent`, test suite (45 tests / 191 assertions), `npm run build`, `git diff --check`, dan audit token/teknologi lulus.

## Known Risks

- View aplikasi lama masih menggunakan Flux dan kelas warna legacy; migrasinya berada di fase berikutnya.
- Avatar fallback untuk gambar yang gagal memuat menggunakan handler error HTML minimal.

## Next Phase

Phase 3 — Forms, Data and Navigation Components.
