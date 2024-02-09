@extends('layouts.guest')

@section('title')
Cart
@endsection

@section('content')
<section class="pt-[134px] px-[11%] bg-[#FAFAFA] min-h-screen">
    <div class="border border-[#FAFAFA] w-[100%]"></div>
    <div class="flex gap-5">
        <div class="w-8/12 bg-[#FAFAFA] pr-[20px]">
            <h1 class="text-[32px] pt-[24px] pb-[21px] font-semibold">Shopping Cart</h1>
            <div class="border border-[#D9D9D9] w-[100%]"></div>
            @if($items)
            @foreach($items as $item)
            <div class="pt-[16px] pb-[17px]">
                <div class="flex items-center w-[100%] justify-between">
                    <div class="flex items-center justify-between w-[65%]">
                        <input onchange="checkbox($(this), {{$item->id}})" type="checkbox" name="check{{$item->id}}" id="check{{$item->id}}" class="border border-[#D9D9D9] h-[16px] w-[16px]">
                        <div class="bg-white h-[160px] w-[160px] flex justify-center items-center">
                            <img src="{{ asset('/images/beer/'. $item->product->product_image )}}" class="h-[143px] px-3">
                        </div>
                        <div class="flex flex-col justify-between items-start h-[160px]">
                            <div class="">
                                <h1 class="font-bold text-[20px]">{{$item->product->category->category_name}}</h1>
                                <h1 class="font-bold text-[20px] w-[210px]">{{$item->product->product_name}}</h1>
                            </div>
                            <p class="text-[14px]">330ml</p>
                            <div class="flex gap-[12px] pb-3 items-center">
                                <p class="font-bold text-[14px] text-[#888686]">Quantity</p>
                                <div class="flex justify-between bg-white px-[6px] py-[8px] rounded-[9px] h-[37px] w-[125px]">
                                    <button onclick="decrease('{{ $item->id }}')" class="text-[#333232] text-[16px] bg-[#F9F9F9] rounded-[3px] hover:bg-[#B3B4B4] font-bold w-[21px] h-[21px]">-</button>
                                    <input class="w-7 text-center text-[16px] font-bold" type="text" value="{{$item->quantity}}" id="counter{{ $item->id }}" readonly>
                                    <button onclick="increase('{{ $item->id }}')" class="text-[#333232] text-[16px] bg-[#F9F9F9] rounded-[3px] hover:bg-[#B3B4B4] font-bold w-[21px] h-[21px]">+</button>
                                </div>
                            </div>

                            <!-- Initiate Stock -->
                            <input type="number" value="{{$item->product->stock}}" id="stock" hidden>
                        </div>
                    </div>
                    <div class="flex justify-around items-center w-[25%] gap-[18%]">
                        <div class="flex flex-col leading-6">
                            <h1 class="font-bold text-[24px]">¥{{$item->product->price}}</h1>
                            <p class="text-[16px] font-normal">(税込)</p>
                        </div>
                        <input type="number" id="price{{ $item->id }}" value="{{$item->product->price}}" hidden>
                        <button onclick="deleteCart('{{$item->id}}')"><img src="{{asset('images/icons/trash.svg')}}" alt="trash"></button>
                    </div>
                </div>
            </div>
            <div class="border border-[#D9D9D9] w-[100%]"></div>
            @endforeach
            @else
            <h1 class="text-black text-[32px]">There Are No Product In The Cart! </h1>
            @endif
        </div>
        <div class="w-4/12 bg-white pl-[30px]">
            <h1 class="text-[32px] pt-[24px] pb-[21px] font-semibold">Total</h1>
            <div class="border border-[#D9D9D9] w-[100%]"></div>
            <div class="grid grid-cols-2 py-[24px]">
                <p class="font-semibold text-[20px]">Total</p>
                <p id="total_payment" class="font-semibold text-[20px]">¥0</span></p>
            </div>
            <div class="grid grid-cols-2 pb-[39px]">
                <p class="text-[#888686] font-medium text-[16px]">DISCOUNT CODE</p>
                <p class="font-medium text-[16px]">→</p>
            </div>
            <div class="border border-[#888] w-[100%]"></div>
            <div class="flex flex-col items-center">
                <div class="border border-[black] border-solid text-center mt-[39px] rounded-[4px] mx-[25px]">
                    <button onclick="checkout()" class="py-[8px] px-[66px] text-[16px] font-medium">CHECKOUT NOW</button>
                </div>
                <a href="{{ url('/') }}" class="text-[16px] font-medium mt-[20px]">← <span class="border-b border-black">Continue shopping</span></a>
            </div>
        </div>

    </div>
</section>
<script>
    var initialStock = $('#stock').val();

    function updateCounter(cartId, counter) {
        $(`#counter${cartId}`).val(counter);
    }

    function decrease(cartId) {
        let counter = $(`#counter${cartId}`).val();
        console.log(counter)
        if (counter > 0) {
            counter--;
            initialStock++;
            updateCounter(cartId, counter);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf"]').attr('value')
                },
                url: '{{url("")}}/cart/' + cartId,
                method: 'PUT',
                data: {
                    'quantity': counter,
                },
                success: function(msg) {
                    console.log(msg);
                },
                error: function(error) {
                    console.error(error);
                }
            });

        }
    }

    function increase(cartId) {
        let counter = $(`#counter${cartId}`).val();
        if (initialStock > 0) {
            counter++;
            initialStock--;
            updateCounter(cartId, counter);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf"]').attr('value')
                },
                url: '{{url("")}}/cart/' + cartId,
                method: 'PUT',
                data: {
                    'quantity': counter,
                },
                success: function(msg) {
                    console.log(msg);
                },
                error: function(error) {
                    console.error(error);
                }
            });
        }
    }

    function deleteCart(cartId) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf"]').attr('value')
            },
            url: '{{url("")}}/cart/' + cartId,
            method: 'GET',
            success: function(msg) {
                console.log(msg);
                window.location.href = "/cart";
            },
            error: function(error) {
                console.error(error);
            }
        });
    }
</script>

<script>
    var checkedItems = [];
    let totalPayment = 0;

    function checkbox(element, cartId) {
        let price = $(`#price${cartId}`).val();
        let quantity = $(`#counter${cartId}`).val();
        let total = price * quantity;

        if (element.prop('checked')) {
            totalPayment += total;
            checkedItems.push(cartId); // Menambahkan ID item yang di-check ke dalam array
        } else {
            totalPayment -= total;
            // Menghapus ID item yang di-uncheck dari array
            checkedItems = checkedItems.filter(item => item !== cartId);
        }

        $('#total_payment').text('¥' + totalPayment);
        console.log(checkedItems)
    }

    function checkout() {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf"]').attr('value')
            },
            url: '{{url("")}}/checkout',
            method: 'POST',
            data: {
                'checked_items': checkedItems,
                'total_payment': totalPayment,
            },
            success: function(msg) {
                console.log(msg);
                window.location.href = "/checkout/" + msg.transaction_id;
            },
            error: function(error) {
                console.error(error);
            }
        });
    }
</script>
@endsection