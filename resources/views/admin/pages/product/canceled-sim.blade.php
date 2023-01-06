@extends('admin.layout.app')

@section('content')
<div class="absolute right-0 w-auto z-50">

    @include('admin.pages.components.errors')

</div>

{{-- @dd($simCards) --}}
<div class="mx-auto px-4">
    {{-- <div class="flex justify-end">

        <button class="light-btn" type="button" data-modal-toggle="distribution">{{__('Action')}}</button>
        <form id="share-sim" action="{{url('admin/phan-phoi-sim')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.pages.components.phan-phoi')

        </form>
        <button class="light-btn" type="button" data-modal-toggle="popup-modal">{{__('Add')}}</button>
        <form action="{{url('admin/add-sim')}}" method="POST">
            @csrf
            @include('admin.pages.components.add-sim')
        </form>
        <form id="import-form" action="{{url('admin/import-sim')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <button type="button" class="light-btn">
                <label for="import-file">{{__('import file')}}</label> </button>
            <input type="file" name="file" id="import-file"
                accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
                class="hidden">
        </form>

        <a href="{{url('admin/export-sim')}} " class="light-btn">
            {{__('Export file')}} </a>

    </div> --}}

    <div class="-mx-4 sm:-mx-8 py-4 overflow-x-auto px-4">
        <div class="inline-block w-full shadow-md rounded-lg overflow-hidden pb-5">
            <table id="product-table" class="w-full leading-normal dark:text-gray-400">
                <thead class="bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>

                        <th class=" whitespace-nowrap">
                            {{__('phone')}}
                        </th>
                        <th class=" whitespace-nowrap">
                            {{__('iccid')}}
                        </th>
                        <th class=" whitespace-nowrap">
                            {{__('Old ICCID')}}
                        </th>
                        <th class=" whitespace-nowrap">
                            {{__('network')}}
                        </th>
                        <th class=" whitespace-nowrap">
                            {{__('custommers')}}
                        </th>
                        <th class=" whitespace-nowrap">
                            {{__('type')}}
                        </th>
                        <th class=" whitespace-nowrap">
                            {{__('Created at')}}
                        </th>
                        <th class=" whitespace-nowrap">
                            {{__('Ngày cho thuê')}}
                        </th>
                        <th class=" whitespace-nowrap">
                            {{__('Ngày hết hạn')}}
                        </th>
                        <th class=" whitespace-nowrap">
                            {{__('status')}}
                        </th>
                        <th class="nosort"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($simCards as $simCard )
                    <tr>
                        <td>
                            <div class="ml-3">
                                <a href="{{url('admin/lich-su', $simCard->id)}}" class="text-color whitespace-no-wrap">
                                    {{$simCard->phone}}
                                </a>
                            </div>
                        </td>
                        <td>
                            <p class="text-color whitespace-no-wrap">{{$simCard->iccid}}</p>
                            {{-- <p class="text-red-500 whitespace-no-wrap"><i>{{$simCard->old_iccid}}</i> </p> --}}
                        </td>
                        <td>

                            <p class="text-red-500 whitespace-no-wrap"><i>{{$simCard->old_iccid}}</i> </p>
                        </td>
                        <td>
                            <p class="text-color whitespace-no-wrap">{{is_null($simCard->network) ? '' :
                                $simCard->network->name}}</p>
                        </td>

                        <td>
                            <p class="text-color whitespace-no-wrap">{{ $simCard->partner->ownerable->name ?? ''}}</p>
                        </td>
                        <td>
                            {{$simCard->partner->type ?? ''}}
                        </td>

                        <td>
                            <span data-href="{{url('admin/cap-nhat-ngay-them',$simCard->id)}}"
                                data-text="Cập nhật ngày tạo" class="show-popup">
                                {{$simCard->created_at->format('d-m-Y')}}
                            </span>
                        </td>

                        <td>
                            <span data-href="{{url('admin/cap-nhat-ngay-cho-thue',$simCard->id)}}"
                                data-text="Cập nhật ngày cho thuê" class="show-popup">
                                {{$simCard->partner ? $simCard->partner->created_at->format('d-m-Y') : ''}}
                            </span>
                        </td>

                        <td>
                            <p data-href="{{url('admin/cap-nhat-han-su-dung',$simCard->id)}}"
                                data-text="Cập nhật ngày hết hạn"
                                class="show-popup whitespace-no-wrap {{ $simCard->partner  && $simCard->partner->expired->isPast() ? 'text-red-500' : ''}} ">
                                {{$simCard->partner ? $simCard->partner->expired->format('d-m-Y') : '' }}
                            </p>
                        </td>
                        <td>

                            @if ($simCard->deleted_at !=null)
                            <span class=" uppercase text-red-500">Đã xoá</span>
                            @else
                            <span
                                class="relative inline-block px-3 py-1 font-semibold {{config('constrain.sim_status.'.$simCard->status.'.color')}} leading-tight">

                                <span
                                    class="relative">{{__(config('constrain.sim_status.'.$simCard->status.'.text'))}}</span>
                            </span>
                            @endif

                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-right">
                            <button type="button" class="inline-block text-gray-500 hover:text-gray-700 btn-dropdown"
                                data-dropdown-toggle="dropdownLeft" data-dropdown-placement="left"
                                data-iccid="{{$simCard->iccid}}"
                                data-history="{{url('admin/lich-su-thay-doi',$simCard->id)}}">
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

<div id="dropdownLeft"
    class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 dark:bg-gray-700 border shadow-lg" data-target="">
    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownLeftButton">
        <li class="context-menu-item change-status" data-status="1">

            <a href="javascript:;"
                class="block py-2 px-4 hover:hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-white">{{__('active')}}</a>
        </li>
        {{-- <li>
            <a href="javascript:;" class="block py-2 px-4 hover:hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-white"
                data-modal-toggle="edit-sim-modal">{{__('Edit')}}</a>
        </li>
        <li class="context-menu-item change-status" data-status="3">

            <a href="javascript:;"
                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-white">{{__('temporarily cut')}}</a>
        </li>
        <li class="context-menu-item change-status" data-status="4">

            <a href="javascript:;"
                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-white">{{__('Cancel')}}</a>
        </li>
        <li class="context-menu-item change-status" data-status="5">
            <a href="javascript:;"
                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-white">{{__('reset')}}</a>
        </li>
        <li class="invoice-btn">
            <a href="javascript:;" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-white"
                data-modal-toggle="invoice-modal">{{__('Customer inofmation')}}</a>
        </li>
        <li id="rent-btn">
            <a href="javascript:;" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-white"
                data-modal-toggle="rent-modal">{{__('rent')}}</a>
        </li>
        <li id="btn-extend">
            <a href="javascript:;" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-white"
                data-modal-toggle="extend-modal">{{__('Extend')}}</a>
        </li>
        <li class="btn-delete-sim">
            <a href="javascript:;"
                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-white">{{__('Delete')}}</a>
        </li>
        <li class="btn-history">
            <a href="javascript:;" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-white">{{__('Lịch sử
                thay đổi')}}</a>
        </li> --}}
    </ul>
</div>



</div>



@stop

@section('js')

<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://unpkg.com/flowbite@1.5.2/dist/flowbite.js"></script>
<script src="https://unpkg.com/flowbite@1.5.4/dist/datepicker.js"></script>
<script src="{{asset('backend/assets/js/test.js')}}"></script>
<script>
    const targetEl = document.getElementById('dropdownSearch');
const triggerEl = document.getElementById('dropdownSearchButton');
const dropdown = new Dropdown(targetEl, triggerEl);
</script>
@stop
