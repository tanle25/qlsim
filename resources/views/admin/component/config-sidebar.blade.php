<div fixed-plugin>
    <a fixed-plugin-button
        class="fixed px-4 py-2 bg-white shadow-lg cursor-pointer bottom-8 right-8 text-size-xl z-990 rounded-circle text-slate-700">
        <i class="py-2 pointer-events-none fa fa-cog"> </i>
    </a>
    <!-- -right-90 in loc de 0-->
    <div fixed-plugin-card
        class="z-sticky backdrop-blur-2xl backdrop-saturate-200 dark:bg-slate-850/80 shadow-3xl w-90 ease -right-90 fixed top-0 left-auto flex h-full min-w-0 flex-col break-words rounded-none border-0 bg-white/80 bg-clip-border px-2.5 duration-200">

        <div class="px-6 pt-4 pb-0 mb-0 border-b-0 rounded-t-2xl">
            <div class="float-left">
                <h5 class="mt-4 mb-0 dark:text-white">{{__('message.settings.display')}}</h5>
                <p class="dark:text-white dark:opacity-80">{{__('message.settings.description')}}</p>
            </div>
            <div class="float-right mt-6">
                <button fixed-plugin-close-button
                    class="inline-block p-0 mb-4 font-bold leading-normal text-center uppercase align-middle transition-all ease-in bg-transparent border-0 rounded-lg shadow-none cursor-pointer hover:-translate-y-px text-size-sm tracking-tight-rem bg-150 bg-x-25 active:opacity-85 dark:text-white text-slate-700">
                    <i class="fa fa-close"></i>
                </button>
            </div>
            <!-- End Toggle Button -->
        </div>
        <hr
            class="h-px mx-0 my-1 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent" />
        <div class="flex-auto p-6 pt-0 overflow-auto sm:pt-4">

            <div class="mt-4">
                <h6 class="mb-0 dark:text-white">{{__('message.settings.side_style')}}</h6>
                <p class="leading-normal dark:text-white dark:opacity-80 text-size-sm">{{__('message.settings.side_des')}}</p>
            </div>
            <div class="flex">
                <button transparent-style-btn
                    class="inline-block w-full px-4 py-2.5 mb-2 font-bold leading-normal text-center text-white capitalize align-middle transition-all bg-blue-500 border border-transparent border-solid rounded-lg cursor-pointer text-size-sm xl-max:cursor-not-allowed xl-max:opacity-65 xl-max:pointer-events-none xl-max:bg-gradient-to-tl xl-max:from-blue-500 xl-max:to-violet-500 xl-max:text-white xl-max:border-0 hover:-translate-y-px dark:cursor-not-allowed dark:opacity-65 dark:pointer-events-none dark:bg-gradient-to-tl dark:from-blue-500 dark:to-violet-500 dark:text-white dark:border-0 hover:shadow-xs active:opacity-85 ease-in tracking-tight-rem shadow-md bg-150 bg-x-25 bg-gradient-to-tl from-blue-500 to-violet-500 hover:border-blue-500"
                    data-class="bg-transparent" active-style>{{__('message.settings.side_mode.white')}}</button>
                <button white-style-btn
                    class="inline-block w-full px-4 py-2.5 mb-2 ml-2 font-bold leading-normal text-center text-blue-500 capitalize align-middle transition-all bg-transparent border border-blue-500 border-solid rounded-lg cursor-pointer text-size-sm xl-max:cursor-not-allowed xl-max:opacity-65 xl-max:pointer-events-none xl-max:bg-gradient-to-tl xl-max:from-blue-500 xl-max:to-violet-500 xl-max:text-white xl-max:border-0 hover:-translate-y-px dark:cursor-not-allowed dark:opacity-65 dark:pointer-events-none dark:bg-gradient-to-tl dark:from-blue-500 dark:to-violet-500 dark:text-white dark:border-0 hover:shadow-xs active:opacity-85 ease-in tracking-tight-rem shadow-md bg-150 bg-x-25 bg-none hover:border-blue-500"
                    data-class="bg-white">{{__('message.settings.side_mode.dark')}}</button>
            </div>

            {{-- Lang --}}
            <div class="mt-4">
                <h6 class="mb-0 dark:text-white">{{__('message.lang')}}</h6>
            </div>
            <div class="flex">
                <a href="{{url('change-lang/vi')}}"
                    class="inline-block w-full px-4 py-2.5 mb-2 ml-2 font-bold leading-normal text-center text-blue-500 capitalize align-middle transition-all bg-transparent border border-blue-500 border-solid rounded-lg cursor-pointer text-size-sm xl-max:cursor-not-allowed xl-max:opacity-65 xl-max:pointer-events-none xl-max:bg-gradient-to-tl xl-max:from-blue-500 xl-max:to-violet-500 xl-max:text-white xl-max:border-0 hover:-translate-y-px dark:text-white hover:shadow-xs active:opacity-85 ease-in tracking-tight-rem shadow-md bg-150 bg-x-25 bg-none hover:border-blue-500 dark:border-white {{app()->getLocale() == 'vi' ? 'active-btn' : ''}}"
                    data-class="bg-transparent">Tiếng việt</a>
                <a href="{{url('change-lang/jp')}}"
                    class="inline-block w-full px-4 py-2.5 mb-2 ml-2 font-bold leading-normal text-center text-blue-500 capitalize align-middle transition-all bg-transparent border border-blue-500 border-solid rounded-lg cursor-pointer text-size-sm xl-max:cursor-not-allowed xl-max:opacity-65 xl-max:pointer-events-none xl-max:bg-gradient-to-tl xl-max:from-blue-500 xl-max:to-violet-500 xl-max:text-white xl-max:border-0 hover:-translate-y-px dark:text-white hover:shadow-xs active:opacity-85 ease-in tracking-tight-rem shadow-md bg-150 bg-x-25 bg-none hover:border-blue-500 dark:border-white {{app()->getLocale() == 'jp' ? 'active-btn' : ''}}"
                    data-class="bg-white">日本</a>
            </div>
            <!-- Navbar Fixed -->
            <div class="flex my-4">
                <h6 class="mb-0 dark:text-white">Navbar Fixed</h6>
                <div class="block pl-0 ml-auto min-h-6">
                    <input navbarFixed
                        class="rounded-10 duration-250 ease-in-out after:rounded-circle after:shadow-2xl after:duration-250 checked:after:translate-x-5.3 h-5-em relative float-left mt-1 ml-auto w-10 cursor-pointer appearance-none border border-solid border-gray-200 bg-slate-800/10 bg-none bg-contain bg-left bg-no-repeat align-top transition-all after:absolute after:top-px after:h-4 after:w-4 after:translate-x-px after:bg-white after:content-[''] checked:border-blue-500/95 checked:bg-blue-500/95 checked:bg-none checked:bg-right"
                        type="checkbox" />
                </div>
            </div>
            <hr
                class="h-px my-6 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent " />
            <div class="flex mt-2 mb-12">
                <h6 class="mb-0 dark:text-white">{{__('message.settings.dark_mode')}}</h6>
                <div class="block pl-0 ml-auto min-h-6">
                    <input dark-toggle id="swich-mode"
                        class="rounded-10 duration-250 ease-in-out after:rounded-circle after:shadow-2xl after:duration-250 checked:after:translate-x-5.3 h-5-em relative float-left mt-1 ml-auto w-10 cursor-pointer appearance-none border border-solid border-gray-200 bg-slate-800/10 bg-none bg-contain bg-left bg-no-repeat align-top transition-all after:absolute after:top-px after:h-4 after:w-4 after:translate-x-px after:bg-white after:content-[''] checked:border-blue-500/95 checked:bg-blue-500/95 checked:bg-none checked:bg-right"
                        type="checkbox" {{Session::has('darkMode') ? 'checked' : ''}}/>
                </div>
            </div>
        </div>
        <div class="pb-5 text-center">

             <form  action="{{url('logout')}}" method="post">
                @csrf
                <button type="submit" class="btn-red font-semibold"><i class="fal fa-sign-out-alt text-white"></i> Logout</button>
             </form>
        </div>
    </div>
</div>
