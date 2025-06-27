<!DOCTYPE html>
<html lang="en">

<head>
  <title>Home</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--===============================================================================================-->
  <link rel="icon" type="image/png" href="images/icons/favicon.png" />
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="fonts/linearicons-v1.0.0/icon-font.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/slick/slick.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/MagnificPopup/magnific-popup.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="css/util.css">
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <!--===============================================================================================-->
</head>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const modal = document.querySelector('.wrap-modal1');
    const overlay = document.querySelector('.overlay-modal1');

    // Show modal function
    function showModal(productData) {
      // Update modal content
      document.getElementById('modal-name').innerText = productData.name;
      document.getElementById('modal-price').innerText = 'Rp. ' + productData.price;
      document.getElementById('modal-description').innerText = productData.description;

      const modalImage = document.getElementById('modal-image');
      modalImage.src = productData.image;
      modalImage.alt = productData.name;

      document.getElementById('modal-link').href = productData.image;
      document.getElementById('modal-form').action = productData.action;

      // Show modal
      modal.style.display = 'block';
      document.body.style.overflow = 'hidden';
    }

    // Close modal function
    function closeModal() {
      modal.style.display = 'none';
      document.body.style.overflow = '';
    }

    // Event listeners for quick view buttons
    document.querySelectorAll('.js-show-modal1').forEach(btn => {
      btn.addEventListener('click', function (e) {
        e.preventDefault();
        showModal({
          name: this.dataset.name,
          price: this.dataset.price,
          description: this.dataset.description,
          image: this.dataset.image,
          action: this.dataset.action
        });
      });
    });

    // Close modal handlers
    document.querySelectorAll('.js-hide-modal1').forEach(btn => {
      btn.addEventListener('click', closeModal);
    });

    // Close when clicking overlay
    overlay.addEventListener('click', closeModal);

    // Close when pressing ESC key
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && modal.style.display === 'block') {
        closeModal();
      }
    });
  });
</script>

