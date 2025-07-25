<!DOCTYPE html>
<html class="h-full bg-white" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Login</title>
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    @vite('resources/css/app.css', 'resources/js/app.js')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="h-full">
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">

            {{-- Alert sukses --}}
            @if (session()->has('success'))
                <div x-data="{ show: true }" x-show="show" x-transition
                    class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 relative" role="alert">
                    <div class="flex justify-between items-start">
                        <div>
                            <span class="font-medium">Success alert!</span> {{ session('success') }}
                        </div>
                        <button @click="show = false" type="button"
                            class="text-green-800 hover:text-green-900 rounded-lg text-sm p-1.5 ml-2 inline-flex items-center"
                            aria-label="Close">
                            &times;
                        </button>
                    </div>
                </div>
            @endif
            @if (session()->has('loginError'))
                <div x-data="{ show: true }" x-show="show" x-transition
                    class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 relative" role="alert">
                    <div class="flex justify-between items-start">
                        <div>
                            <span class="font-medium">Login failed!</span> {{ session('loginError') }}
                        </div>
                        <button @click="show = false" type="button"
                            class="text-red-800 hover:text-red-900 rounded-lg text-sm p-1.5 ml-2 inline-flex items-center"
                            aria-label="Close">
                            &times;
                        </button>
                    </div>
                </div>
            @endif


            <img class="mx-auto h-10 w-auto"
                src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600"
                alt="Your Company" />
            <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Login to your account</h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="/login" method="POST">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-900">Email address</label>
                    <div class="mt-2">
                        <input type="email" name="email" id="email" autocomplete="off"
                            value="{{ old('email') }}" @class([
                                'block w-full rounded-md px-3 py-1.5 text-base text-gray-900 placeholder:text-gray-400 sm:text-sm',
                                'bg-white outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2',
                                'border border-red-500 focus:outline-red-600' => $errors->has('email'),
                                'focus:outline-indigo-600' => !$errors->has('email'),
                            ]) />
                    </div>
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>


                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
                        <div class="text-sm">
                            <a href="#" class="font-semibold text-indigo-600 hover:text-indigo-500">Forgot
                                password?</a>
                        </div>
                    </div>
                    <div class="mt-2">
                        <input type="password" name="password" id="password" autocomplete="current-password" required
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 placeholder:text-gray-400 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Login
                    </button>
                </div>
            </form>

            <p class="mt-10 text-center text-sm/6 text-gray-500">
                Don't have an account?
                <a href="/register" class="font-semibold text-indigo-600 hover:text-indigo-500">Make a new one</a>
            </p>
        </div>
    </div>
</body>

</html>
