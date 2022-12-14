@extends('admin.layout.app')

@section('content')
<div class="absolute right-0 w-auto z-50">

@include('admin.pages.components.errors')

</div>


<div class="mx-auto px-4">

<div class="flex justify-end">
    <a href="{{url('dealer/export-sim')}} " class="light-btn">
        {{__('Export file')}} </a>
</div>
        <div class="-mx-4 sm:-mx-8 py-4 overflow-x-auto px-4">
            <div class="inline-block w-full shadow-md rounded-lg overflow-hidden pb-5">
                <table id="product-table" class="w-full leading-normal dark:text-gray-400">
                    <thead class="bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>

                            <th>
                                {{__('phone')}}
                            </th>
                            <th>
                                {{__('iccid')}}
                            </th>
                            <th>
                                {{__('network')}}
                            </th>

                            <th>
                                {{__('Created at')}}
                            </th>

                            <th>
                                {{__('Expire date')}}
                            </th>
                            <th>
                                {{__('status')}}
                            </th>
                            <th class="nosort"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($simCards as $simCard )
                        <tr>

                            <td>
                                <div class="ml-3">
                                    <p class="text-color whitespace-no-wrap">
                                        {{$simCard->sim->phone}}
                                    </p>
                                </div>
                            </td>
                            <td>
                                <p class="text-color whitespace-no-wrap">{{$simCard->sim->iccid}}</p>
                            </td>
                            <td>
                                <p class="text-color whitespace-no-wrap">{{!is_null($simCard->sim->network) ? $simCard->sim->network->name : '' }}</p>
                            </td>
                            <td>
                                <p class="text-color whitespace-no-wrap">{{$simCard->created_at->format('d-m-Y')}}</p>
                            </td>

                            <td>
                                <p class="{{$simCard->expired->isPast() ? 'text-red-500' : ''}}">
                                    {{ $simCard->expired->format('d-m-Y')}}
                                </p>
                            </td>
                            <td>
                                <span
                                    class="relative inline-block px-3 py-1 font-semibold {{config('constrain.sim_status.'.$simCard->sim->status.'.color')}} leading-tight">

                                    <span class="relative">{{__(config('constrain.sim_status.'.$simCard->sim->status.'.text'))}}</span>
                                </span>
                            </td>

                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-right">
                                <button type="button" class="inline-block text-gray-500 hover:text-gray-700 btn-dropdown" data-dropdown-toggle="dropdownLeft" data-dropdown-placement="left"
                                data-iccid="{{$simCard->sim->iccid}}" data-status="{{$simCard->sim->status}}">
                                    <svg class="inline-block h-6 w-6 fill-current" viewBox="0 0 24 24">
                                        <path
                                            d="M12 6a2 2 0 110-4 2 2 0 010 4zm0 8a2 2 0 110-4 2 2 0 010 4zm-2 6a2 2 0 104 0 2 2 0 00-4 0z" />
                                    </svg>
                                </button>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div id="dropdownLeft" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 dark:bg-gray-700 border shadow-lg" data-target="">
    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownLeftButton">
        <li class="context-menu-item" data-status="1">
            <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-white">{{__('active')}}</a>
        </li>
        <li class="context-menu-item" data-status="4">
            <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-white">{{__('Cancel')}}</a>
        </li>
        <li class="context-menu-item" data-status="3">
            <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-white">{{__('temporarily cut')}}</a>
        </li>
        <li  class="context-menu-item" data-status="5">
            <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-white">{{__('reset')}}</a>
        </li>
        <li class="invoice-btn">
            <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-white" data-modal-toggle="invoice-modal">{{__('bill')}}</a>
        </li>
        {{-- <li id="rent-btn">
            <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-white" data-modal-toggle="rent-modal">{{__('rent')}}</a>
        </li>
        <li id="btn-extend" class="hidden">
            <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-white" data-modal-toggle="extend-modal">{{__('Extend')}}</a>
        </li> --}}
    </ul>
