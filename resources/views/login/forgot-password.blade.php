@extends('login.master')
@section('title')
{{__('Forgot Password')}}
@stop

@section('content')
<div class="bg-gradient-to-tr from-green-300 to-green-600 h-screen w-full flex justify-center items-center">
    <div class="w-1/2 flex justify-center items-center">
        <div class="bg-white w-full md:w-1/2 flex flex-col items-center py-10 px-8  justify-center">
            <form class="w-full" action="{{url('forgot-password')}}" method="post">
                @csrf
                <input type="email" name="email" class="input-field w-full" placeholder="{{__('Email Address')}}">
                <div class="flex justify-center">
                    <button class="btn-default">{{__('Reset Password')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
