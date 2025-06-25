<!DOCTYPE html>
<html lang="en">

<head>
  <title>Shopping Cart</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="{{ asset('images/icons/favicon.png') }}" />
  <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('fonts/iconic/css/material-design-iconic-font.min.css') }}">
  <link rel="stylesheet" href="{{ asset('fonts/linearicons-v1.0.0/icon-font.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/animate/animate.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/css-hamburgers/hamburgers.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/animsition/css/animsition.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/select2/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/perfect-scrollbar/perfect-scrollbar.css') }}">
  <link rel="stylesheet" href="{{ asset('css/util.css') }}">
  <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>

<body class="animsition">

  {{-- NAVBAR --}}
  @include('layouts.navbar')

  {{-- RIWAYAT TRANSAKSI --}}
  <div class="bg0 p-t-75 p-b-85">
    <div class="container">
      <div class="p-b-30 text-center">
        <h3 class="ltext-103 cl5">Riwayat Transaksi</h3>
      </div>

      @forelse($orders as $order)
      <div class="bor10 p-lr-40 p-t-30 p-b-30 m-b-40 shadow-sm">
      <div class="flex-w flex-sb-m p-b-20">
        <div>
        <span class="mtext-102 cl2">Order #{{ $order->id }}</span>
        </div>
        <div>
        <span class="stext-110 cl6">Status: <strong class="cl2">{{ ucfirst($order->status) }}</strong></span>
        </div>
      </div>

      <div class="wrap-table-shopping-cart">
        <table class="table-shopping-cart">
        <tr class="table_head">
          <th class="column-1">Product</th>
          <th class="column-2"></th>
          <th class="column-3">Price</th>
          <th class="column-4">Qty</th>
          <th class="column-5">Subtotal</th>
        </tr>

        @foreach($order->orderItems as $item)
      <tr class="table_row">
        <td class="column-1">
        <div class="how-itemcart1">
        <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}">
        </div>
        </td>
        <td class="column-2">{{ $item->product->name }}</td>
        <td class="column-3">Rp.{{ number_format($item->price, 0, ',', '.') }}</td>
        <td class="column-4">{{ $item->quantity }}</td>
        <td class="column-5">Rp.{{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
      </tr>
      @endforeach
        </table>
      </div>

      <div class="flex-w flex-sb-m p-t-20">
        <div></div>
        <div>
        <strong class="mtext-110 cl2">Total: Rp.{{ number_format($order->total, 0, ',', '.') }}</strong>
        </div>
        @if($order->status === 'pending')
      <form method="POST" action="{{ route('orders.cancel', $order->id) }}"
      onsubmit="return confirm('Yakin ingin membatalkan pesanan ini?');" class="mt-3">
      @csrf
      @method('PATCH')
      <button type="submit" class="btn btn-sm btn-danger">Batalkan Pesanan</button>
      </form>
      @endif
      </div>
      </div>
    @empty
      <div class="text-center">
      <h5 class="stext-109 cl2">Belum ada transaksi.</h5>
      <a href="{{ url('/shop') }}" class="btn btn-primary mt-3">Mulai Belanja</a>
      </div>
    @endforelse
    </div>
  </div>

  {{-- JS --}}
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
    });
  </script>
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
      });
    });
  </script>
  <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>