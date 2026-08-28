# Accessibility

## Ekspektasi

Komponen dan halaman harus mempertahankan:

- HTML semantik dan landmark yang benar.
- Label yang terhubung ke kontrol form.
- Status <code>required</code>, <code>disabled</code>, dan <code>aria-invalid</code> yang akurat.
- Pesan error dengan <code>role="alert"</code> dan deskripsi yang dihubungkan saat diperlukan.
- Fokus terlihat serta keyboard yang dapat digunakan.
- ARIA yang sesuai untuk dialog, menu, tabs, collapsible, tooltip, breadcrumb, pagination, dan toast.
- Token semantik yang menjaga contrast pada Light serta Dark.
- Interaksi responsive yang tetap dapat dioperasikan.

## Implementasi penting

- Application shell menyediakan skip link menuju <code>main</code>.
- Dialog dan Sheet memakai <code>role="dialog"</code>, <code>aria-modal</code>, Escape, fokus awal, pengembalian fokus, dan focus trap ringan.
- Dropdown, Command, dan Tabs memiliki navigasi keyboard yang diuji.
- Toast memiliki live region; error memakai <code>role="alert"</code>.
- Dashboard chart memiliki SVG title/description serta alternatif teks; tabel memiliki caption.
- Avatar image memakai <code>alt</code>; Skeleton bersifat <code>aria-hidden</code>.

## Automated dan manual QA

Browser test melakukan pemeriksaan JavaScript error dan audit aksesibilitas representative pada level critical/serious. Itu adalah sinyal regresi, bukan sertifikasi WCAG.

Selalu lakukan QA manual untuk flow penting:

1. Navigasikan tanpa mouse dengan Tab, Shift+Tab, Enter, Space, Escape, Arrow keys, Home, dan End.
2. Pastikan fokus tidak hilang setelah membuka/menutup overlay atau navigasi Livewire.
3. Periksa label, error, live region, dan nama kontrol memakai browser accessibility tree atau pembaca layar.
4. Periksa Light dan Dark di UI Playground.
5. Periksa layout desktop, tablet, serta mobile.
6. Uji kontras visual pada browser target.

Pemeriksaan pembaca layar nyata, WebAuthn authenticator, serta upacara QR 2FA tetap menjadi pekerjaan manual. Tidak ada klaim sertifikasi atau kepatuhan WCAG formal.

## Risiko yang diketahui

- Focus trap Dialog/Sheet bersifat ringan dan perlu verifikasi pembaca layar nyata.
- Popover memakai anchor CSS sederhana, tanpa collision detection seluruh tepi viewport.
- Trigger mobile memiliki ukuran visual di bawah rekomendasi touch target 44px pada beberapa control; perubahan ini perlu keputusan desain lintas komponen.
- Axe dapat menghasilkan false positive mode Dark terhadap custom property <code>oklch</code>; verifikasi Chromium dan inspeksi visual tetap diperlukan.

Gunakan [UI Playground](layouts-and-pages.md#ui-playground) untuk QA manual dan [Testing](testing.md) untuk validasi otomatis.
