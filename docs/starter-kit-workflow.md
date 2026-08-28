# Starter Kit Workflow

## Memulai proyek baru

1. Clone atau salin starter kit.
2. Ganti nama folder serta metadata proyek sesuai kebutuhan.
3. Buat dan konfigurasi <code>.env</code>, key aplikasi, URL, dan koneksi database.
4. Perbarui <code>APP_NAME</code> serta branding/logo.
5. Jalankan migrasi dan setup development.
6. Tinjau data navigasi default di <code>x-app.shell</code>.
7. Tinjau feature Fortify dan kebutuhan keamanan sebelum mengubah flow auth.
8. Pertahankan semantic token Amber sebagai fondasi visual.
9. Reuse primitive <code>x-ui.*</code>.
10. Susun kebutuhan reusable aplikasi dengan <code>x-app.*</code> atau block.
11. Buat Blade atau Livewire page khusus domain.
12. Letakkan business logic, database, authorization, dan validasi di lapisan Laravel/Livewire.
13. Tambah Feature test dan Browser test untuk flow penting.
14. Gunakan UI Playground untuk validasi visual serta interaction.
15. Jalankan build, audit, dan diff check.
16. Commit hanya perubahan yang terkait dan telah diverifikasi.

## Yang lazim dikustomisasi

- Nama aplikasi, branding, dan logo.
- Navigasi serta data workspace demo.
- Halaman domain, block khusus, Livewire state, database, policy, dan authorization.
- Domain form dan komponen aplikasi spesifik.
- Integrasi data nyata untuk Dashboard-01 atau table/pagination.

## Yang tidak diubah sembarangan

- Nama token semantic, API primitive, dan semantik aksesibilitas.
- Runtime tema Light/Dark dan key <code>localStorage.theme</code>.
- Arsitektur shell serta kontrak satu sumber data nav/workspace.
- Kontrak Fortify, limiter, CSRF, session, two-factor, dan passkey.
- Primitive UI generik sebagai tempat business logic.

Modifikasi dapat dibenarkan bila kebutuhan produk, keamanan, atau aksesibilitas menuntutnya, tetapi harus dijaga kompatibilitasnya, diuji, dan didokumentasikan.

## Workflow komponen baru

1. Cari component atau block yang telah ada.
2. Gunakan referensi shadcn hanya bila berguna untuk konsep/visual.
3. Periksa dokumentasi resmi framework untuk API yang dipakai.
4. Tentukan API Blade yang kecil dan konsisten.
5. Implementasikan Blade-native dengan Tailwind dan token semantik.
6. Pertahankan semantik HTML, ARIA, fokus, serta keyboard.
7. Tambahkan contoh produksi di UI Playground.
8. Tambahkan/ubah Feature test.
9. Tambahkan Browser test bila terdapat interaksi JavaScript penting.
10. Perbarui dokumentasi.

## Perbedaan infrastruktur dan kode aplikasi

| Starter kit | Aplikasi baru |
| --- | --- |
| Token, primitive, shell, layout auth, Playground, test setup, Fortify integration | Domain model, database, route baru, policy, query, data real, proses bisnis, serta form spesifik |

Jaga pemisahan ini agar starter kit tetap dapat di-upgrade dan komponen reusable tidak terikat pada domain pertama yang menggunakannya.
