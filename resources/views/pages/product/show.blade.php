@extends('layouts.guest')

@section('title')
Beer
@endsection

@section('content')


<section class="mt-[150px] px-[11%]">
  <nav class="flex" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
      <li class="inline-flex items-center">
        <p class="inline-flex items-center font-normal text-gray-500 dark:text-gray-400 dark:hover:text-white text-[12px]">
          Nikko Brewing
        </p>
      </li>
      <li aria-current="page">
        <div class="flex items-center">
          <svg class="rtl:rotate-180 w-[4px] text-gray-700 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
          </svg>
          <span class="ms-1 font-normal text-gray-500 md:ms-2 dark:text-gray-400 text-[12px]"> <a href="{{ url('/')}}">Beer</a></span>
        </div>
      </li>
      <li aria-current="page">
        <div class="flex items-center">
          <svg class="rtl:rotate-180 w-[4px] text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
          </svg>
          <span class="ms-1 font-normal text-gray-500 md:ms-2 dark:text-gray-400 text-[12px]">{{ Breadcrumbs::render('product_name', $product->category->category_name) }}</span>
        </div>
      </li>
      <li aria-current="page">
        <div class="flex items-center">
          <svg class="rtl:rotate-180 w-[4px] text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
          </svg>
          <span class="ms-1 font-bold text-gray-700 md:ms-2 dark:text-gray-400 text-[12px]">{{ Breadcrumbs::render('product_name', $product->product_name) }}</span>
        </div>
      </li>
    </ol>
  </nav>

  <div class="gap-5 pt-[17px]">
    <div class="flex  gap-[30px]">
      <div class="flex w-[53%] h-[416px] gap-[2%]">
        <div class="border border-[#D7A933] w-[75%] h-[416px] px-[23px] py-[13px] flex items-center justify-center">
          <img src="{{ asset('images/beer/'. $product->product_image) }}" alt="Shoes" class="h-[381px]" />
        </div>
        <div class="flex flex-col justify-between w-[23%]">
          <div class="h-[132px] border border-[#D7A933]">
          </div>
          <div class="h-[132px] border border-[#D7A933]">
          </div>
          <div class="h-[132px] border border-[#D7A933]">
          </div>
        </div>
      </div>
      <div class="flex flex-col justify-between w-[45%] h-[416px]">
        <div>
          <div>
            <input type="number" id="product_id" value="{{ $product->id }}" hidden>
            <h1 class="font-bold text-[36px] leading-[1.3]">{{ $product->category->category_name }}</h1>
            <h1 class="font-bold text-[36px] leading-[1.3]">{{ $product->product_name }}</h1>
          </div>
          <div class="flex flex-col justify-between h-[155px]">

            {!! $product->json_description !!}
            
          </div>

        </div>
        <div class="flex flex-col justify-between">
          <div class="flex items-center gap-1">
            <h1 class="font-bold text-[36px] text-black">¥{{ $product->price }}</h1>
            <p class="text-[16px]">(税込)/330ml</p>
          </div>
          <div class="flex items-start gap-[18px] pb-[14px]">
            <p class="font-medium text-[12px] text-[#00000080]">Quantity</p>
            <div class="flex flex-col items-center gap-[8px]">
              <div class="flex items-center gap-[30px]">
                <button class="text-[#333232] text-[16px] bg-[#F9F9F9] rounded-[3px] hover:bg-[#B3B4B4] font-bold w-[21px] h-[21px]">-</button>
                <input class="w-7 text-center text-[16px] font-bold" type="text" value="0" readonly>
                <button class="text-[#333232] text-[16px] bg-[#F9F9F9] rounded-[3px] hover:bg-[#B3B4B4]  font-bold w-[21px] h-[21px]">+</button>
              </div>
              <p class="font-medium text-[#FF3737] text-[12px] tab-si">stock {{ $product->stock }}</p>
            </div>
          </div>
          <div class="flex gap-[18px]">
            <button type="button" class="px-[30px] py-[10px] rounded-[9px] bg-[#BB1313] text-white text-[16px] font-bold hover:bg-[#A21010]" id="buy_now">Buy Now</button>
            <button type="button" class="px-[30px] py-[10px] rounded-[9px] bg-[#258F0B] text-white text-[16px] font-bold hover:bg-[#185E07]" id="add_to_cart">Add To Cart</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="flex justify-center items-center mt-[70px]">
    <h1 class="font-bold text-[24px]">Related Product</h1>
  </div>

  <div class="grid grid-cols-4 place-content-between gap-8 mt-[49px] mb-[110px]">
    @foreach($related_products as $item)
    <!-- Card -->
    <div class="h-[384px]">
      <a class="card w-[100%] h-96 bg-base-100 flex justify-between" href="{{url('beer/'.$item->id)}}" style="box-shadow: 3px 3px 4px 1px rgba(0, 0, 0, 0.05);">
        <div class="h-[280px] flex items-center justify-center px-5 py-[22px]">
          <img src="{{ asset('images/beer/'. $item->product_image) }}" alt="Shoes" class="" />
        </div>
        <div class="flex flex-col items-center text-center justify-end gap-2 pb-5">
          <div class="leading-5">
            <h1 class="font-bold text-[16px]">{{ $item->category->category_name }}</h1>
            <h1 class="font-bold text-[16px]">{{ $item->product_name }}</h1>
          </div>
          <div class="flex items-center">
            <h1 class="font-bold text-[20px]">¥{{ $item->price }} </h1>
            <p class="text-[12px]">(税込み)/330ml</p>
          </div>
        </div>
      </a>
    </div>
    <!-- End Card -->
    @endforeach
  </div>

