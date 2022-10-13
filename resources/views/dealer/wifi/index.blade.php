@extends('admin.layout.app')

@section('content')
<div class="absolute right-0 w-auto z-50">

@include('admin.pages.components.errors')

</div>

<div class="flex justify-end">
    <button class="light-btn" type="button" data-modal-toggle="create-request-modal">{{__('create request')}}</button>
</div>
<div class="mx-auto px-4">
        <div class="-mx-4 sm:-mx-8 py-4 overflow-x-auto px-4">
            <div class="inline-block w-full shadow-md rounded-lg overflow-hidden pb-5">
                <table id="product-table" class="w-full leading-normal dark:text-gray-400">
                    <thead class="bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>

                            <th>
                                {{__('custommers')}}
                            </th>
                            <th>
                                {{__('requester')}}
                            </th>
                            <th>
                                {{__('discription')}}
                            </th>
                            <th>
                                {{__('status')}}
                            </th>
                            <th class="nosort"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($requests as $req )
                        <tr>

                            <td>
                                <div class="ml-3">
                                    <p class="text-color whitespace-no-wrap">
                                        {{$req->customer->name}}
                                    </p>
                                </div>
                            </td>
                            <td>
                                <p class="text-color whitespace-no-wrap">{{$req->partner->name}}</p>
                            </td>
                            <td>
                                <p class="text-color whitespace-no-wrap">{{$req->content}}</p>
                            </td>

                            <td>
                                <span
                                    class="relative inline-block px-3 py-1 font-semibold text-green-500 leading-tight">

                                    <span class="relative">{{__(config('constrain.wifi_request.'.$req->status))}}</span>
                                </span>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-right">
                                <button type="button" class="inline-block text-gray-500 hover:text-gray-700 btn-dropdown" data-dropdown-toggle="dropdown" data-dropdown-placement="left"
                                >
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
{{--
<div id="drop-down-menu" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 dark:bg-gray-700 border shadow-lg" data-target="">
    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownLeftButton">
        <li class="context-menu-item" data-status="1">

            <a href="#" class="block py-2 px-4 hover:hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-white">{{__('open')}}</a>
        </li>
        <li>
            <a href="#" class="block py-2 px-4 hover:hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-white" data-modal-toggle="edit-sim-modal">{{__('Edit')}}</a>
        </li>
        <li class="context-menu-item" data-status="0">

            <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-white">{{__('stop')}}</a>
        </li>
        <li class="context-menu-item" data-status="0">

            <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-white">{{__('Cancel')}}</a>
        </li>
        <li>
            <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-white">{{__('reset')}}</a>
        </li>
        <li class="invoice-btn">
            <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-white" data-modal-toggle="invoice-modal">{{__('bill')}}</a>
        </li>
        <li>
            <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-white" data-modal-toggle="rent-modal">{{__('rent')}}</a>
        </li>
    </ul>
</div> --}}
<div id="dropdown" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700">
    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefault">
      <li>
        <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dashboard</a>
      </li>
      <li>
        <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Settings</a>
      </li>
      <li>
        <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Earnings</a>
      </li>
      <li>
        <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Sign out</a>
      </li>
    </ul>
</div>

