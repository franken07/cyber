        <div>
        <div>Total Price: $<span id="total-price">{{ $totalprice }}</span></div> <!-- Display total price -->
                <button type="submit" id="proceed-to-order-btn">CHECK OUT SELECTED</button>
                <label><input type="checkbox" id="check-all"> Check All</label>
            </div>
        </form>
        <div>
        <div>Total Price: $<span id="total-price">{{ $totalprice }}</span></div> <!-- Display total price -->
            <form action="{{ route('checkoutprod') }}" method="post">
                @csrf
                <button type="submit" id="proceed-to-order-btn-all">CHECK OUT ALL</button>
            </form>
        </div>