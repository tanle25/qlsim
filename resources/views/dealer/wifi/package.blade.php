@extends('admin.layout.app')

@section('content')
<div class="absolute right-0 w-auto z-50">

@include('admin.pages.components.errors')

</div>

<div class="flex justify-end">
    <button class="light-btn" type="button" data-modal-toggle="create-request-modal">{{ __('add pakage')}}</button>
</div>
<div class="mx-auto px-4">
        <div class="-mx-4 sm:-mx-8 py-4 overflow-x-auto px-4">
            <div class="inline-block w-full shadow-md rounded-lg overflow-hidden pb-5">
                <table id="product-table" class="w-full leading-normal dark:text-gray-400">
                    <thead class="bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>

                            <th>
                                {{__('pakage name')}}
                            </th>
                            <th>
                                {{__('network')}}
                            </th>
                            <th>
                                {{__('duration')}}
                            </th>
                            <th>
                                {{__('price')}}
                            </th>

                            <th>
                                {{__('Fee')}}
                            </th>

                            <th class="nosort"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($packages as $package )
                        <tr>

                            <td>
                                <div class="ml-3">
                                    <p class="text-color whitespace-no-wrap">
                                        {{$package->name}}
                                    </p>
                                </div>
                            </td>
                            <td>
                                <div class="ml-3">
                                    <p class="text-color whitespace-no-wrap">
                                        {{$package->network->name}}
                                    </p>
                                </div>
                            </td>
                            <td>
                                <div class="ml-3">
                                    <p class="text-color whitespace-no-wrap">
                                        {{$package->number_of_month}}
                                    </p>
                                </div>
                            </td>
                            <td>
                                <div class="ml-3">
                                    <p class="text-color whitespace-no-wrap">
                                        {{$package->price}}
                                    </p>
                                </div>
                            </td>
                            <td>
                                <div class="ml-3">
                                    <p class="text-color whitespace-no-wrap">
                                        {{$package->fee}}
                                    </p>
                                </div>
                            </td>

                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-right">
                                <button type="button" class="inline-block text-gray-500 hover:text-gray-700 btn-dropdown" data-package="{{$package->id}}" data-dropdown-toggle="dropdown" data-dropdown-placement="left">
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

<form action="{{url('admin/add-wifi-package')}}" method="post">
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
                        <input type="text" class="input-field mb-3" name="name" placeholder="{{__('pakage name')}}">
                        <select id="countries" name="network" class="bg-gray-50 mb-3 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected>{{__('choose network')}}</option>
                            @foreach ($networks as $network )
                            <option value="{{$network->id}}">{{$network->name}}</option>
                            @endforeach
                          </select>
                          <input type="number" class="input-field mb-3" name="duration" placeholder="{{__('duration')}}">
                          <input type="number" class="input-field mb-3" name="price" placeholder="{{__('price')}}">
                          <input type="number" class="input-field mb-3" name="fee" placeholder="{{__('Fee')}}">
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

<form action="{{url('admin/update-wifi-package')}}" method="post">
    @csrf
    <div id="edit-package" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full">
        <div class="relative p-4 w-full max-w-md h-full md:h-auto">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="edit-package">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-6 text-center">
                    {{-- <svg aria-hidden="true" class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> --}}
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">{{__('Edit :resource',['resource'=>__('pakage')])}}</h3>

                    <div class="modal-body">
                        <input type="hidden" name="id" id="input-id">
                        <input id="input-name" type="text" class="input-field mb-3" name="name" placeholder="{{__('pakage name')}}">
                        <select id="select-network" name="network" class="bg-gray-50 mb-3 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected value="">{{__('choose network')}}</option>
                            @foreach ($networks as $network )
                            <option value="{{$network->id}}">{{$network->name}}</option>
                            @endforeach
                          </select>
                          <input id="input-duration" type="number" class="input-field mb-3" name="duration" placeholder="{{__('duration')}}">
                          <input id="input-price" type="number" class="input-field mb-3" name="price" placeholder="{{__('price')}}">
                          <input id="input-fee" type="number" class="input-field mb-3" name="fee" placeholder="{{__('Fee')}}">
                    </div>
                    <div class="flex justify-center">
                        <button  type="submit" class="btn-red">
                            OK
                        </button>
                        <button data-modal-toggle="edit-package" type="button" class="light-btn">{{__('Cancel')}}</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</form>
<form action="{{url('admin/delete-wifi-network')}}" method="post">
    @csrf
    <div id="delete-package" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full">
        <div class="relative p-4 w-full max-w-md h-full md:h-auto">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="delete-package">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-6 text-center">
                    <input type="hidden" name="id" id="input-package-id">
                    <svg aria-hidden="true" class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">{{__('Are you sure you want to delete this :name?',['name'=>__('pakage')])}}</h3>
                    <button  type="submit" class="btn-red">
                        OK
                    </button>
                    <button data-modal-toggle="delete-package" type="button" class="light-btn">No, cancel</button>
                </div>
            </div>
        </div>
    </div>
</form>

<div id="dropdown" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700">
    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefault">
      <li id="edit-package-btn" data-modal-toggle="edit-package">
        <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{__('Edit')}}</a>
      </li>
      <li id="delete-package-btn" data-modal-toggle="delete-package">
        <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{__('Delete')}}</a>
      </li>

    </ul>
</div>

@stop

@section('js')

<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>
{{-- <script src="https://unpkg.com/flowbite@1.5.3/dist/datepicker.js"></script> --}}
{{-- <script src="{{asset('backend/assets/js/picker.js')}}"></script> --}}
<script src="{{asset('backend/assets/js/test.js')}}"></script>
<script>
    $(document).ready( function () {
        // myCalendar.init();
        $('#product-table').DataTable( {
            "order": [],
            "columnDefs": [ {
                'orderable': false,
                "targets": 'nosort'
                } ]
        });
        var packageId = null;
        $('.btn-dropdown').click(function(){
            packageId = $(this).data('package');
        });
        $('#edit-package-btn').click(function(){
            $.ajax({
                type: "get",
                url: "{{url('admin/get-wifi-package')}}/"+packageId,
                dataType: "json",
                success: function (response, statusText, xhr) {
                    $('#input-name').val(response.name);
                    $('#input-duration').val(response.number_of_month);
                    $('#input-price').val(response.price);
                    $('#input-fee').val(response.fee);
                    $('#input-id').val(response.id);
                    $('#select-network').val(response.wifi_network_id);
                }
            });
        });
        $('#delete-package-btn').click(function(){
            $('#input-package-id').val(packageId)
        });

    } );





</script>
@stop
