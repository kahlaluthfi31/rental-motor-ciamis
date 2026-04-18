<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RMC - Rental Motor Ciamis</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- cdn flowbite -->
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <!-- end cdn flowbite -->
    <!-- untuk font poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --rmc-primary: #6748FB;
            --rmc-primary-dark: #5034d9;
            --rmc-primary-soft: #ede9ff;
            --rmc-primary-soft-border: rgba(103, 72, 251, 0.18);
        }

        body {
            font-family: 'Poppins', sans-serif;
        }

        .hero-bg {
            background-image: radial-gradient(circle at 10% 20%, rgba(103, 72, 251, 0.16), transparent 30%),
                radial-gradient(circle at 90% 10%, rgba(103, 72, 251, 0.1), transparent 35%);
        }

        .hero-wrap {
            background: linear-gradient(180deg, #f8fbff 0%, #f4f8fb 100%);
        }

        .hero-bubble {
            background: radial-gradient(circle at center, rgba(103, 72, 251, 0.22) 0%, rgba(103, 72, 251, 0.08) 45%, transparent 70%);
        }

        .btn-primary-rmc {
            background: linear-gradient(135deg, var(--rmc-primary) 0%, #7e63ff 100%);
        }

        .search-card {
            box-shadow: 0 6px 18px rgba(15, 23, 42, 0.06);
        }

        .rmc-text {
            color: var(--rmc-primary);
        }

        .rmc-text-soft {
            color: rgba(103, 72, 251, 0.62);
        }

        .rmc-border-soft {
            border-color: var(--rmc-primary-soft-border);
        }

        .rmc-badge {
            background-color: var(--rmc-primary-soft);
            color: var(--rmc-primary-dark);
        }

        .rmc-link {
            transition: color 0.2s ease;
        }

        .rmc-link:hover {
            color: var(--rmc-primary);
        }

        .rmc-outline-btn {
            color: var(--rmc-primary);
            border: 1px solid var(--rmc-primary-soft-border);
            transition: all 0.2s ease;
        }

        .rmc-outline-btn:hover {
            background-color: var(--rmc-primary-soft);
        }

        .rmc-input:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(103, 72, 251, 0.2);
            border-color: rgba(103, 72, 251, 0.35);
        }

        .how-section-wrap {
            background: linear-gradient(180deg, rgba(103, 72, 251, 0.05) 0%, rgba(255, 255, 255, 0.9) 100%);
            /* border: 1px solid rgba(103, 72, 251, 0.11); */
            /* box-shadow: 0 6px 16px rgba(37, 28, 110, 0.05); */
        }

        .how-step-number {
            color: rgba(103, 72, 251, 0.62);
            text-shadow: 0 8px 22px rgba(103, 72, 251, 0.15);
        }

        .how-wireframe-wrap {
            background: #f3f4f6;
        }

        .how-wireframe-card {
            background: #fff;
            border: 1px solid rgba(103, 72, 251, 0.14);
        }

        .how-icon-box {
            width: 56px;
            height: 56px;
            border-radius: 0.9rem;
            background: #f5f3ff;
            border: 1px solid rgba(103, 72, 251, 0.16);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--rmc-primary);
        }

        .faq-item {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 0.75rem;
            padding: 1rem 1.25rem;
        }

        .faq-trigger {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            text-align: left;
            font-weight: 600;
            color: #1e293b;
        }

        .faq-icon {
            font-size: 1.2rem;
            line-height: 1;
            color: #64748b;
            transition: transform 0.25s ease, color 0.25s ease;
            flex-shrink: 0;
        }

        .faq-content {
            max-height: 0;
            overflow: hidden;
            opacity: 0;
            transition: max-height 0.35s ease, opacity 0.25s ease;
        }

        .faq-item.active .faq-content {
            opacity: 1;
        }

        .faq-item.active .faq-icon {
            transform: rotate(45deg);
            color: var(--rmc-primary);
        }

        .why-pill {
            background: var(--rmc-primary);
            color: #ffffff;
            border-radius: 9999px;
            padding: 0.7rem 1rem;
            min-height: 56px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            font-size: 0.84rem;
            font-weight: 600;
            line-height: 1.2;
            box-shadow: 0 8px 20px rgba(103, 72, 251, 0.1);
        }

        .why-pill-right {
            width: min(100%, 300px);
            margin-left: auto;
        }

        .why-pill-shift-1 {
            margin-right: 8rem;
        }

        .why-pill-shift-2 {
            margin-right: 4.5rem;
        }

        .why-pill-shift-3 {
            margin-right: 0;
        }

        .why-pill-shift-4 {
            margin-right: 4.5rem;
        }

        .why-pill-shift-5 {
            margin-right: 8rem;
        }

        .why-motor-stage {
            width: 100%;
            max-width: 470px;
            height: 220px;
            object-fit: contain;
        }

        @media (min-width: 768px) {
            .why-motor-stage {
                height: 300px;
            }
        }

        @media (min-width: 1024px) {
            .why-motor-stage {
                height: 330px;
            }
        }

        @media (max-width: 1023px) {

            .why-pill-shift-1,
            .why-pill-shift-2,
            .why-pill-shift-3,
            .why-pill-shift-4,
            .why-pill-shift-5 {
                margin-right: 0;
            }
        }

        .testi-track {
            scroll-behavior: smooth;
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .testi-track::-webkit-scrollbar {
            display: none;
        }

        .testi-card {
            scroll-snap-align: start;
            flex: 0 0 100%;
        }

        @media (min-width: 768px) {
            .testi-card {
                flex: 0 0 calc(50% - 0.5rem);
            }
        }
    </style>
</head>

<body class="bg-gray-100 text-gray-800">
    <header class="hero-wrap hero-bg border-b rmc-border-soft relative overflow-visible z-10">
        <nav class="fixed top-0 left-0 right-0 z-50 border-b border-slate-200/70 bg-white/85 backdrop-blur">
            <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full" style="background-color:#6748FB"></span>
                    <span class="w-3 h-3 rounded-full -ml-1" style="background-color:#8E79FF"></span>
                    <span class="text-2xl font-extrabold text-slate-700 ml-1">RMC</span>
                </div>
                <ul class="hidden md:flex items-center gap-6 text-sm text-slate-600 font-medium">
                    <li><a href="<?php echo e(url('/')); ?>" class="rmc-link">Home</a></li>
                    <li><a href="<?php echo e(url('/')); ?>#motor-results" class="rmc-link">Motor</a></li>
                    <li><a href="<?php echo e(url('/')); ?>#cara-rental" class="rmc-link">Cara Rental</a></li>
                    <li><a href="<?php echo e(url('/')); ?>#keunggulan" class="rmc-link">Keunggulan</a></li>
                    <li><a href="<?php echo e(url('/')); ?>#testimoni" class="rmc-link">Testimoni</a></li>
                    <li><a href="<?php echo e(url('/')); ?>#faq" class="rmc-link">FAQ</a></li>
                    <li><a href="<?php echo e(url('/')); ?>#lokasi" class="rmc-link">Lokasi</a></li>
                    <li><a href="/login" class="rmc-link">Login</a></li>
                </ul>
            </div>
        </nav>

        <div class="max-w-6xl mx-auto px-6 pt-20 pb-6 md:pt-24 md:pb-8">

            <div class="grid md:grid-cols-2 gap-10 items-center pt-10 md:pt-16 pb-14 md:pb-24">
                <div>
                    <span
                        class="inline-flex items-center px-4 py-2 rounded-full rmc-badge text-xs md:text-sm font-semibold">
                        Rental Motor Ciamis
                    </span>
                    <h1 class="mt-6 text-4xl md:text-6xl font-extrabold tracking-tight text-slate-800 leading-tight">
                        Make Your Ride
                        <span class="rmc-text">Easy & Affordable</span>
                    </h1>
                    <p class="mt-5 text-base md:text-lg text-slate-600 max-w-xl leading-relaxed">
                        Pengen jalan-jalan di Ciamis, kota terbersih se-ASEAN, tapi gak punya kendaraan? RMC jadi solusi
                        rental motor praktis, nyaman, dan siap berangkat kapan saja.
                    </p>
                    <div class="mt-8 flex flex-wrap items-center gap-4">
                        <a href="/login"
                            class="btn-primary-rmc inline-flex items-center px-6 py-3 text-white text-sm md:text-base font-semibold rounded-full shadow-sm hover:opacity-95 transition">
                            Pesan Sekarang
                        </a>
                        <a href="#motor"
                            class="rmc-outline-btn inline-flex items-center px-6 py-3 bg-white text-sm md:text-base font-semibold rounded-full transition">
                            Lihat Motor
                        </a>
                    </div>
                </div>

                <div class="relative">
                    <div class="hero-bubble absolute -z-0 inset-0 rounded-full scale-125"></div>
                    <img src="/app/foto/Motor-Fazzio-Kuning.png" alt="Motor rental RMC"
                        class="relative z-10 w-full max-w-xl mx-auto h-[320px] md:h-[460px] object-contain drop-shadow-md">
                </div>
            </div>
        </div>

        <div id="motor-results"
            class="max-w-6xl mx-auto px-6 pb-12 md:pb-0 md:absolute md:left-1/2 md:-translate-x-1/2 md:bottom-[-42px] w-full z-30">
            <div class="search-card bg-white rounded-2xl border border-slate-100 p-3 md:p-4 relative z-30">
                <form action="<?php echo e(url('/')); ?>#motor-results" method="GET"
                    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-2" id="hero-search-form">
                    <div class="rounded-xl bg-slate-50 px-3 py-2 lg:col-span-7">
                        <label for="brand" class="text-xs text-slate-500 block">Nama Motor</label>
                        <input id="brand" name="brand" type="text" value="<?php echo e($brand ?? ''); ?>"
                            placeholder="Contoh: NMAX, Beat, Vario"
                            class="mt-1 w-full bg-transparent text-sm font-semibold text-slate-700 placeholder:text-slate-400 focus:outline-none" />
                    </div>
                    <div class="rounded-xl bg-slate-50 px-3 py-2 lg:col-span-5">
                        <label for="type_cc" class="text-xs text-slate-500 block">Tipe Motor (CC)</label>
                        <select id="type_cc" name="type_cc"
                            class="mt-1 w-full bg-transparent text-sm font-semibold text-slate-700 focus:outline-none">
                            <option value="" <?php echo e(empty($typeCc) ? 'selected' : ''); ?>>Semua Tipe</option>
                            <option value="100" <?php echo e(($typeCc ?? '') === '100' ? 'selected' : ''); ?>>100cc</option>
                            <option value="125" <?php echo e(($typeCc ?? '') === '125' ? 'selected' : ''); ?>>125cc</option>
                            <option value="150" <?php echo e(($typeCc ?? '') === '150' ? 'selected' : ''); ?>>150cc</option>
                        </select>
                    </div>
                </form>
            </div>
        </div>
    </header>

    <main>
        <section class="max-w-6xl mx-auto px-6 pt-16 md:pt-24 pb-8">
            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-2 mb-5">
                <div>
                    <p class="text-sm font-semibold rmc-text tracking-wide uppercase">
                        <?php echo e(!empty($isSearching) ? 'Hasil Pencarian Motor' : 'Motor Terlaris'); ?>

                    </p>
                    
                </div>
            </div>

            <?php if(isset($motors) && $motors->count() > 0): ?>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                    <?php $__currentLoopData = $motors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $motor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $rawPhoto = $motor->getRawOriginal('photo_url') ?? '';
                            $photoUrl = \Illuminate\Support\Str::startsWith($rawPhoto, ['http://', 'https://'])
                                ? $rawPhoto
                                : asset($rawPhoto);
                            $harian = optional($motor->rentalRates)->harian;
                        ?>
                        <article class="bg-white rounded-2xl border border-slate-100 overflow-hidden">
                            <img src="<?php echo e($photoUrl); ?>" alt="<?php echo e($motor->brand); ?>" class="w-full h-44 object-cover">
                            <div class="p-4">
                                <h4 class="text-base font-bold text-slate-800"><?php echo e($motor->brand); ?></h4>
                                <p class="text-sm text-slate-500 mt-1">Tipe : <?php echo e($motor->type_cc); ?>cc</p>
                                <p class="text-xs text-slate-500 mt-1">
                                    Disewa <?php echo e($motor->completed_bookings_count ?? 0); ?> kali
                                </p>
                                <p class="mt-3 text-sm font-semibold text-slate-700">
                                    <?php echo e($harian ? 'Mulai Rp ' . number_format($harian, 0, ',', '.') . '/hari' : 'Harga belum tersedia'); ?>

                                </p>
                                <a href="/login"
                                    class="mt-4 inline-flex w-full justify-center items-center btn-primary-rmc rounded-xl text-white text-sm font-semibold px-4 py-2.5 hover:opacity-95 transition">
                                    Pesan Sekarang
                                </a>
                            </div>
                        </article>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <div class="bg-white border border-slate-100 rounded-2xl p-8 text-center text-slate-500">
                    Motor tidak ditemukan. Coba ubah kata kunci nama motor atau tipe motor.
                </div>
            <?php endif; ?>
        </section>

        <section id="cara-rental" class="max-w-6xl mx-auto px-6 pt-2 md:pt-8 pb-4 md:pb-8">
            <div class="how-wireframe-wrap md:p-8 lg:p-10">
                <div class="text-center max-w-3xl mx-auto">
                    <p class="text-sm font-semibold tracking-wide uppercase rmc-text">How RMC works</p>
                    <h2 class="mt-2 text-3xl md:text-4xl font-extrabold leading-tight text-slate-800">Cara rental motor
                        di RMC</h2>
                    <p class="mt-3 text-slate-600">Alur sederhana, cepat, dan mudah dipahami untuk proses sewa di RMC.
                    </p>
                </div>

                <div class="mt-8 grid sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-5">
                    <article class="how-wireframe-card rounded-2xl p-5">
                        <div class="how-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m21 21-4.35-4.35m1.6-5.15a6.75 6.75 0 1 1-13.5 0 6.75 6.75 0 0 1 13.5 0Z" />
                            </svg>
                        </div>
                        <p class="mt-4 text-xs font-semibold rmc-text uppercase tracking-wide">Step 01</p>
                        <h3 class="mt-1 text-lg font-bold text-slate-800">Cari Motor</h3>
                        <p class="mt-2 text-sm text-slate-500">Cari motor yang diinginkan. Jika tersedia, langsung
                            pesan
                            setelah login atau registrasi.</p>
                    </article>

                    <article class="how-wireframe-card rounded-2xl p-5">
                        <div class="how-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" width="16" height="16"
                                fill="currentColor" class="bi bi-calendar-check" viewBox="0 0 16 16">
                                <path
                                    d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0" />
                                <path
                                    d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z" />
                            </svg>
                        </div>
                        <p class="mt-4 text-xs font-semibold rmc-text uppercase tracking-wide">Step 02</p>
                        <h3 class="mt-1 text-lg font-bold text-slate-800">Pemesanan</h3>
                        <p class="mt-2 text-sm text-slate-500">Masuk dashboard penyewa, buka menu "Cari Motor", lalu
                            lakukan pemesanan penyewaan.</p>
                    </article>

                    <article class="how-wireframe-card rounded-2xl p-5">
                        <div class="how-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" width="16" height="16"
                                fill="currentColor" class="bi bi-pin-map" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M3.1 11.2a.5.5 0 0 1 .4-.2H6a.5.5 0 0 1 0 1H3.75L1.5 15h13l-2.25-3H10a.5.5 0 0 1 0-1h2.5a.5.5 0 0 1 .4.2l3 4a.5.5 0 0 1-.4.8H.5a.5.5 0 0 1-.4-.8z" />
                                <path fill-rule="evenodd"
                                    d="M8 1a3 3 0 1 0 0 6 3 3 0 0 0 0-6M4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999z" />
                            </svg>
                        </div>
                        <p class="mt-4 text-xs font-semibold rmc-text uppercase tracking-wide">Step 03</p>
                        <h3 class="mt-1 text-lg font-bold text-slate-800">Ke Lokasi RMC</h3>
                        <p class="mt-2 text-sm text-slate-500">Datang ke lokasi RMC untuk pengambilan motor sewa
                            sekaligus melakukan pembayaran.</p>
                    </article>

                    <article class="how-wireframe-card rounded-2xl p-5">
                        <div class="how-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" width="16" height="16"
                                fill="currentColor" class="bi bi-map" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M15.817.113A.5.5 0 0 1 16 .5v14a.5.5 0 0 1-.402.49l-5 1a.5.5 0 0 1-.196 0L5.5 15.01l-4.902.98A.5.5 0 0 1 0 15.5v-14a.5.5 0 0 1 .402-.49l5-1a.5.5 0 0 1 .196 0L10.5.99l4.902-.98a.5.5 0 0 1 .415.103M10 1.91l-4-.8v12.98l4 .8zm1 12.98 4-.8V1.11l-4 .8zm-6-.8V1.11l-4 .8v12.98z" />
                            </svg>
                        </div>
                        <p class="mt-4 text-xs font-semibold rmc-text uppercase tracking-wide">Step 04</p>
                        <h3 class="mt-1 text-lg font-bold text-slate-800">Mulai Perjalanan</h3>
                        <p class="mt-2 text-sm text-slate-500">Motor siap digunakan. Sekarang waktunya memulai
                            perjalanan Anda dengan nyaman.</p>
                    </article>
                </div>
            </div>
        </section>

        
        <section id="keunggulan" class="max-w-6xl mx-auto px-6 py-4 md:py-6">
            <div class="text-center max-w-3xl mx-auto">
                <p class="text-sm font-semibold tracking-wide uppercase rmc-text">Why Choose Us</p>
                <h2 class="mt-2 text-3xl md:text-4xl font-extrabold leading-tight text-slate-800">Keunggulan RMC</h2>
                <p class="mt-3 text-slate-600">
                    RMC menawarkan pengalaman rental motor yang berbeda dengan proses yang mudah, cepat, dan transparan.
                </p>
            </div>
            <div class="rounded-3xl bg-[#f3f4f6] p-4 md:p-6 lg:p-8">
                <div class="grid lg:grid-cols-12 gap-4 lg:gap-8 items-center">
                    <div class="lg:col-span-6 order-1">
                        <img src="https://elangsung.com/wp-content/uploads/2023/11/Daftar-Merek-Motor-di-Indonesia-kamu-punya-yang-mana-yamaha-aerox.webp"
                            alt="Motor unggulan RMC" class="why-motor-stage drop-shadow-md mx-auto">
                    </div>

                    <div class="lg:col-span-6 order-2 space-y-8 md:space-y-10">
                        <div class="why-pill why-pill-right why-pill-shift-1">Unit motor bersih & terawat</div>
                        <div class="why-pill why-pill-right why-pill-shift-2">Harga transparan tanpa biaya tersembunyi
                        </div>
                        <div class="why-pill why-pill-right why-pill-shift-3">Proses booking cepat & mudah</div>
                        <div class="why-pill why-pill-right why-pill-shift-4">Banyak pilihan motor siap pakai</div>
                        <div class="why-pill why-pill-right why-pill-shift-5">Pelayanan admin responsif</div>
                    </div>
                </div>
            </div>
        </section>

        <section id="testimoni" class="max-w-6xl mx-auto px-6 py-8 md:py-12">
            <div class="grid lg:grid-cols-4 gap-6 items-start">
                <div class="lg:col-span-1">
                    <p class="text-sm font-semibold rmc-text tracking-wide uppercase">What client say</p>
                    <h3 class="mt-2 text-3xl font-extrabold text-slate-800 leading-tight">Apa kata pengguna RMC</h3>
                    <p class="mt-3 text-slate-500 text-sm">Pengalaman real pengguna yang sudah sewa motor di RMC.</p>
                </div>
                <div class="lg:col-span-3">
                    <div id="testi-track" class="testi-track flex gap-4 overflow-x-auto snap-x snap-mandatory pb-1">
                        <article class="testi-card bg-white rounded-2xl p-6 border border-slate-100 shadow-sm">
                            <p class="text-slate-600 text-sm leading-relaxed">
                                “Proses booking cepat, motornya bersih, dan admin responsif banget. Sangat membantu pas
                                liburan ke Ciamis.”
                            </p>
                            <p class="mt-4 font-semibold text-slate-800">Adam Levina</p>
                            <p class="text-xs rmc-text">Traveler</p>
                        </article>

                        <article class="testi-card bg-white rounded-2xl p-6 border border-slate-100 shadow-sm">
                            <p class="text-slate-600 text-sm leading-relaxed">
                                “Tarifnya masuk akal, unit lengkap, dan pengambilan motor tepat waktu. Recommended buat
                                kebutuhan harian.”
                            </p>
                            <p class="mt-4 font-semibold text-slate-800">Jenny Riguston</p>
                            <p class="text-xs rmc-text">Mahasiswa</p>
                        </article>

                        <article class="testi-card bg-white rounded-2xl p-6 border border-slate-100 shadow-sm">
                            <p class="text-slate-600 text-sm leading-relaxed">
                                “Sistemnya enak dipakai, pilih motor langsung jelas, dan pas datang unitnya sesuai foto.
                                Jadi lebih percaya untuk sewa lagi.”
                            </p>
                            <p class="mt-4 font-semibold text-slate-800">Rian Putra</p>
                            <p class="text-xs rmc-text">Karyawan Swasta</p>
                        </article>

                        <article class="testi-card bg-white rounded-2xl p-6 border border-slate-100 shadow-sm">
                            <p class="text-slate-600 text-sm leading-relaxed">
                                “Untuk perjalanan dinas di Ciamis, RMC sangat membantu. Booking cepat, admin ramah, dan
                                harga sewa masih masuk budget.”
                            </p>
                            <p class="mt-4 font-semibold text-slate-800">Nadia Pratama</p>
                            <p class="text-xs rmc-text">Staff Operasional</p>
                        </article>
                    </div>

                    <div class="flex items-center justify-end gap-2 mt-4">
                        <button type="button" id="testi-prev"
                            class="w-9 h-9 rounded-full border border-slate-200 bg-white text-slate-600 hover:bg-slate-50 transition inline-flex items-center justify-center"
                            aria-label="Testimoni sebelumnya">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                            </svg>
                        </button>
                        <button type="button" id="testi-next"
                            class="w-9 h-9 rounded-full border border-slate-200 bg-white text-slate-600 hover:bg-slate-50 transition inline-flex items-center justify-center"
                            aria-label="Testimoni berikutnya">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <section id="faq" class="max-w-4xl mx-auto px-6 py-14 md:py-24">
            <div class="text-center">
                <p class="text-sm font-semibold rmc-text tracking-wide uppercase">FAQs</p>
                <h3 class="mt-2 text-3xl md:text-4xl font-extrabold text-slate-800">Pertanyaan yang sering ditanyakan
                </h3>
                <p class="mt-3 text-slate-500">Jawaban cepat sebelum kamu mulai booking motor di RMC.</p>
            </div>

            <div class="mt-10 space-y-4">
                <div class="faq-item active">
                    <button class="faq-trigger" type="button" aria-expanded="true" aria-controls="faq-1">
                        <span>Bagaimana cara booking motor di RMC?</span>
                        <span class="faq-icon">+</span>
                    </button>
                    <div id="faq-1" class="faq-content">
                        <p class="pt-3 text-sm text-slate-600">Klik tombol "Pesan Sekarang", login, pilih motor,
                            tentukan pilihan (harian/mingguan dan bulanan) pemesanan, lalu konfirmasi pesanan.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-trigger" type="button" aria-expanded="false" aria-controls="faq-2">
                        <span>Apakah harus upload dokumen identitas?</span>
                        <span class="faq-icon">+</span>
                    </button>
                    <div id="faq-2" class="faq-content">
                        <p class="pt-3 text-sm text-slate-600">Ya, untuk keamanan transaksi, penyewa perlu melengkapi
                            dokumen identitas (KTP/SIM).</p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-trigger" type="button" aria-expanded="false" aria-controls="faq-3">
                        <span>Bisa sewa untuk mingguan atau bulanan?</span>
                        <span class="faq-icon">+</span>
                    </button>
                    <div id="faq-3" class="faq-content">
                        <p class="pt-3 text-sm text-slate-600">Bisa. RMC mendukung opsi sewa harian, mingguan, hingga
                            bulanan sesuai kebutuhanmu.</p>
                    </div>
                </div>
            </div>
        </section>

        
        <section id="lokasi" class="max-w-6xl mx-auto px-6 py-14 md:py-16">
            <div class="rounded-3xl border border-slate-200 bg-white p-5 md:p-8 lg:p-10">
                <div class="grid lg:grid-cols-2 gap-8 md:gap-10 items-start">
                    <div>
                    <p class="text-sm font-semibold rmc-text tracking-wide uppercase">Lokasi & Kontak</p>
                    <h3 class="mt-2 text-3xl md:text-4xl font-extrabold text-slate-800">Temukan RMC di Maps</h3>
                    <p class="mt-3 text-slate-500 leading-relaxed">
                        Datang langsung ke lokasi untuk pengambilan motor dan informasi lebih lanjut. Kamu juga bisa
                        hubungi kami melalui kontak berikut.
                    </p>

                    <div class="mt-6 grid sm:grid-cols-2 gap-3 text-sm">
                        <a href="https://wa.me/6289657571177" target="_blank" rel="noopener noreferrer"
                            class="group rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 hover:border-[#6748FB]/40 hover:bg-[#f6f3ff] transition">
                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">WhatsApp</p>
                            <p class="mt-1 font-semibold text-slate-800 group-hover:text-[#6748FB]">089657571177</p>
                        </a>

                        <a href="mailto:kahlaluthifiyah@gmail.com"
                            class="group rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 hover:border-[#6748FB]/40 hover:bg-[#f6f3ff] transition">
                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Email</p>
                            <p class="mt-1 font-semibold text-slate-800 group-hover:text-[#6748FB] break-all">kahlaluthifiyah@gmail.com</p>
                        </a>

                        <a href="https://www.linkedin.com/in/kahla-luthfiyah-halim-817730323?utm_source=share_via&utm_content=profile&utm_medium=member_android"
                            target="_blank" rel="noopener noreferrer"
                            class="group rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 hover:border-[#6748FB]/40 hover:bg-[#f6f3ff] transition">
                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">LinkedIn</p>
                            <p class="mt-1 font-semibold text-slate-800 group-hover:text-[#6748FB] break-all">kahla-luthfiyah-halim</p>
                        </a>

                        <a href="https://www.instagram.com/kahlaluthfi_" target="_blank" rel="noopener noreferrer"
                            class="group rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 hover:border-[#6748FB]/40 hover:bg-[#f6f3ff] transition">
                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Instagram</p>
                            <p class="mt-1 font-semibold text-slate-800 group-hover:text-[#6748FB]">@kahlaluthfi_</p>
                        </a>
                    </div>
                </div>

                    <div class="rounded-2xl overflow-hidden border border-slate-200 bg-slate-50">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.271937754759!2d108.32438897415992!3d-7.323321492684864!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f5eba1b06f52f%3A0xaf882382d9de1508!2sPublic%20Vocational%20High%20School%201of%20Ciamis!5e0!3m2!1sen!2sid!4v1776515680030!5m2!1sen!2sid"
                            class="w-full h-[320px] md:h-[420px]" style="border:0;" allowfullscreen=""
                            loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-[#eceff5] border-t border-slate-200">
        <div class="max-w-6xl mx-auto px-6 py-12 md:py-14">
            <div class="grid md:grid-cols-2 lg:grid-cols-12 gap-8 md:gap-10 text-sm">
                <div class="lg:col-span-4">
                    <p class="text-3xl font-bold text-slate-800">RMC</p>
                    <p class="mt-4 text-slate-500 leading-relaxed max-w-sm">
                        Platform rental motor di Ciamis dengan pilihan unit terawat, proses booking cepat, dan layanan
                        yang ramah untuk perjalanan harian maupun liburan.
                    </p>
                    <button type="button"
                        class="mt-6 inline-flex items-center gap-2 rounded-full border border-slate-300 bg-white px-4 py-2 text-slate-600 hover:border-slate-400 transition">
                        <span class="text-base" aria-hidden="true">🇮🇩</span>
                        <span>Bahasa Indonesia</span>
                    </button>
                </div>

                <div class="lg:col-span-3">
                    <p class="font-semibold text-slate-800">Navigation</p>
                    <ul class="mt-4 space-y-3 text-slate-500">
                        <li><a href="<?php echo e(url('/')); ?>#motor-results" class="rmc-link">Motor</a></li>
                        <li><a href="<?php echo e(url('/')); ?>#cara-rental" class="rmc-link">Cara Rental</a></li>
                        <li><a href="<?php echo e(url('/')); ?>#keunggulan" class="rmc-link">Keunggulan</a></li>
                        <li><a href="<?php echo e(url('/')); ?>#testimoni" class="rmc-link">Testimoni</a></li>
                    </ul>
                </div>

                <div class="lg:col-span-2">
                    <p class="font-semibold text-slate-800">Company</p>
                    <ul class="mt-4 space-y-3 text-slate-500">
                        <li><a href="<?php echo e(url('/')); ?>" class="rmc-link">Tentang Kami</a></li>
                        <li><a href="<?php echo e(url('/')); ?>#lokasi" class="rmc-link">Kontak</a></li>
                        <li><a href="/login" class="rmc-link">Login</a></li>
                    </ul>
                </div>

                <div class="lg:col-span-3">
                    <p class="font-semibold text-slate-800">Support</p>
                    <ul class="mt-4 space-y-3 text-slate-500">
                        <li><a href="<?php echo e(url('/')); ?>#faq" class="rmc-link">Help center</a></li>
                        <li><a href="mailto:kahlaluthifiyah@gmail.com" class="rmc-link">Ask a question</a></li>
                        <li><a href="<?php echo e(url('/')); ?>" class="rmc-link">Privacy policy</a></li>
                        <li><a href="<?php echo e(url('/')); ?>" class="rmc-link">Terms & conditions</a></li>
                    </ul>
                </div>
            </div>

            <div class="mt-10 pt-5 border-t border-slate-300/70 text-xs text-slate-500 flex flex-col sm:flex-row gap-2 sm:items-center sm:justify-between">
                <p>&copy; <?php echo e(date('Y')); ?> Rental Motor Ciamis. All rights reserved.</p>
                <a href="https://portfolio-kahla.vercel.app/" target="_blank" rel="noopener noreferrer"
                    class="text-slate-600 rmc-link">About developer</a>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchForm = document.getElementById('hero-search-form');
            const brandInput = document.getElementById('brand');
            const typeSelect = document.getElementById('type_cc');
            let searchTimer;

            function submitSearch() {
                if (!searchForm || !brandInput || !typeSelect) return;

                const baseUrl = <?php echo json_encode(url('/'), 15, 512) ?>;
                const brandValue = brandInput.value.trim();
                const typeValue = typeSelect.value.trim();
                const params = new URLSearchParams();

                if (brandValue !== '') {
                    params.set('brand', brandValue);
                }

                if (typeValue !== '') {
                    params.set('type_cc', typeValue);
                }

                const query = params.toString();
                const targetUrl = query ? `${baseUrl}?${query}#motor-results` : `${baseUrl}#motor-results`;
                window.location.assign(targetUrl);
            }

            if (searchForm && brandInput && typeSelect) {
                searchForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    submitSearch();
                });

                brandInput.addEventListener('input', function() {
                    clearTimeout(searchTimer);

                    if (brandInput.value.trim() === '') {
                        typeSelect.value = '';
                    }

                    searchTimer = setTimeout(submitSearch, 350);
                });

                typeSelect.addEventListener('change', function() {
                    clearTimeout(searchTimer);
                    searchTimer = setTimeout(submitSearch, 150);
                });
            }

            const testiTrack = document.getElementById('testi-track');
            const testiPrev = document.getElementById('testi-prev');
            const testiNext = document.getElementById('testi-next');

            if (testiTrack && testiPrev && testiNext) {
                const getStep = () => {
                    const firstCard = testiTrack.querySelector('.testi-card');
                    if (!firstCard) return 280;
                    return firstCard.getBoundingClientRect().width + 16;
                };

                testiPrev.addEventListener('click', () => {
                    testiTrack.scrollBy({
                        left: -getStep(),
                        behavior: 'smooth'
                    });
                });

                testiNext.addEventListener('click', () => {
                    testiTrack.scrollBy({
                        left: getStep(),
                        behavior: 'smooth'
                    });
                });
            }

            const items = document.querySelectorAll('.faq-item');

            function closeItem(item) {
                const content = item.querySelector('.faq-content');
                const trigger = item.querySelector('.faq-trigger');
                item.classList.remove('active');
                trigger.setAttribute('aria-expanded', 'false');
                content.style.maxHeight = '0px';
            }

            function openItem(item) {
                const content = item.querySelector('.faq-content');
                const trigger = item.querySelector('.faq-trigger');
                item.classList.add('active');
                trigger.setAttribute('aria-expanded', 'true');
                content.style.maxHeight = content.scrollHeight + 'px';
            }

            items.forEach((item, index) => {
                const trigger = item.querySelector('.faq-trigger');

                if (item.classList.contains('active') || index === 0) {
                    openItem(item);
                } else {
                    closeItem(item);
                }

                trigger.addEventListener('click', function() {
                    const isActive = item.classList.contains('active');

                    items.forEach(other => {
                        if (other !== item) closeItem(other);
                    });

                    if (isActive) {
                        closeItem(item);
                    } else {
                        openItem(item);
                    }
                });
            });
        });
    </script>
</body>

</html>
<?php /**PATH D:\PROJEK PROJEK\rental-motor\rental-motor\resources\views/welcome.blade.php ENDPATH**/ ?>