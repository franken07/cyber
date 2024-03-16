<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link rel="shortcut icon" href="{{ secure_asset('assets/images/loko.png') }}" type="image/x-icon">
<link rel="stylesheet" href="{{ secure_asset('assets/admincss/admin.css') }}">
<link rel="stylesheet" href="{{ secure_asset('assets/web/assets/mobirise-icons2/mobirise2.css') }}">
<link rel="stylesheet" href="{{ secure_asset('assets/parallax/jarallax.css') }}">
<link rel="stylesheet" href="{{ secure_asset('assets/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ secure_asset('assets/bootstrap/css/bootstrap-grid.min.css') }}">
<link rel="stylesheet" href="{{ secure_asset('assets/bootstrap/css/bootstrap-reboot.min.css') }}">
<link rel="stylesheet" href="{{ secure_asset('assets/dropdown/css/style.css') }}">
<link rel="stylesheet" href="{{ secure_asset('assets/socicon/css/styles.css') }}">
<link rel="stylesheet" href="{{ secure_asset('assets/animatecss/animate.css') }}">
<link rel="stylesheet" href="{{ secure_asset('assets/theme/css/style.css') }}">
<link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter+Tight:wght@400;700&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter+Tight:wght@400;700&display=swap"></noscript>
<link rel="preload" as="style" href="{{ secure_asset('assets/mobirise/css/additional.css') }}"><link rel="stylesheet" href="{{ secure_asset('assets/mobirise/css/additional.css') }}" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.css">
  
<body style="background-image: url('{{ asset('images/17.png') }}');">
<div class="container">
    <h1>Admin Dashboard</h1>
    
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#addProducts">Add Products</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#editDeleteProducts">Edit/Delete Products</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#userPurchases">User Purchases</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#Addapointment">Add Apointment</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#reserverations">Reservation</a>
        </li>
    </ul>
    
    <!-- Tab panes -->
    <div class="rounded-container">
    <div class="tab-content">
        <!-- Add Products Tab -->
        <div id="addProducts" class="container tab-pane active"><br>
            @include('include.addProducts')
        </div>
        <!-- Edit/Delete Products Tab -->
        <div id="editDeleteProducts" class="container tab-pane fade"><br>
            @include('include.editDeleteProducts')
        </div>
        <!-- User Purchases Tab -->
        <div id="userPurchases" class="container tab-pane fade"><br>
            @include('include.userPurchases')
        </div> 
        
        <div id="Addapointment" class="container tab-pane fade"><br>
            @include('include.Addapointment')
        </div>
        <div id="reserverations" class="container tab-pane active"><br>
            @include('include.reservations')
        </div>
    </div>
</div>
</div>

<script>
function confirmDelete(productId) {
    if (confirm('Are you sure you want to delete this product?')) {
        fetch('/delete_product.php', {
            method: 'POST', 
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ id: productId }),
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                alert('Product deleted successfully!');
    
            } else {
                alert('There was a problem with the deletion.');
            }
        })
        .catch((error) => {
            console.error('Error:', error);
            alert('Product deleted successfully!');
        });
    }
}
</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="assets/parallax/jarallax.js"></script>
<script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/dropdown/js/navbar-dropdown.js"></script>
<script src="assets/scrollgallery/scroll-gallery.js"></script>
<script src="assets/mbr-switch-arrow/mbr-switch-arrow.js"></script>
<script src="assets/smoothscroll/smooth-scroll.js"></script>
<script src="assets/ytplayer/index.js"></script>
<script src="assets/theme/js/script.js"></script>
<script src="assets/formoid/formoid.min.js"></script>
</body>
</html>
