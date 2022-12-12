@extends('admin.layout.app')

@section('content')
<div class="absolute right-0 w-auto z-50">

    @include('admin.pages.components.errors')

</div>
{{-- <div class="flex justify-end">
    <button class="light-btn" type="button" data-modal-toggle="add-pakage">
        {{__('Add')}}
      </button>

</div> --}}
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
                        {{__('dealer')}}
                    </th>
                    <th>
                        {{__('Ngày thuê')}}
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
                @foreach ($sims as $sim )
                <tr>

                    <td>
                        <div class="ml-3">
                            <p class="text-color whitespace-no-wrap">
                                {{$sim->sim->phone}}
                            </p>
                        </div>
                    </td>
                    <td>
                        {{-- <p class="text-color whitespace-no-wrap">{{$sim->sim->iccid }}</p> --}}
                        <div class="flex flex-col">
                           <span class="whitespace-no-wrap font-normal">
                            {{$sim->sim->iccid }}
                        </span>

                        <del class="whitespace-no-wrap font-normal italic text-xs text-orange-500">
                             {{$sim->sim->old_iccid }}
                        </del>
                        </div>
                    </td>
                    {{-- @dd($sim) --}}
                    <td>
                        <p class="text-color whitespace-no-wrap">{{$sim->ownerable->name}}</p>
                    </td>
                    <td>
                        <p class="text-color whitespace-no-wrap">{{$sim->created_at->format('d-m-Y')}}</p>
                    </td>
                    <td>
                        <p class="{{$sim->expired->isPast() ? 'text-red-400' : ''}} whitespace-no-wrap">
                            {{$sim->expired->format('d-m-Y')}}
                        </p>
                    </td>

                    <td>
                        <p class="{{config("constrain.sim_status.".$sim->sim->status.".color")}} whitespace-no-wrap">
                            {{__(config("constrain.sim_status.".$sim->sim->status.".text"))}}
                        </p>
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

<template id="btn-template">
    <button  type="button" class="btn-request light-btn" data-modal-toggle="add-pakage">{{__('Add')}}</button>
    <a href="{{ url('admin/export-sim-partner',$user->id)}}" class="btn-request light-btn">{{__('Export')}}</a>
</template>
@stop
@section('js')
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://unpkg.com/flowbite@1.5.2/dist/flowbite.js"></script>

    <script>
         $('#product-table').DataTable( {
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
        $('.btn-request').css({margin:0, 'margin-left':10});
    </script>

@stop
