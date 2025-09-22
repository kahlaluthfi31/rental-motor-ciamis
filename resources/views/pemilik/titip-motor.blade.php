<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Titip Motor - RMC</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 8px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #e5e7eb;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: #a78bfa;
            border-radius: 10px;
            border: 2px solid #e5e7eb;
        }
    </style>
</head>

<body class="bg-slate-50 flex h-screen overflow-hidden">
    @include('partials.sidebar')
    <div class="flex-1 flex flex-col overflow-hidden">
        <main class="flex-1 p-6 overflow-y-auto custom-scrollbar">
            <div class="flex items-center justify-between mb-4 bg-white p-5 rounded-xl shadow-md overflow-x-auto">
                <h1 class="text-xl font-bold text-purple-800">Daftar Motor Saya</h1>
                <button data-modal-target="titip-motor-modal" data-modal-toggle="titip-motor-modal" class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-6 py-3 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 focus:outline-none focus:ring-4 focus:ring-purple-500 focus:ring-opacity-50">
                    <span class="flex items-center justify-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-motorbike">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M5 16m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                            <path d="M19 16m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                            <path d="M7.5 14h5l4 -4h-10.5m1.5 4l4 -4" />
                            <path d="M13 6h2l1.5 3l2 4" />
                        </svg>
                        <span class="font-semibold">Titipkan Motor</span>
                    </span>
                </button>
            </div>
            @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-6 shadow-md" role="alert">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm leading-5 font-medium">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
            @endif
            @if(session('error'))
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-6 shadow-md" role="alert">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm leading-5 font-medium">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
            @endif

            <div class="bg-white p-8 rounded-xl shadow-md overflow-x-auto">
                @if($motors->isEmpty())
                <div class="text-center py-20">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 0 0-1.883 2.542l.857 6a2.25 2.25 0 0 0 2.227 1.932H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6A2.25 2.25 0 0 1 6 3.75h3.879a1.5 1.5 0 0 1 1.06.44l2.122 2.12a1.5 1.5 0 0 0 1.06.44H18A2.25 2.25 0 0 1 20.25 9v.776" />
                    </svg>
                    <h3 class="mt-4 text-xl font-semibold text-gray-900">Belum Ada Motor Terdaftar</h3>
                    <p class="mt-2 text-sm text-gray-500">
                        Silakan daftarkan motor pertama Anda untuk memulai.
                    </p>
                </div>
                @else
                <div class="overflow-x-auto">
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-200">
                                <th class="px-5 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider rounded-tl-xl">
                                    Motor
                                </th>
                                <th class="px-5 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Plat Nomor
                                </th>
                                <th class="px-5 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-5 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider rounded-tr-xl">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($motors as $motor)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 w-12 h-12">
                                            <img class="w-full h-full rounded-full object-cover shadow-sm" src="{{ asset($motor->photo_url) }}" alt="{{ $motor->brand }} {{ $motor->type_cc }}">
                                        </div>
                                        <div class="ml-4">
                                            <p class="text-gray-900 font-semibold whitespace-no-wrap">{{ $motor->brand }}</p>
                                            <p class="text-gray-500 text-sm whitespace-no-wrap">{{ $motor->type_cc }}cc</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap font-medium">{{ $motor->plate_number }}</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    @if($motor->status == 'tersedia')
                                    <span class="relative inline-block px-3 py-1 font-semibold text-green-800 leading-tight">
                                        <span aria-hidden class="absolute inset-0 bg-green-200 opacity-75 rounded-full"></span>
                                        <span class="relative text-xs">Tersedia</span>
                                    </span>
                                    @elseif($motor->status == 'disewa')
                                    <span class="relative inline-block px-3 py-1 font-semibold text-orange-800 leading-tight">
                                        <span aria-hidden class="absolute inset-0 bg-orange-200 opacity-75 rounded-full"></span>
                                        <span class="relative text-xs">Disewa</span>
                                    </span>
                                    @elseif($motor->status == 'pending_verification')
                                    <span class="relative inline-block px-3 py-1 font-semibold text-yellow-800 leading-tight">
                                        <span aria-hidden="true" class="absolute inset-0 bg-yellow-200 opacity-75 rounded-full"></span>
                                        <span class="relative text-xs">Menunggu Verifikasi</span>
                                    </span>
                                    @endif
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <div class="flex space-x-3 items-center">
                                        @if($motor->status != 'pending_verification')
                                        <button onclick="openEditModal('{{ $motor->id }}', '{{ $motor->brand }}', '{{ $motor->type_cc }}', '{{ $motor->plate_number }}', '{{ asset($motor->photo_url) }}')"
                                            class="text-indigo-600 hover:text-indigo-900 transition-colors duration-200 font-medium">
                                            Edit
                                        </button>
                                        @endif
                                        <button onclick="openDeleteModal('{{ $motor->id }}', '{{ $motor->status }}')"
                                            class="text-red-600 hover:text-red-900 transition-colors duration-200 font-medium">
                                            Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </main>
    </div>

    <div id="editMotorModal" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex overflow-y-auto items-center justify-center hidden z-50 transition-opacity duration-300">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-lg mx-4 my-auto overflow-y-auto transform scale-95 transition-transform duration-300">
            <div class="p-6 md:p-8">
                <h3 class="text-2xl font-bold text-gray-900 text-center mb-6">Edit Data Motor</h3>
                <form id="editMotorForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="space-y-6">
                        <div>
                            <label for="edit_brand" class="block text-sm font-medium text-gray-700 mb-2">Merek Motor</label>
                            <input type="text" name="brand" id="edit_brand" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                        </div>

                        <div>
                            <label for="edit_type_cc" class="block text-sm font-medium text-gray-700 mb-2">Tipe & CC</label>
                            <select name="type_cc" id="edit_type_cc" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                                <option value="100">100cc</option>
                                <option value="125">125cc</option>
                                <option value="150">150cc</option>
                            </select>
                            <p class="mt-1 text-xs text-gray-500">Pilih tipe CC motor yang sesuai</p>
                        </div>

                        <div>
                            <label for="edit_plate_number" class="block text-sm font-medium text-gray-700 mb-2">Plat Nomor</label>
                            <input type="text" name="plate_number" id="edit_plate_number" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                        </div>
                        <div>
                            <label for="edit_dokumen_kepemilikan" class="block text-sm font-medium text-gray-700 mb-2">Dokumen Kepemilikan (Opsional)</label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl cursor-pointer hover:border-purple-500 transition-colors duration-200">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.26-3.26a4 4 0 00-5.66 0L16 26" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="edit_dokumen_kepemilikan" class="relative cursor-pointer bg-white rounded-md font-medium text-purple-600 hover:text-purple-500 focus-within:outline-none">
                                            <span>Unggah file</span>
                                            <input id="edit_dokumen_kepemilikan" name="dokumen_kepemilikan" type="file" class="sr-only">
                                        </label>
                                        <p class="pl-1">atau seret dan lepas</p>
                                    </div>
                                    <p class="text-xs text-gray-500">PDF, DOC, DOCX hingga 5MB</p>
                                </div>
                            </div>
                            <div id="currentDocument" class="mt-4 text-center text-sm text-gray-600"></div>
                        </div>
                        <div>
                            <label for="edit_photo_url" class="block text-sm font-medium text-gray-700 mb-2">Foto Motor (Opsional)</label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl cursor-pointer hover:border-purple-500 transition-colors duration-200">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.26-3.26a4 4 0 00-5.66 0L16 26" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="edit_photo_url" class="relative cursor-pointer bg-white rounded-md font-medium text-purple-600 hover:text-purple-500 focus-within:outline-none">
                                            <span>Unggah file</span>
                                            <input id="edit_photo_url" name="photo_url" type="file" class="sr-only">
                                        </label>
                                        <p class="pl-1">atau seret dan lepas</p>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG, JPEG hingga 5MB</p>
                                </div>
                            </div>
                            <div id="currentPhoto" class="mt-4 text-center text-sm text-gray-600"></div>
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end space-x-3">
                        <button type="button" onclick="closeEditModal()" class="px-5 py-2 text-sm font-medium text-gray-700 bg-gray-200 hover:bg-gray-300 rounded-lg transition-colors duration-200">
                            Batal
                        </button>
                        <button type="submit" class="px-5 py-2 text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 rounded-lg transition-colors duration-200">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="deleteConfirmModal" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center hidden z-50 transition-opacity duration-300">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-sm mx-4 transform scale-95 transition-transform duration-300">
            <div class="p-6 md:p-8 text-center">
                <svg class="mx-auto h-16 w-16 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <h3 class="mt-4 text-xl font-bold text-gray-900">Konfirmasi Hapus</h3>
                <p class="mt-2 text-sm text-gray-600">Apakah Anda yakin ingin menghapus motor ini? Aksi ini tidak bisa dibatalkan.</p>
                <p id="deleteMessage" class="text-sm text-red-600 font-medium mt-4 hidden">Motor sedang disewa atau dalam proses verifikasi, tidak dapat dihapus.</p>
            </div>
            <div class="px-6 py-4 bg-gray-50 rounded-b-xl flex justify-end space-x-3">
                <button type="button" onclick="closeDeleteModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 hover:bg-gray-300 rounded-md transition-colors duration-200">
                    Batal
                </button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" id="deleteButton" class="px-4 py-2 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-md transition-colors duration-200">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div id="titip-motor-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <div class="relative bg-white rounded-3xl shadow-2xl overflow-hidden transform transition-all sm:my-8 sm:w-full sm:max-w-xl">
                <div class="bg-gradient-to-r from-purple-600 to-indigo-600 p-6 flex items-center justify-between">
                    <h3 class="text-2xl font-bold text-white">
                        Daftarkan Motor Anda
                    </h3>
                    <button type="button" class="text-white hover:text-gray-200 transition-colors duration-200" data-modal-hide="titip-motor-modal">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <div class="p-6 md:p-8 space-y-6">
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Lengkapi formulir di bawah ini dengan detail motor Anda untuk segera diverifikasi dan siap disewakan.
                    </p>
                    <form action="{{ route('pemilik.titip-motor.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="space-y-6">
                            <!-- Field yang sudah ada sebelumnya -->
                            <div>
                                <label for="brand" class="block text-sm font-medium text-gray-700 mb-1">Merek Motor</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-tag">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M7.5 7.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                            <path d="M3 6v5.172a2 2 0 0 0 .586 1.414l7.71 7.71a2.41 2.41 0 0 0 3.408 0l5.592 -5.592a2.41 2.41 0 0 0 0 -3.408l-7.71 -7.71a2 2 0 0 0 -1.414 -.586h-5.172a3 3 0 0 0 -3 3z" />
                                        </svg>
                                    </span>
                                    <input type="text" name="brand" id="brand" value="{{ old('brand') }}" required
                                        class="w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                                </div>
                            </div>

                            <div>
                                <label for="type_cc" class="block text-sm font-medium text-gray-700 mb-1">Tipe & CC</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-circle-dashed-letter-c">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M14 10a2 2 0 1 0 -4 0v4a2 2 0 1 0 4 0" />
                                            <path d="M8.56 3.69a9 9 0 0 0 -2.92 1.95" />
                                            <path d="M3.69 8.56a9 9 0 0 0 -.69 3.44" />
                                            <path d="M3.69 15.44a9 9 0 0 0 1.95 2.92" />
                                            <path d="M8.56 20.31a9 9 0 0 0 3.44 .69" />
                                            <path d="M15.44 20.31a9 9 0 0 0 2.92 -1.95" />
                                            <path d="M20.31 15.44a9 9 0 0 0 .69 -3.44" />
                                            <path d="M20.31 8.56a9 9 0 0 0 -1.95 -2.92" />
                                            <path d="M15.44 3.69a9 9 0 0 0 -3.44 -.69" />
                                        </svg>
                                    </span>
                                    <select name="type_cc" id="type_cc" required
                                        class="w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 appearance-none">
                                        <option value="">Pilih Tipe CC</option>
                                        <option value="100" {{ old('type_cc') == '100' ? 'selected' : '' }}>100cc</option>
                                        <option value="125" {{ old('type_cc') == '125' ? 'selected' : '' }}>125cc</option>
                                        <option value="150" {{ old('type_cc') == '150' ? 'selected' : '' }}>150cc</option>
                                    </select>
                                    <span class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </span>
                                </div>
                            </div>

                            <div>
                                <label for="plate_number" class="block text-sm font-medium text-gray-700 mb-1">Plat Nomor</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-number-123">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M3 10l2 -2v8" />
                                            <path d="M9 8h3a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-2a1 1 0 0 0 -1 1v2a1 1 0 0 0 1 1h3" />
                                            <path d="M17 8h2.5a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1 -1.5 1.5h-1.5h1.5a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1 -1.5 1.5h-2.5" />
                                        </svg>
                                    </span>
                                    <input type="text" name="plate_number" id="plate_number" value="{{ old('plate_number') }}" required
                                        class="w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                                </div>
                            </div>

                            <div>
                                <label for="photo_url" class="block text-sm font-medium text-gray-700 mb-1">Foto Motor</label>
                                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl cursor-pointer hover:border-purple-500 transition-colors duration-200">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.26-3.26a4 4 0 00-5.66 0L16 26" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex text-sm text-gray-600">
                                            <label for="photo_url" class="relative cursor-pointer bg-white rounded-md font-medium text-purple-600 hover:text-purple-500 focus-within:outline-none">
                                                <span>Unggah file</span>
                                                <input id="photo_url" name="photo_url" type="file" class="sr-only" required>
                                            </label>
                                            <p class="pl-1">atau seret dan lepas</p>
                                        </div>
                                        <p class="text-xs text-gray-500">PNG, JPG, JPEG hingga 5MB</p>
                                    </div>
                                </div>
                            </div>

                            <!-- TAMBAHAN: Field Dokumen Kepemilikan -->
                            <div>
                                <label for="dokumen_kepemilikan" class="block text-sm font-medium text-gray-700 mb-1">Dokumen Kepemilikan</label>
                                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl cursor-pointer hover:border-purple-500 transition-colors duration-200">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.26-3.26a4 4 0 00-5.66 0L16 26" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex text-sm text-gray-600">
                                            <label for="dokumen_kepemilikan" class="relative cursor-pointer bg-white rounded-md font-medium text-purple-600 hover:text-purple-500 focus-within:outline-none">
                                                <span>Unggah file</span>
                                                <input id="dokumen_kepemilikan" name="dokumen_kepemilikan" type="file" class="sr-only">
                                            </label>
                                            <p class="pl-1">atau seret dan lepas</p>
                                        </div>
                                        <p class="text-xs text-gray-500">PDF, DOC, DOCX hingga 5MB</p>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-base font-semibold text-white bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-all duration-300 transform hover:-translate-y-1">
                                    Daftarkan Motor
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Fungsi untuk membuka modal edit
        function openEditModal(motorId, brand, typeCc, plateNumber, photoUrl, dokumenKepemilikan) {
            const modal = document.getElementById('editMotorModal');
            const form = document.getElementById('editMotorForm');
            const currentPhoto = document.getElementById('currentPhoto');
            const currentDocument = document.getElementById('currentDocument');

            // Isi form dengan data motor
            document.getElementById('edit_brand').value = brand;
            document.getElementById('edit_type_cc').value = typeCc;
            document.getElementById('edit_plate_number').value = plateNumber;

            // Set action form
            form.action = `/pemilik/titip-motor/${motorId}`;

            // Tampilkan foto saat ini jika ada
            if (photoUrl) {
                currentPhoto.innerHTML = `<p class="font-medium">Foto saat ini:</p><img src="${photoUrl}" class="mt-2 mx-auto h-32 object-contain rounded-lg border border-gray-200 p-1 shadow-sm">`;
            } else {
                currentPhoto.innerHTML = '<p class="text-gray-500">Tidak ada foto saat ini</p>';
            }

            // Tampilkan dokumen saat ini jika ada
            if (dokumenKepemilikan) {
                currentDocument.innerHTML = `<p class="font-medium">Dokumen saat ini:</p>
                <a href="${dokumenKepemilikan}" target="_blank" class="mt-2 inline-flex items-center px-3 py-1 bg-purple-100 text-purple-700 rounded-lg hover:bg-purple-200 transition-colors duration-200">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Lihat Dokumen
                </a>`;
            } else {
                currentDocument.innerHTML = '<p class="text-gray-500">Tidak ada dokumen saat ini</p>';
            }

            // Tampilkan modal
            modal.classList.remove('hidden');
        }

        // Fungsi untuk menutup modal edit
        function closeEditModal() {
            document.getElementById('editMotorModal').classList.add('hidden');
        }

        // Fungsi untuk membuka modal hapus
        function openDeleteModal(motorId, status) {
            const modal = document.getElementById('deleteConfirmModal');
            const form = document.getElementById('deleteForm');
            const deleteButton = document.getElementById('deleteButton');
            const deleteMessage = document.getElementById('deleteMessage');

            // Set action form
            form.action = `/pemilik/titip-motor/${motorId}`;

            // Cek status motor
            if (status === 'disewa' || status === 'pending_verification') {
                deleteButton.disabled = true;
                deleteButton.classList.add('opacity-50', 'cursor-not-allowed');
                deleteMessage.classList.remove('hidden');
            } else {
                deleteButton.disabled = false;
                deleteButton.classList.remove('opacity-50', 'cursor-not-allowed');
                deleteMessage.classList.add('hidden');
            }

            // Tampilkan modal
            modal.classList.remove('hidden');
        }

        // Fungsi untuk menutup modal hapus
        function closeDeleteModal() {
            document.getElementById('deleteConfirmModal').classList.add('hidden');
        }

        // Konfirmasi sebelum mengupdate data
        document.getElementById('editMotorForm').addEventListener('submit', function(e) {
            if (!confirm('Apakah Anda yakin ingin mengupdate data motor ini?')) {
                e.preventDefault();
            }
        });

        // Tutup modal ketika klik di luar area modal
        window.addEventListener('click', function(e) {
            const editModal = document.getElementById('editMotorModal');
            const deleteModal = document.getElementById('deleteConfirmModal');

            if (e.target === editModal) {
                closeEditModal();
            }

            if (e.target === deleteModal) {
                closeDeleteModal();
            }
        });
    </script>
</body>

</html>