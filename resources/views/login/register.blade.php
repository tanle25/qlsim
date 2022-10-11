@extends('login.master')
@section('title')
{{__('Register')}}
@stop

@section('content')
<div class="bg-gradient-to-tr from-green-300 to-green-600 h-screen w-full flex justify-center items-center">
    <div class="w-1/2 flex justify-center items-center">
        <div class="bg-white w-full md:w-1/2 flex flex-col items-center py-10 px-8  justify-center">
            <h3 class="text-3xl font-bold text-green-500 mb-4">
                {{__('Register')}}
            </h3>
            <form method="POST" action="{{url('register')}}" class="w-full flex flex-col justify-center">
                @csrf
                <div class="mb-4">
                    <input type="text" placeholder="{{__('Full name')}}" autocomplete="off" required="" name="name" class="w-full p-3 rounded border placeholder-gray-400 focus:outline-none focus:border-green-600">
                </div>
                <div class="mb-4">
                    <input type="text" placeholder="Email" name="email" autocomplete="off" class="w-full p-3 rounded border placeholder-gray-400 focus:outline-none focus:border-green-600">
                </div>
                <div class="mb-4">
                    <input type="password" placeholder="{{__('Password')}}" autocomplete="off" required="" name="password" class="w-full p-3 rounded border placeholder-gray-400 focus:outline-none focus:border-green-600">
                </div>
                <div class="mb-4">
                    <input type="password" placeholder="{{__('Confirm Password')}}" autocomplete="off" required="" name="password_confirmation" class="w-full p-3 rounded border placeholder-gray-400 focus:outline-none focus:border-green-600">
                </div>
                <div class="mb-4">
                    <input type="text" placeholder="{{__('phone')}}" autocomplete="off" required="" name="phone" class="w-full p-3 rounded border placeholder-gray-400 focus:outline-none focus:border-green-600">
                </div>
                <button type="submit" class="mb-2 w-full inline-block px-6 py-3 bg-blue-600 text-white font-bold  leading-normal uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">{{__('Register')}}</button>
                <a href="">{{__('Have an account')}} <b>{{__('Login now')}}</b> </a>
            </form>
        </div>
    </div>
</div>
@endsection
