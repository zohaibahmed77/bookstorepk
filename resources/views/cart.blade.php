<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Cart</title>
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
</head>
<body>
    <header class="navbar">
        <div class="container">
            <div class="logo">🛒 Your Cart</div>
<nav class="nav-links">
    <a href="/">Home</a>
    <a href="/books">All Books</a>
    <a href="/cart">Cart</a>
    @if(session()->has('user'))
        <a href="/logout">Logout ({{ session('user.name') }})</a>
    @endif
</nav>

        </div>
    </header>

    <main class="cart-wrapper">
        @if(session('success'))
            <p class="success">{{ session('success') }}</p>
        @endif

        @if(count($cart) > 0)
            <ul class="cart-items">
                @foreach($cart as $index => $item)
                    <li class="cart-item">
                        <div>
                            <strong>{{ $item['title'] }}</strong><br>
                            Price: Rs. {{ $item['price'] }}
                        </div>
                        <div class="item-actions">
                            <form action="/remove-from-cart/{{ $index }}" method="POST">
                                @csrf
                                <button type="submit" class="remove-btn">Remove</button>
                            </form>
                            <button onclick="openModal({{ $index }})" class="checkout-btn">Buy</button>
                        </div>
                    </li>
                @endforeach
            </ul>

            <div class="cart-summary">
                <p><strong>Total Items:</strong> {{ count($cart) }}</p>
                <p><strong>Total Price:</strong> Rs. {{ array_sum(array_column($cart, 'price')) }}</p>

                <form action="/clear-cart" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="remove-btn">Clear All</button>
                </form>

                <button onclick="openModal('all')" class="checkout-btn">Buy All</button>
            </div>
        @else
            <p class="empty">Your cart is empty 😢</p>
        @endif
    </main>

    <!-- Checkout Modal -->
    <div class="modal" id="checkoutModal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Cash on Delivery</h2>
            <form action="/checkout/submit" method="POST">
                @csrf
                <input type="hidden" name="index" id="checkoutIndex">
                <input type="hidden" name="buy_all" id="buyAllFlag">

                <label>Name</label>
                <input name="name" required>

                <label>Email</label>
                <input name="email" type="email" required>

                <label>Phone</label>
                <input name="phone" required>

                <label>Address</label>
                <textarea name="address" required></textarea>

                <button type="submit" class="checkout-btn full-btn">Confirm Order</button>
            </form>
        </div>
    </div>

    <script>
        function openModal(index) {
            document.getElementById('checkoutModal').style.display = 'block';
            document.getElementById('checkoutIndex').value = index === 'all' ? '' : index;
            document.getElementById('buyAllFlag').value = index === 'all' ? '1' : '';
        }

        function closeModal() {
            document.getElementById('checkoutModal').style.display = 'none';
        }

        window.onclick = function(event) {
            const modal = document.getElementById('checkoutModal');
            if (event.target === modal) {
                closeModal();
            }
        };
    </script>
</body>
</html>
