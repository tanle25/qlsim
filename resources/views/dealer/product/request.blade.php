@extends('admin.layout.app')

@section('content')
<div class="absolute right-0 w-auto z-50">

@include('admin.pages.components.errors')

</div>

<div class="mb-4 border-b border-gray-200 dark:border-gray-700">
    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
        <li class="mr-2" role="presentation">
            <button class="inline-block p-4 rounded-t-lg border-b-2 font-extrabold uppercase" id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">{{__('no request')}}</button>
        </li>
        <li class="mr-2" role="presentation">
            <button class="inline-block p-4  font-extrabold uppercase rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">{{__('requested')}}</button>
        </li>
    </ul>
</div>
{{-- @dd($requestest) --}}

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
                                        {{__('ICCID')}}
                                    </th>
                                    <th>
                                        {{__('network')}}
                                    </th>
                                    <th class="nosort"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($all as $sim )
                                <tr>
                                    <td>
                                        <input form="send-request" type="checkbox" name="sims[]" class="input-checkbox w-5 h-5" value="{{$sim->id}}">
                                    </td>
                                    <td>
                                        <div class="ml-3">
                                            <p class="text-color whitespace-no-wrap">
                                                {{$sim->phone}}
                                            </p>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-color whitespace-no-wrap">{{$sim->iccid}}</p>
                                    </td>
                                    <td>
                                        <p class="text-color whitespace-no-wrap">{{$sim->network->name}}</a></p>
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

    </div>
    <div class="hidden p-4 bg-gray-50 rounded-lg dark:bg-gray-800" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
        <div class="mx-auto px-4">
            <div class="-mx-4 sm:-mx-8 py-4 overflow-x-auto px-4">
                <div class="inline-block w-full shadow-md rounded-lg overflow-hidden pb-5">
                    <table id="requested-table" class="w-full leading-normal dark:text-gray-400">
                        <thead class="bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="nosort">

                                </th>
                                <th>
                                    {{__('phone')}}
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
                            @foreach ($requestest as $requested )
                            {{-- @dd($requested->sim) --}}
                            <tr>
                                <td>
                                    <input form="send-request" type="checkbox" name="sims[]" class="input-checkbox w-5 h-5" value="{{$sim->id}}">
                                </td>
                                <td>
                                    <div class="ml-3">
                                        <p class="text-color whitespace-no-wrap">
                                            {{$requested->sim->phone}}
                                        </p>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-color whitespace-no-wrap">{{$requested->sim->iccid}}</p>
                                </td>
                                <td>
                                    <p class="text-color whitespace-no-wrap">{{$requested->sim->network->name}}</a></p>
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
    </div>
</div>
<template id="btn-template">
    <button id="btn-request" form="send-request" type="submit" class="light-btn">{{__('Add')}}</button>
</template>

<form id="send-request" action="{{url('dealer/send-request-sim')}}" method="post">
    @csrf
</form>
@endsection
@section('js')
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script>
    $('#product-table').DataTable( {
            "order": [],
            "columnDefs": [ {
                'orderable': false,
                "targets": 'nosort'
                } ],

        });

        $('#requested-table').DataTable( {
            "order": [],
            "columnDefs": [ {
                'orderable': false,
                "targets": 'nosort'
                } ],

        });
    var temp = document.getElementById('btn-template');
    var button = temp.content.cloneNode(true);
    $('#product-table_filter').addClass('flex');
    $('#product-table_filter').append(button)
    $('#btn-request').css({margin:0, 'margin-left':10});
</script>
@endsection
