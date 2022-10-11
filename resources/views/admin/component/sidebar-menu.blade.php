<ul class="flex flex-col pl-0 mb-0">
    @foreach (Config::get('admintemplate.menu', null) as $menu)
    @if (isset($menu['header']))

    @if (isset($menu['role']))
    @hasanyrole($menu['role'])
    <li class="w-full mt-4">
        <h6 class="pl-6 ml-2 font-bold leading-tight uppercase dark:text-white text-size-xs opacity-60">{{__($menu['header']) }}</h6>
    </li>
    @endhasanyrole
    @else
    <li class="w-full mt-4">
        <h6 class="pl-6 ml-2 font-bold leading-tight uppercase dark:text-white text-size-xs opacity-60">{{__($menu['header']) }}</h6>
    </li>
    @endif


    @else
    @if (isset($menu['role']))

    @hasanyrole($menu['role'])
    @isset($menu['can'])
    @can($menu['can'])
    <li class="mt-0.5 w-full" data-accordion="collapse">
        <div>
            <a class="py-2.7 {{(isset($menu['url']) && request()->is($menu['url'])) ? 'bg-blue-500/13' : ''}}  dark:text-white dark:opacity-80 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors" href="{{isset($menu['url']) ? url($menu['url']) : 'javascript:void(0)'}}">
                <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                  <i class="relative top-0 leading-normal text-blue-500 {{$menu['icon']}} text-size-sm"></i>
                </div>
                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">{{__($menu['text']) }}</span>
              </a>
              @if (isset($menu['sub']))
                  <ul class="flex flex-col pl-10 mb-0" >
                      @foreach ($menu['sub'] as $sub )
                        @if (isset($sub['role']))
                            @hasanyrole($sub['role'])
                            @if (isset($sub['can']))
                            @can(isset($sub['can']))
                            <li class="mt-0.5 w-full">
                                <a class="py-2.7 {{(isset($sub['url']) && request()->is($sub['url'])) ? 'bg-blue-500/13' : ''}}  dark:text-white dark:opacity-80 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors" href="{{isset($sub['url']) ? url($sub['url']) : 'javascript:void(0)'}}">
                                  <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                                    <i class="relative top-0 leading-normal text-blue-500 {{getIcon($sub)}} text-size-sm"></i>
                                  </div>
                                  <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">{{__($sub['text']) }}</span>
                                </a>
                            </li>
                            @endcan
                            @endif

                            @endhasanyrole
                        @else
                            @if (isset($sub['can']))
                                @can($sub['can'])
                                    <li class="mt-0.5 w-full">
                                        <a class="py-2.7 {{(isset($sub['url']) && request()->is($sub['url'])) ? 'bg-blue-500/13' : ''}}  dark:text-white dark:opacity-80 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors" href="{{isset($sub['url']) ? url($sub['url']) : 'javascript:void(0)'}}">
                                            <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                                            <i class="relative top-0 leading-normal text-blue-500 {{getIcon($sub)}} text-size-sm"></i>
                                            </div>
                                            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">{{__($sub['text']) }}</span>
                                        </a>
                                    </li>
                                @endcan
                            @endif

                        @endif
                      @endforeach
                  </ul>
              @endif
        </div>
    </li>
    @endcan
    @else
    <li class="mt-0.5 w-full" data-accordion="collapse">
        <div>
            <a class="py-2.7 {{(isset($menu['url']) && request()->is($menu['url'])) ? 'bg-blue-500/13' : ''}}  dark:text-white dark:opacity-80 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors" href="{{isset($menu['url']) ? url($menu['url']) : 'javascript:void(0)'}}">
                <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                  <i class="relative top-0 leading-normal text-blue-500 {{$menu['icon']}} text-size-sm"></i>
                </div>
                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">{{__($menu['text']) }}</span>
              </a>
              @if (isset($menu['sub']))
                  <ul class="flex flex-col pl-10 mb-0" >
                      @foreach ($menu['sub'] as $sub )
                        @if (isset($sub['role']))
                            @hasanyrole($sub['role'])
                            @if (isset($sub['can']))
                            @can(isset($sub['can']))
                            <li class="mt-0.5 w-full">
                                <a class="py-2.7 {{(isset($sub['url']) && request()->is($sub['url'])) ? 'bg-blue-500/13' : ''}}  dark:text-white dark:opacity-80 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors" href="{{isset($sub['url']) ? url($sub['url']) : 'javascript:void(0)'}}">
                                  <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                                    <i class="relative top-0 leading-normal text-blue-500 {{getIcon($sub)}} text-size-sm"></i>
                                  </div>
                                  <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">{{__($sub['text']) }}</span>
                                </a>
                            </li>
                            @endcan
                            @endif

                            @endhasanyrole
                        @else
                            @if (isset($sub['can']))
                                @can($sub['can'])
                                    <li class="mt-0.5 w-full">
                                        <a class="py-2.7 {{(isset($sub['url']) && request()->is($sub['url'])) ? 'bg-blue-500/13' : ''}}  dark:text-white dark:opacity-80 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors" href="{{isset($sub['url']) ? url($sub['url']) : 'javascript:void(0)'}}">
                                            <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                                            <i class="relative top-0 leading-normal text-blue-500 {{getIcon($sub)}} text-size-sm"></i>
                                            </div>
                                            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">{{__($sub['text']) }}</span>
                                        </a>
                                    </li>
                                @endcan
                            @endif

                        @endif
                      @endforeach
                  </ul>
              @endif
        </div>
    </li>
    @endisset

    @endhasanyrole
    @else
    @isset($menu['can'])
    @can($menu['can'])
    <li class="mt-0.5 w-full" data-accordion="collapse">
        <div>
            <a class="py-2.7 {{(isset($menu['url']) && request()->is($menu['url'])) ? 'bg-blue-500/13' : ''}}  dark:text-white dark:opacity-80 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors" href="{{isset($menu['url']) ? url($menu['url']) : 'javascript:void(0)'}}">
                <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                  <i class="relative top-0 leading-normal text-blue-500 {{$menu['icon']}} text-size-sm"></i>
                </div>
                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">{{__($menu['text']) }}</span>
              </a>
              @if (isset($menu['sub']))
                  <ul class="flex flex-col pl-10 mb-0" >

                      @foreach ($menu['sub'] as $sub )
                        @if (isset($sub['role']))
                            @hasanyrole($sub['role'])
                            <li class="mt-0.5 w-full">
                                <a class="py-2.7 {{(isset($sub['url']) && request()->is($sub['url'])) ? 'bg-blue-500/13' : ''}}  dark:text-white dark:opacity-80 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors" href="{{isset($sub['url']) ? url($sub['url']) : 'javascript:void(0)'}}">
                                  <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                                    <i class="relative top-0 leading-normal text-blue-500 {{getIcon($sub)}} text-size-sm"></i>
                                  </div>
                                  <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">{{__($sub['text']) }}</span>
                                </a>
                            </li>
                            @endhasanyrole
                            @else
                            <li class="mt-0.5 w-full">
                              <a class="py-2.7 {{(isset($sub['url']) && request()->is($sub['url'])) ? 'bg-blue-500/13' : ''}}  dark:text-white dark:opacity-80 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors" href="{{isset($sub['url']) ? url($sub['url']) : 'javascript:void(0)'}}">
                                <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                                  <i class="relative top-0 leading-normal text-blue-500 {{getIcon($sub)}} text-size-sm"></i>
                                </div>
                                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">{{__($sub['text']) }}</span>
                              </a>
                          </li>
                        @endif

                      @endforeach
                  </ul>

              @endif
        </div>

    </li>
    @endcan
    @else
    <li class="mt-0.5 w-full" data-accordion="collapse">
        <div>
            <a class="py-2.7 {{(isset($menu['url']) && request()->is($menu['url'])) ? 'bg-blue-500/13' : ''}}  dark:text-white dark:opacity-80 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors" href="{{isset($menu['url']) ? url($menu['url']) : 'javascript:void(0)'}}">
                <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                  <i class="relative top-0 leading-normal text-blue-500 {{$menu['icon']}} text-size-sm"></i>
                </div>
                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">{{__($menu['text']) }}</span>
              </a>
              @if (isset($menu['sub']))
                  <ul class="flex flex-col pl-10 mb-0" >
                      @foreach ($menu['sub'] as $sub )
                        @if (isset($sub['role']))
                            @hasanyrole($sub['role'])
                            <li class="mt-0.5 w-full">
                                <a class="py-2.7 {{(isset($sub['url']) && request()->is($sub['url'])) ? 'bg-blue-500/13' : ''}}  dark:text-white dark:opacity-80 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors" href="{{isset($sub['url']) ? url($sub['url']) : 'javascript:void(0)'}}">
                                  <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                                    <i class="relative top-0 leading-normal text-blue-500 {{getIcon($sub)}} text-size-sm"></i>
                                  </div>
                                  <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">{{__($sub['text']) }}</span>
                                </a>
                            </li>
                            @endhasanyrole
                            @else
                            <li class="mt-0.5 w-full">
                              <a class="py-2.7 {{(isset($sub['url']) && request()->is($sub['url'])) ? 'bg-blue-500/13' : ''}}  dark:text-white dark:opacity-80 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors" href="{{isset($sub['url']) ? url($sub['url']) : 'javascript:void(0)'}}">
                                <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                                  <i class="relative top-0 leading-normal text-blue-500 {{getIcon($sub)}} text-size-sm"></i>
                                </div>
                                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">{{__($sub['text']) }}</span>
                              </a>
                          </li>
                        @endif
                      @endforeach
                  </ul>
              @endif
        </div>

    </li>
    @endisset

    @endif
    @endif

    @endforeach

  </ul>