<div id="create-request-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-md h-full md:h-auto">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="create-request-modal">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-6 text-center">
                {{-- <svg aria-hidden="true" class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> --}}
                <h3 class="mb-5 text-lg text-gray-500 dark:text-gray-400 font-bold uppercase">{{__('create request')}}</h3>
                <div class="modal-content">
                    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center w-full" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
                            <li class="w-1/2" role="presentation">
                                <button class="inline-block p-4 rounded-t-lg border-b-2 font-semibold" id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Khách hàng cũ</button>
                            </li>
                            <li class="w-1/2" role="presentation">
                                <button class="inline-block p-4 rounded-t-lg border-b-2 font-semibold border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">Khách hàng mới</button>
                            </li>
                        </ul>
                    </div>
                    <div id="myTabContent">
                        <div class="hidden p-4 bg-gray-50 rounded-lg dark:bg-gray-700" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <form action="{{url('create-old-wifi-request')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <button id="dropdownSearchButton" class="text-field p-2 border w-full flex justify-between rounded" type="button"><span>{{__('custommers')}}</span>  <svg class="ml-2 w-4 h-4 self-center" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></button>
                                <div id="dropdownMenu">
                                    @include('admin.pages.components.search-dropdown')
                                    <input type="hidden" name="customer_id" class="user_id">
                                </div>
                                {{-- <select name="network" class="bg-gray-50 mt-3 border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-white dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected>{{__('choose network')}}</option>
                                    @foreach ($networks as $network )
                                    <option value="{{$network->id}}">{{$network->name}}</option>
                                    @endforeach

                                </select> --}}
                                <select name="wifi_package_id" class="bg-gray-50 mt-3 border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-white dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected>{{__('Choose package')}}</option>
                                    @foreach ($packages as $package )
                                    <option value="{{$package->id}}">{{$package->name}}</option>
                                    @endforeach
                                </select>
                                <input class="block w-full mt-3 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" id="file_input" type="file" accept="image/png, image/jpeg, image/jpg" name="image">
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PNG, JPG or JPEG (MAX. 800x400px).</p>
                                <textarea name="content" id="message" rows="3" class="mt-3 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{__('discription')}}..."></textarea>
                                <div class="mt-3">
                                    <button type="submit" class="btn-red">
                                        {{__('Create')}}
                                    </button>
                                    <button data-modal-toggle="create-request-modal" type="button" class="light-btn">{{__('Cancel')}}</button>
                                </div>

                            </form>

                        </div>
                        <div class="hidden p-4 bg-gray-50 rounded-lg dark:bg-gray-800" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                            <form action="{{url('create-new-wifi-request')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input name="custommer_name" type="text" class="input-field" placeholder="{{__('Full name')}}">
                                <input name="address" type="text" class="input-field mt-3" placeholder="{{__('Address')}}">
                                <input name="facebook" type="text" class="input-field mt-3" placeholder="{{__('Facebook')}}">
                                <select name="wifi_package_id" class="bg-gray-50 mt-3 border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-white dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected>{{__('Choose package')}}</option>
                                    @foreach ($packages as $package )
                                    <option value="{{$package->id}}">{{$package->name}}</option>
                                    @endforeach
                                </select>
                                <input class="block w-full text-sm text-gray-900 mt-3 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" id="file_input" type="file" accept="image/png, image/jpeg, image/jpg" name="image">
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PNG, JPG or JPEG (MAX. 800x400px).</p>
                                <textarea name="content" id="message" rows="3" class="mt-3 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{__('discription')}}..."></textarea>
                                <div class="mt-3">
                                    <button type="submit" class="btn-red">
                                        {{__('Create')}}
                                    </button>
                                    <button data-modal-toggle="create-request-modal" type="button" class="light-btn">{{__('Cancel')}}</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@stop

@section('js')

<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>
{{-- <script src="https://unpkg.com/flowbite@1.5.3/dist/datepicker.js"></script> --}}
{{-- <script src="{{asset('backend/assets/js/picker.js')}}"></script> --}}
<script src="{{asset('backend/assets/js/test.js')}}"></script>
<script>
const targetEl = document.getElementById('dropdownSearch');
const triggerEl = document.getElementById('dropdownSearchButton');
const dropdown = new Dropdown(targetEl, triggerEl);



    $(document).ready( function () {
        // myCalendar.init();
        var customers = @json($customers);
        $('#product-table').DataTable( {
            "order": [],
            "columnDefs": [ {
                'orderable': false,
                "targets": 'nosort'
                } ]
        });

        initDropdown(customers);
        $('#input-group-search').on('input', function(){
            // console.log($(this).val());
            filterMenu($(this).val(), customers);
        });
        $(document).on('click', '#dropdownSearch ul li', function(){
            let text = $(this).text();
            let value = $(this).data('id');
            $('#dropdownSearchButton span').text(text);
            $('input[name=customer_id]').val(value);
            console.log(value);
            dropdown.hide();
        });
        $(document).on('click','#dropdownSearchButton', function(){
            dropdown.show();
        });

    } );



    function initDropdown(customers){
        var ul = $('#dropdownSearch ul');
        customers.forEach(element => {
            let li = `<li class="text-left mb-2 py-2 pl-2 cursor-pointer dark:bg-gray-600 listview-bg-gray-300 rounded hover:bg-gray-200 dark:hover:bg-gray-600" data-id="${element.id}">
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
            let li = `<li class="text-left py-2 mb-2 pl-2 cursor-pointer rounded dark:bg-gray-600 listview-bg-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600" data-id="${element.id}">
                                <span  class="ml-2 w-full text-sm font-medium text-gray-900 rounded dark:text-gray-300">${element.name}</span>
                        </li>`;

            $(ul).append(li);
        });
    }



</script>
@stop
