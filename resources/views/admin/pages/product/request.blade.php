@extends('admin.layout.app')

@section('content')
<div class="absolute right-0 w-auto z-50">

@include('admin.pages.components.errors')

</div>

<div class="mb-4 border-b border-gray-200 dark:border-gray-700">
    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
        <li class="mr-2" role="presentation">
            <button class="inline-block p-4 rounded-t-lg border-b-2" id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false"><span class="font-bold uppercase">{{__('Request sim')}}</span> </button>
        </li>
        <li class="mr-2" role="presentation">
            <button class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false"> <span class="text-base uppercase">{{__('Request status change')}}</span></button>
        </li>
    </ul>
</div>

<div id="myTabContent">
    <div class="hidden p-4 bg-gray-50 rounded-lg dark:bg-gray-800" id="profile" role="tabpanel" aria-labelledby="profile-tab">

<div class="mx-auto px-4">
    <div class="-mx-4 sm:-mx-8 py-4 overflow-x-auto px-4">
        <div class="inline-block w-full shadow-md rounded-lg overflow-hidden pb-5">
            <table id="product-table" class="w-full leading-normal dark:text-gray-400">
                <thead class="bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th class="nosort">

                        </th>
                        <th>
                            {{__('phone')}}
                        </th>
                        <th>
                            {{__('requester')}}
                        </th>
                        <th>
                            {{__('ICCID')}}
                        </th>
                        <th>
                            {{__('network')}}
                        </th>
                        <th class="nosort"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($requestest as $resquested )
                    <tr>
                        <td>
                            <input form="request-form" type="checkbox" name="sims[]" class="input-checkbox w-5 h-5" value="{{$resquested->id}}">
                        </td>
                        <td>
                            <div class="ml-3">
                                <p class="text-color whitespace-no-wrap">
                                    {{$resquested->sim->phone}}
                                </p>
                            </div>
                        </td>

                        <td>
                            <p class="text-color whitespace-no-wrap">{{$resquested->partner->name}}</p>
                        </td>

                        <td>
                            <p class="text-color whitespace-no-wrap">{{$resquested->sim->iccid}}</p>
                        </td>
                        <td>
                            <p class="text-color whitespace-no-wrap"> {{$resquested->sim->network->name}}</a></p>
                        </td>

                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-right">
                            <button type="button" class="inline-block text-gray-500 hover:text-gray-700 btn-dropdown" data-dropdown-toggle="dropdownLeft" data-dropdown-placement="left"
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
    <div class="hidden p-4 bg-gray-50 rounded-lg dark:bg-gray-800" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
        <div class="inline-block w-full shadow-md rounded-lg overflow-hidden pb-5">
            <table id="request-table" class="w-full leading-normal dark:text-gray-400">
                <thead class="bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>

                        <th>
                            {{__('phone')}}
                        </th>
                        <th>
                            {{__('ICCID')}}
                        </th>
                        <th>
                            {{__('requester')}}
                        </th>
                        <th>
                            {{__('Created at')}}
                        </th>
                        <th>
                            {{__('status')}}
                        </th>
                        <th>
                            {{__('request')}}
                        </th>
                        <th class="nosort"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($statusRequest as $resquested )
                    <tr>

                        <td>
                            <div class="ml-3">
                                <p class="text-color whitespace-no-wrap">
                                    {{$resquested->sim->phone}}
                                </p>
                            </div>
                        </td>
                        <td>
                            <p class="text-color whitespace-no-wrap">{{$resquested->sim->iccid}}</p>
                        </td>
                        <td>
                            <p class="text-color whitespace-no-wrap">{{$resquested->partner->name}}</p>
                        </td>
                        <td>
                            <p class="text-color whitespace-no-wrap">{{$resquested->created_at->format('d-m-Y H:i:s')}}</p>
                        </td>
                        <td>
                            <p class="text-color whitespace-no-wrap">{{__($resquested->status ? 'Done' : '')}}</p>
                        </td>
                        <td>
                            <p class="text-color whitespace-no-wrap"> {{__(config("constrain.sim_status.$resquested->status.text"))  }}</a></p>
                        </td>

                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-right">
                            <a href="{{url('admin/xac-nhan-yeu-cau',$resquested->id)}}" class="py-2 px-4 text-sm font-medium text-gray-900 bg-white rounded-l-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white">
                                OK
                            </a>

                            <a href="{{url('admin/xoa-yeu-cau', $resquested->id)}}" class="py-2 px-4 text-sm font-medium text-gray-900 bg-white rounded-r-md border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white">
                            {{__('refuse')}}
                            </a>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


<template id="btn-template">
    <button id="btn-request" type="button" class="light-btn" data-modal-toggle="popup-modal">{{__('accept / refuse')}}</button>
</template>

<div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-md h-full md:h-auto">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="popup-modal">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-6 text-center">
                <form id="request-form" action="{{url('admin/reply-request')}}" method="post">
                    @csrf
                    {{-- <svg aria-hidden="true" class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> --}}
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">{{__('reply to request')}}</h3>
                    <select name="reply" class="bg-gray-50 border mb-3 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="1" selected>{{__('refuse')}}</option>
                        <option value="2">{{__('accept')}}</option>
                    </select>
                    <button  type="submit" class="btn-red">
                        {{__('accept')}}
                    </button>
                    <button data-modal-toggle="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">{{__('Cancel')}}</button>
                </form>

            </div>
        </div>
    </div>
</div>


@stop

@section('js')

<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>
{{-- <script src="https://unpkg.com/flowbite@1.5.3/dist/datepicker.js"></script> --}}

<script>


    // $(document).ready( function () {
        // myCalendar.init();
        $('#product-table').DataTable( {
            "order": [],
            "columnDefs": [ {
                'orderable': false,
                "targets": 'nosort'
                } ]
        });

        $('#request-table').DataTable( {
            "order": [],
            "columnDefs": [ {
                'orderable': false,
                "targets": 'nosort'
                } ]
        });

        var temp = document.getElementById('btn-template');
        var button = temp.content.cloneNode(true);
        $('#product-table_filter').addClass('flex');
        $('#product-table_filter').append(button)
        $('#btn-request').css({margin:0, 'margin-left':10});

    // } );
</script>
@stop
