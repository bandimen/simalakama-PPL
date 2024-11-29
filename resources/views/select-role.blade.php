<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <title>Pilih Role</title>
</head>

<body>

    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                <img class="w-8 h-8 mr-2" src="images/logo-undip.png" alt="logo">
                SIMALAKAMA Undip    
            </a>
            <div class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 dark:bg-gray-800 dark:border-gray-700">
                <h5 class="mb-3 text-base font-semibold text-gray-900 md:text-xl dark:text-white">
                    Pilih Role
                </h5>
                <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Anda akan diarahkan ke halaman sesuai dengan role yang Anda pilih.</p>
                
                <form action="{{ route('selectRole') }}" method="POST">
                    @csrf
                    <ul class="my-4 space-y-3">
                        @foreach ($roles as $role)
                            <li>
                                <!-- Gunakan peer pada input radio -->
                                <input type="radio" name="role" value="{{ $role->name }}" id="role-{{ $role->name }}" class="hidden peer" required>
                                <label for="role-{{ $role->name }}" 
                                       class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 peer-checked:bg-blue-500 peer-checked:text-white transition">
                                    <span class="flex-1 ms-3 whitespace-nowrap">{{ ucfirst($role->name) }}</span>
                                </label>
                            </li>
                        @endforeach
                    </ul>
                    <button type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Lanjutkan</button>
                </form>
                

            </div>

        </div>
    </section>

</body>

</html>