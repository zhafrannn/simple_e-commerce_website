@extends('layouts.guest')

@section('title')
Beer
@endsection

@section('content')

<section class="pt-[150px] px-[11%]">
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <p class="inline-flex items-center font-normal text-gray-500 dark:text-gray-400 dark:hover:text-white text-[12px]">
                    Nikko Brewing
                </p>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 w-[4px] text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="ms-1 font-bold text-gray-700 md:ms-2 dark:text-gray-400 text-[12px]">{{ Breadcrumbs::render('beer') }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="pt-[71px] pb-[139px]">
        <div class="grid grid-cols-4 place-content-between gap-8">
            @foreach($products as $product)
            <!-- Card -->
            <div class="h-[384px]">
                <a class="card w-[100%] h-96 bg-base-100 flex justify-between" href="{{url('beer/'.$product->id)}}" style="box-shadow: 3px 3px 4px 1px rgba(0, 0, 0, 0.05);">
                    <div class="h-[280px] flex items-center justify-center px-5 py-[22px]">
                        <img src="{{ asset('images/beer/'. $product->product_image) }}" alt="Shoes" class="" />
                    </div>
                    <div class="flex flex-col items-center text-center justify-end gap-2 pb-5">
                        <div class="leading-5">
                            <h1 class="font-bold text-[16px]">{{ $product->category_name }}</h1>
                            <h1 class="font-bold text-[16px]">{{ $product->product_name }}</h1>
                        </div>
                        <div class="flex items-center">
                            <h1 class="font-bold text-[20px]">¥{{ $product->price }} </h1>
                            <p class="text-[12px]">(税込)/330ml</p>
                        </div>
                    </div>
                </a>
            </div>
            <!-- End Card -->
            @endforeach
        </div>
    </div>
</section>

<script>
    function search() {
        event.preventDefault();

        let searchValue = $('#search-value').val();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf"]').attr('value')
            },
            url: '{{url("")}}/search',
            method: 'POST',
            data: {
                'search_value': searchValue,
            },
            success: function(response) {
                console.log(response);

            },
            error: function(error) {
                console.error(error);
            }
        });
    }
</script>
@endsection