# Troubleshooting

## Vite manifest atau asset tidak ditemukan

Jalankan build:

~~~powershell
npm run build
~~~

Saat mengembangkan, jalankan <code>npm run dev</code> atau <code>composer run dev</code>. Periksa bahwa entry yang digunakan adalah <code>resources/css/app.css</code> dan <code>resources/js/app.js</code>.

## Font gagal pada build

Font Inter, Source Serif 4, dan JetBrains Mono diambil melalui plugin Bunny pada Vite. Pastikan koneksi ke provider font tersedia saat menjalankan <code>npm run build</code>, lalu ulangi build.

## Browser test gagal memulai

Periksa extension socket PHP dan browser Chromium:

~~~powershell
php -m
npx playwright install chromium
vendor/bin/pest tests/Browser --compact
~~~

Jika runner Windows sebelumnya dihentikan paksa, pastikan proses test telah berhenti sebelum menghapus cache <code>vendor/pestphp/pest-plugin-browser/.temp/playwright-server.json</code>, lalu jalankan ulang.

## Tema tidak berubah atau kembali ke Light

Runtime hanya menghormati <code>localStorage.theme</code> bernilai <code>light</code> atau <code>dark</code>. Nilai kosong atau invalid memilih Light. Periksa class <code>dark</code> pada elemen <code>html</code>, bukan pada container halaman. Jangan gunakan System preference, cookie, atau state komponen kedua.

## Tema hilang setelah Livewire navigation

Link aplikasi seharusnya memakai <code>wire:navigate</code> ketika sesuai. Theme controller mendaftarkan listener <code>livewire:navigating</code>; periksa JavaScript error di browser dan jangan mendaftarkan controller kedua.

## Alpine error pada komponen interaksi

Pastikan struktur subcomponent lengkap dan ID unik. Jangan membungkus state Alpine internal dengan store global atau memindahkan atribut caller ke child internal. Untuk selector loop keyboard, pola proyek menggunakan <code>Array.from(...)</code>.

## Authentication test atau route bermasalah

Periksa feature Fortify di <code>config/fortify.php</code>, mapping view di <code>FortifyServiceProvider</code>, middleware route, serta database test in-memory dari <code>phpunit.xml</code>. Jangan mengganti route/action Fortify untuk memperbaiki presentasi.

## Passkey tidak dapat dipakai

Passkey memerlukan browser yang mendukung WebAuthn, secure context/origin yang cocok dengan konfigurasi, serta authenticator/credential yang tersedia. Browser test hanya menguji runtime dan UI, bukan ceremony credential nyata.

Jika masalah tetap ada, kumpulkan perintah yang dijalankan, output error ringkas, versi PHP/Node, dan browser sebelum mengubah source.
