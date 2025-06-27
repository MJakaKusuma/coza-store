<div class="block2">
  <div class="block2-pic hov-img0 @if($label) label-new @endif" @if($label) data-label="{{ $label }}" @endif>
    <img src="{{ asset($image) }}" alt="{{ $name }}">

    @if($stock > 0)
    <a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1"
      data-name="{{ $name }}" data-price="{{ number_format($price, 0, ',', '.') }}"
      data-description="{{ strip_tags($description) }}" data-image="{{ asset($image) }}" data-action="{{ $action }}">
      Quick View
    </a>
  @else
    <div class="block2-btn flex-c-m stext-103 cl2 size-102 bg-secondary text-white p-lr-15"
      style="cursor: not-allowed;">
      Stok Habis
    </div>
  @endif
  </div>

  <div class="block2-txt flex-w flex-t p-t-14">
    <div class="block2-txt-child1 flex-col-l">
      <a href="{{ $detailUrl }}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
        {{ $name }}
      </a>
      <span class="stext-105 cl3">Rp {{ number_format($price, 0, ',', '.') }}</span>
      <span class="stext-105 cl3">Stok: {{ $stock }}</span>
      @if ($rating)
      <span class="stext-105 cl3">Rating: {{ $rating }}</span>
    @endif
    </div>
  </div>
</div>