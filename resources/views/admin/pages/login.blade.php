
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="{{asset('backend/assets/img/laravel-logo.png')}}" />
    <title>Login</title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/index.min.css" />
    <link rel="stylesheet" href="{{asset('backend/plugins/fontawesome-pro/css/all.min.css')}}">
    <script src="https://cdn.tailwindcss.com"></script>
  </head>

  <body class="m-0 font-sans antialiased font-normal bg-white text-start text-size-base leading-default text-slate-500">
    <!-- Navbar -->


    <main class="mt-0 transition-all duration-200 ease-in-out bg-gray-200">
        <div class="bg-gradient-to-tr from-green-300 to-green-600 h-screen w-full flex justify-center items-center">
            <div class="bg-green-600 w-full sm:w-1/2 md:w-9/12 lg:w-1/2 shadow-md flex flex-col md:flex-row items-center mx-5 sm:m-0 rounded my-5">
              <div class="w-full md:w-1/2 hidden md:flex flex-col justify-center items-center text-white">
                <h1 class="text-3xl">Hello</h1>
                <p class="text-5xl font-extrabold">Welcome!</p>
              </div>
              <div class="bg-white w-full md:w-1/2 flex flex-col items-center py-10 px-8  justify-center">
                <h3 class="text-3xl font-bold text-green-500 mb-4">
                  LOGIN
                </h3>
                <span>message</span>
                <form method="POST" action="{{ route('login') }}" class="w-full flex flex-col justify-center">
                    @csrf

                  <div class="mb-4">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <input type="email" placeholder="Email" name="email" class="w-full p-3 rounded border placeholder-gray-400 focus:outline-none focus:border-green-600" />
                  </div>
                  <div class="mb-4">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <input type="password" placeholder="Password" name="password" required autocomplete="current-password" class="w-full p-3 rounded border placeholder-gray-400 focus:outline-none focus:border-green-600" />
                  </div>
                  <div class="flex items-center space-x-2 mb-2">
                    <input
                      type="checkbox"
                      id="remember"
                      class="w-4 h-4 transition duration-300 rounded focus:ring-2 focus:ring-offset-0 focus:outline-none focus:ring-blue-200"
                    />
                    <label for="remember" class="text-sm font-semibold text-gray-500">Remember me</label>
                    <div class="flex justify-between">
                        <a href="">Quên mật khẩu?</a>
                        <a href="">Chưa có tài khoản?</a>
                    </div>
                  </div>
                  <button type="submit" class="mb-2 w-full inline-block px-6 py-3 bg-blue-600 text-white font-bold  leading-normal uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Login</button>
                  <div class="flex flex-col space-y-5">
                    <span class="flex items-center justify-center space-x-2">
                      <span class="h-px bg-gray-400 w-14"></span>
                      <span class="font-normal text-gray-500">or login with</span>
                      <span class="h-px bg-gray-400 w-14"></span>
                    </span>
                    <div class="flex flex-col space-y-4">
                      <a
                        href="#"
                        class="flex items-center justify-center px-4 py-2 space-x-2 transition-colors duration-300 border border-blue-500 rounded-md group hover:bg-blue-500 focus:outline-none"
                      >
                          <i class="fab fa-facebook text-blue-500 group-hover:text-white text-xl"></i>
                        {{-- </span> --}}
                        <span class="text-sm font-medium text-gray-800 group-hover:text-white">Facebook</span>
                      </a>
                      <a
                        href="#"
                        class="flex items-center justify-center px-4 py-2 space-x-2 transition-colors duration-300 border border-blue-500 rounded-md group hover:bg-blue-500 focus:outline-none"
                      >
                        <span>
                          <svg class="text-blue-500 group-hover:text-white" width="20" height="20" fill="currentColor">
                            <path
                              d="M6.29 18.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0020 3.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.073 4.073 0 01.8 7.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 010 16.407a11.616 11.616 0 006.29 1.84"
                            ></path>
                          </svg>
                        </span>
                        <span class="text-sm font-medium text-blue-500 group-hover:text-white">Twitter</span>
                      </a>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
    </main>
  </body>
  <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script>
</html>
