# Architecture

## Gambaran

~~~text
Laravel
├── Routes
├── Fortify
├── Livewire
├── Blade
└── UI Layer
    ├── Design Tokens
    ├── UI Components
    ├── App Components
    ├── Auth Components
    ├── Blocks
    └── Pages
~~~

Laravel menangani route, middleware, model, action, validasi, session, dan kontrak keamanan. Fortify mendaftarkan serta menjalankan kontrak autentikasi. Livewire memegang state dan aksi server untuk halaman interaktif. Blade menyusun markup dan komponen. Alpine memegang state interaksi yang lokal dan sementara.

## Lapisan UI

| Lokasi | Tanggung jawab |
| --- | --- |
| <code>resources/css/theme.css</code> | Nilai token Light/Dark dan alias Tailwind melalui <code>@theme inline</code>. |
| <code>resources/css/app.css</code> | Entry Tailwind, source scan, varian Dark, serta fallback <code>x-cloak</code>. |
| <code>resources/views/components/ui/</code> | Primitive generik tanpa query database, business logic, atau asumsi navigasi aplikasi. |
| <code>resources/views/components/app/</code> | Shell dan komposisi reusable khusus aplikasi: sidebar, header, navigasi, tema, toast. |
| <code>resources/views/components/auth/</code> | Presentasi kontrol autentikasi khusus, saat ini password field. |
| <code>resources/views/blocks/</code> | Komposisi reusable skala halaman. |
| <code>resources/views/pages/</code> | Halaman Fortify dan halaman Livewire settings. |
| <code>resources/views/ui/playground/</code> | Demo komponen produksi pada UI Playground. |

## Route dan komposisi halaman

Route web dashboard dan Playground berada di <code>routes/web.php</code>. Semua route <code>/ui</code> memakai middleware <code>auth</code> dan <code>verified</code>. Route settings ada pada <code>routes/settings.php</code>; Profile memakai <code>auth</code>, sedangkan Appearance dan Security juga mensyaratkan <code>verified</code>, dan Security memakai <code>password.confirm</code>.

Komposisi yang direkomendasikan:

~~~text
Route
  ↓
Blade page atau Livewire page
  ↓
x-layouts::app atau x-layouts::auth
  ↓
App component dan Block
  ↓
UI components
~~~

Jangan memindahkan query, autentikasi, atau aturan domain ke primitive UI. Lihat [Layouts & Pages](layouts-and-pages.md), [Livewire & Alpine](livewire-and-alpine.md), dan [Authentication](authentication.md).

## Batas teknologi

Runtime frontend proyek adalah Laravel, Livewire, Blade, Alpine.js, dan Tailwind CSS 4. Bahasa desain boleh mengacu pada shadcn, tetapi API <code>x-ui.*</code> aktual adalah otoritas. Repository ini tidak menjalankan React, Vue, atau Inertia.

Tidak ada dependency runtime Flux. Toast, Settings Security, pengelolaan passkey, recovery code, dan overlay merupakan surface Blade/Livewire/Alpine milik proyek.

## Asset dan font

Vite memproses <code>resources/css/app.css</code>, <code>resources/js/app.js</code>, dan <code>resources/js/passkeys.js</code>. Plugin font Vite mengirim Inter, Source Serif 4, dan JetBrains Mono melalui Bunny dengan <code>optimizedFallbacks: false</code>. Lihat [Theming](theming.md).
