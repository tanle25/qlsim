@extends('admin.layout.app')

@section('content')

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
                        {{__('Email')}}
                    </th>

                    <th>
                        {{__('Role')}}
                    </th>
                    <th>
                        {{__('status')}}
                    </th>
                    <th class="nosort"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user )
                <tr>

                    <td>
                        <div class="ml-3">
                            <p class="text-color whitespace-no-wrap">
                                {{$user->name}}
                            </p>
                        </div>
                    </td>
                    <td>
                        <p class="text-color whitespace-no-wrap">{{$user->phone}}</p>
                    </td>
                    <td>
                        <p class="text-color whitespace-no-wrap">{{$user->email}}</p>
                    </td>
                    <td>
                        <p class="text-color whitespace-no-wrap">
                            {{__($user->getRoleNames()->first()) }}
                        </p>
                    </td>
                    <td>
                        {{$user->status == 0 ? __('Disable') : __('active')}}
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-right">
                        <button type="button" data-dropdown-toggle="dropdown"  class="btn-dropdown inline-block text-gray-500 hover:text-gray-700 btn-dropdown" data-dropdown-toggle="dropdownLeft" data-dropdown-placement="left"
                        data-id="{{$user->id}}">
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


<div id="authentication-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-md h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="authentication-modal">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="py-6 px-6 lg:px-8">
                <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">{{__('Create Account')}}</h3>
                <form  autocomplete="off" class="space-y-6" action="{{url('admin/them-nguoi-dung')}}" method="POST">
                    @csrf
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__('Full name')}}</label>
                        <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="{{__('Full name')}}" required>
                    </div>
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__('Email')}}</label>
                        <input type="email" autocomplete="off" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="name@company.com" required>
                    </div>
                    <div>
                        <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__('Role')}}</label>
                        <select id="role" name="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="" selected>{{__('Role')}}</option>
                            @foreach ($roles as $role )
                            <option value="{{$role->id}}">{{__($role->name) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__('phone')}}</label>
                        <input type="text" name="phone" id="phone" placeholder="phone number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__('Password')}}</label>
                        <input type="password" autocomplete="new-password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>

                    <button type="submit" class="w-full mt-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{__('Create')}}</button>

                </form>
            </div>
        </div>
    </div>
</div>



{{-- EDIT MODAL --}}


<div id="edit-account" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-md h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="edit-account">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="py-6 px-6 lg:px-8">
                <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">{{__('Create Account')}}</h3>
                <form  autocomplete="off" class="space-y-6" action="{{url('admin/sua-nguoi-dung')}}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" id="user-id">
                    <div>
                        <label for="user-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__('Full name')}}</label>
                        <input type="text" name="name" id="user-name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="{{__('Full name')}}" required>
                    </div>
                    <div>
                        <label for="user-email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__('Email')}}</label>
                        <input type="email" autocomplete="off" name="email" id="user-email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="name@company.com" required>
                    </div>
                    <div>
                        <label for="user-role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__('Role')}}</label>
                        <select id="user-role" name="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="" selected>{{__('Role')}}</option>
                            @foreach ($roles as $role )
                            <option value="{{$role->id}}">{{__($role->name) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex items-center w-full mb-12">

                        <label for="toggleB" class="flex items-center cursor-pointer">
                          <!-- toggle -->
                          <div class="relative">
                            <!-- input -->
                            <input type="checkbox" name="status" id="toggleB" class="sr-only" value="1">
                            <!-- line -->
                            <div class="block dark:bg-gray-700 dark:border-white bg-gray-300 border border-gray-700  w-14 h-8 rounded-full"></div>
                            <!-- dot -->
                            <div class="dot absolute left-1 top-1 bg-gray-600 dark:bg-white w-6 h-6 rounded-full transition"></div>
                          </div>
                          <!-- label -->
                          <div class="ml-3 text-gray-700 font-medium dark:text-white">
                            {{__('status')}}
                          </div>
                        </label>

                      </div>
                    <div>
                        <label for="user-phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__('phone')}}</label>
                        <input type="text" name="phone" id="user-phone" placeholder="phone number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                    <div>
                        <label for="user-password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__('Password')}}</label>

                        <div class="relative">
                            <input type="password" autocomplete="new-password" name="password" id="user-password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                            <button type="button" class="btn-toggle-password absolute btn-eyes h-full w-10"><i class="fal fa-eye"></i></button>
                        </div>

                    </div>

                    <button type="submit" class="w-full mt-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{__('Update')}}</button>

                </form>
            </div>
        </div>
    </div>
</div>

{{-- DROP DOWN --}}

<div id="dropdown" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700">
    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefault">
      <li>
        <a href="#" id="btn-edit"  data-modal-toggle="edit-account" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{__('Edit Profile')}}</a>
      </li>
      <li>
        <a href="#" id="btn-delete" data-modal-toggle="alert-modal"  class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{__('Delete Account')}}</a>
      </li>

    </ul>
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
                <form action="{{url('admin/xoa-nguoi-dung')}}" method="post">
                    @csrf
                    <input type="hidden" name="user_id" class="user-id">
                    <svg aria-hidden="true" class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <h3 class="text-xl font-normal text-gray-500 dark:text-gray-400">{{__('Action cannot undone')}}</h3>
                    <h3 class="mb-5 text-base font-normal text-gray-500 dark:text-gray-400">{{__('Do you want to delete this users')}}</h3>
                    <button type="submit" class="btn-red">
                        {{__('Delete')}}
                    </button>
                    <button data-modal-toggle="alert-modal" type="button" class="light-btn">{{__('Cancel')}}</button>
                </form>

            </div>
        </div>
    </div>
</div>

<template id="btn-template">
    <button class="light-btn" data-modal-toggle="authentication-modal" style="margin: 0; margin-left:10px">
        {{__('add user')}}
    </button>
</template>



@endsection
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
        var users = @json($users);
        var item = null;
        var temp = document.getElementById('btn-template');
        var button = temp.content.cloneNode(true);
        $('#product-table_filter').addClass('flex');
        $('#product-table_filter').append(button);

        $('.btn-dropdown').click(function(){
            var id = $(this).data('id');
            item = users.filter(item=>item.id==id);
        })

        $('#btn-edit').click(function(){
            console.log(item[0]);
            if(item !== null && item.length > 0){
                $('#user-name').val(item[0].name);
                $('#user-email').val(item[0].email);
                if (!jQuery.isEmptyObject(item[0].roles[0])) {
                    $('#user-role').val(item[0].roles[0].id);
                }
                $('#user-phone').val(item[0].phone);
                $('#user-id').val(item[0].id);
                if(item[0].status == 1){
                    $('#toggleB').prop('checked',true);

                }else{
                    $('#toggleB').prop('checked',false);
                }
            }
        });
        $('.btn-toggle-password').click(function(){
            var element = $('input[name=password]');
            // $(element).attr('type') == 'password' ? $(element).attr('type','text') : $(element).attr('type','password');
            if($(element).attr('type') == 'password'){
                $(element).attr('type','text');
                $(this).children().removeClass('fa-eye').addClass('fa-eye-slash');
            }else{
                $(element).attr('type','password');
                $(this).children().removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });
        $('#btn-delete').click(function(){
            $('.user-id').val(item[0].id);
        });
</script>
@endsection
