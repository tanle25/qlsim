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
                {{-- @dd($sim) --}}
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
<form action="{{url('admin/them-sim-vao-dai-ly',$user->id)}}" method="post">
    @csrf
<div id="add-sim-to-partner" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
    <div class="relative w-full h-full max-w-2xl md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Danh sách sim khả dụng
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="add-sim-to-partner">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
            <!-- Modal body -->
            <div class="space-y-6">

                <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="p-4">
                                    {{-- <div class="flex items-center">
                                        <input id="checkbox-all" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="checkbox-all" class="sr-only">checkbox</label>
                                    </div> --}}
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    {{__('phone')}}
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    ICCID
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    {{__('network')}}
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sim_not_rent as $sim )

                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="p-4 w-4">
                                    <div class="flex items-center">
                                        <input id="checkbox-table-{{$sim->id}}" name="sim[]" value="{{$sim->id}}" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="checkbox-table-{{$sim->id}}" class="sr-only">checkbox</label>
                                    </div>
                                </td>
                                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{$sim->phone}}
                                </th>
                                <td class="py-4 px-6">
                                    {{$sim->iccid}}
                                </td>
                                <td class="py-4 px-6">
                                    {{$sim->network->name}}
                                </td>

                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button  type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">OK</button>
                <button data-modal-toggle="add-sim-to-partner" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Huỷ</button>
            </div>
        </div>
    </div>
</div>
</form>

<template id="btn-template">
    <button  type="button" class="btn-request light-btn" data-modal-toggle="add-sim-to-partner">{{__('Add')}}</button>
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
