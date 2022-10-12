@extends('login.master')
@section('title')
{{__('Log In')}}
@stop
@section('content')
<div class="bg-gradient-to-tr from-green-300 to-green-600 h-screen w-full flex justify-center items-center">
    <div class="bg-green-600 w-full sm:w-1/2 md:w-9/12 lg:w-1/2 shadow-md flex flex-col md:flex-row items-center mx-5 sm:m-0 rounded my-5">
      <div class="w-full md:w-1/2 hidden md:flex flex-col justify-center items-center text-white">
        <h1 class="text-3xl">Hello</h1>
        <p class="text-5xl font-extrabold">Welcome!</p>
      </div>
      <div class="bg-white w-full md:w-1/2 flex flex-col items-center py-10 px-8  justify-center">
        <h3 class="text-3xl font-bold text-green-500 mb-4">
          {{__('login')}}
        </h3>
        @error('loginfail')
        <span class="text-red-400">{{__('login fail')}}</span>
        @enderror
        <form method="POST" action="{{ route('login') }}" class="w-full flex flex-col justify-center">
            @csrf

          <div class="mb-4">
            @error('email')
                {{-- <span role="alert"> --}}
                    <span class="text-red-400">{{ $message }}</span>
                {{-- </span> --}}
            @enderror
            {{-- <span class="invalid-feedback"">test</span> --}}
            <input type="text" placeholder="Email" name="email" class="w-full p-3 rounded border placeholder-gray-400 focus:outline-none focus:border-green-600" />
          </div>
          <div class="mb-4">
            @error('password')
                    <span class="text-red-400">{{ $message }}</span>
            @enderror
            <input type="password" placeholder="Password" required name="password" autocomplete="current-password" class="w-full p-3 rounded border placeholder-gray-400 focus:outline-none focus:border-green-600" />
          </div>
          <div class="flex items-center space-x-2 mb-2">
            <input
              type="checkbox"
              id="remember"
              name="remember"
              class="w-4 h-4 transition duration-300 rounded focus:ring-2 focus:ring-offset-0 focus:outline-none focus:ring-blue-200"
            />
            <label for="remember" class="text-sm font-semibold text-gray-500">{{__('remember me')}}</label>

          </div>
          <div class="flex justify-between mb-3">
            <a class="text-sm font-semibold text-blue-500" href="{{url('quen-mat-khau')}}">{{__('Forgot your password?')}}</a>
            <a class="text-sm font-semibold text-blue-500" href="{{url('dang-ky')}}">{{__('Create Account')}}</a>
        </div>
          <button type="submit" class="mb-2 w-full inline-block px-6 py-3 bg-blue-600 text-white font-bold  leading-normal uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">{{__('login')}}</button>
          <div class="flex flex-col space-y-5">
            <span class="flex items-center justify-center space-x-2">
              <span class="h-px bg-gray-400 w-14"></span>
              <span class="font-normal text-gray-500">{{__('or login with')}}</span>
              <span class="h-px bg-gray-400 w-14"></span>
            </span>
            <div class="flex flex-col space-y-4">
              <a
                href="{{route('facebook.login')}}"
                class="flex items-center justify-center px-4 py-2 space-x-2 transition-colors duration-300 border border-blue-500 rounded-md group hover:bg-blue-500 focus:outline-none h-11"
              >
                  <i class="fab fa-facebook text-blue-500 group-hover:text-white text-xl"></i>
                {{-- </span> --}}
                <span class="text-sm font-medium text-gray-800 group-hover:text-white">Facebook</span>
              </a>
              <a
                href="{{route('google.login')}}"
                class="flex items-center justify-center px-4 py-2 space-x-2 transition-colors duration-300 border border-blue-500 rounded-md group hover:bg-blue-500 focus:outline-none h-11"
              >
                <i class="fab fa-google text-red-500 group-hover:text-white text-xl"></i>
                <span class="text-sm font-medium text-gray-800 group-hover:text-white">Google</span>
              </a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@stop
