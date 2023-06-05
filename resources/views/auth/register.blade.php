<html>

<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/charts.css/dist/charts.min.css">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body>
    <div class="container mx-auto p-4 ">
        <div class=" mx-auto ">
            <form class="flex flex-col mt-4 border p-5 rounded-md border-2" action="{{ route('register') }}"
                method="post">
                <h1 class="text-lg mb-5 text-center font-bold">Register</h1>
                @csrf
                @error('terms')
                    <small class="text-red-700">{{ $message }}</small>
                @enderror
                <input type="text" name="name"
                    class="px-4 py-3 w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0 text-sm"
                    placeholder="Full Name" />
                @error('name')
                    <small class="text-red-700">{{ $message }}</small>
                @enderror
                <input type="email" name="email"
                    class="px-4 py-3 mt-4 w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0 text-sm"
                    placeholder="Email address" />
                @error('email')
                    <small class="text-red-700">{{ $message }}</small>
                @enderror
                <input type="text" name="phone"
                    class="px-4 py-3 mt-4 w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0 text-sm"
                    placeholder="Phone" />
                @error('phone')
                    <small class="text-red-700">{{ $message }}</small>
                @enderror

                <select name="gender" id=""
                    class="px-4 py-3 mt-4 w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0 text-sm">
                    <option value="male">Male</option>
                    <option value="female">FeMale</option>
                </select>
                @error('gender')
                    <small class="text-red-700">{{ $message }}</small>
                @enderror
                <textarea name="address"
                    class="px-4 py-3 mt-4 w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0 text-sm"></textarea>
                <input type="password" name="password"
                    class="px-4 py-3 mt-4 w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0 text-sm"
                    placeholder=" Password" />
                @error('password')
                    <small class="text-red-700">{{ $message }}</small>
                @enderror
                <input type="password" name="password_confirmation"
                    class="px-4 py-3 mt-4 w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0 text-sm"
                    placeholder="Repeat Password" />
                <button type="submit"
                    class="mt-4 px-4 py-3  leading-6 text-base rounded-md border border-transparent text-white focus:outline-none bg-blue-500 text-blue-100 hover:text-white focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 cursor-pointer inline-flex items-center w-full justify-center items-center font-medium focus:outline-none">
                    Register
                </button>



                <div class="flex flex-col items-center mt-5">
                    <p class="mt-1 text-xs font-light text-gray-500">
                        Register already?<a href="{{ route('login') }}" class="ml-1 font-medium text-blue-400">Sign in
                            now</a>
                    </p>
                </div>
            </form>
        </div>
    </div>

</body>

</html>
