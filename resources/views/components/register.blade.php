<!DOCTYPE html>
<html class="h-full bg-white" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    @vite('resources/css/app.css', 'resources/js/app.js')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="h-full">
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <img class="mx-auto h-10 w-auto" src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company" />
            <h2 class="mt-10 text-center text-2xl font-bold tracking-tight text-gray-900">Register your new account</h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form action="/register" method="POST" class="space-y-6">
                @csrf

                {{-- Name --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-900">Your Name</label>
                    <div class="mt-2">
                        <input type="text" name="name" id="name" autocomplete="off" value="{{ old('name')}}"
                            @class([
                                'block w-full rounded-md px-3 py-1.5 text-base text-gray-900 placeholder:text-gray-400 sm:text-sm',
                                'bg-white outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2',
                                'border border-red-500 focus:outline-red-600' => $errors->has('name'),
                                'focus:outline-indigo-600' => !$errors->has('name'),
                            ]) />
                    </div>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Username --}}
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-900">Username</label>
                    <div class="mt-2">
                        <input type="text" name="username" id="username" autocomplete="off" value="{{ old('username')}}"
                            @class([
                                'block w-full rounded-md px-3 py-1.5 text-base text-gray-900 placeholder:text-gray-400 sm:text-sm',
                                'bg-white outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2',
                                'border border-red-500 focus:outline-red-600' => $errors->has('username'),
                                'focus:outline-indigo-600' => !$errors->has('username'),
                            ]) />
                    </div>
                    @error('username')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-900">Email address</label>
                    <div class="mt-2">
                        <input type="email" name="email" id="email" autocomplete="email" value="{{ old('email')}}"
                            @class([
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

                {{-- Password --}}
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-900">Password</label>
                    <div class="mt-2">
                        <input type="password" name="password" id="password"
                            @class([
                                'block w-full rounded-md px-3 py-1.5 text-base text-gray-900 placeholder:text-gray-400 sm:text-sm',
                                'bg-white outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2',
                                'border border-red-500 focus:outline-red-600' => $errors->has('password'),
                                'focus:outline-indigo-600' => !$errors->has('password'),
                            ]) />
                    </div>
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Submit --}}
                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Register
                    </button>
                </div>

                {{-- Link --}}
                <p class="mt-10 text-center text-sm text-gray-500">
                    Already registered?
                    <a href="/login" class="font-semibold text-indigo-600 hover:text-indigo-500">Login to your account</a>
                </p>
            </form>
        </div>
    </div>
</body>

</html>
