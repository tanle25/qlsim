@extends('admin.layout.app')

@section('content')
<div class="absolute right-0 w-auto z-50">

@include('admin.pages.components.errors')

</div>

{{__('History request')}}
{{-- @dd($requestest) --}}

<div>
    <div class="p-4 bg-gray-50 rounded-lg dark:bg-gray-800" id="history" role="tabpanel" aria-labelledby="history-tab">
        <div class="mx-auto px-4">
            <div class="-mx-4 sm:-mx-8 py-4 overflow-x-auto px-4">
                <div class="inline-block w-full shadow-md rounded-lg overflow-hidden pb-5">
                    <table id="requested-table" class="w-full leading-normal dark:text-gray-400">
                        <thead class="bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                {{-- <th class="nosort">

                                </th> --}}
                                <th>
                                    {{__('phone')}}
                                </th>
                                <th>
                                    {{__('ICCID')}}
                                </th>

                                <th>
                                    {{__('Created at')}}
                                </th>
                                <th>
                                    {{__('request')}}
                                </th>
                                <th>
                                    {{__('status')}}
                                </th>
                                <th class="nosort"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($requestes as $requested )
                            {{-- @dd($requestes) --}}
                            <tr>

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
                                    <p class="text-color whitespace-no-wrap">{{$requested->created_at->format('d-m-Y H:i:s')}}</p>
                                </td>
                                <td>
                                    <p class="text-color whitespace-no-wrap">{{__(config("constrain.sim_status.$requested->request.text") )}}</a></p>
                                </td>
                                <td>
                                    <p class="text-color whitespace-no-wrap">{{__(config("constrain.request.$requested->status") ) }}</p>
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
