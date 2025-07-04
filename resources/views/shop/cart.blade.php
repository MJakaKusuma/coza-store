<!DOCTYPE html>
<html lang="en">

<head>
  <title>Shopping Cart</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="{{ asset('images/icons/favicon.png') }}" />
  <link rel="stylesheet" type="text/css" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('fonts/iconic/css/material-design-iconic-font.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('fonts/linearicons-v1.0.0/icon-font.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('vendor/animate/animate.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('vendor/css-hamburgers/hamburgers.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('vendor/animsition/css/animsition.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('vendor/select2/select2.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('vendor/perfect-scrollbar/perfect-scrollbar.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/util.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
</head>

<body class="animsition">

  @include('layouts.navbar')

  <div class="wrap-header-cart js-panel-cart">
    <div class="s-full js-hide-cart"></div>

    <div class="header-cart flex-col-l p-l-65 p-r-25">
      <div class="header-cart-title flex-w flex-sb-m p-b-8">
        <span class="mtext-103 cl2">
          Your Cart
        </span>

        <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
          <i class="zmdi zmdi-close"></i>
        </div>
      </div>

      <div class="header-cart-content flex-w js-pscroll">
        <ul class="header-cart-wrapitem w-full">
          {{-- Cart items for the sidebar (mini cart) --}}
          @php
      $sidebarTotal = 0;
      $cartItems = session()->get('cart', []);
    @endphp
          @forelse ($cartItems as $id => $item)
          @php
        $sidebarSubtotal = $item['price'] * $item['quantity'];
        $sidebarTotal += $sidebarSubtotal;
        @endphp
          <li class="header-cart-item flex-w flex-t m-b-12">
          <div class="header-cart-item-img">
            <img src="{{ asset('storage/' . $item['image']) }}" alt="IMG">
          </div>

          <div class="header-cart-item-txt p-t-8">
            <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
            {{ $item['name'] }}
            </a>

            <span class="header-cart-item-info">
            {{ $item['quantity'] }} x ${{ number_format($item['price']) }}
            </span>
          </div>
          </li>
      @empty
        <li class="header-cart-item flex-w flex-t m-b-12">
        <div class="p-t-8">
          <span class="mtext-103 cl2">Your cart is empty.</span>
        </div>
        </li>
      @endforelse
        </ul>

        <div class="w-full">
          <div class="header-cart-total w-full p-tb-40">
            Total: Rp.{{ number_format($sidebarTotal, 0, ',', '.') }}
          </div>

          <div class="header-cart-buttons flex-w w-full">
            {{-- Since you don't have cart.show, this might link back to a main shop page or be removed --}}
            <a href="{{ url('/shop') }}"
              class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
              Continue Shopping
            </a>

            <a href="{{ route('checkout') }}"
              class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10 {{ empty($cartItems) ? 'disabled' : '' }}">
              Check Out
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
      <a href="{{ url('/') }}" class="stext-109 cl8 hov-cl1 trans-04">
        Home
        <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
      </a>

      <span class="stext-109 cl4">
        Shopping Cart
      </span>
    </div>
  </div>

  <div class="bg0 p-t-75 p-b-85">
    <div class="container">
      <div class="row">
        <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
          <div class="m-l-25 m-r--38 m-lr-0-xl">
            @php
        $mainCartTotal = 0;
        $cartItems = session()->get('cart', []); // Re-fetch or use the already defined $cartItems
        @endphp

            @if (!empty($cartItems))
          <form action="{{ route('cart.update') }}" method="POST">
            @csrf
            <div class="wrap-table-shopping-cart">
            <table class="table-shopping-cart">
              <tr class="table_head">
              <th class="column-1">Product</th>
              <th class="column-2"></th>
              <th class="column-3">Price</th>
              <th class="column-4">Quantity</th>
              <th class="column-5">Total</th>
              </tr>

              @foreach ($cartItems as $id => $item)
            @php
          $subtotal = $item['price'] * $item['quantity'];
          $mainCartTotal += $subtotal;
          @endphp
            <tr class="table_row">
            <td class="column-1">
              <div class="how-itemcart1">
              <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}">
              </div>
            </td>
            <td class="column-2">
              {{ $item['name'] }}
              @if (isset($item['size']))
            <small>(Size: {{ $item['size'] }})</small>
          @endif
              @if (isset($item['color']))
            <small>(Color: {{ $item['color'] }})</small>
          @endif
            </td>
            <td class="column-3">Rp.{{ number_format($item['price'], 0, ',', '.') }}</td>
            <td class="column-4">
              <div class="wrap-num-product flex-w m-l-auto m-r-0">
              <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
              <i class="fs-16 zmdi zmdi-minus"></i>
              </div>

              <input class="mtext-104 cl3 txt-center num-product" type="number" name="quantities[{{ $id }}]"
              value="{{ $item['quantity'] }}" min="1">

              <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
              <i class="fs-16 zmdi zmdi-plus"></i>
              </div>
              </div>
            </td>
            <td class="column-5">Rp.{{ number_format($subtotal, 0, ',', '.') }}</td>
            </tr>
          @endforeach
            </table>
            </div>

            <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
            <div class="flex-w flex-m m-r-20 m-tb-5">
              <input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" type="text" name="coupon"
              placeholder="Coupon Code">

              <button type="button"
              class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
              Apply coupon
              </button>
            </div>

            <button type="submit"
              class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
              Update Cart
            </button>
            </div>

        @else
          <div class="alert alert-warning text-center p-5">
          Your cart is empty.
          <br>
          <a href="{{ url('/shop') }}" class="btn btn-sm btn-primary mt-3">Start Shopping</a>
          </div>
        @endif
          </div>
        </div>

        <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
          <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
            <h4 class="mtext-109 cl2 p-b-30">
              Cart Totals
            </h4>

            <div class="flex-w flex-t bor12 p-b-13">
              <div class="size-208">
                <span class="stext-110 cl2">
                  Subtotal:
                </span>
              </div>

              <div class="size-209">
                <span class="mtext-110 cl2">
                  Rp.{{ number_format($mainCartTotal, 0, ',', '.') }}
                </span>
              </div>
            </div>

            <div class="flex-w flex-t bor12 p-t-15 p-b-30">
              <div class="size-208 w-full-ssm">
                <span class="stext-110 cl2">
                  Shipping:
                </span>
              </div>

              <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
                <p class="stext-111 cl6 p-t-2">
                  There are no shipping methods available. Please double check your address, or contact us if you need
                  any help.
                </p>

                <div class="p-t-15">
                  <span class="stext-112 cl8">
                    Calculate Shipping
                  </span>

                  <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
                    <select class="js-select2" name="country">
                      <option>Select a country...</option>
                      <option>USA</option>
                      <option>UK</option>
                    </select>
                    <div class="dropDownSelect2"></div>
                  </div>

                  <div class="bor8 bg0 m-b-12">
                    <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="state"
                      placeholder="State / country">
                  </div>

                  <div class="bor8 bg0 m-b-22">
                    <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="postcode"
                      placeholder="Postcode / Zip">
                  </div>
                  <div class="m-b-20">

                    <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12">
                      <select class="js-select2" name="payment_method" required>
                        <option value="">-- Pilih Metode Pembayaran --</option>
                        <option value="bank_transfer">Transfer Bank</option>
                        <option value="cod">Bayar di Tempat (COD)</option>
                        <option value="ewallet">Dompet Digital (OVO, DANA, dll)</option>
                      </select>
                      <div class="dropDownSelect2"></div>
                    </div>
                  </div>
                  <button type="submit"
                    class="flex-c-m stext-101 cl2 size-115 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer">
                    Update Totals
                    <button>
                </div>
                </form>
              </div>
            </div>
          </div>

          <div class="flex-w flex-t p-t-27 p-b-33">
            <div class="size-208">
              <span class="mtext-101 cl2">
                Total:
              </span>
            </div>

            <div class="size-209 p-t-1">
              <span class="mtext-110 cl2">
                Rp.{{ number_format($mainCartTotal, 0, ',', '.') }}
              </span>
            </div>
          </div>

          <form method="POST" action="{{ route('checkout') }}">
            @csrf
            <button type="submit"
              class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer {{ empty($cartItems) ? 'disabled' : '' }}"
              {{ empty($cartItems) ? 'disabled' : '' }}>
              Proceed to Checkout
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
  </div>


  <footer class="bg3 p-t-75 p-b-32">
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-lg-3 p-b-50">
          <h4 class="stext-301 cl0 p-b-30">
            Categories
          </h4>

          <ul>
            <li class="p-b-10">
              <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                Women
              </a>
            </li>

            <li class="p-b-10">
              <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                Men
              </a>
            </li>

            <li class="p-b-10">
              <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                Shoes
              </a>
            </li>

            <li class="p-b-10">
              <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                Watches
              </a>
            </li>
          </ul>
        </div>

        <div class="col-sm-6 col-lg-3 p-b-50">
          <h4 class="stext-301 cl0 p-b-30">
            Help
          </h4>

          <ul>
            <li class="p-b-10">
              <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                Track Order
              </a>
            </li>

            <li class="p-b-10">
              <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                Returns
              </a>
            </li>

            <li class="p-b-10">
              <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                Shipping
              </a>
            </li>

            <li class="p-b-10">
              <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                FAQs
              </a>
            </li>
          </ul>
        </div>

        <div class="col-sm-6 col-lg-3 p-b-50">
          <h4 class="stext-301 cl0 p-b-30">
            GET IN TOUCH
          </h4>

          <p class="stext-107 cl7 size-201">
            Any questions? Let us know in store at 8th floor, 379 Hudson St, New York, NY 10018 or call us on (+1) 96
            716 6879
          </p>

          <div class="p-t-27">
            <a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
              <i class="fa fa-facebook"></i>
            </a>

            <a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
              <i class="fa fa-instagram"></i>
            </a>

            <a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
              <i class="fa fa-pinterest-p"></i>
            </a>
          </div>
        </div>

        <div class="col-sm-6 col-lg-3 p-b-50">
          <h4 class="stext-301 cl0 p-b-30">
            Newsletter
          </h4>

          <form>
            <div class="wrap-input1 w-full p-b-4">
              <input class="input1 bg-none plh1 stext-107 cl7" type="text" name="email" placeholder="email@example.com">
              <div class="focus-input1 trans-04"></div>
            </div>

            <div class="p-t-18">
              <button class="flex-c-m stext-101 cl0 size-103 bg1 bor1 hov-btn2 p-lr-15 trans-04">
                Subscribe
              </button>
            </div>
          </form>
        </div>
      </div>

      <div class="p-t-40">
        <div class="flex-c-m flex-w p-b-18">
          <a href="#" class="m-all-1">
            <img src="{{ asset('images/icons/icon-pay-01.png') }}" alt="ICON-PAY">
          </a>

          <a href="#" class="m-all-1">
            <img src="{{ asset('images/icons/icon-pay-02.png') }}" alt="ICON-PAY">
          </a>

          <a href="#" class="m-all-1">
            <img src="{{ asset('images/icons/icon-pay-03.png') }}" alt="ICON-PAY">
          </a>

          <a href="#" class="m-all-1">
            <img src="{{ asset('images/icons/icon-pay-04.png') }}" alt="ICON-PAY">
          </a>

          <a href="#" class="m-all-1">
            <img src="{{ asset('images/icons/icon-pay-05.png') }}" alt="ICON-PAY">
          </a>
        </div>

        <p class="stext-107 cl6 txt-center">
          Copyright &copy;
          <script>
            document.write(new Date().getFullYear());
          </script> All rights reserved | Made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a
            href="https://colorlib.com" target="_blank">Colorlib</a>
          &amp; distributed by <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
        </p>
      </div>
    </div>
  </footer>


  <div class="btn-back-to-top" id="myBtn">
    <span class="symbol-btn-back-to-top">
      <i class="zmdi zmdi-chevron-up"></i>
    </span>
  </div>

  <script src="{{ asset('vendor/jquery/jquery-3.2.1.min.js') }}"></script>
  <script src="{{ asset('vendor/animsition/js/animsition.min.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap/js/popper.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
  <script>
    $(".js-select2").each(function () {
      $(this).select2({
        minimumResultsForSearch: 20,
        dropdownParent: $(this).next('.dropDownSelect2')
      });
    })
  </script>
  <script src="{{ asset('vendor/MagnificPopup/jquery.magnific-popup.min.js') }}"></script>
  <script src="{{ asset('vendor/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
  <script>
    $('.js-pscroll').each(function () {
      $(this).css('position', 'relative');
      $(this).css('overflow', 'hidden');
      var ps = new PerfectScrollbar(this, {
        wheelSpeed: 1,
        scrollingThreshold: 1000,
        wheelPropagation: false,
      });

      $(window).on('resize', function () {
        ps.update();
      })
    });
  </script>
  <script src="{{ asset('js/main.js') }}"></script>

  <script>
    $(document).ready(function () {
      // Quantity Plus Button
      $('.btn-num-product-up').on('click', function () {
        var input = $(this).parent().find('.num-product');
        var quantity = parseInt(input.val());
        input.val(quantity + );
      });

      // Quantity Minus Button
      $('.btn-num-product-down').on('click', function () {
        var input = $(this).parent().find('.num-product');
        var quantity = parseInt(input.val());
        if (quantity > 1) {
          input.val(quantity - );
        }
      });
    });
  </script>
</body>

</html>