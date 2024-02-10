<nav class="flex fixed left-0 top-0 z-[500] w-[100%] justify-between items-center bg-white px-[160px] pt-[66px] pb-[20px] gap-8">
    <div class="w-[20%] flex items-center mb-[12px]">
        <a href="{{ url('/') }}" class="flex items-center">
            <img src="{{ asset('images/nikko-logo.svg') }}" alt="logo-nikko" class="h-[36px]">
        </a>
    </div>
    <div class="flex items-center justify-between text-[12px] w-[50%] gap-[40px]">
        <a href="" class="">
            <p>About Us</p>
        </a>
        <a href="" class="">
            <p>Beer</p>
        </a>
        <a href="" class="">
            <p>FAQs</p>
        </a>
        <a href="" class="">
            <p>Contact Us</p>
        </a>
        <div class="flex">
            <div class="flex items-center border border-black rounded-xl px-3 gap-5 {{ request()->is('/') ? '' : 'hidden' }}">
                <form id="search-form" action="" method="GET">
                    <button type="submit"><img src="{{ asset('images/icons/search.svg') }}" alt=""></button>
                    <input id="search-value" placeholder="search" class="outline-none resize-none" rows="1" name="search">
                </form>
            </div>
        </div>
    </div>

    <div class="flex items-center justify-between gap-[46px] text-12px">
        <a class="flex items-center gap-[3px]" href="">
            <img src="{{ asset('images/icons/user.svg') }}" alt="" class="w-[18px]">
            <p class="text-[12px]">Sign In</p>
        </a>
        <a class="flex items-center gap-[3px]" href="{{url('/cart')}}">
            @if($myGlobalKey>0)
            <button class="py-4 px-1 relative border-2 border-transparent text-gray-800 rounded-full hover:text-gray-400 focus:outline-none focus:text-gray-500 transition duration-150 ease-in-out" aria-label="Cart">
                <img src="{{ asset('images/icons/cart.svg') }}" alt="" class="h-6 w-6">

                <span class="absolute inset-0 object-right-top -mr-6">
                    <div class="inline-flex items-center px-1.5 py-0.5 border-2 border-white rounded-full text-xs font-semibold leading-4 bg-[#ff9900] text-white">
                        {{ $myGlobalKey }}
                    </div>
                </span>
            </button>

            @else
            <img src="{{ asset('images/icons/cart.svg') }}" alt="" class="w-[18px]">
            @endif
            <p class="text-[12px]">Cart</p>
        </a>
    </div>
</nav>