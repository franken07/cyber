<!DOCTYPE html>
<html>
<head>
  <!---->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise AI v0.01, ai.mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="assets/images/loko.png" type="image/x-icon">
  <meta name="description" content="Explore the latest and greatest PC parts and accessories for your ultimate gaming setup or workstation.">
 
  <title>csd</title>
  <link rel="stylesheet" href="assets/web/assets/mobirise-icons2/mobirise2.css">
  <link rel="stylesheet" href="assets/parallax/jarallax.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="assets/dropdown/css/style.css">
  <link rel="stylesheet" href="assets/socicon/css/styles.css">
  <link rel="stylesheet" href="assets/animatecss/animate.css">
  <link rel="stylesheet" href="assets/theme/css/style.css">
  <link rel="stylesheet" href="assets/componentscss/components.css">
  <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter+Tight:wght@400;700&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter+Tight:wght@400;700&display=swap"></noscript>
  <link rel="preload" as="style" href="assets/mobirise/css/additional.css"><link rel="stylesheet" href="assets/mobirise/css/additional.css" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  
  
  

  <style>:root{ --background: #EBF1FF; --dominant-color: #3772FF; --primary-color: #FDCA40; --secondary-color: #DF2935; --success-color: #31D98B; --danger-color: #DB2F40; --warning-color: #FFC20B; --info-color: #18CEF2; --background-text: #000000; --dominant-text: #FFFFFF; --primary-text: #000000; --secondary-text: #FFFFFF; --success-text: #000000; --danger-text: #FFFFFF; --warning-text: #000000; --info-text: #000000;}

</style>
</head>
@include('include.header')
<body style="background-image: url('{{ asset('images/17.png') }}');">


<!-- components.blade.php -->   
<section class="pricing02 cid-u3GZCsHE3N" id="product-list-8-u3GZCsHE3N">
    <div class="container-fluid">
        @foreach($productsBycategory as $category => $products)
        <div class="row justify-content-center">
            <div class="col-12 content-head">
                <div class="mbr-section-head mb-5">
                    <h4 class="mbr-section-title mbr-fonts-style align-center mb-0 display-2">
                        <strong>{{ ucfirst($category) }}</strong>
                    </h4>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($products as $product)
            <div class="item features-image col-12 col-md-6 col-lg-3">
                <div class="item-wrapper">
                    <div class="item-img">
                        <img src="{{ url($product->image) }}" alt="{{ $product->prod_name }}">
                    </div>
                    <div class="item-content">
                        <h5 class="item-title mbr-fonts-style display-5">
                            <strong>{{ $product->prod_name }}</strong>
                        </h5>
                        <p class="mbr-text mbr-fonts-style display-7">
                            {{ $product->description }}
                        </p>
                        <!-- Example for Price, if needed -->
                        <p class="mbr-text mbr-fonts-style display-7">
                            Price: ₱{{ $product->price }}
                        </p>
                        <form class="add-to-cart-form" action="{{ route('cart.add', ['id' => $product->id]) }}" method="POST">
                            @csrf
                            <input type="number" name="quantity" value="1" min="1" class="form-control form-control-sm" required="" value="{{ old('quantity', 1) }}">
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <div class="d-flex justify-content-center align-items-center">
                                 <button class="btn btn-primary">Add to Cart</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endforeach
    </div>
</section>




<!--footer -->  
<section class="footer3 cid-u3GZCsJlbC" once="footers" id="footer-3-u3GZCsJlbC">
  <div class="container">
      <div class="row">
        <p class="mbr-fonts-style copyright display-1">
          CYBER SERVICE DEN
      </p>
          <div class="col-12 mt-4">
              <div class="social-row">
                  <div class="soc-item">
                      <a href="https://www.facebook.com/profile.php?id=100085615815833" target="_blank">
                          <span class="mbr-iconfont socicon socicon-facebook display-7"></span>
                      </a>
                  </div>
                  <div class="soc-item">
                      <a href="#" target="_blank">
                          <span class="mbr-iconfont socicon-twitter socicon"></span>
                      </a>
                  </div>
                  <div class="soc-item">
                      <a href="#" target="_blank">
                          <span class="mbr-iconfont socicon-instagram socicon"></span>
                      </a>
                  </div>
              </div>
          </div>

          <div class="col-12 mt-5">
              <p class="mbr-fonts-style copyright display-7">
                  © 2024 CSD. All Rights Reserved.
              </p>
          </div>
      </div>
  </div>
</section>


<script src="assets/parallax/jarallax.js"></script>
  <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/dropdown/js/navbar-dropdown.js"></script>
  <script src="assets/scrollgallery/scroll-gallery.js"></script>
  <script src="assets/mbr-switch-arrow/mbr-switch-arrow.js"></script>
  <script src="assets/smoothscroll/smooth-scroll.js"></script>
  <script src="assets/ytplayer/index.js"></script>
  <script src="assets/theme/js/script.js"></script>
  <script src="assets/formoid/formoid.min.js"></script>
  
  
  
  <script>

    (function(){
      var animationInput = document.createElement('input');
      animationInput.setAttribute('name', 'animation');
      animationInput.setAttribute('type', 'hidden');
      document.body.append(animationInput);
    })();

  </script>
  @include('include.carticon')
</body>
</html>