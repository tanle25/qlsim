@extends('login.master')
@section('title')
{{__('Reset Password')}}
@stop
@section('content')
<div class="bg-gradient-to-tr from-green-300 to-green-600 h-screen w-full flex justify-center items-center">
    <div class="w-1/2 flex justify-center items-center">
        <div class="bg-white w-full md:w-1/2 flex flex-col items-center py-10 px-8  justify-center">
            <form class="w-full" action="{{url('reset-password')}}" method="post">
                @csrf
                <input type="password" name="password" class="input-field w-full" placeholder="{{__('Password')}}">
                <input type="password" name="password_confirmation" class="input-field w-full mt-3" placeholder="{{__('Password confirmation')}}">

                <div class="flex justify-center">
                    <button type="submit" class="btn-default btn-otp">{{__('Reset Password')}}</button>

                </div>
            </form>
        </div>
    </div>
</div>
@endsection
