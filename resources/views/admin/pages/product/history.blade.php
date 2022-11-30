@extends('admin.layout.app')


@section('content')
    <!-- component -->
<section class="antialiased bg-gray-100 text-gray-600 h-screen">
    <div class="flex flex-col h-full">
        <!-- Table -->
        <div class="w-full mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
            <header class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
                <h4 class="font-semibold text-slate-DEFAULT-500">Lịch sử cho thuê sim</h4>
                <button form="delete-history" type="submit" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Xoá lịch sử đã chọn</button>
            </header>
            <div class="p-3">
                <div class="overflow-x-auto">
                    <table class="table-auto w-full">
                        <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                            <tr>
                                <th class="p-2 whitespace-nowrap">
                                    {{-- <div class="font-semibold text-left">{{__('ICCID')}}</div> --}}
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">{{__('custommers')}}</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">{{__('type')}}</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-center">{{__('start date')}}</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-center">{{__('end date')}}</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-center">{{__('Hoá đơn')}}</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100">
                            @foreach ($invoices as $invoice )
                            <tr>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <input form="delete-history" type="checkbox" name="id[]" value="{{$invoice->id}}">
                                    </div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left">{{$invoice->invoiceable->name}}</div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left font-medium text-green-500">{{ $invoice->type}}</div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class=" text-center">{{$invoice->from_date->format('d-m-Y')}}</div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class=" text-center">{{$invoice->to_date->format('d-m-Y')}}</div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class=" text-center">
                                        <a class="text-blue-500 get-invocie-image" data-invoice="{{$invoice->id}}" href="javascript:;">Xem</a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<div id="image-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 p-4 md:inset-0 h-modal md:h-full">
    <div class="relative w-full max-w-md h-full md:h-auto">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white close-image-modal" >
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-6 text-center">
                <div class="modal-content my-5"></div>
                <button  type="button" class="close-image-modal text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                    Yes, I'm sure
                </button>
                <button  type="button" class="close-image-modal text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
            </div>
        </div>
    </div>
</div>

<form id="delete-history" action="{{url('admin/xoa-lich-su-cho-thue-sim')}}" method="post">
    @csrf
</form>
@endsection

@section('js')
<script src="https://unpkg.com/flowbite@1.5.4/dist/flowbite.js"></script>
    <script>
        const targetEl = document.getElementById('image-modal');
        const options = {
            placement: 'center',
            backdrop: 'dynamic',
            backdropClasses: 'bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40',
        };
        const modal = new Modal(targetEl, options);

        $('.get-invocie-image').click(function(){
            modal.show();
            var data = $(this).data('invoice');
            $.ajax({
                type: "get",
                url: "{{url('admin/get-invoice-image')}}/"+data,
                dataType: "html",
                beforeSend: function(){
                    $('.modal-content').html(`<div class="absolute right-1/2 bottom-1/2  transform translate-x-1/2 translate-y-1/2 ">
                        <div class="border-t-transparent border-solid animate-spin  rounded-full border-blue-400 border-8 h-64 w-64"></div>
                    </div>`);
                },
                success: function (response) {
                    // console.log(response);
                    $('.modal-content').html(response);
                }
            });
        });
        $('.close-image-modal').click(function(){
            modal.hide();
        });
    </script>
@endsection
