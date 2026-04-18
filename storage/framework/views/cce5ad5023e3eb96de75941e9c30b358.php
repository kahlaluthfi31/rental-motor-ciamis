<aside class="w-64 bg-purple-100 text-purple-800 flex flex-col hidden md:flex">
    <div class="p-6">
        <h1 class="text-2xl font-bold">RMC</h1>
        <span class="text-sm text-purple-400">Rental Motor Ciamis</span>
    </div>

    <nav class="flex-1 px-4 overflow-y-auto">
        
        <?php if(Auth::user()->role === 'admin'): ?>
        <a href="<?php echo e(route('admin.dashboard-admin')); ?>" class="flex items-center p-3 my-2 transition-colors duration-200 rounded-lg hover:bg-purple-200 <?php echo e(request()->routeIs('admin.dashboard-admin') ? 'bg-purple-200 text-purple-900 font-semibold' : ''); ?>">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1"></path>
            </svg>
            Dashboard
        </a>
        <?php elseif(Auth::user()->role === 'pemilik'): ?>
        <a href="<?php echo e(route('pemilik.dashboard-pemilik')); ?>" class="flex items-center p-3 my-2 transition-colors duration-200 rounded-lg hover:bg-purple-200 <?php echo e(request()->routeIs('pemilik.dashboard-pemilik') ? 'bg-purple-200 text-purple-900 font-semibold' : ''); ?>">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1"></path>
            </svg>
            Dashboard
        </a>
        <?php elseif(Auth::user()->role === 'penyewa'): ?>
        <a href="<?php echo e(route('penyewa.dashboard-penyewa')); ?>" class="flex items-center p-3 my-2 transition-colors duration-200 rounded-lg hover:bg-purple-200 <?php echo e(request()->routeIs('penyewa.dashboard-penyewa') ? 'bg-purple-200 text-purple-900 font-semibold' : ''); ?>">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1"></path>
            </svg>
            Dashboard
        </a>
        <?php endif; ?>

        
        <?php if(Auth::user()->role === 'admin'): ?>
        <a href="<?php echo e(route('admin.verifikasi-motor')); ?>" class="flex items-center p-3 my-2 transition-colors duration-200 rounded-lg hover:bg-purple-200 <?php echo e(request()->routeIs('admin.verifikasi-motor') ? 'bg-purple-200 text-purple-900 font-semibold' : ''); ?>">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
            </svg>
            Verifikasi Motor
        </a>
        <a href="<?php echo e(route('admin.manajemen-harga')); ?>" class="flex items-center p-3 my-2 transition-colors duration-200 rounded-lg hover:bg-purple-200 <?php echo e(request()->routeIs('admin.manajemen-harga') ? 'bg-purple-200 text-purple-900 font-semibold' : ''); ?>">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Data Motor
        </a>
        <a href="<?php echo e(route('admin.manajemen-pemesanan')); ?>" class="flex items-center p-3 my-2 transition-colors duration-200 rounded-lg hover:bg-purple-200 <?php echo e(request()->routeIs('admin.manajemen-pemesanan') ? 'bg-purple-200 text-purple-900 font-semibold' : ''); ?>">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
            </svg>
            Pemesanan
        </a>
        <?php elseif(Auth::user()->role === 'pemilik'): ?>
        
        <a href="<?php echo e(route('pemilik.titip-motor')); ?>" class="flex items-center p-3 my-2 transition-colors duration-200 rounded-lg hover:bg-purple-200 <?php echo e(request()->routeIs('pemilik.titip-motor') ? 'bg-purple-200 text-purple-900 font-semibold' : ''); ?>">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-motorbike">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M5 16m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                <path d="M19 16m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                <path d="M7.5 14h5l4 -4h-10.5m1.5 4l4 -4" />
                <path d="M13 6h2l1.5 3l2 4" />
            </svg>
            Titip Motor
        </a>
        <?php elseif(Auth::user()->role === 'penyewa'): ?>
        
        <a href="<?php echo e(route('penyewa.cari-motor')); ?>" class="flex items-center p-3 my-2 transition-colors duration-200 rounded-lg hover:bg-purple-200 <?php echo e(request()->routeIs('penyewa.cari-motor') ? 'bg-purple-200 text-purple-900 font-semibold' : ''); ?>">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            Cari Motor
        </a>
        <a href="<?php echo e(route('penyewa.pemesanan')); ?>" class="flex items-center p-3 my-2 transition-colors duration-200 rounded-lg hover:bg-purple-200 <?php echo e(request()->routeIs('penyewa.pemesanan') ? 'bg-purple-200 text-purple-900 font-semibold' : ''); ?>">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
            </svg>
            Pesanan Saya
        </a>
        <?php endif; ?>

        
        <?php if(in_array(Auth::user()->role, ['admin', 'pemilik'])): ?>
        <a href="<?php echo e(Auth::user()->role === 'admin' ? route('admin.laporan') : route('pemilik.laporan')); ?>" class="flex items-center p-3 my-2 transition-colors duration-200 rounded-lg hover:bg-purple-200 <?php echo e(request()->routeIs('*.laporan') ? 'bg-purple-200 text-purple-900 font-semibold' : ''); ?>">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-clipboard-text">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                <path d="M9 12h6" />
                <path d="M9 16h6" />
            </svg>
            Laporan
        </a>
        <?php endif; ?>

        
        <?php if(Auth::user()->role === 'penyewa'): ?>
        <a href="<?php echo e(route('penyewa.riwayat-sewa')); ?>" class="flex items-center p-3 my-2 transition-colors duration-200 rounded-lg hover:bg-purple-200 <?php echo e(request()->routeIs('penyewa.riwayat-sewa') ? 'bg-purple-200 text-purple-900 font-semibold' : ''); ?>">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Riwayat Sewa
        </a>
        <?php endif; ?>
    </nav>

    <div class="mt-auto">
        <div class="py-1 pb-5 px-4">
            <a href="<?php echo e(route('logout')); ?>"
                onclick="event.preventDefault(); confirmLogout();"
                class="bg-purple-500 text-white px-4 py-3 rounded-lg block text-center font-semibold hover:bg-red-600 transition-colors duration-200">
                <span class="flex items-center justify-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-logout">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                        <path d="M7 12h14l-3 -3m0 6l3 -3" />
                    </svg>
                    <span>Logout</span>
                </span>
            </a>
        </div>
        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="hidden">
            <?php echo csrf_field(); ?>
        </form>
    </div>
    <script>
        function confirmLogout() {
            if (confirm('Apakah Anda yakin ingin keluar dari akun ini?')) {
                document.getElementById('logout-form').submit();
            }
        }
    </script>
</aside><?php /**PATH D:\PROJEK PROJEK\rental-motor\rental-motor\resources\views/partials/sidebar.blade.php ENDPATH**/ ?>