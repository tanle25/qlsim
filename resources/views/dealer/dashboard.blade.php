@extends('admin.layout.app')
@section('content')
<div class="flex flex-wrap -mx-3">
    <!-- card1 -->
    {{-- <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
        <div
            class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p
                                class="mb-0 font-sans font-semibold leading-normal uppercase dark:text-white dark:opacity-60 text-size-sm">
                                Today's Money</p>
                            <h5 class="mb-2 font-bold dark:text-white">$53,000</h5>
                            <p class="mb-0 dark:text-white dark:opacity-60">
                                <span
                                    class="font-bold leading-normal text-size-sm text-emerald-500">+55%</span>
                                since yesterday
                            </p>
                        </div>
                    </div>
                    <div class="px-3 text-right basis-1/3">
                        <div
                            class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-blue-500 to-violet-500">
                            <i class="ni ni-money-coins text-size-lg relative top-3.5 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- card2 -->
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-2 lg:w-1/3 xl:w-1/4">
        <div
            class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p
                                class="mb-0 font-sans font-semibold leading-normal uppercase dark:text-white dark:opacity-60 text-size-sm text-truncate">
                                {{__('total sim')}}</p>
                            <h5 class="mb-2 font-bold dark:text-white">{{$simCount}}</h5>
                            {{-- <a href="#" class="mb-0 dark:text-white dark:opacity-60">

                                {{__('sim manager')}}
                            </a> --}}
                        </div>
                    </div>
                    <div class="px-3 text-right basis-1/3">
                        <div
                            class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-red-600 to-orange-600">
                            {{-- <i class="ni ni-world text-size-lg relative top-3.5 text-white"></i> --}}
                            <i class="fal fa-sim-card text-size-lg relative top-3.5 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- card3 -->
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-2 lg:w-1/3 xl:w-1/4">
        <div
            class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p
                                class="mb-0 font-sans font-semibold leading-normal uppercase dark:text-white dark:opacity-60 text-size-sm text-truncate">
                                {{__('custommers')}}</p>
                            <h5 class="mb-2 font-bold dark:text-white">{{$customers}}</h5>
                        </div>
                    </div>
                    <div class="px-3 text-right basis-1/3">
                        <div
                            class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-emerald-500 to-teal-400">
                            {{-- <i class="ni ni-paper-diploma text-size-lg relative top-3.5 text-white"></i> --}}
                            <i class="fal fa-users text-size-lg relative top-3.5 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- card4 -->


    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-2 lg:w-1/3 xl:w-1/4">
        <div
            class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p
                                class="mb-0 font-sans font-semibold leading-normal uppercase dark:text-white dark:opacity-60 text-size-sm text-truncate">
                                {{__('request wifi')}}</p>
                            <h5 class="mb-2 font-bold dark:text-white">{{$wifiRequests->count()}}</h5>
                        </div>
                    </div>
                    <div class="px-3 text-right basis-1/3">
                        <div
                            class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-orange-500 to-yellow-500">
                            <i class="far fa-router text-size-lg relative top-3.5 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-2 lg:w-1/3 xl:w-1/4">
        <div
            class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p
                                class="mb-0 font-sans font-semibold leading-normal uppercase dark:text-white dark:opacity-60 text-size-sm text-truncate">
                                {{__('Contract is about to expire')}}</p>
                            <h5 class="mb-2 font-bold dark:text-white">{{$simAlerts->count()}}</h5>
                        </div>
                    </div>
                    <div class="px-3 text-right basis-1/3">
                        <div
                            class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-orange-500 to-yellow-500">
                            <i class="fal fa-file-contract text-size-lg relative top-3.5 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
</div>

<!-- cards row 2 -->
<div class="flex flex-wrap mt-6 -mx-3">
    <div class="w-full max-w-full px-3 mt-0 lg:w-7/12 lg:flex-none">
        <div
            class="border-black/12.5 dark:bg-slate-850 dark:shadow-dark-xl shadow-xl relative z-20 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
            <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid p-6 pt-4 pb-0">
                <h6 class="capitalize dark:text-white"> {{__('Sim revenue')}}</h6>

            </div>
            <div class="flex-auto p-4">
                <div>
                    <canvas id="chart-line" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="w-full max-w-full px-3 lg:w-5/12 lg:flex-none">

        <div
            class="border-black/12.5 dark:bg-slate-850 dark:shadow-dark-xl shadow-xl relative z-20 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
            <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid p-6 pt-4 pb-0">
                <h6 class="capitalize dark:text-white"> {{__('Wifi revenue')}}</h6>

            </div>
            <div class="flex-auto p-4">
                <div>
                    <canvas id="chart-line2" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- cards row 3 -->

<div class="flex flex-wrap mt-6 -mx-3">
    <div class="w-full max-w-full px-3 mt-0 mb-6 lg:mb-0 lg:w-7/12 lg:flex-none">
        <div
            class="relative flex flex-col min-w-0 break-words bg-white border-0 border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl dark:bg-gray-950 border-black-125 rounded-2xl bg-clip-border">
            <div class="p-4 pb-0 mb-0 rounded-t-4">
                <div class="flex justify-between">
                    <h6 class="mb-2 dark:text-white">{{__('Contract is about to expire')}}</h6>
                    <h6 class="dark:text-white text-sm text-blue-500"><a href="{{url('dealer/danh-sach-sim')}}">{{__('Read more')}}</a></h6>

                </div>
            </div>
            <div class="overflow-x-auto">
                {{-- <table
                    class="items-center w-full mb-4 align-top border-collapse border-gray-200 dark:border-white/40">
                    <tbody>
                        @foreach ($simAlerts->take(5) as $arlert )
                        <tr>

                            <td>
                                <div class="ml-3">
                                    <p class="text-color whitespace-no-wrap">
                                        {{$arlert->sim->phone}}
                                    </p>
                                </div>
                            </td>
                            <td>
                                <p class="text-color whitespace-no-wrap">{{$arlert->sim->iccid}}</p>
                            </td>
                            <td>
                                <p class="text-color whitespace-no-wrap">{{is_null($arlert->sim->network) ? '' : $arlert->sim->network->name}}</p>
                            </td>
                            <td>
                                <p class="text-color whitespace-no-wrap">{{ is_null($arlert->sim->partner) ? '' : $arlert->sim->partner->partner->name}}</p>
                            </td>
                            <td>
                                <p class="text-color whitespace-no-wrap">
                                    {{is_null($arlert->sim->bill) ? '' : $arlert->sim->bill->customer->name}}
                                </p>
                            </td>

                            <td>
                                <p class="text-color whitespace-no-wrap">
                                    {{$arlert->status == 2 ? \Carbon\Carbon::parse($arlert->sim->bill->end_at)->format('d/m/Y')  : '' }}
                                </p>
                            </td>

                        </tr>
                        @endforeach

                    </tbody>
                </table> --}}
            </div>
        </div>
    </div>
    <div class="w-full max-w-full px-3 mt-0 lg:w-5/12 lg:flex-none">
        <div
            class="border-black/12.5 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl relative flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
            <div class="p-4 pb-0 rounded-t-4 flex justify-between">
                <h6 class="mb-0 dark:text-white">{{__('New request wifi')}}</h6>
                <h6 class="dark:text-white text-sm text-blue-500"><a href="{{url('danh-sach-yeu-cau')}}">{{__('Read more')}}</a></h6>

            </div>
            <div class="flex-auto p-4">
                <ul class="flex flex-col pl-0 mb-0 rounded-lg">
                    @foreach ($wifiRequests as $wifi )
                    <li
                    class="relative flex justify-between py-2 pr-4 mb-2 border-0 rounded-t-lg rounded-xl text-inherit">


                    <div class="flex flex-col">
                        <h6 class="mb-1 leading-normal text-size-sm text-slate-700 dark:text-white">
                            {{$wifi->customer->name}}</h6>
                        <span class="leading-tight dark:text-white/80 text-size-xs">{{$wifi->content}}</span>
                    </div>
                    <div class="flex flex-col">
                        <h6 class="mb-1 leading-normal text-size-sm text-slate-700 dark:text-white">
                            {{$wifi->partner->name}}</h6>
                    </div>
                    <div class="flex flex-col">
                        <h6 class="mb-1 leading-normal text-size-sm text-slate-700 dark:text-white">
                            {{__(config('constrain.wifi_request.'.$wifi->status))}}</h6>
                    </div>

                    <div class="flex">
                        <button
                            class="group ease-in leading-pro text-size-xs rounded-3.5xl p-1.2 h-6.5 w-6.5 mx-0 my-auto inline-block cursor-pointer border-0 bg-transparent text-center align-middle font-bold text-slate-700 shadow-none transition-all dark:text-white"><i
                                class="ni ease-bounce text-size-2xs group-hover:translate-x-1.25 ni-bold-right transition-all duration-200"
                                aria-hidden="true"></i></button>
                    </div>
                </li>
                    @endforeach


                </ul>
            </div>
        </div>
    </div>
</div>
@stop
@section('js')
<script src="{{asset('backend/assets/js/plugins/chartjs.min.js')}}"></script>
<script>
var days = "{{\Carbon\Carbon::today()->daysInMonth}}";
var date = [ "@lang('Su')", "@lang('Mo')", "@lang('Tu')", "@lang('We')", "@lang('Th')", "@lang('Fri')","@lang('Sa')"];

var simLabel = "@lang('rent sim')";
var wifiLabel = "@lang('request wifi')";


if(document.querySelector("#chart-line")){



// var ctx1 = document.getElementById("chart-line").getContext("2d");

// var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

// gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
// gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
// gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');
// new Chart(ctx1, {
//   type: "line",
//   data: {
//     labels: date,
//     datasets: [{
//       label: simLabel,
//       tension: 0.4,
//       borderWidth: 0,
//       pointRadius: 0,
//       borderColor: "#5e72e4",
//       backgroundColor: gradientStroke1,
//       borderWidth: 3,
//       fill: true,
//       data: dataSim,
//       maxBarThickness: 6
//     }],
//   },
//   options: {
//     responsive: true,
//     maintainAspectRatio: false,
//     plugins: {
//       legend: {
//         display: false,
//       }
//     },
//     interaction: {
//       intersect: false,
//       mode: 'index',
//     },
//     scales: {
//       y: {
//         grid: {
//           drawBorder: false,
//           display: true,
//           drawOnChartArea: true,
//           drawTicks: false,
//           borderDash: [5, 5]
//         },
//         ticks: {
//           display: true,
//           padding: 10,
//           color: '#fbfbfb',
//           font: {
//             size: 11,
//             family: "Open Sans",
//             style: 'normal',
//             lineHeight: 2
//           },
//         }
//       },
//       x: {
//         grid: {
//           drawBorder: false,
//           display: false,
//           drawOnChartArea: false,
//           drawTicks: false,
//           borderDash: [5, 5]
//         },
//         ticks: {
//           display: true,
//           color: '#ccc',
//           padding: 20,
//           font: {
//             size: 11,
//             family: "Open Sans",
//             style: 'normal',
//             lineHeight: 2
//           },
//         }
//       },
//     },
//   },
// });
}


if(document.querySelector("#chart-line2")){



// var ctx1 = document.getElementById("chart-line2").getContext("2d");

// var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

// gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
// gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
// gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');
// new Chart(ctx1, {
//   type: "line",
//   data: {
//     labels: date,
//     datasets: [
//     {
//       label: wifiLabel,
//       tension: 0.4,
//       borderWidth: 0,
//       pointRadius: 0,
//       borderColor: "rgb(34 197 94)",
//       backgroundColor: gradientStroke1,
//       borderWidth: 3,
//       fill: true,
//       data: dataWifi,
//       maxBarThickness: 6
//     }],
//   },
//   options: {
//     responsive: true,
//     maintainAspectRatio: false,
//     plugins: {
//       legend: {
//         display: false,
//       }
//     },
//     interaction: {
//       intersect: false,
//       mode: 'index',
//     },
//     scales: {
//       y: {
//         grid: {
//           drawBorder: false,
//           display: true,
//           drawOnChartArea: true,
//           drawTicks: false,
//           borderDash: [5, 5]
//         },
//         ticks: {
//           display: true,
//           padding: 10,
//           color: '#fbfbfb',
//           font: {
//             size: 11,
//             family: "Open Sans",
//             style: 'normal',
//             lineHeight: 2
//           },
//         }
//       },
//       x: {
//         grid: {
//           drawBorder: false,
//           display: false,
//           drawOnChartArea: false,
//           drawTicks: false,
//           borderDash: [5, 5]
//         },
//         ticks: {
//           display: true,
//           color: '#ccc',
//           padding: 20,
//           font: {
//             size: 11,
//             family: "Open Sans",
//             style: 'normal',
//             lineHeight: 2
//           },
//         }
//       },
//     },
//   },
// });
}
</script>
@stop
