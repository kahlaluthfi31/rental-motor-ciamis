<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Role - Sistem Penyewaan Motor</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h1 class="text-2xl font-bold text-center mb-6">Pilih Role</h1>

        <p class="mb-6 text-center">Halo {{ Auth::user()->name }}, silakan pilih role yang ingin Anda gunakan:</p>

        <form method="POST" action="{{ route('update.role') }}">
            @csrf

            <div class="mb-6">
                <div class="flex items-center mb-4 p-4 border rounded hover:bg-gray-50 cursor-pointer">
                    <input type="radio" id="penyewa" name="role" value="penyewa" class="mr-3" {{ Auth::user()->role === 'penyewa' ? 'checked' : '' }}>
                    <label for="penyewa" class="flex-1 cursor-pointer">
                        <span class="block font-semibold">Penyewa</span>
                        <span class="block text-sm text-gray-600">Menyewa motor untuk kebutuhan transportasi</span>
                    </label>
                </div>

                <div class="flex items-center mb-4 p-4 border rounded hover:bg-gray-50 cursor-pointer">
                    <input type="radio" id="pemilik" name="role" value="pemilik" class="mr-3" {{ Auth::user()->role === 'pemilik' ? 'checked' : '' }}>
                    <label for="pemilik" class="flex-1 cursor-pointer">
                        <span class="block font-semibold">Pemilik Motor</span>
                        <span class="block text-sm text-gray-600">Menitipkan motor untuk disewakan</span>
                    </label>
                </div>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">
                    Lanjutkan
                </button>
            </div>
        </form>
    </div>
</body>

</html>