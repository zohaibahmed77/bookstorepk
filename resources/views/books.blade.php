<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Books</title>
    <link rel="stylesheet" href="{{ asset('css/books.css') }}">
    <script>
        function applyFilters() {
            const category = document.getElementById('categorySelect').value;
            const price = document.getElementById('priceSelect').value;
            const cards = document.querySelectorAll('.book-card');

            cards.forEach(card => {
                const bookCategory = card.dataset.category;
                const bookPrice = parseInt(card.dataset.price);
                let show = true;

                if (category !== 'All' && bookCategory !== category) show = false;
                if (price === 'under500' && bookPrice >= 500) show = false;
                if (price === '500to700' && (bookPrice < 500 || bookPrice > 700)) show = false;
                if (price === 'above700' && bookPrice <= 700) show = false;

                card.style.display = show ? 'block' : 'none';
            });
        }
    </script>
</head>
<body>
    <header class="navbar">
        <div class="container">
            <div class="logo">📘 All Books</div>
            <nav class="nav-links">
                <a href="/">Home</a>
                <a href="/books">All Books</a>
                <a href="/cart">Cart</a>
            </nav>
        </div>
    </header>

@if(session('success'))
    <div class="popup-center" id="successAlert">
        <span class="popup-text">{{ session('success') }}</span>
        <span class="popup-close" onclick="document.getElementById('successAlert').style.display='none';">✖</span>
    </div>
@endif


    <!-- Filter Section -->
    <div class="filter-bar">
        <label>Category:</label>
        <select id="categorySelect" onchange="applyFilters()">
            <option value="All">All</option>
            <option value="Education">Education</option>
            <option value="Fitness">Fitness</option>
            <option value="Life">Life</option>
            <option value="Novels">Novels</option>
            <option value="Comedy">Comedy</option>
        </select>

        <label style="margin-left: 20px;">Price:</label>
        <select id="priceSelect" onchange="applyFilters()">
            <option value="all">All</option>
            <option value="under500">Under Rs. 500</option>
            <option value="500to700">Rs. 500 - Rs. 700</option>
            <option value="above700">Above Rs. 700</option>
        </select>
    </div>

    <main>
        <div class="book-list">
            @php
                $categories = ['Education', 'Fitness', 'Life', 'Novels', 'Comedy'];
                $images = [
                    'Education' => 'https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8dHJhdmVsfGVufDB8MHwwfHx8MA%3D%3D',
                    'Fitness' => 'https://images.unsplash.com/photo-1553913861-c0fddf2619ee?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTEwfHx0cmF2ZWx8ZW58MHwwfDB8fHww',
                    'Life' => 'https://images.unsplash.com/photo-1524492412937-b28074a5d7da?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTg5fHx0cmF2ZWx8ZW58MHwwfDB8fHww',
                    'Novels' => 'https://images.unsplash.com/photo-1618822113381-a0d6e0afa168?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTQyfHx0cmF2ZWx8ZW58MHwwfDB8fHww',
                    'Comedy' => 'https://images.unsplash.com/photo-1517176642928-dfc2da661b3f?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NTZ8fHRyYXZlbHxlbnwwfDB8MHx8fDA%3D',
                ];
                $bookId = 1;
            @endphp

            @foreach($categories as $category)
                @for($i = 1; $i <= 10; $i++)
                    @php $price = rand(300, 850); @endphp
                    <div class="book-card" data-category="{{ $category }}" data-price="{{ $price }}">
                        <img src="{{ $images[$category] }}" alt="Book Image">
                        <h3>{{ $category }} Book {{ $i }}</h3>
                        <p><strong>Author:</strong> Author {{ chr(64 + $i) }}</p>
                        <p><strong>Price:</strong> Rs. {{ $price }}</p>
                        <a href="/book/{{ $bookId }}" class="details-link">View Details</a>
                        <form action="/add-to-cart/{{ $bookId }}" method="POST">
                            @csrf
                            <input type="hidden" name="title" value="{{ $category }} Book {{ $i }}">
                            <input type="hidden" name="price" value="{{ $price }}">
                            <button type="submit" class="add-btn">Add to Cart</button>
                        </form>
                    </div>
                    @php $bookId++; @endphp
                @endfor
            @endforeach
        </div>
    </main>
</body>
</html>
