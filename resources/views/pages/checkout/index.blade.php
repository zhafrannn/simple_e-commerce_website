@extends('layouts.guest')

@section('title')
Checkout
@endsection

@section('content')
<section class="pt-[134px] px-[11%] bg-[#FAFAFA] min-h-screen">
    <div class="border border-[#FAFAFA] w-[100%]"></div>
    <div class="flex gap-5">
        <div class="w-8/12 bg-[#FAFAFA] pr-[20px]">
            <h1 class="text-[32px] pt-[24px] pb-[21px] font-semibold">Checkout</h1>
            <div class="border border-[#D9D9D9] w-[100%]"></div>
            @php
            $sub_total = 0;
            @endphp
            @foreach($items as $item)
            <div class="pt-[16px] pb-[17px]">
                <div class="flex items-center w-[100%] justify-between">
                    <div class="flex justify-between gap-[32px]">
                        <div class="bg-white h-[160px] w-[160px] flex justify-center items-center">
                            <img src="{{ asset('/images/beer/'. $item->product->product_image )}}" class="h-[143px]">
                        </div>
                        <div class="flex flex-col justify-between items-start h-[160px]">
                            <div>
                                <h1 class="font-bold text-[20px]">{{$item->product->category->category_name}}</h1>
                                <h1 class="font-bold text-[20px]">{{$item->product->product_name}}</h1>
                            </div>
                            <p class="text-[14px]">330ml</p>
                            <div class="flex gap-[12px] pb-10 items-center">
                                <p class="font-bold text-[14px] text-[#888686]">Quantity</p>
                                <p class="font-medium text-[14px] text-[#888686]">x{{$item->quantity}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-around items-center w-[25%] gap-[18%]">
                        <div class="flex flex-col leading-6">
                            <h1 class="font-bold text-[24px]">¥{{$item->product->price}}</h1>
                            <p class="text-[16px] font-normal">(税込)</p>
                        </div>
                        <input type="number" id="price{{ $item->id }}" value="{{$item->product->price}}" hidden>
                        <button onclick="deleteCheckout('{{$item->id}}')"><img src="{{asset('images/icons/trash.svg')}}" alt="trash"></button>
                    </div>

                    <input type="number" value="{{$item->transaction_id}}" id="transaction_id" hidden>
                </div>
            </div>
            <div class="border border-[#D9D9D9] w-[100%]"></div>
            @php
            $total = $item->product->price * $item->quantity;
            $sub_total += $total;
            @endphp
            @endforeach
        </div>
        <div class="w-4/12 bg-white pl-[30px]">
            <h1 class="text-[32px] pt-[24px] pb-[21px] font-semibold">Total</h1>
            <div class="border border-[#D9D9D9] w-[100%]"></div>
            <div class="grid grid-cols-2 py-[24px]">
                <p class="font-semibold text-[20px]">Subtotal</p>
                <p class="font-semibold text-[20px]">¥{{$sub_total}}</span></p>
            </div>
            <div class="grid grid-cols-2 pb-[32px]">
                <p class="font-semibold text-[20px]">Shipping</p>
                <p class="font-semibold text-[20px]">¥0</span></p>
            </div>
            <div class="border border-[#D9D9D9] w-[100%]"></div>
            <div class="grid grid-cols-2 pb-[24px] pt-[31px]">
                <p class="font-semibold text-[20px]">Total</p>
                <p id="total_payment" class="font-semibold text-[20px]">¥{{$sub_total}}</span></p>
            </div>
            <div class="grid grid-cols-2 pb-[39px]">
                <p class="text-[#888686] font-medium text-[16px]">DISCOUNT CODE</p>
                <p class="font-medium text-[16px]">→</p>
            </div>
            <div class="border border-[#888] w-[100%]"></div>
            <div class="flex flex-col items-center">
                <div class="border border-[black] border-solid text-center mt-[39px] rounded-[4px] mx-[25px]">
                    <button onclick="payment()" class="py-[8px] px-[66px] text-[16px] font-medium">PAYMENT</button>
                </div>
                <button onclick="backToCart()" class="text-[16px] font-medium mt-[20px]">← <span class="border-b border-black">Back to cart</span></button>
                <button onclick="ContinueShopping()" class="text-[16px] font-medium mt-[20px]">← <span class="border-b border-black">Continue shopping</span></button>
            </div>
        </div>

    </div>
</section>
<script>
    var transactionId = $('#transaction_id').val();
    let totalPayment = $('#total_payment').text('');

    function deleteCheckout(checkoutId) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf"]').attr('value')
            },
            url: '{{url("")}}/checkoutd/' + checkoutId,
            method: 'GET',
            success: function(msg) {
                console.log(msg);
                window.location.href = "/checkout/" + transactionId;
            },
            error: function(error) {
                console.error(error);
            }
        });
    }

    function payment() {
        console.log(transactionId)
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf"]').attr('value')
            },
            url: '{{url("")}}/transaction',
            method: 'POST',
            data: {
                'transaction_id': transactionId,
            },
            success: function(msg) {
                console.log(msg);
                window.location.href = "/transaction";
            },
            error: function(error) {
                console.error(error);
            }
        });
    }

    function deleteAll() {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf"]').attr('value')
            },
            url: '{{url("")}}/transaction/delete/' + transactionId,
            method: 'GET',
            success: function(msg) {
                console.log(msg);
            },
            error: function(error) {
                console.error(error);
            }
        });
    }

    function backToCart() {
        deleteAll();

        window.location.href = "/cart";
    }

    function ContinueShopping() {
        deleteAll();

        window.location.href = "/";
    }
</script>
@endsection