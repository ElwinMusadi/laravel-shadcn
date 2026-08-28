# AI Development

## Prinsip

Agen AI harus memperlakukan repository sebagai sumber kebenaran yang tahan lintas conversation. Jangan mengandalkan memory conversation sebelumnya untuk keputusan implementasi.

Urutan sumber:

1. Source aktual repository.
2. Test aktual.
3. Dokumentasi proyek.
4. Dokumentasi resmi Laravel, Livewire, Pest, dan Tailwind.
5. Dokumentasi resmi shadcn sebagai referensi konsep/visual.
6. Referensi lain.

Jika sumber bertentangan, implementasi serta test aktual menang.

## Workflow

1. Jalankan <code>git status</code>.
2. Baca <code>AGENTS.md</code>, <code>PROJECT_STATUS.md</code>, dan index <code>.ai/rules/</code>.
3. Baca semua rule yang cocok dengan path scope serta cari keyword relevan di aturan.
4. Periksa source sibling, component API, route, config, dan test terkait.
5. Aktifkan skill yang relevan dan gunakan Laravel Boost ketika tersedia.
6. Verifikasi API framework yang version-sensitive melalui dokumentasi resmi.
7. Buat perubahan paling kecil yang memenuhi scope.
8. Jalankan test, build, formatter, diff check, dan audit sesuai dampak.
9. Perbarui dokumentasi dan Playground bila API/UI produksi berubah.
10. Laporkan bukti serta risiko manual yang tersisa; jangan auto-commit.

## Batas frontend

Jangan memperkenalkan React, Vue, Inertia, JSX, TSX, atau frontend framework tambahan. Gunakan Blade, Livewire, Alpine lokal, Tailwind CSS 4, dan komponen yang sudah ada.

Jangan menyalin kode React shadcn secara buta. shadcn dapat membantu memahami visual, primitive, atau komposisi; API project yang valid hanya API Blade aktual.

## Batas komponen dan tema

- Cari komponen yang ada sebelum membuat yang baru.
- Gunakan <code>x-ui.*</code> untuk primitive generik, <code>x-app.*</code> untuk komposisi aplikasi, block untuk komposisi tingkat halaman, dan page untuk domain screen.
- Pakai token semantik; jangan menciptakan token atau color palette arbitrary.
- Jangan mengubah nama token, API primitive, semantik aksesibilitas, theme runtime, shell, atau kontrak Fortify tanpa alasan yang jelas serta validasi.
- Jangan meletakkan query, auth logic, atau business logic di Blade primitive.

## Konteks dan Git

Untuk fase besar, gunakan satu tujuan yang jelas per conversation, periksa history Git, dan buat checkpoint commit hanya bila developer memintanya. Setelah fase selesai, buat handoff eksplisit di file repository yang relevan seperti <code>PROJECT_STATUS.md</code>.

Jangan reset, discard, overwrite perubahan developer, atau commit perubahan yang tidak terkait. Jika working tree sudah memiliki perubahan tidak terkait sebelum pekerjaan dimulai, hentikan dan laporkan.

Lihat [Contributing](contributing.md) dan [Starter Kit Workflow](starter-kit-workflow.md).
