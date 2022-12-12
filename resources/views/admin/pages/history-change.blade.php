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
                        {{__('admin')}}
                    </th>
                    <th>
                        {{__('requester')}}
                    </th>
                    <th>
                        {{__('Action')}}
                    </th>
                    <th>
                        {{__('Created at')}}
                    </th>
                    <th class="nosort"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($histories as $history )

                {{-- @dd($history->request) --}}
                <tr>
                    <td>
                        <div class="ml-3">
                            <p class="text-color whitespace-no-wrap">
                                {{$history->sim->phone}}
                            </p>
                        </div>
                    </td>
                    <td>
                        <div class="flex flex-col">
                           <span class="whitespace-no-wrap font-normal">
                            {{$history->user->name }}
                        </span>

                        </div>
                    </td>
                    <td>
                        <p class="text-color whitespace-no-wrap">{{$history->request->user->name ?? ''}}</p>
                    </td>
                    <td>
                        <p class="text-color whitespace-no-wrap">{{config("constrain.action.$history->action")}}</p>
                    </td>
                    <td>
                        <p class="text-color whitespace-no-wrap">{{$history->created_at->format('d-m-Y')}}</p>
                    </td>

                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-right">
                        <button type="button" class="view-change inline-block text-gray-500 hover:text-gray-700 mx-2" data-index="{{$loop->index}}">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        </button>
                        <a href="{{url('admin/xoa-lich-su-thay-doi', $history->id)}}" class="inline-block text-gray-500 hover:text-gray-700 mx-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

</div>

<div id="comparse-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
    <div class="relative w-full h-full max-w-2xl md:h-auto" style="max-width: 700px">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Xem thay đổi
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white close-modal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 flex">
                <div id="before-change" class=" flex flex-col w-1/2">
                    <span>ICCID: <b class="iccid">01231231</b></span>
                    <span>Số điện thoại: <b class="phone">01231231</b></span>
                    <span>Nhà mạng: <b class="network">Viettel</b></span>
                    <span>Giá nhập vào: <b class="price">1000</b></span>
                    <span>Giá cho thuê: <b class="lease-price">1200</b></span>
                    <span>Thời hạn: <b class="duration">6</b></span>
                    <span>Tình trạng: <b class="is-rent">Đang cho thuê</b></span>
                    <span>Trạng thái: <b class="status">Hoạt động</b></span>
                </div>
                <div id="after-change" class=" flex flex-col w-1/2">
                    <span>ICCID: <b class="iccid">01231231</b></span>
                    <span>Số điện thoại: <b class="phone">01231231</b></span>
                    <span>Nhà mạng: <b class="network">Viettel</b></span>
                    <span>Giá nhập vào: <b class="price">1000</b></span>
                    <span>Giá cho thuê: <b class="lease-price">1200</b></span>
                    <span>Thời hạn: <b class="duration">6</b></span>
                    <span>Tình trạng: <b class="is-rent">Đang cho thuê</b></span>
                    <span>Trạng thái: <b class="status">Hoạt động</b></span>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">

                <button type="button" class="close-modal text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Đóng</button>
            </div>
        </div>
    </div>
</div>

{{-- <template id="btn-template">
    <button id="btn-request" type="button" class="light-btn" data-modal-toggle="add-pakage">{{__('Add')}}</button>
</template> --}}
@stop
@section('js')
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://unpkg.com/flowbite@1.5.2/dist/flowbite.js"></script>

    <script>
        var histories = @json($histories);
        const status = ['Dừng','Hoạt động','Hoạt động','Tạm cắt','Huỷ','Đang làm mới']
        var simData = null;
         $('#product-table').DataTable( {
            "order": [],
            "columnDefs": [ {
                'orderable': false,
                "targets": 'nosort'
                } ]
        });
        const targetEl = document.getElementById('comparse-modal');

        const options = {
            backdrop: 'dynamic',
            backdropClasses: 'bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40',
            onShow: () => {
                // console.log('modal is shown');
                if(simData){
                    var after = JSON.parse(simData.content);
                    $('#after-change .iccid').text(after.iccid);
                    $('#after-change .phone').text(after.phone);
                    $('#after-change .network').text( after.network ? after.network.name : '');
                    $('#after-change .price').text(after.network ? after.network.price : '');
                    $('#after-change .lease-price').text(after.network ? after.network.lease_price : '');
                    $('#after-change .duration').text(after.network ? after.network.duration : '');
                    $('#after-change .is-rent').text(after.is_rent == 0 ? 'Chưa cho thuê' : 'Không cho thuê');
                    $('#after-change .status').text(status[after.status] );


                    $('#before-change .iccid').text(simData.sim.iccid);
                    $('#before-change .phone').text(simData.sim.phone);
                    $('#before-change .network').text( simData.sim.network ? simData.sim.network.name : '');
                    $('#before-change .price').text(simData.sim.network ? simData.sim.network.price : '');
                    $('#before-change .lease-price').text(simData.sim.network ? simData.sim.network.lease_price : '');
                    $('#before-change .duration').text(simData.sim.network ? simData.sim.network.duration : '');
                    $('#before-change .is-rent').text(simData.sim.is_rent == 0 ? 'Chưa cho thuê' : 'Không cho thuê');
                    $('#before-change .status').text(status[simData.sim.status] );
                    // console.log(after);
                }
            },
            onHide: () => {
                simData = null;
            },
        };
        const modal = new Modal(targetEl, options);

        $('.view-change').click(function(){
            var index = $(this).data('index');
            simData = histories[index];
            modal.show();
        });
        $('.close-modal').click(function(){
            modal.hide();
        });
        // var temp = document.getElementById('btn-template');
        // var button = temp.content.cloneNode(true);
        // $('#product-table_filter').addClass('flex');
        // $('#product-table_filter').append(button)
        // $('#btn-request').css({margin:0, 'margin-left':10});
    </script>

@stop
