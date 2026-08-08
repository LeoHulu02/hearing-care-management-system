# UI Design Skills & Reference Guide
**Hearing Care Order Management System**

> Dokumen ini adalah panduan desain UI resmi untuk project ini. Setiap halaman, komponen, dan interaksi baru wajib mengacu pada panduan berikut agar tampilan tetap konsisten.

---

## Daftar Isi

1. [Tech Stack & Tools](#1-tech-stack--tools)
2. [Design Principles](#2-design-principles)
3. [Color System](#3-color-system)
4. [Typography](#4-typography)
5. [Spacing System](#5-spacing-system)
6. [Component Library](#6-component-library)
7. [Layout & Page Structure](#7-layout--page-structure)
8. [Interactive States](#8-interactive-states)
9. [Form Patterns](#9-form-patterns)
10. [Table Patterns](#10-table-patterns)
11. [Status & Feedback](#11-status--feedback)
12. [Responsive Design](#12-responsive-design)
13. [Do's & Don'ts](#13-dos--donts)

---

## 1. Tech Stack & Tools

| Layer | Tool / Library | Versi |
|---|---|---|
| Backend framework | Laravel | 11.x |
| Templating | Blade (`.blade.php`) | bawaan Laravel |
| CSS framework | Tailwind CSS | v4.x |
| Admin panel | Filament | v3.x |
| Build tool | Vite | v6.x |
| Font | Instrument Sans | Google Fonts |
| Icons (admin) | Heroicons | via Filament |

**Catatan Tailwind v4:** Project ini menggunakan Tailwind v4 dengan direktif `@theme` di `resources/css/app.css`, **bukan** `tailwind.config.js`. Custom token didefinisikan di sana dan bisa langsung dipakai sebagai class seperti `bg-hc-primary`, `text-hc-muted`, dll.

---

## 2. Design Principles

### Prinsip Utama

**1. Clarity over decoration**
UI harus membantu pengguna menyelesaikan task secepat mungkin. Dekorasi visual boleh ada, tapi tidak boleh mengorbankan readability atau fungsi.

**2. Consistent token usage**
Selalu gunakan token warna dan kelas utilitas yang sudah didefinisikan (`hc-primary`, `hc-muted`, dll). Jangan hardcode warna di luar sistem token.

**3. Mobile-first**
Desain dimulai dari mobile, kemudian di-extend ke desktop dengan breakpoint `sm:`, `lg:`, `xl:`.

**4. Accessible by default**
- Kontras teks minimum WCAG AA (4.5:1 untuk teks biasa)
- Semua elemen interaktif dapat dijangkau via keyboard
- Label eksplisit di semua form input
- Focus ring wajib terlihat

**5. Subtle motion**
Transisi dipakai untuk memberikan feedback, bukan untuk entertainment. Gunakan `transition-all duration-300` untuk hover, `duration-500` untuk transform gambar.

---

## 3. Color System

Token warna didefinisikan di `resources/css/app.css` dalam blok `@theme`.

### Warna Utama

| Token CSS | Kelas Tailwind | Nilai Hex | Digunakan untuk |
|---|---|---|---|
| `--color-hc-primary` | `hc-primary` | `#0d9488` | CTA button, link aktif, harga, aksen utama |
| `--color-hc-sidebar` | `hc-sidebar` | `#0f172a` | Sidebar admin, elemen dark |
| `--color-hc-bg` | `hc-bg` | `#f8fafc` | Background halaman (`<body>`) |
| `--color-hc-card` | `hc-card` | `#ffffff` | Background card, panel, modal |
| `--color-hc-border` | `hc-border` | `#e2e8f0` | Border card, divider, input |
| `--color-hc-text` | `hc-text` | `#0f172a` | Teks utama (heading, body) |
| `--color-hc-muted` | `hc-muted` | `#64748b` | Teks sekunder, placeholder, label |

### Warna Status

| Token CSS | Kelas Tailwind | Nilai Hex | Status |
|---|---|---|---|
| `--color-status-pending` | `status-pending` | `#f59e0b` | Pending (amber) |
| `--color-status-processing` | `status-processing` | `#2563eb` | Processing (blue) |
| `--color-status-completed` | `status-completed` | `#16a34a` | Completed (green) |
| `--color-status-cancelled` | `status-cancelled` | `#dc2626` | Cancelled (red) |

### Penggunaan Warna Status di Badge

```blade
{{-- Selalu gunakan komponen x-status-badge --}}
<x-status-badge :status="$order->status" />
<x-status-badge status="in_stock" />
<x-status-badge status="out_of_stock" />
```

Badge secara otomatis menangani mapping warna berdasarkan status string. Jangan buat badge status manual dengan kelas Tailwind inline.

### Skala Warna Tambahan

Untuk variasi ringan yang tidak memerlukan token baru, gunakan warna bawaan Tailwind:

```
slate-50 / slate-100 / slate-200   → surface, border ringan
slate-500 / slate-700 / slate-900  → teks sekunder hingga utama
teal-600 / teal-700                → hover dari hc-primary
amber-100 / amber-700              → badge pending
blue-100 / blue-700                → badge processing
emerald-100 / emerald-700          → badge completed, in_stock
rose-100 / rose-700                → badge cancelled, out_of_stock
```

---

## 4. Typography

### Font Family

**Instrument Sans** — diset di `--font-sans` dalam `@theme`. Font ini aktif secara otomatis di seluruh halaman melalui `font-sans`.

```css
--font-sans: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
```

### Hierarki Teks

| Elemen | Kelas Tailwind | Digunakan untuk |
|---|---|---|
| Page title | `.hc-page-title` | Heading utama tiap halaman (H1) |
| Page subtitle | `.hc-page-subtitle` | Deskripsi singkat di bawah page title |
| Card heading | `text-lg font-semibold text-hc-text tracking-tight` | Judul dalam card (H2/H3) |
| Body text | `text-sm text-slate-700` | Konten body, deskripsi produk |
| Muted text | `text-sm text-hc-muted` | Label, metadata, teks sekunder |
| Label kecil | `text-xs font-semibold uppercase tracking-wide text-slate-500` | Header tabel, label field |
| Harga | `text-lg font-bold text-hc-primary` | Tampilan harga produk |

### Implementasi Page Title

Selalu gunakan class utilitas yang sudah ada:

```blade
{{-- Benar --}}
<h1 class="hc-page-title">Hearing Aid Products</h1>
<p class="hc-page-subtitle">Browse available products and review details before placing an order.</p>

{{-- Salah — jangan tulis ulang style secara manual --}}
<h1 class="text-3xl font-bold tracking-tight text-slate-800">Hearing Aid Products</h1>
```

---

## 5. Spacing System

Project menggunakan **8pt spacing grid**. Semua spacing mengacu pada kelipatan 4 atau 8 pixel.

| Ukuran | Tailwind class | Pixel |
|---|---|---|
| XS | `gap-1`, `p-1`, `m-1` | 4px |
| SM | `gap-2`, `p-2`, `m-2` | 8px |
| MD | `gap-3`, `p-3` / `gap-4`, `p-4` | 12–16px |
| LG | `gap-5`, `p-5` / `gap-6`, `p-6` | 20–24px |
| XL | `gap-8`, `p-8` / `gap-10`, `p-10` | 32–40px |

### Padding Internal Card

```blade
{{-- Card content spacing --}}
<article class="hc-card p-5 sm:p-6">
```

### Page Padding & Max Width

```blade
{{-- Sudah diatur di layout utama, jangan override --}}
<main class="mx-auto max-w-6xl px-4 py-10 sm:py-12">
```

---

## 6. Component Library

### 6.1 Card — `.hc-card`

Definisi:
```css
.hc-card {
    @apply rounded-2xl border border-hc-border/60 bg-hc-card shadow-sm;
}
```

Penggunaan dasar:
```blade
<div class="hc-card p-5 sm:p-6">
    {{-- konten card --}}
</div>
```

Variasi — Card dengan hover lift (untuk product card):
```blade
<article class="hc-card p-5 sm:p-6 flex flex-col transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
```

Variasi — Card yang membungkus tabel:
```blade
<div class="overflow-hidden hc-card">
    <table class="min-w-full">...</table>
</div>
```

Variasi — Card empty state (dashed border):
```blade
<div class="col-span-full rounded-xl border border-dashed border-hc-border bg-white p-8 text-center text-hc-muted">
    No products are available yet.
</div>
```

---

### 6.2 Button — `.hc-button-primary`

Definisi:
```css
.hc-button-primary {
    @apply rounded-full bg-hc-primary px-5 py-2.5 font-medium text-white
           transition-all hover:bg-teal-700 hover:shadow-md
           focus:ring-2 focus:ring-teal-500 focus:ring-offset-2;
}
```

Penggunaan:
```blade
{{-- Button primary (CTA) --}}
<a href="{{ route('orders.create') }}" class="hc-button-primary text-sm">
    New Order
</a>

{{-- Button kecil inline --}}
<a href="{{ route('products.show', $product) }}"
   class="rounded-full bg-hc-primary px-4 py-2 text-sm font-medium text-white
          transition-all hover:bg-teal-700 hover:shadow-md
          focus:ring-2 focus:ring-teal-500 focus:ring-offset-2">
    View Detail
</a>

{{-- Button logout (dark) --}}
<button type="submit"
        class="rounded-full bg-slate-900 px-4 py-2 text-sm font-medium text-white
               transition hover:bg-slate-800">
    Logout
</button>
```

**Aturan button:**
- Selalu `rounded-full` (pill shape)
- Primary: `bg-hc-primary` dengan hover `bg-teal-700`
- Secondary/dark: `bg-slate-900` dengan hover `bg-slate-800`
- Ghost/link: hanya teks dengan `hover:text-hc-primary`
- Selalu sertakan focus ring untuk aksesibilitas

---

### 6.3 Status Badge — `<x-status-badge>`

Komponen Blade yang menangani semua status secara otomatis.

```blade
{{-- Order status --}}
<x-status-badge :status="$order->status" />
{{-- Output: Pending / Processing / Completed / Cancelled --}}

{{-- Stock status --}}
<x-status-badge :status="$product->stock > 0 ? 'in_stock' : 'out_of_stock'" />
{{-- Output: In Stock / Out of Stock --}}

{{-- Status custom --}}
<x-status-badge status="pending" />
```

Mapping warna yang sudah ada di komponen:

| Status string | Label tampil | Warna |
|---|---|---|
| `pending` | Pending | Amber |
| `processing` | Processing | Blue |
| `completed` | Completed | Emerald |
| `cancelled` | Cancelled | Rose |
| `in_stock` | In Stock | Emerald |
| `out_of_stock` | Out of Stock | Rose |

Untuk menambah status baru, edit `resources/views/components/status-badge.blade.php`.

---

### 6.4 Product Card — `<x-product-card>`

```blade
{{-- Di dalam loop --}}
@foreach ($products as $product)
    <x-product-card :product="$product" />
@endforeach
```

Struktur internal card (jangan duplikasi, modifikasi via komponen):
- Gambar dengan rasio `4:3`, hover scale `group-hover:scale-105`
- Nama produk + stock badge
- Deskripsi terpotong 100 karakter
- Harga dalam format `Rp` + tombol View Detail

---

### 6.5 Navigation Link (Header)

```blade
{{-- Link aktif / default --}}
<a href="{{ route('products.index') }}"
   class="text-hc-muted transition hover:text-hc-primary">
    Products
</a>
```

---

### 6.6 Alert / Flash Message

```blade
{{-- Flash success --}}
@if (session('status'))
    <div class="mb-6 rounded-md border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
        {{ session('status') }}
    </div>
@endif
```

Variasi alert berdasarkan tone:

```blade
{{-- Success --}}
<div class="rounded-md border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
    Order placed successfully.
</div>

{{-- Warning --}}
<div class="rounded-md border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-800">
    Stock is running low.
</div>

{{-- Error --}}
<div class="rounded-md border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-800">
    Something went wrong. Please try again.
</div>

{{-- Info --}}
<div class="rounded-md border border-blue-200 bg-blue-50 px-4 py-3 text-sm text-blue-800">
    Your order is being processed.
</div>
```

---

## 7. Layout & Page Structure

### 7.1 Struktur Halaman Standar

```blade
@extends('layouts.app')

@section('content')
    {{-- Page header --}}
    <div class="mb-6 flex items-end justify-between">
        <div>
            <h1 class="hc-page-title">Judul Halaman</h1>
            <p class="hc-page-subtitle">Deskripsi singkat halaman ini.</p>
        </div>
        {{-- Opsional: action button di kanan --}}
        <a href="#" class="hc-button-primary text-sm">Tambah Data</a>
    </div>

    {{-- Konten utama --}}
    <div class="hc-card">
        ...
    </div>
@endsection
```

### 7.2 Grid Product / Card

```blade
{{-- 1 kolom mobile, 2 kolom tablet, 3 kolom desktop --}}
<div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:gap-8">
    @foreach ($items as $item)
        <x-product-card :product="$item" />
    @endforeach
</div>
```

### 7.3 Layout Dua Kolom (Detail + Sidebar)

```blade
<div class="grid gap-8 lg:grid-cols-3">
    {{-- Konten utama (2/3) --}}
    <div class="lg:col-span-2">
        <div class="hc-card p-6">...</div>
    </div>

    {{-- Sidebar (1/3) --}}
    <div class="space-y-4">
        <div class="hc-card p-5">...</div>
        <div class="hc-card p-5">...</div>
    </div>
</div>
```

### 7.4 Max Width & Centering

Semua konten terikat pada max width yang sudah diset di layout:
```html
max-w-6xl  →  1152px (diset di <main> layout)
```

Jangan override max width di level halaman kecuali ada kebutuhan khusus.

---

## 8. Interactive States

### Hover

```blade
{{-- Card lift --}}
hover:-translate-y-1 hover:shadow-lg transition-all duration-300

{{-- Link/nav --}}
hover:text-hc-primary transition

{{-- Button --}}
hover:bg-teal-700 hover:shadow-md transition-all

{{-- Gambar zoom --}}
group-hover:scale-105 transition-transform duration-500
```

### Focus (Aksesibilitas)

```blade
{{-- Wajib ada di semua elemen interaktif --}}
focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 focus:outline-none
```

### Disabled

```blade
<button disabled class="hc-button-primary opacity-50 cursor-not-allowed">
    Submit
</button>
```

---

## 9. Form Patterns

### Input Standar

```blade
<div>
    <label for="name" class="block text-sm font-medium text-slate-700 mb-1.5">
        Nama Lengkap
    </label>
    <input
        type="text"
        id="name"
        name="name"
        value="{{ old('name') }}"
        class="w-full rounded-xl border border-hc-border bg-white px-4 py-2.5 text-sm
               text-hc-text placeholder:text-hc-muted
               focus:border-hc-primary focus:ring-2 focus:ring-teal-500/20 focus:outline-none
               transition"
        placeholder="Masukkan nama lengkap"
    >
    @error('name')
        <p class="mt-1.5 text-xs text-rose-600">{{ $message }}</p>
    @enderror
</div>
```

### Select

```blade
<div>
    <label for="status" class="block text-sm font-medium text-slate-700 mb-1.5">
        Status
    </label>
    <select
        id="status"
        name="status"
        class="w-full rounded-xl border border-hc-border bg-white px-4 py-2.5 text-sm
               text-hc-text focus:border-hc-primary focus:ring-2 focus:ring-teal-500/20
               focus:outline-none transition"
    >
        <option value="">Pilih status...</option>
        <option value="pending">Pending</option>
        <option value="processing">Processing</option>
    </select>
</div>
```

### Textarea

```blade
<div>
    <label for="notes" class="block text-sm font-medium text-slate-700 mb-1.5">
        Catatan
    </label>
    <textarea
        id="notes"
        name="notes"
        rows="4"
        class="w-full rounded-xl border border-hc-border bg-white px-4 py-2.5 text-sm
               text-hc-text placeholder:text-hc-muted resize-none
               focus:border-hc-primary focus:ring-2 focus:ring-teal-500/20 focus:outline-none
               transition"
        placeholder="Tulis catatan..."
    ></textarea>
</div>
```

### Form Submit

```blade
<div class="flex items-center gap-3 pt-4 border-t border-hc-border">
    <button type="submit" class="hc-button-primary text-sm">
        Simpan Perubahan
    </button>
    <a href="{{ url()->previous() }}"
       class="rounded-full border border-hc-border px-5 py-2.5 text-sm font-medium
              text-hc-muted transition hover:border-slate-300 hover:text-hc-text">
        Batal
    </a>
</div>
```

### Error Validasi Global

```blade
@if ($errors->any())
    <div class="mb-6 rounded-xl border border-rose-200 bg-rose-50 px-5 py-4">
        <p class="text-sm font-medium text-rose-800 mb-1">Ada beberapa kesalahan:</p>
        <ul class="list-disc list-inside space-y-0.5">
            @foreach ($errors->all() as $error)
                <li class="text-sm text-rose-700">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
```

---

## 10. Table Patterns

### Tabel Standar

```blade
<div class="overflow-hidden hc-card">
    <table class="min-w-full divide-y divide-slate-200">
        <thead class="bg-slate-50">
            <tr>
                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                    Kolom A
                </th>
                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                    Kolom B
                </th>
                <th class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wide text-slate-500">
                    Aksi
                </th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-200">
            @forelse ($items as $item)
                <tr class="hover:bg-slate-50 transition">
                    <td class="px-4 py-3 text-sm font-medium text-slate-900">
                        {{ $item->name }}
                    </td>
                    <td class="px-4 py-3 text-sm text-slate-700">
                        {{ $item->value }}
                    </td>
                    <td class="px-4 py-3 text-right">
                        <a href="#" class="text-sm font-medium text-hc-primary hover:brightness-90">
                            Detail
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="px-4 py-8 text-center text-sm text-slate-500">
                        Tidak ada data.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
```

### Pagination

```blade
{{-- Selalu tempatkan di bawah tabel dengan margin atas --}}
<div class="mt-6">
    {{ $items->links() }}
</div>
```

---

## 11. Status & Feedback

### Pola Status Pesanan

Urutan status: `pending` → `processing` → `completed` (atau `cancelled`)

Warna progres:
```
pending    → amber   (menunggu konfirmasi)
processing → blue    (sedang diproses)
completed  → emerald (selesai)
cancelled  → rose    (dibatalkan)
```

### Loading State (Skeleton)

Untuk state loading pada AJAX/Livewire:
```blade
<div class="animate-pulse space-y-4">
    <div class="h-4 w-3/4 rounded bg-slate-200"></div>
    <div class="h-4 w-1/2 rounded bg-slate-200"></div>
    <div class="h-32 w-full rounded-xl bg-slate-200"></div>
</div>
```

### Empty State

```blade
<div class="rounded-xl border border-dashed border-hc-border bg-white p-12 text-center">
    <div class="mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-full bg-slate-100">
        {{-- Icon heroicon atau SVG --}}
    </div>
    <h3 class="text-sm font-semibold text-slate-700">Belum ada data</h3>
    <p class="mt-1 text-sm text-hc-muted">Tambahkan data pertama untuk memulai.</p>
    <div class="mt-4">
        <a href="#" class="hc-button-primary text-sm">Tambah Sekarang</a>
    </div>
</div>
```

---

## 12. Responsive Design

### Breakpoint yang Digunakan

| Prefix | Min-width | Keterangan |
|---|---|---|
| *(default)* | 0px | Mobile |
| `sm:` | 640px | Tablet kecil |
| `lg:` | 1024px | Desktop |
| `xl:` | 1280px | Desktop lebar |

### Pola Grid Responsif

```blade
{{-- Card grid --}}
<div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:gap-8">

{{-- Dua kolom di desktop --}}
<div class="grid gap-8 lg:grid-cols-2">

{{-- Tiga kolom, sidebar 1/3 di desktop --}}
<div class="grid gap-8 lg:grid-cols-3">
    <div class="lg:col-span-2">...</div>  {{-- main --}}
    <div>...</div>                          {{-- sidebar --}}
</div>
```

### Header Halaman Responsif

```blade
{{-- Stack di mobile, side-by-side di desktop --}}
<div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
    <div>
        <h1 class="hc-page-title">Judul</h1>
        <p class="hc-page-subtitle">Subtitle.</p>
    </div>
    <a href="#" class="hc-button-primary w-fit text-sm">Aksi</a>
</div>
```

---

## 13. Do's & Don'ts

### Warna

| Do | Don't |
|---|---|
| `text-hc-primary` | `text-[#0d9488]` (hardcode hex) |
| `bg-hc-border` | `bg-gray-200` untuk border utama |
| `<x-status-badge>` | Inline badge dengan class manual per status |

### Komponen

| Do | Don't |
|---|---|
| `<x-product-card :product="$p">` | Duplikasi markup card di halaman |
| `class="hc-card p-5"` | `class="rounded-2xl border border-slate-200 bg-white shadow-sm p-5"` |
| `class="hc-button-primary"` | `class="bg-teal-600 rounded-full px-5 py-2.5 text-white"` |

### Tipografi

| Do | Don't |
|---|---|
| `<h1 class="hc-page-title">` | `<h1 class="text-3xl font-bold text-slate-800">` |
| `<p class="hc-page-subtitle">` | `<p class="text-base text-slate-500 mt-2">` |

### Layout

| Do | Don't |
|---|---|
| Gunakan grid sistem 8pt (`gap-4`, `gap-6`, `gap-8`) | Spacing arbitrer (`gap-7`, `p-11`) |
| `max-w-6xl` dari layout utama | Override max width per halaman |
| Mobile-first: base → `sm:` → `lg:` | Desktop-first lalu override mobile |

### Aksesibilitas

| Do | Don't |
|---|---|
| `<label for="input-id">` pada setiap input | Input tanpa label |
| `focus:ring-2 focus:ring-teal-500` pada semua elemen interaktif | Menghilangkan focus ring |
| Kontras teks cukup (minimum 4.5:1) | Teks `text-slate-300` di atas `bg-white` |
| `alt` attribute di semua gambar | `<img>` tanpa `alt` |

---

## Catatan Tambahan

### Menambah Token Warna Baru

Tambahkan di `resources/css/app.css` dalam blok `@theme`:
```css
@theme {
    --color-hc-accent: #7c3aed; /* contoh: warna aksen baru */
}
```

Langsung bisa dipakai: `bg-hc-accent`, `text-hc-accent`, `border-hc-accent`.

### Menambah Utility Class Baru

Tambahkan di `resources/css/app.css` dalam blok `@layer components`:
```css
@layer components {
    .hc-badge {
        @apply rounded-full px-2.5 py-1 text-xs font-medium;
    }
}
```

### Komponen Blade Baru

Buat di `resources/views/components/nama-komponen.blade.php`, panggil dengan:
```blade
<x-nama-komponen :prop="$value" />
```

---

*Dokumen ini diperbarui sesuai perkembangan project. Setiap penambahan komponen atau pola baru wajib didokumentasikan di sini.*