<body class="animsition">

  <!-- Header -->
  @include('layouts.navbar')

  <!-- Cart -->




  <!-- Slider -->
  <section class="section-slide">
    <div class="wrap-slick1">
      <div class="slick1">
        <div class="item-slick1" style="background-image: url(images/slide-01.jpg);">
          <div class="container h-full">
            <div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
              <div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
                <span class="ltext-101 cl2 respon2">
                  Women Collection 2018
                </span>
              </div>

              <div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
                <h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">
                  NEW SEASON
                </h2>
              </div>

              <div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="1600">
                <a href="{{ route('shop') }}"
                  class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                  Shop Now
                </a>
              </div>
            </div>
          </div>
        </div>

        <div class="item-slick1" style="background-image: url(images/slide-02.jpg);">
          <div class="container h-full">
            <div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
              <div class="layer-slick1 animated visible-false" data-appear="rollIn" data-delay="0">
                <span class="ltext-101 cl2 respon2">
                  Men New-Season
                </span>
              </div>

              <div class="layer-slick1 animated visible-false" data-appear="lightSpeedIn" data-delay="800">
                <h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">
                  Jackets & Coats
                </h2>
              </div>

              <div class="layer-slick1 animated visible-false" data-appear="slideInUp" data-delay="1600">
                <a href="{{ route('shop') }}"
                  class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                  Shop Now
                </a>
              </div>
            </div>
          </div>
        </div>

        <div class="item-slick1" style="background-image: url(images/slide-03.jpg);">
          <div class="container h-full">
            <div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
              <div class="layer-slick1 animated visible-false" data-appear="rotateInDownLeft" data-delay="0">
                <span class="ltext-101 cl2 respon2">
                  Men Collection 2018
                </span>
              </div>

              <div class="layer-slick1 animated visible-false" data-appear="rotateInUpRight" data-delay="800">
                <h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">
                  New arrivals
                </h2>
              </div>

              <div class="layer-slick1 animated visible-false" data-appear="rotateIn" data-delay="1600">
                <a href="<a href=" {{ route('shop') }}
                  class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                  Shop Now
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- Banner -->
  <div class="sec-banner bg0 p-t-80 p-b-50">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
          <!-- Block1 -->
          <div class="block1 wrap-pic-w">
            <img src="images/banner-01.jpg" alt="IMG-BANNER">

            <a href=" {{ route('shop') }}"
              class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
              <div class="block1-txt-child1 flex-col-l">
                <span class="block1-name ltext-102 trans-04 p-b-8">
                  Women
                </span>

                <span class="block1-info stext-102 trans-04">
                  Spring 2018
                </span>
              </div>

              <div class="block1-txt-child2 p-b-4 trans-05">
                <div class="block1-link stext-101 cl0 trans-09">
                  Shop Now
                </div>
              </div>
            </a>
          </div>
        </div>

        <div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
          <!-- Block1 -->
          <div class="block1 wrap-pic-w">
            <img src="images/banner-02.jpg" alt="IMG-BANNER">

            <a href="<a href=" {{ route('shop') }} class="block1-txt ab-t-l s-full flex-col-l-sb
        p-lr-38 p-tb-34 trans-03 respon3">
              <div class="block1-txt-child1 flex-col-l">
                <span class="block1-name ltext-102 trans-04 p-b-8">
                  Men
                </span>

                <span class="block1-info stext-102 trans-04">
                  Spring 2018
                </span>
              </div>

              <div class="block1-txt-child2 p-b-4 trans-05">
                <div class="block1-link stext-101 cl0 trans-09">
                  Shop Now
                </div>
              </div>
            </a>
          </div>
        </div>

        <div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
          <!-- Block1 -->
          <div class="block1 wrap-pic-w">
            <img src="images/banner-03.jpg" alt="IMG-BANNER">

            <a href="{{ route('shop') }}"
              class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
              <div class="block1-txt-child1 flex-col-l">
                <span class="block1-name ltext-102 trans-04 p-b-8">
                  Accessories
                </span>

                <span class="block1-info stext-102 trans-04">
                  New Trend
                </span>
              </div>

              <div class="block1-txt-child2 p-b-4 trans-05">
                <div class="block1-link stext-101 cl0 trans-09">
                  Shop Now
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Product -->
  <section class="bg0 p-t-23 p-b-130">
    <div class="container">
      <div class="p-b-10">
        <h3 class="ltext-103 cl5">Product Overview</h3>
      </div>

      <!-- Filter Buttons -->
      <div class="flex-w flex-sb-m p-b-52">
        <div class="flex-w flex-l-m filter-tope-group m-tb-10">
          <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
            All Products
          </button>

          @foreach($categories as $category)
        <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".{{ $category->slug }}">
        {{ $category->name }}
        </button>
      @endforeach
        </div>
      </div>

      <!-- Product List -->
      <div class="row isotope-grid">
        @foreach ($products as $product)
      <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item {{ $product->category->slug ?? 'uncategorized' }}">
        <x-product-card :image="'storage/' . $product->image" :name="$product->name" :price="$product->price"
        :detailUrl="route('product.detail', $product->id)" :label="now()->diffInDays($product->created_at) < 10 ? 'New' : ''" :description="$product->description" :action="route('cart.add', $product->id)"
        :stock="$product->stock" :rating="number_format($product->comments_avg_rating ?? 0, 1)" />
      </div>
    @endforeach
      </div>


      <!-- Load More (optional, bisa diubah menjadi pagination backend) -->
      <div class="flex-c-m flex-w w-full p-t-45">
        <a href="#" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
          Load More
        </a>
      </div>
    </div>
  </section>



  <!-- Footer -->
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
            <img src="images/icons/icon-pay-01.png" alt="ICON-PAY">
          </a>

          <a href="#" class="m-all-1">
            <img src="images/icons/icon-pay-02.png" alt="ICON-PAY">
          </a>

          <a href="#" class="m-all-1">
            <img src="images/icons/icon-pay-03.png" alt="ICON-PAY">
          </a>

          <a href="#" class="m-all-1">
            <img src="images/icons/icon-pay-04.png" alt="ICON-PAY">
          </a>

          <a href="#" class="m-all-1">
            <img src="images/icons/icon-pay-05.png" alt="ICON-PAY">
          </a>
        </div>

        <p class="stext-107 cl6 txt-center">
          <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
          Copyright &copy;
          <script>document.write(new Date().getFullYear());</script> All rights reserved | Made with <i
            class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
          &amp; distributed by <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
          <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->

        </p>
      </div>
    </div>
  </footer>


  <!-- Back to top -->
  <div class="btn-back-to-top" id="myBtn">
    <span class="symbol-btn-back-to-top">
      <i class="zmdi zmdi-chevron-up"></i>
    </span>
  </div>

  <!-- Modal1 -->
  <x-product-quick-view :product="$product" />

  <!--===============================================================================================-->
  <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
  <!--===============================================================================================-->
  <script src="vendor/animsition/js/animsition.min.js"></script>
  <!--===============================================================================================-->
  <script src="vendor/bootstrap/js/popper.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
  <!--===============================================================================================-->
  <script src="vendor/select2/select2.min.js"></script>
  <script>
    $(".js-select2").each(function () {
      $(this).select2({
        minimumResultsForSearch: 20,
        dropdownParent: $(this).next('.dropDownSelect2')
      });
    })
  </script>
  <!--===============================================================================================-->
  <script src="vendor/daterangepicker/moment.min.js"></script>
  <script src="vendor/daterangepicker/daterangepicker.js"></script>
  <!--===============================================================================================-->
  <script src="vendor/slick/slick.min.js"></script>
  <script src="js/slick-custom.js"></script>
  <!--===============================================================================================-->
  <script src="vendor/parallax100/parallax100.js"></script>
  <script>
    $('.parallax100').parallax100();
  </script>
  <!--===============================================================================================-->
  <script src="vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
  <script>
    $('.gallery-lb').each(function () { // the containers for all your galleries
      $(this).magnificPopup({
        delegate: 'a', // the selector for gallery item
        type: 'image',
        gallery: {
          enabled: true
        },
        mainClass: 'mfp-fade'
      });
    });
  </script>
  <!--===============================================================================================-->
  <script src="vendor/isotope/isotope.pkgd.min.js"></script>
  <!--===============================================================================================-->
  <script src="vendor/sweetalert/sweetalert.min.js"></script>
  <script>
    $('.js-addwish-b2').on('click', function (e) {
      e.preventDefault();
    });

    $('.js-addwish-b2').each(function () {
      var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
      $(this).on('click', function () {
        swal(nameProduct, "is added to wishlist !", "success");

        $(this).addClass('js-addedwish-b2');
        $(this).off('click');
      });
    });

    $('.js-addwish-detail').each(function () {
      var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

      $(this).on('click', function () {
        swal(nameProduct, "is added to wishlist !", "success");

        $(this).addClass('js-addedwish-detail');
        $(this).off('click');
      });
    });

    /*---------------------------------------------*/

    $('.js-addcart-detail').each(function () {
      var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
      $(this).on('click', function () {
        swal(nameProduct, "is added to cart !", "success");
      });
    });
  </script>
  <!--===============================================================================================-->
  <script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
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
  <!--===============================================================================================-->
  <script src="js/main.js"></script>
  <script src="{{ asset('vendor/isotope/isotope.pkgd.min.js') }}"></script>
  <script>
    var $grid = $('.isotope-grid').isotope({
      itemSelector: '.isotope-item',
      layoutMode: 'fitRows'
    });

    $('.filter-tope-group button').on('click', function () {
      var filterValue = $(this).attr('data-filter');
      $grid.isotope({ filter: filterValue });

      // Toggle active class
      $('.filter-tope-group button').removeClass('how-active1');
      $(this).addClass('how-active1');
    });
  </script>

</body>

</html>