</div>
<div id="rent-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-md h-full md:h-auto">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="rent-modal">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-6 text-center">
                <h3 class="mb-5 text-lg font-normal  dark:text-gray-400">{{__('rent sim')}}</h3>

                <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
                        <li class="mr-2" role="presentation">
                            <button class="inline-block p-4 rounded-t-lg border-b-2 font-bold" id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">{{__('old customer')}}</button>
                        </li>
                        <li class="mr-2" role="presentation">
                            <button class="inline-block p-4 rounded-t-lg font-bold border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">{{__('new customer')}}</button>
                        </li>
                    </ul>
                </div>
                <div id="myTabContent">
                    <div class="hidden p-4 bg-gray-50 rounded-lg dark:bg-gray-800" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <form action="{{url('dealer/cho-thue-sim')}}" method="post" enctype="multipart/form-data">
                            @csrf
                        <input type="hidden" name="customer">
                        <div class="mb-3 mb">
                            <button id="dropdownSearchButton" class="text-field p-2 border w-full flex justify-between rounded" type="button"><span>{{__('custommers')}}</span>  <svg class="ml-2 w-4 h-4" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></button>
                            <div id="dropdownMenu">
                                @include('admin.pages.components.search-dropdown')
                                <input type="hidden" name="sim" class="sim-id">
                            </div>
                        </div>


                        <input class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" id="file_input" type="file" accept="image/png, image/jpeg, image/jpg" name="image">
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PNG, JPG or JPEG (MAX. 800x400px).</p>


                        <div class="modal-footer">
                            <button type="submit" class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                {{__('Done')}}
                            </button>
                            <button data-modal-toggle="rent-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">{{__('Close')}}</button>
                        </div>
                        </form>
                    </div>
                    <div class="hidden p-4 bg-gray-50 rounded-lg dark:bg-gray-800" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                        <form action="{{url('admin/khach-hang-moi-thue-sim')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="sim" class="sim-id">
                            <input name="name" type="text" class="input-field" placeholder="{{__('Full name')}}">
                            <input name="address" type="text" class="input-field mt-3" placeholder="{{__('Address')}}">
                            <input name="facebook" type="text" class="input-field mt-3" placeholder="{{__('Facebook')}}">

                            <input class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" id="file_input" type="file" accept="image/png, image/jpeg, image/jpg" name="image">
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PNG, JPG or JPEG (MAX. 800x400px).</p>
                            <div class="modal-footer">
                                <button type="submit" class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                    {{__('Done')}}
                                </button>
                                <button data-modal-toggle="rent-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">{{__('Close')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="invoice-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-md h-full md:h-auto">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="invoice-modal">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="modal-loader loader-box flex justify-center items-center">
                {{-- <button disabled type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 inline-flex items-center"> --}}
                    <svg aria-hidden="true" role="status" class="inline w-8 h-8 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                    </svg>
                {{-- </button> --}}
            </div>
            <div id="invoice-modal-body" class="p-6 text-center modal-body hidden">
                {{-- <svg aria-hidden="true" class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> --}}
                <h3 id="bill-phone" class="text-lg font-normal text-gray-700 dark:text-white">Th??ng tin ho?? ????n</h3>
                <div id="invoice-info" class="flex flex-col items-start">
                    <span class="text-sm text-gray-700 dark:text-white">T??n Kh??ch h??ng: <span id="customer-name" class="dark:text-white text-sm">ten</span> </span>
                    <span class="text-sm text-gray-700 dark:text-white">Ng??y k?? h???p ?????ng: <span id="contract-sign" class="dark:text-white text-sm">ten</span> </span>
                    <span class="text-sm text-gray-700 dark:text-white">Ng??y thanh to??n: <span id="pay-date" class="dark:text-white text-sm">ten</span> </span>
                    <span class="text-sm dark:text-white text-gray-700">Ng??y k???t th??c h???p ?????ng: <span id="bill-date" class="text-sm dark:text-white">Ngay ket thuc hop dong</span> </span>
                </div>
                <img class="w-full" src="{{asset('backend/assets/img/home-decor-1.jpg')}}" alt="" id="bill-image">
            </div>
        </div>
    </div>
</div>


<div id="extend-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-md h-full md:h-auto">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="extend-modal">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Close modal</span>
            </button>
            <form action="{{url('dealer/gia-han-hop-dong')}}" method="post" enctype="multipart/form-data">
                <div class="p-6 text-center">
                    {{-- <svg aria-hidden="true" class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> --}}
                        @csrf
                        <div>
                            <input id="extend-sim" type="hidden" name="sim_id">
                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">{{__('Extend contract')}}</h3>

                            <input class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" id="file_input" type="file" accept="image/png, image/jpeg, image/jpg" name="image">
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PNG, JPG or JPEG (MAX. 800x400px).</p>
                        </div>

                    <button type="submit" class="btn-default">
                        Yes, I'm sure
                    </button>
                    <button data-modal-toggle="extend-modal" type="button" class="light-btn">No, cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>


{{-- @include('admin.pages.components.edit-sim') --}}

<form id="status-form" action="{{url('dealer/request-status-sim')}}" method="post">
    @csrf
    <input id="status-sim-id" type="hidden" name="sim_id">
    <input type="hidden" name="status">
</form>

@stop

@section('js')

<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>

<script>
const targetEl = document.getElementById('dropdownSearch');
const triggerEl = document.getElementById('dropdownSearchButton');

const dropdown = new Dropdown(targetEl, triggerEl);



    var sim = null;

    $(document).ready( function () {
        // myCalendar.init();


        var customers = @json($customers);
        var sims = @json($simCards);
        // console.log(sims);
        $('#product-table').DataTable( {
            "order": [],
            "columnDefs": [ {
                'orderable': false,
                "targets": 'nosort'
                } ]
        });
        // initDatePicker();
        // $(document).on('click','.invoice-btn', function () {

        // });
        $(document).on('click','.invoice-btn', function (){
            const options = { weekday: 'long', year: 'numeric', month: 'numeric', day: 'numeric' };
            // console.log(sim);
            if(sim.length <= 0){
                return false
            }
            let id = sim[0].sim.id;

            $.ajax({
                type: "get",
                url: "{{url('dealer/get-bill-info')}}"+'/'+id,
                dataType: "json",

                success: function (response) {
                    var date = new Date(Date.parse(response.end_at));
                    $('#invoice-modal .modal-loader').addClass('hidden');
                    $('#invoice-modal .modal-body').removeClass('hidden');

                    if (jQuery.isEmptyObject(response)) {
                        $('#invoice-modal-body').html('<span class="py-5">no data</span>');
                    }else{
                        $('#bill-image').attr('src',`{{asset('${response.image}')}}`);
                        $('#customer-name').text(response.customer.name);
                        $('#bill-phone').text(response.modelable.phone);
                        $('#bill-date').text(new Intl.DateTimeFormat('vi-VN').format( date));
                        $('#pay-date').text(new Intl.DateTimeFormat('vi-VN').format( new Date(Date.parse(response.updated_at))));
                        $('#contract-sign').text(new Intl.DateTimeFormat('vi-VN').format( new Date(Date.parse(response.created_at))));

                    }
                }
            });
        });

        initDropdown(customers);

        $(document).on('click','.btn-dropdown', function () {
            let iccid = $(this).data('iccid');
            let status = $(this).data('status');
            var item = sims.filter(item=>item.sim.iccid==iccid);
            sim = item;
            $('#dropdownLeft').attr('data-target',item[0].sim.id);
            $('#sim-number').val(item[0].sim.phone);
            $('#iccid').val(item[0].sim.iccid);
            $('#network').val(item[0].sim.network);
            $('#sim_id').val(item[0].sim.id);
            $('.sim-id').val(item[0].sim.id);
            $('#dropdownLeft ul').attr('data-sim',item[0].sim.id);
            $('#extend-sim').val(item[0].id);
            if(status != 1){
                $('#rent-btn').addClass('hidden');
                $('#btn-extend').removeClass('hidden')
            }else{
                $('#rent-btn').removeClass('hidden');
                $('#btn-extend').addClass('hidden')
            }
        });
        $('.context-menu-item').click(function(){
            if(sim.length > 0){
                $('#status-form input[name=sim_id]').val(sim[0].id);
                $('#status-form input[name=status]').val($(this).data('status'));
                $('#status-form').submit();
            }


        });
        $(document).on('change','#import-file',function(){
            $('#import-form').submit();
        });

        $('#input-group-search').on('input', function(){
            // console.log($(this).val());
            filterMenu($(this).val(), customers);
        });
        $(document).on('click', '#dropdownSearch ul li', function(){
            let text = $(this).text();
            let value = $(this).data('id');
            $('#dropdownSearchButton span').text(text);
            $('input[name=customer]').val(value);
            dropdown.hide();
        });
        $(document).on('click','#dropdownSearchButton', function(){
            dropdown.show();
        });

    } );

    function initDropdown(customers){
        var ul = $('#dropdownSearch ul');
        customers.forEach(element => {
            let li = `<li class="text-left py-2 pl-2 cursor-pointer rounded hover:bg-gray-100 dark:hover:bg-gray-600" data-id="${element.id}">
                                <span  class="ml-2 w-full text-sm font-medium text-gray-900 rounded dark:text-gray-300">${element.name}</span>
                        </li>`;

            $(ul).append(li);
        });
    }
    function filterMenu(keyword, customers){
        var ul = $('#dropdownSearch ul');
        var expression = new RegExp(keyword, "i");
        let results = customers.filter(function(item){
            return item.name.search(expression) != -1;
        });
        $(ul).html('');
        results.forEach(element => {
            let li = `<li class="text-left py-2 pl-2 cursor-pointer rounded hover:bg-gray-100 dark:hover:bg-gray-600" data-id="${element.id}">
                                <span  class="ml-2 w-full text-sm font-medium text-gray-900 rounded dark:text-gray-300">${element.name}</span>
                        </li>`;

            $(ul).append(li);
        });
    }



</script>
@stop


