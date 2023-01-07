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
                    <th>id</th>

                    <th>
                        {{__('network name')}}
                    </th>

                    <th>
                        {{__('price')}}
                    </th>
                    <th>
                        {{__('rent price')}}
                    </th>
                    <th>
                        {{__('duration')}}
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
                                {{$network->id}}
                            </p>
                        </div>
                    </td>

                    <td>
                        <div class="ml-3">
                            <p class="text-color whitespace-no-wrap">
                                {{$network->name}}
                            </p>
                        </div>
                    </td>

                    <td>
                        <div class="ml-3">
                            <p class="text-color whitespace-no-wrap">
                                {{$network->price}}
                            </p>
                        </div>
                    </td>
                    <td>
                        <div class="ml-3">
                            <p class="text-color whitespace-no-wrap">
                                {{$network->lease_price}}
                            </p>
                        </div>
                    </td>

                    <td>
                        <div class="ml-3">
                            <p class="text-color whitespace-no-wrap">
                                {{$network->duration}}
                            </p>
                        </div>
                    </td>


                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-right">
                        <button type="button" class="inline-block text-gray-500 hover:text-gray-700 btn-dropdown" data-dropdown-toggle="dropdown" data-dropdown-placement="left"
                        data-network="{{$network->id}}" >
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
<form id="package-form" action="{{url('admin/them-nha-mang-sim')}}" method="post">
    @csrf

    <div id="add-pakage" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full">
        <div class="relative p-4 w-full max-w-md h-full md:h-auto">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="add-pakage">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-6 text-center">
                        <h3 class="mb-5 text-lg font-normal  dark:text-gray-400">{{__('add network')}}</h3>

                        <div class="my-2">
                            <input type="text" name="name" id="" class="input-field" placeholder="{{__('network name')}}">
                        </div>
                        <div class="my-2">
                            <input type="number" name="price" id="" class="input-field" placeholder="{{__('price')}}">
                        </div>
                        <div class="my-2">
                            <input type="number" name="lease_price" id="" class="input-field" placeholder="{{__('rent price')}}">
                        </div>
                        <div class="my-2">
                            <input type="number" name="duration" id="" class="input-field" placeholder="{{__('duration')}}">
                        </div>
                    <button data-modal-toggle="add-pakage" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Đóng</button>
                    <button  type="submit" class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                        Thêm
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<div id="dropdown" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700">
    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefault">
      <li class="btn-edit" data-modal-toggle="edit-network-modal">
        <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{__('Edit')}}</a>
      </li>
      <li >
        <a href="#" class="btn-delete block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{__('Delete')}}</a>
      </li>

    </ul>
</div>
<template id="btn-template">
    <button id="btn-request" type="button" class="light-btn" data-modal-toggle="add-pakage">{{__('Add')}}</button>
</template>
<form action="{{url('admin/update-sim-network')}}" method="post">
    @csrf
    <div id="edit-network-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full">
        <div class="relative p-4 w-full max-w-md h-full md:h-auto">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="edit-network-modal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-6 text-center">
                    {{-- <svg aria-hidden="true" class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> --}}
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">{{__('Edit')}}</h3>
                    <input id="network-name" type="text" name="name" class="input-field">
                    <div class="my-2">
                        <input id="edit-network-price" type="number" name="price" id="" class="input-field" placeholder="{{__('price')}}">
                    </div>
                    <div class="my-2">
                        <input  type="number" name="lease_price" id="" class="input-field" placeholder="{{__('rent price')}}">
                    </div>
                    <div class="my-2">
                        <input type="number" name="duration" id="" class="input-field" placeholder="{{__('duration')}}">
                    </div>
                    <input type="hidden" name="id" id="network-id">
                    <div class="mt-3">
                        <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                            {{__('OK')}}
                        </button>
                        <button data-modal-toggle="edit-network-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">{{__('Cancel')}}</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</form>


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
        var networkId = null;
        var temp = document.getElementById('btn-template');
        var button = temp.content.cloneNode(true);
        $('#product-table_filter').addClass('flex');
        $('#product-table_filter').append(button)
        $('#btn-request').css({margin:0, 'margin-left':10});
        $('.btn-dropdown').click(function(){
            networkId = $(this).data('network');
        });
        $('.btn-edit').click(function(){
            $.ajax({
                type: "get",
                url: "{{url('admin/get-sim-network')}}/"+networkId,
                dataType: "json",
                success: function (response, extStatus, xhr) {
                    console.log(response);
                    if(xhr.status == 200){
                        $('#network-name').val(response.name);
                        $('#network-id').val(response.id);
                        $('#edit-network-modal input[name=price]').val(response.price);
                        $('#edit-network-modal input[name=lease_price]').val(response.lease_price);
                        $('#edit-network-modal input[name=duration]').val(response.duration);
                    }

                }
            });
        });
        $('.btn-delete').click(function(){
            location.href ="{{url('admin/delete-sim-network')}}/"+networkId
        });
    </script>

@stop
