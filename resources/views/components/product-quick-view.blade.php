<!-- MODAL QUICK VIEW -->
<div class="wrap-modal1 js-modal1 p-t-60 p-b-20" style="display: none;">
  <div class="overlay-modal1 js-hide-modal1"></div>

  <div class="container">
    <div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
      <button class="how-pos3 hov3 trans-04 js-hide-modal1">
        <img src="{{ asset('images/icons/icon-close.png') }}" alt="CLOSE">
      </button>

      <div class="row">
        <div class="col-md-6 col-lg-7 p-b-30">
          <div class="p-l-25 p-r-30 p-lr-0-lg">
            <div class="wrap-pic-w pos-relative">
              <img id="modal-image" src="" alt="" style="width:100%;">
              <a id="modal-link" class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="">
                <i class="fa fa-expand"></i>
              </a>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-5 p-b-30">
          <div class="p-r-50 p-t-5 p-lr-0-lg">
            <h4 id="modal-name" class="mtext-105 cl2 js-name-detail p-b-14">Product Name</h4>
            <span id="modal-price" class="mtext-106 cl2">Rp0</span>
            <p id="modal-description" class="stext-102 cl3 p-t-23">Deskripsi belum dimuat</p>

            <div class="p-t-10" id="modal-rating-stars">
              ☆☆☆☆☆ (0.0)
            </div>

            <div class="p-t-33">
              <div class="flex-w flex-r-m p-b-10">
                <div class="size-203 flex-c-m respon6">Jumlah</div>
                <div class="size-204 respon6-next">
                  <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                    <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                      <i class="fs-16 zmdi zmdi-minus"></i>
                    </div>
                    <input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product" value="1">
                    <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                      <i class="fs-16 zmdi zmdi-plus"></i>
                    </div>
                  </div>
                </div>
              </div>

              <form id="modal-form" method="POST" action="">
                @csrf
                <input type="hidden" name="quantity" value="1" class="input-quantity">
                <input type="hidden" name="product_id" id="modal-product-id">
                <button type="submit" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                  Tambah ke Keranjang
                </button>
              </form>
            </div>

            <div class="p-t-40">
              <h5 class="mtext-102 cl2 p-b-10">Ulasan Pelanggan</h5>
              <div id="modal-comments" class="stext-102 cl6">
                <p>Belum ada komentar.</p>
              </div>

              @auth
            @if(auth()->user()->role === 'customer')
          <form method="POST" action="{{ route('product.comment', 0) }}" id="modal-comment-form" class="p-t-20">
          @csrf
          <textarea name="comment" class="bor8 stext-102 cl2 p-lr-20 p-tb-10" rows="3"
          placeholder="Tulis ulasan..."></textarea>
          <div class="p-t-10">
          <label class="stext-102 cl2 p-b-10">Rating:</label>
          <select name="rating" class="bor8 stext-102 cl2 p-lr-15 p-tb-5 m-t-5">
          <option value="5">★★★★★ (5)</option>
          <option value="4">★★★★☆ (4)</option>
          <option value="3">★★★☆☆ (3)</option>
          <option value="2">★★☆☆☆ (2)</option>
          <option value="1">★☆☆☆☆ (1)</option>
          </select>
          </div>
          <button type="submit" class="flex-c-m stext-101 cl0 size-101 bg3 bor1 hov-btn2 p-lr-15 trans-04 m-t-15">
          Kirim Ulasan
          </button>
          </form>
        @endif
        @endauth
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  $('.js-show-modal1').click(function () {
    let name = $(this).data('name');
    let price = $(this).data('price');
    let description = $(this).data('description');
    let image = $(this).data('image');
    let action = $(this).data('action');
    let productId = $(this).data('product-id');

    $('#modal-name').text(name);
    $('#modal-price').text('Rp ' + price);
    $('#modal-description').text(description);
    $('#modal-image').attr('src', image);
    $('#modal-form').attr('action', action);
    $('#modal-product-id').val(productId);
    $('#modal-comment-form').attr('action', `/product/${productId}/comment`);

    $('#modal-comments').html('Memuat komentar...');
    $('#modal-rating-stars').html('');

    $.get(`/api/products/${productId}/comments`, function (data) {
      let html = '';
      let totalRating = 0;
      data.forEach(comment => {
        totalRating += comment.rating;
        html += `<div class="border-bottom mb-1 pb-1">
          <strong>${comment.user.name}</strong><br/>
          <span style="color: gold;">${'★'.repeat(comment.rating)}${'☆'.repeat(5 - comment.rating)}</span><br/>
          ${comment.comment}
        </div>`;
      });

      $('#modal-comments').html(html || 'Belum ada komentar');
      if (data.length > 0) {
        let avg = totalRating / data.length;
        $('#modal-rating-stars').html('★'.repeat(Math.round(avg)) + '☆'.repeat(5 - Math.round(avg)) + ` (${avg.toFixed(1)})`);
      } else {
        $('#modal-rating-stars').html('☆☆☆☆☆ (0.0)');
      }
    });

    $('.wrap-modal1').fadeIn(300);
  });

  $('.js-hide-modal1').click(function () {
    $('.wrap-modal1').fadeOut(300);
  });
</script>