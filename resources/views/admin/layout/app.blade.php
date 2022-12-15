<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{Session::has('darkMode') ? 'dark' : ''}}" >

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('backend/assets/img/apple-icon.png')}}" />
    <link rel="icon" type="image/png" href="{{asset('logo.jpg')}}" />
    <title>{{env('APP_NAME')}}</title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    {{-- <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script> --}}
    <!-- Nucleo Icons -->
    <link href="{{asset('backend/assets/css/nucleo-icons.css')}}" rel="stylesheet" />
    <link href="{{asset('backend/assets/css/nucleo-svg.css')}}" rel="stylesheet" />
    <!-- Popper -->
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <link rel="stylesheet" href="{{asset('backend/assets/css/argon-dashboard-tailwind.css')}}">
    <link href="{{asset('backend/plugins/fontawesome-pro/css/all.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('backend/src/styles.css')}}">
    @yield('css')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>

<body
    class="m-0 font-sans antialiased font-normal dark:bg-slate-900 text-size-base leading-default bg-gray-50 text-slate-500">
    <div class="absolute w-full bg-blue-500 dark:hidden {{request()->routeIs('admin') || request()->routeIs('dealer') ? 'min-h-75' : 'min-h-57'}} "></div>
    <!-- sidenav  -->
    <aside
        class="fixed inset-y-0 flex-wrap items-center justify-between block w-full p-0 my-4 overflow-y-auto antialiased transition-transform duration-200 -translate-x-full bg-white border-0 shadow-xl dark:shadow-none dark:bg-slate-850 max-w-64 ease-nav-brand z-10 xl:ml-6 rounded-2xl xl:left-0 xl:translate-x-0"
        aria-expanded="false">
        <div class="h-19">
            <i class="absolute top-0 right-0 p-4 opacity-50 cursor-pointer fas fa-times dark:text-white text-slate-400 xl:hidden"
                sidenav-close></i>
            <a class="block px-8 py-6 m-0 text-size-sm whitespace-nowrap dark:text-white text-slate-700"
                href="{{url('admin')}}" target="_blank">
                <img src="{{asset('logo.jpg')}}"
                    class="inline h-full max-w-full transition-all duration-200 ease-nav-brand max-h-8"
                    alt="main_logo" />
                {{-- <img src="{{asset('backend/assets/img/logo-ct.png')}}"
                    class="hidden h-full max-w-full transition-all duration-200 dark:inline ease-nav-brand max-h-8"
                    alt="main_logo" /> --}}
                <span class="ml-1 font-semibold transition-all duration-200 ease-nav-brand">{{env('APP_NAME')}}</span>
            </a>
        </div>

        <hr
            class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent" />

        <div class="items-center block w-auto max-h-screen overflow-auto grow basis-full">
            @include('admin.component.sidebar-menu')
        </div>

        {{-- <div class="mx-4">
            <!-- load phantom colors for card after: -->
            <p
                class="invisible hidden text-gray-800 text-red-500 text-red-600 text-blue-500 bg-gray-500/30 bg-cyan-500/30 bg-emerald-500/30 bg-orange-500/30 bg-red-500/30 after:bg-gradient-to-tl after:from-zinc-800 after:to-zinc-700 dark:bg-gradient-to-tl dark:from-slate-750 dark:to-gray-850 after:from-blue-700 after:to-cyan-500 after:from-orange-500 after:to-yellow-500 after:from-green-600 after:to-lime-400 after:from-red-600 after:to-orange-600 after:from-slate-600 after:to-slate-300 text-emerald-500 text-cyan-500 text-slate-400">
            </p>
            <div class="relative flex flex-col min-w-0 break-words bg-transparent border-0 shadow-none rounded-2xl bg-clip-border"
                sidenav-card>
                <img class="w-1/2 mx-auto" src="{{asset('backend/assets/img/illustrations/icon-documentation.svg')}}"
                    alt="sidebar illustrations" />
                <div class="flex-auto w-full p-4 pt-0 text-center">
                    <div class="transition-all duration-200 ease-nav-brand">
                        <h6 class="mb-0 dark:text-white text-slate-700">Need help?</h6>
                        <p class="mb-0 font-semibold leading-tight dark:text-white dark:opacity-60 text-size-xs">Please
                            check our docs</p>
                    </div>
                </div>
            </div>
            <a href="https://www.creative-tim.com/learning-lab/tailwind/html/quick-start/argon-dashboard/"
                target="_blank"
                class="inline-block w-full px-8 py-2 mb-4 font-bold leading-normal text-center text-white capitalize transition-all ease-in rounded-lg shadow-md bg-slate-700 bg-150 text-size-xs hover:shadow-xs hover:-translate-y-px">Documentation</a>
            <!-- pro btn  -->
            <!-- <a class="inline-block w-full px-8 py-2 font-bold leading-normal text-center text-white align-middle transition-all ease-in bg-blue-500 border-0 rounded-lg shadow-md select-none bg-150 bg-x-25 text-size-xs hover:shadow-xs hover:-translate-y-px" href="javascript:;">Upgrade to pro</a> -->
        </div> --}}
    </aside>

    <!-- end sidenav -->

    <main class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl">
        <!-- Navbar -->
        <nav class="flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all ease-in shadow-none duration-250 rounded-2xl lg:flex-nowrap lg:justify-start"
            navbar-main navbar-scroll="false">
            <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
                <nav>
                    <!-- breadcrumb -->
                    <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
                        <li class="leading-normal text-size-sm">
                            <a class="text-white opacity-50" href="javascript:;">Pages</a>
                        </li>
                        <li class="text-size-sm pl-2 capitalize leading-normal text-white before:float-left before:pr-2 before:text-white before:content-['/']"
                            aria-current="page">Dashboard</li>
                    </ol>
                    <h6 class="mb-0 font-bold text-white capitalize">Dashboard</h6>
                </nav>

                <div class="flex items-center mt-2 grow sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto">
                    <div class="flex items-center md:ml-auto md:pr-4">
                        <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease">

                        </div>
                    </div>
                    <ul class="flex flex-row justify-end pl-0 mb-0 list-none md-max:w-full">
                        <li class="flex items-center">
                            <i class="fa fa-user sm:mr-1 text-white"></i>
                            <span class="hidden sm:inline text-white ">{{Auth::user()->name}}</span>
                        </li>
                        <li class="flex items-center pl-4 xl:hidden">
                            <a href="javascript:;"
                                class="block p-0 text-white transition-all ease-nav-brand text-size-sm" sidenav-trigger>
                                <div class="w-4.5 overflow-hidden">
                                    <i class="ease mb-0.75 relative block h-0.5 rounded-sm bg-white transition-all"></i>
                                    <i class="ease mb-0.75 relative block h-0.5 rounded-sm bg-white transition-all"></i>
                                    <i class="ease relative block h-0.5 rounded-sm bg-white transition-all"></i>
                                </div>
                            </a>
                        </li>
                        <li class="flex items-center px-4">
                            <a href="javascript:;" class="p-0 text-white transition-all text-size-sm ease-nav-brand">
                                <i fixed-plugin-button-nav class="cursor-pointer fa fa-cog"></i>
                                <!-- fixed-plugin-button-nav  -->
                            </a>
                        </li>

                        <!-- notifications -->

                        <li class="relative flex items-center pr-2">
                            <p class="hidden transform-dropdown-show"></p>
                            <a href="javascript:;"
                                class="block p-0 text-white transition-all text-size-sm ease-nav-brand relative" dropdown-trigger
                                aria-expanded="false">
                                <i class="cursor-pointer fa fa-bell"></i>

                                    <div class="inline-flex absolute -top-2 -right-2 justify-center items-center w-5 h-5 text-xs font-bold text-white bg-red-500 rounded-full border-2 border-white dark:border-gray-900">{{Auth::user()->unreadNotifications->count()}}</div>
                            </a>

                            <ul dropdown-menu
                                class="text-size-sm transform-dropdown before:font-awesome before:leading-default before:duration-350 before:ease lg:shadow-3xl duration-250 min-w-44 before:sm:right-8 before:text-5.5 pointer-events-none absolute right-0 top-0 z-50 origin-top list-none rounded-lg border-0 border-solid border-transparent dark:shadow-dark-xl dark:bg-slate-850 bg-white bg-clip-padding px-2 py-4 text-left text-slate-500 opacity-0 transition-all before:absolute before:right-2 before:left-auto before:top-0 before:z-50 before:inline-block before:font-normal before:text-white before:antialiased before:transition-all sm:-mr-6 lg:absolute lg:right-0 lg:left-auto lg:mt-2 lg:block lg:cursor-pointer">
                                <!-- add show class on dropdown open js -->
                                @foreach (Auth::user()->notifications as  $notify)
                                <li class="relative mb-2">
                                    <div class="dark:hover:bg-slate-900 ease py-1.2 clear-both block w-full whitespace-nowrap rounded-lg bg-transparent px-4 duration-300 hover:bg-gray-200 hover:text-slate-700 lg:transition-colors"
                                        href="javascript:;">
                                        <div class="py-1">
                                            <div class="flex flex-col justify-center">
                                                <h6
                                                    class="mb-1 font-normal leading-normal dark:text-white text-size-sm">
                                                    <span class="font-semibold">Bạn nhận được lời mời tham gia đại lý</span></h6>
                                                <p
                                                    class="mb-0 leading-tight text-size-xs text-slate-400 dark:text-white/80">
                                                    <i class="mr-1 fa fa-clock"></i>
                                                    {{diffDateTime($notify->created_at)}}
                                                </p>
                                                <div class="flex justify-between mt-3">
                                                    <a href="{{url('dong-y',[$notify->data['token'], $notify->id])}}" role="button" class="btn-purple"> Đồng ý </a>
                                                    <a href="{{url('tu-choi', [$notify->data['token'] , $notify->id])}}" role="button" class="btn-yellow"> Từ chối</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @endforeach

                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- end Navbar -->

        <!-- cards -->
        <div class="w-full px-6 py-6 mx-auto">
            <!-- row 1 -->
            <div class="main-h-screen relative">
                @yield('content')

            </div>
            {{-- @dd(Auth::user()->notifications->first()->data['token']) --}}

            <footer class="pt-4">
                <div class="w-full px-6 mx-auto">
                    <div class="flex flex-wrap items-center -mx-3 lg:justify-between">
                        <div class="w-full max-w-full px-3 mt-0 mb-6 shrink-0 lg:mb-0 lg:w-1/2 lg:flex-none">
                            <div class="leading-normal text-center text-size-sm text-slate-500 lg:text-left">
                                ©
                                <script>
                                    document.write(new Date().getFullYear() + ",");
                                </script>
                                made with <i class="fa fa-heart"></i> by
                                <a href="javascript:void(0);"
                                    class="font-semibold text-slate-700 dark:text-white" target="_blank">Creative
                                    Tim</a>
                                rewire by <span class="font-semibold text-slate-700 dark:text-white">Tan Le</span>
                            </div>
                        </div>
                        {{-- <div class="w-full max-w-full px-3 mt-0 shrink-0 lg:w-1/2 lg:flex-none">
                            <ul class="flex flex-wrap justify-center pl-0 mb-0 list-none lg:justify-end">
                                <li class="nav-item">
                                    <a href="https://www.creative-tim.com"
                                        class="block px-4 pt-0 pb-1 font-normal transition-colors ease-in-out text-size-sm text-slate-500"
                                        target="_blank">Creative Tim</a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://www.creative-tim.com/presentation"
                                        class="block px-4 pt-0 pb-1 font-normal transition-colors ease-in-out text-size-sm text-slate-500"
                                        target="_blank">About Us</a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://creative-tim.com/blog"
                                        class="block px-4 pt-0 pb-1 font-normal transition-colors ease-in-out text-size-sm text-slate-500"
                                        target="_blank">Blog</a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://www.creative-tim.com/license"
                                        class="block px-4 pt-0 pb-1 pr-0 font-normal transition-colors ease-in-out text-size-sm text-slate-500"
                                        target="_blank">License</a>
                                </li>
                            </ul>
                        </div> --}}
                    </div>
                </div>
            </footer>
        </div>
        <!-- end cards -->
    </main>
    @include('admin.component.config-sidebar')
</body>
<!-- plugin for charts  -->
<script src="https://code.jquery.com/jquery-3.6.1.min.js"
    integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="{{asset('backend/assets/js/plugins/chartjs.min.js')}}" async></script>
<!-- plugin for scrollbar  -->
<script src="{{asset('backend/assets/js/perfect-scrollbar.js')}}" async></script>

<script src="{{asset('backend/assets/js/argon-dashboard-tailwind.js')}}" async></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    $(document).ready(function () {
        $(document).on('change','#swich-mode',function(){
            $.ajax({
                type: "post",
                url: "{{ url('toggle-dark-mode')}}",
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                dataType: "json",
                success: function (response) {

                }
            });

        });
        @if ($errors->any())
            var defautDuration = 5000;
            @foreach ($errors->all() as $key => $error )
                toastr.error('{{$error}}', '', {timeOut: defautDuration += 1000})
            @endforeach


        @endif

        @if (Session::has('success'))
        toastr.success('{{Session::get("success")}}', '', {
            timeOut: 5000,
        })
        @endif
    });
</script>

@yield('js')
@stack('script')

</html>
