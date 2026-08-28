# Contributing

## Aturan kontribusi

- Tetap Blade-native: Laravel, Livewire, Blade, Alpine lokal, dan Tailwind CSS 4.
- Gunakan token semantik; hindari palette hard-coded pada primitive reusable.
- Pertahankan responsive behavior, semantic HTML, label, ARIA, fokus, serta keyboard.
- Reuse component dan API yang sudah ada sebelum menambah yang baru.
- Jangan menambah dependency tanpa persetujuan.
- Jangan menambah React, Vue, Inertia, JSX, atau TSX.
- Jangan menaruh query database atau business logic pada UI primitive.
- Jaga stabilitas API component dan kontrak Fortify.
- Perbarui UI Playground serta dokumentasi ketika surface produksi berubah.
- Tambah atau ubah test yang membuktikan behavior yang diubah.

## Checklist sebelum handoff

1. <code>git status</code> bersih dari perubahan yang tidak terkait.
2. Source, routes, component API, dan test telah diperiksa.
3. Semua path relevan mematuhi <code>AGENTS.md</code> dan <code>.ai/rules/</code>.
4. Test terfokus lulus.
5. Suite Unit/Feature dan Browser yang relevan lulus.
6. <code>npm run build</code>, Pint jika PHP berubah, dan <code>git diff --check</code> lulus.
7. Audit dependency dilakukan sesuai scope.
8. Dokumentasi serta Playground diperbarui bila perlu.
9. Tidak ada perubahan unrelated, reset, atau auto-commit.

## Git workflow

Sebelum bekerja:

~~~powershell
git status
~~~

Setelah sebuah fase selesai dan validasi lulus:

~~~powershell
git add <file-yang-terkait>
git commit -m "<pesan-yang-jelas>"
git push
~~~

Commit dan push adalah keputusan developer. Jangan meng-commit perubahan milik orang lain atau perubahan tidak terkait.

Lihat [AI Development](ai-development.md) untuk workflow agen dan [Testing](testing.md) untuk bukti validasi.
