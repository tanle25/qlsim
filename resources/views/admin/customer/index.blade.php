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
                                {{__('phone')}}
                            </th>
                            <th>
                                {{__('iccid')}}
                            </th>
                            <th>
                                {{__('pakage name')}}
                            </th>
                            <th>
                                {{__('Facebook')}}
                            </th>
                            {{-- <th class="nosort"></th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $customer )
                        @foreach ($customer->bills as $bill )

                        <tr>
                            @if ($loop->first)
                               <td rowspan="{{$customer->bills->count()}}">
                                <div class="ml-3">
                                    <p class="text-color whitespace-no-wrap">
                                        {{$customer->name}}
                                    </p>
                                </div>
                            </td>
                            @endif


                            <td>
                                <p class="text-color whitespace-no-wrap">{{$bill->modelable->phone}}</p>
                            </td>
                            <td>
                                <p class="text-color whitespace-no-wrap">{{$bill->modelable->iccid}}</p>
                            </td>
                            <td>
                                <p class="text-color whitespace-no-wrap">{{$bill->packageable->name}}</p>
                            </td>
                            @if ($loop->first)
                                <td rowspan="{{$customer->bills->count()}}">
                                <p class="text-color whitespace-no-wrap"><a class="text-blue-500 font-medium hover:font-normal hover:text-blue-400" href="{{$customer->facebook}}" target="_blank" rel="noopener noreferrer"> {{$customer->facebook}}</a></p>
                            </td>
                            @endif

                        </tr>
                        @endforeach


                        @endforeach
                    </tbody>
                </table>
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
