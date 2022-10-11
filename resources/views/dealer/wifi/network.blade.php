@extends('admin.layout.app')

@section('content')
<div class="absolute right-0 w-auto z-50">

@include('admin.pages.components.errors')

</div>

<div class="flex justify-end">
    <button class="light-btn" type="button" data-modal-toggle="create-request-modal">{{ __('add network')}}</button>
</div>
<div class="mx-auto px-4">
        <div class="-mx-4 sm:-mx-8 py-4 overflow-x-auto px-4">
            <div class="inline-block w-full shadow-md rounded-lg overflow-hidden pb-5">
                <table id="product-table" class="w-full leading-normal dark:text-gray-400">
                    <thead class="bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>

                            <th>
                                {{__('network')}}
                            </th>

                            <th class="nosort"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($networks as $network )
                        <tr>

                            <td>
                                <div class="ml-3">
                                    <p class="text-color whitespace-no-wrap">
                                        {{$network->name}}
                                    </p>
                                </div>
                            </td>

                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-right">
                                <button type="button" class="inline-block text-gray-500 hover:text-gray-700 btn-dropdown" data-dropdown-toggle="dropdownLeft" data-dropdown-placement="left">
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
<form action="{{url('admin/add-wifi-network')}}" method="post">
    @csrf
    <div id="create-request-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full">
        <div class="relative p-4 w-full max-w-md h-full md:h-auto">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="create-request-modal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-6 text-center">
                    {{-- <svg aria-hidden="true" class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> --}}
                    <h3 class="mb-5 text-lg text-gray-500 dark:text-gray-400 font-bold uppercase">{{__('add network')}}</h3>
                    <div class="modal-content mb-3">
                        <input type="text" class="input-field" name="name" placeholder="{{__('network name')}}">
                    </div>
                    <button type="submit" class="btn-red">
                        Yes, I'm sure
                    </button>
                    <button data-modal-toggle="create-request-modal" type="button" class="light-btn">No, cancel</button>
                </div>
            </div>
        </div>
    </div>
</form>

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
