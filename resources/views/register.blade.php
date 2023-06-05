{{-- <html>

<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/charts.css/dist/charts.min.css">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body>
    <div class="container mx-auto p-4  flex items-center justify-center">
        <div class=" flex justify-center justify-self-center">
            <form class="flex flex-col mt-4 border p-5 rounded-md border-2" action="{{ route('register') }}"
                method="post">
                <h1 class="text-lg mb-5 text-center font-bold">Register</h1>
                @csrf
                <textarea type="text"
                    class="w-full p-6 border border-gray-300 rounded-md placeholder:font-sans placeholder:font-light"
                    placeholder="Enter your email address" />
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

</html> --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
        href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700&family=Rokkitt:wght@600;700&display=swap"
        rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                fontFamily: {
                    sans: ['Mulish', 'sans-serif'],
                    mono: ['Rokkitt', 'monospace'],
                },
            },
        }
    </script>
    <title>Register Page</title>
</head>

<body>
    <!-- Global Container -->
    <div class="flex items-center justify-center min-h-screen bg-blue-400">
        <!-- Card Container -->
        <div
            class="relative flex flex-col m-6 space-y-10 bg-white shadow-2xl rounded-2xl md:flex-row md:space-y-0 md:m-0">
            <!-- Left Side -->
            <div class="p-6 md:p-20">
                <!-- Top Content -->
                <h2 class="font-mono mb-5 text-4xl font-bold">Register</h2>
                <p class="max-w-sm mb-12 font-sans font-light text-gray-600">
                    register in to your account to manage products and manage users orders
                </p>
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <input type="text" name="role" value="admin" readonly
                            class="w-full p-6 border border-gray-300 rounded-md placeholder:font-sans placeholder:font-light"
                            placeholder="Enter your name" />


                    </div>
                    <div class="mb-4">
                        <input type="text" name="name"
                            class="w-full p-6 border border-gray-300 rounded-md placeholder:font-sans placeholder:font-light"
                            placeholder="Enter your name" />
                        @error('name')
                            <small class="text-red-700">{{ $message }}</small>
                        @enderror

                    </div>

                    <div class="mb-4">
                        <input type="email" name="email"
                            class="w-full p-6 border border-gray-300 rounded-md placeholder:font-sans placeholder:font-light"
                            placeholder="Enter your email address" />
                        @error('email')
                            <small class="text-red-700">{{ $message }}</small>
                        @enderror

                    </div>
                    <div class="mb-4">
                        <input type="number" name="phone"
                            class="w-full p-6 border border-gray-300 rounded-md placeholder:font-sans placeholder:font-light"
                            placeholder="Enter your phone " />
                        @error('phone')
                            <small class="text-red-700">{{ $message }}</small>
                        @enderror

                    </div>
                    <div class="mb-4">
                        <select name="gender"
                            class="w-full p-6 border border-gray-300 rounded-md placeholder:font-sans placeholder:font-light"
                            id="">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                        @error('gender')
                            <small class="text-red-700">{{ $message }}</small>
                        @enderror

                    </div>
                    <div class="mb-4">
                        <textarea name="address" placeholder="enter address"
                            class="w-full p-6 border border-gray-300 rounded-md placeholder:font-sans placeholder:font-light" id=""></textarea>
                        @error('address')
                            <small class="text-red-700">{{ $message }}</small>
                        @enderror

                    </div>
                    <div class="mb-4">
                        <input type="password" name="password"
                            class="w-full p-6 border border-gray-300 rounded-md placeholder:font-sans placeholder:font-light"
                            placeholder="Enter password " />
                        @error('password')
                            <small class="text-red-700">{{ $message }}</small>
                        @enderror

                    </div>
                    <div class="mb-4">
                        <input type="password" name="password_confirmation"
                            class="w-full p-6 border border-gray-300 rounded-md placeholder:font-sans placeholder:font-light"
                            placeholder="Enter password " />


                    </div>
                    <div class="flex flex-col items-center justify-between mt-6 space-y-6 md:flex-row md:space-y-0">
                        <a href="{{ route('login') }}" class="font-thin text-cyan-700">Login</a>


                        <button type="submit"
                            class="w-full md:w-auto flex justify-center items-center p-6 space-x-4 font-sans font-bold text-white rounded-md shadow-lg px-9 bg-cyan-700 shadow-cyan-100 hover:bg-opacity-90 shadow-sm hover:shadow-lg border transition hover:-translate-y-0.5 duration-150">
                            <span>Next</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <line x1="5" y1="12" x2="19" y2="12" />
                                <line x1="13" y1="18" x2="19" y2="12" />
                                <line x1="13" y1="6" x2="19" y2="12" />
                            </svg>
                        </button>
                    </div>
                </form>

                <!-- Middle Content -->


                <!-- Border -->
                {{-- <div class="mt-12 border-b border-b-gray-300"></div> --}}

                <!-- Bottom Content -->
                {{-- <p class="py-6 text-sm font-thin text-center text-gray-400">
                    or log in with
                </p> --}}

                <!-- Bottom Buttons Container -->
                {{-- <div class="flex flex-col space-x-0 space-y-6 md:flex-row md:space-x-4 md:space-y-0">
                    <button
                        class="flex items-center justify-center py-2 space-x-3 border border-gray-300 rounded shadow-sm hover:bg-opacity-30 hover:shadow-lg hover:-translate-y-0.5 transition duration-150 md:w-1/2">
                        <img src="images/facebook.png" alt="" class="w-9" />
                        <span class="font-thin">Facebook</span>
                    </button>
                    <button
                        class="flex items-center justify-center py-2 space-x-3 border border-gray-300 rounded shadow-sm hover:bg-opacity-30 hover:shadow-lg hover:-translate-y-0.5 transition duration-150 md:w-1/2">
                        <img src="images/google.png" alt="" class="w-9" />
                        <span class="font-thin">Google</span>
                    </button>
                </div> --}}
            </div>

            <!-- Right Side -->


            <!-- Close Button -->
            {{-- <div
                class="group absolute -top-5 right-4 flex items-center justify-center w-10 h-10 bg-gray-200 rounded-full md:bg-white md:top-4 hover:cursor-pointer hover:-translate-y-0.5 transition duration-150">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-black group-hover:text-gray-600"
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
            </div> --}}
        </div>
    </div>
</body>

</html>
