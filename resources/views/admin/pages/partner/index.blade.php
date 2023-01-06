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
                            <th></th>

                            <th>
                                {{__('Name')}}
                            </th>
                            <th>
                                {{__('phone')}}
                            </th>
                            <th>
                                {{__('type')}}
                            </th>
                            <th class="nosort"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user )
                        <tr>
                            <td><input value="{{$user->id}}" type="checkbox" name="partner[]" form="list-sim"></td>
                            <td>
                                <a href="{{url('admin/cong-tac-vien',$user->id)}}">{{$user->name}}</a>
                            </td>
                            <td>
                                <div class="ml-3">
                                    <p class="text-color whitespace-no-wrap">
                                        {{$user->phone}}
                                    </p>
                                </div>
                            </td>
                            <td>
                                <p class="text-color whitespace-no-wrap">{{__($user->roles->first()->name)}}</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-right">
                                <button type="button" class="inline-block text-gray-500 hover:text-gray-700  btn-dropdown" data-dropdown-toggle="dropdownLeft" data-dropdown-placement="left" data-id="{{$user->id}}">
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

<div id="dropdownLeft" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 dark:bg-gray-700 border shadow-lg">
    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownLeftButton">

        <li id="btn-edit">
            <a href="#"  data-modal-toggle="edit-partner"  class="block py-2 px-4 hover:hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-white">{{__('Edit')}}</a>
        </li>

        <li>
            <a id="btn-delete" href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-white"  data-modal-toggle="alert-modal">{{__('Delete')}}</a>
        </li>

        {{-- <li>
            <a id="btn-add-owner"  data-modal-toggle="owner-modal" href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-white">{{__('Team Owner')}}</a>
        </li> --}}
    </ul>
</div>

{{-- EDIT PARTNER --}}
<div id="edit-partner" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-md h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="edit-partner">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="py-6 px-6 lg:px-8">
                <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">{{__('Edit Profile')}}</h3>
                <form class="space-y-6" action="{{url('admin/cap-nhat-thong-tin-dai-ly')}}" method="POST">
                    @csrf
                    <input type="hidden" name="partner_id" id="partner_id">
                    <div>
                        <label for="partner-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("agent or collaborator name")}}</label>
                        <input type="text" placeholder="{{__('agent or collaborator name')}}" name="name" id="partner-name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                    </div>
                    <div>
                        <label for="partner-phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__('phone')}}</label>
                        <input type="text" placeholder="{{__('phone')}}" name="phone" id="partner-phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                    </div>

                    <div>
                        <label for="partner-type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__('dealer & colllab')}}</label>
                        <select name="type" id="partner-type" class="input-field">
                            <option value="0">{{__('dealer')}}</option>
                            <option value="1">{{__('collab')}}</option>
                        </select>
                    </div>
                    <div>
                        <label for="partner-address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__('Address')}}</label>
                        <input type="address" placeholder="{{__('Address')}}" name="address" id="partner-address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                    </div>
                    <button type="submit" class="btn-default w-full">{{__('Update')}}</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- ALERT MODAL --}}

<div id="alert-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-md h-full md:h-auto">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="alert-modal">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-6 text-center">
                <form action="{{url('admin/xoa-dai-ly')}}" method="post">
                    @csrf
                    <input type="hidden" name="partner_id" id="partner-id">
                    <svg aria-hidden="true" class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <h3 class="text-xl font-normal text-gray-500 dark:text-gray-400">{{__('Action cannot undone')}}</h3>
                    <h3 class="mb-5 text-base font-normal text-gray-500 dark:text-gray-400">{{__('Delete dealer or collab')}}</h3>
                    <button type="submit" class="btn-red">
                        {{__('Delete')}}
                    </button>
                    <button data-modal-toggle="alert-modal" type="button" class="light-btn">{{__('Cancel')}}</button>
                </form>

            </div>
        </div>
    </div>
</div>



