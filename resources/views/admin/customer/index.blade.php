@extends('admin.layout.app')

@section('content')
<div class="absolute right-0 w-auto z-50">

@include('admin.pages.components.errors')

</div>

<div class="mx-auto px-4">
        <div class="-mx-4 sm:-mx-8 py-4 overflow-x-auto px-4">
            <div class="inline-block w-full shadow-md rounded-lg overflow-hidden pb-5">
                <table id="product-table" class="w-full leading-normal dark:text-gray-400">
                    <thead class="bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>

                            <th>
                                {{__('Full name')}}
                            </th>
                            <th>
                                {{__('Address')}}
                            </th>
                            <th>
                                {{__('Facebook')}}
                            </th>
                            {{-- <th class="nosort"></th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $customer )
                        <tr>

                            <td>
                                <div class="ml-3">
                                    <p class="text-color whitespace-no-wrap">
                                        {{$customer->name}}
                                    </p>
                                </div>
                            </td>
                            <td>
                                <p class="text-color whitespace-no-wrap">{{$customer->address}}</p>
                            </td>
                            <td>
                                <p class="text-color whitespace-no-wrap"><a class="text-blue-500 font-medium hover:font-normal hover:text-blue-400" href="{{$customer->facebook}}" target="_blank" rel="noopener noreferrer"> {{$customer->facebook}}</a></p>
                            </td>

                            {{-- <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-right">
                                <button type="button" class="inline-block text-gray-500 hover:text-gray-700 btn-dropdown" data-dropdown-toggle="dropdownLeft" data-dropdown-placement="left"
                                >
                                    <svg class="inline-block h-6 w-6 fill-current" viewBox="0 0 24 24">
                                        <path
                                            d="M12 6a2 2 0 110-4 2 2 0 010 4zm0 8a2 2 0 110-4 2 2 0 010 4zm-2 6a2 2 0 104 0 2 2 0 00-4 0z" />
                                    </svg>
                                </button>

                            </td> --}}
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- <div id="dropdownLeft" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 dark:bg-gray-700 border shadow-lg" data-target="">
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
        $('#product-table').DataTable( {
            "order": [],
            "columnDefs": [ {
                'orderable': false,
                "targets": 'nosort'
                } ]
        });



    } );





</script>
@stop
