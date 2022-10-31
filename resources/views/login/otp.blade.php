@extends('login.master')

@section('title')
{{__('OTP verifycation')}}
@stop
@php
    $user = Session::has('verifyUser') ? Session::get('verifyUser') : Auth::user();
@endphp
@section('content')
<div class="bg-gradient-to-tr from-green-300 to-green-600 h-screen w-full flex justify-center items-center">
    <div class="w-1/2 flex justify-center items-center">
        <div class="bg-white w-full md:w-1/2 flex flex-col items-center py-10 px-8  justify-center">
            <form action="{{url('register-verify')}}" class="otp-form" name="otp-form" method="POST">
                @csrf

                <div class="title">
                  <h3>{{__('OTP verifycation')}}</h3>
                  <p class="info">{{__('An OTP has been send to you email',['email'=>$user->email])}}</p>
                  <p class="msg">{{__('Please enter OTP to verify')}}</p>
                </div>

                <div class="otp-input-fields">
                    <input type="hidden" name="user_id" value="{{$user->id}}">
                    <input type="number" name="otp[]" class="otp__digit otp__field__1">
                    <input type="number" name="otp[]" class="otp__digit otp__field__2">
                    <input type="number" name="otp[]" class="otp__digit otp__field__3">
                    <input type="number" name="otp[]" class="otp__digit otp__field__4">
                </div>

                {{-- <div class="result"><p id="_otp" class="_notok">855412</p></div> --}}
                <div class="flex justify-center">
                    <button type="submit" class="btn-default w-200-px btn-otp">{{__('Send OTP')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
var otp_inputs = document.querySelectorAll(".otp__digit")
var mykey = "0123456789".split("")
otp_inputs.forEach((_)=>{
  _.addEventListener("keyup", handle_next_input)
})
function handle_next_input(event){
  let current = event.target
  let index = parseInt(current.classList[1].split("__")[2])
  current.value = event.key

  if(event.keyCode == 8 && index > 1){
    current.previousElementSibling.focus()
  }
  if(index < 6 && mykey.indexOf(""+event.key+"") != -1){
    var next = current.nextElementSibling;
    next.focus()
  }
  var _finalKey = ""
  for(let {value} of otp_inputs){
      _finalKey += value
  }

}
</script>
@endsection