<div id="owner-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-md h-full md:h-auto">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="owner-modal">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Close modal</span>
            </button>
            <form action="{{url('admin/them-chu-so-huu')}}" method="post">
                @csrf
                <div class="p-6 text-center">
                    {{-- <svg aria-hidden="true" class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> --}}
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">{{__('Search user')}}</h3>
                    <input id="search-user" autocomplete="off" type="text" class="input-field">
                    <input id="user-id" type="hidden" name="user_id" >
                    <input id="partner-selected" type="hidden" name="partner_id" >
                    <button type="submit" class="btn-default">
                        {{__('Add')}}
                    </button>
                    <button data-modal-toggle="owner-modal" type="button" class="light-btn">{{__('Cancel')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="dropdownSearch" class="hidden z-990 w-60 bg-white rounded shadow dark:bg-gray-700">
    <div class="p-3">
    <ul class="overflow-y-auto px-3 pb-3 min-h-2 dropdown-max-h text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownSearchButton">
        @foreach ($users as $user )
            <li class="user-item" data-id="{{$user->id}}" data-value="{{$user->name}}">
                <div class="ml-2 text-sm hover:bg-gray-300 cursor-pointer dark:hover:bg-gray-600">
                    <div> <span class="font-medium text-base">{{$user->name}}</span></div>
                    <p id="helper-radio-text-4" class="text-xs font-normal text-gray-500 dark:text-gray-300">{{$user->phone}}</p>
                </div>
            </li>
        @endforeach

    </ul>
</div>

<form id="list-sim" action="{{url('admin/cong-tac-vien/danh-sach-sim')}}" method="POST">
    @csrf

</form>

@stop

@section('js')

<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://unpkg.com/flowbite@1.5.2/dist/flowbite.js"></script>

<script>
    const targetEl = document.getElementById('dropdownSearch');
    const triggerEl = document.getElementById('search-user');
    const dropdown = new Dropdown(targetEl, triggerEl);

        var users = @json($users);
        $('#product-table').DataTable( {
            "order": [],
            "columnDefs": [ {
                'orderable': false,
                "targets": 'nosort'
                } ]
        });

        var partners = @json($partners);
        var item = null;
        $(document).ready(function () {
            $('.btn-dropdown').click(function(){
                let id = $(this).data('id');
                item = partners.filter(item=>item.id==id);
            });
            $('#btn-edit').click(function(){
                if(item != null && item.length > 0){
                    $('#partner-name').val(item[0].name);
                    $('#partner-phone').val(item[0].phone);
                    $('#partner-type').val(item[0].type);
                    $('#partner-address').val(item[0].address);
                    $('#partner_id').val(item[0].id);
                }
            });
            $('#btn-delete').click(function(){
                $('#partner-id').val(item[0].id);
            })

            $('#search-user').on('focus', function(){
            $('#dropdownSearch').css({
                    width: $(this).width()
                });
            });

            $('#search-user').on('input', function(){
                    var keyword = $(this).val();
                    if(keyword != ''){
                        // dropdown.show();
                    }
                    var ul = $('#dropdownSearch ul');
                    var expression = new RegExp(keyword, "i");
                    let results = users;
                    results = users.filter(function(item){
                        return item.name.search(expression) != -1;
                    });
                    var li ='';


                    $.each(results, function (index, item) {
                        li += `<li  class="user-item hover:bg-gray-300" data-id="${item.id}" data-value="${item.name}">
                                    <div class="ml-2 text-sm">
                                        <div> <span class="font-medium text-base">${item.name}</span></div>
                                        <p id="helper-radio-text-4" class="text-xs font-normal text-gray-500 dark:text-gray-300">${item.phone}</p>
                                    </div>
                                </li>`;
                    });

                    $(ul).html($(li));
                    if(results.length < 1){
                        $(ul).html(
                            `<li>
                                    <div class="ml-2 text-sm">
                                        <div> <span class="font-medium text-base">No result</span></div>
                                    </div>
                                </li>`
                        );
                    }

            });
            $(document).on('click','.user-item', function(){
                $('#search-user').val($(this).data('value'));
                $('#user-id').val($(this).data('id'));
                $('#partner-selected').val(item[0].id);
                console.log('click');
                dropdown.hide();
            })
        });

</script>
@stop