</section>
<script>
  // Get the initial stock value from the server-side variable
  var initialStock = {{$product -> stock}};
  var product_id = $('#product_id').val();
  console.log(product_id)

  // Update stock display function
  function updateStockDisplay() {
    $('.tab-si').text('Stock ' + initialStock);
  }

  // Plus button click event
  $('button:contains("+")').on('click', function() {
    var quantityInput = $('input[type="text"]');
    var currentQuantity = parseInt(quantityInput.val());

    if (initialStock > 0) {
      console.log(product_id)
      quantityInput.val(currentQuantity + 1);
      initialStock--;
      updateStockDisplay();
    }
  });

  // Minus button click event
  $('button:contains("-")').on('click', function() {
    var quantityInput = $('input[type="text"]');
    var currentQuantity = parseInt(quantityInput.val());

    if (currentQuantity > 0) {
      quantityInput.val(currentQuantity - 1);
      initialStock++;
      updateStockDisplay();
    }
  });

  $('#buy_now').on('click', function() {
    var quantity = parseInt($('input[type="text"]').val());

    if (quantity > 0 && quantity <= initialStock) {

      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf"]').attr('value')
        },
        url: '{{url("")}}/cart',
        method: 'POST',
        data: {
          'product_id': product_id,
          'quantity': quantity,
        },
        success: function(response) {
          console.log(response);
          window.location.href = "/cart";
        },
        error: function(error) {
          console.error(error);
        }
      });
    } else {
      window.location.href = "/";
    }
  });

  $('#add_to_cart').on('click', function() {
    var quantity = parseInt($('input[type="text"]').val());

    if (quantity > 0 && quantity <= initialStock) {

      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf"]').attr('value')
        },
        url: '{{url("")}}/cart',
        method: 'POST',
        data: {
          'product_id': product_id,
          'quantity': quantity,
        },
        success: function(response) {
          console.log(response);
          window.location.href = "/";
        },
        error: function(error) {
          console.error(error);
        }
      });
    } else {
      window.location.href = "/";
    }
  });

  updateStockDisplay();
</script>


@endsection