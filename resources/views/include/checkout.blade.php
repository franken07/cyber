<div>
    <h1>Total Price:₱ {{ $totalprice }}</h1>
        <form action="{{ route('checkoutprod') }}" method="post">
            @csrf
            <button type="submit" id="proceed-to-order-btn">CHECK OUT ALL</button>
        </form>
 </div>