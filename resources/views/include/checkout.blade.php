        <div>
                <h1>Total Price:₱ {{ $totalprice }}</h1>
                <button type="submit" id="proceed-to-order-btn">CHECK OUT SELECTED</button>
                <label><input type="checkbox" id="check-all"> Check All</label>
            </div>
        </form>
        <div>
            <h1>Total Price:₱ {{ $totalprice }}</h1>
            <form action="{{ route('checkoutprod') }}" method="post">
                @csrf
                <button type="submit" id="proceed-to-order-btn-all">CHECK OUT ALL</button>
            </form>
        </div>