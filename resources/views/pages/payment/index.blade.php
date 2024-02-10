@extends('layouts.guest')

@section('title')
Payment
@endsection

@section('content')

<section class="flex flex-col h-screen justify-center items-center">
    <div class="flex flex-col justify-center items-center mb-[35px] pt-14">
        <h1 class="text-[32px] font-semibold">Thank You!</h1>
        <h1 class="text-[32px] font-semibold">Your Payment Has Been Processed</h1>
    </div>
    <img src="{{ asset('images/payment-success.svg')}}" alt="">
    <a href="{{ url('/') }}" class="text-[16px] font-medium mt-[50px]">← <span class="border-b border-black">Continue shopping</span></a>
</section>
@endsection