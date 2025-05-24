@php
    $bookId = $id;
    $categories = ['Education', 'Fitness', 'Life', 'Novels', 'Comedy'];
    $category = $categories[($bookId - 1) % count($categories)];
    $title = "$category Book $bookId";
    $author = "Author " . chr(65 + (($bookId - 1) % 26));
    $price = 300 + ($bookId * 17 % 500);
    $description = "This is a detailed description of $title written by $author. It explores the depths of $category topics and provides great value to readers.";
    $images = [
        'Education' => 'https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?w=1000',
        'Fitness' => 'https://images.unsplash.com/photo-1553913861-c0fddf2619ee?w=1000',
        'Life' => 'https://images.unsplash.com/photo-1524492412937-b28074a5d7da?w=1000',
        'Novels' => 'https://images.unsplash.com/photo-1618822113381-a0d6e0afa168?w=1000',
        'Comedy' => 'https://images.unsplash.com/photo-1517176642928-dfc2da661b3f?w=1000',
    ];
    $image = $images[$category];
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }} - Book Details</title>
    <style>





        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f2f4f8;
            margin: 0;
            color: #333;
        }

        .navbar {
            background-color: #4CAF50;
            padding: 15px 0;
        }
        .container {
            max-width: 1200px;
            margin: auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo {
            font-size: 26px;
            font-weight: bold;
            color: white;
        }
        .nav-links a {
            color: white;
            text-decoration: none;
            margin-left: 25px;
            font-weight: 500;
        }

        .nav-links a:hover {
            text-decoration: underline;
        }

        .book-wrapper {
            max-width: 1000px;
            margin: 60px auto;
            padding: 40px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        }

        .book-details {
            display: flex;
            gap: 40px;
            flex-wrap: wrap;
            align-items: flex-start;
        }

        .book-image {
            flex: 1 1 300px;
        }
        .book-image img {
            width: 100%;
            border-radius: 10px;
            object-fit: cover;
        }

        .book-info {
            flex: 2 1 400px;
        }
        .book-info h1 {
            font-size: 32px;
            margin-bottom: 10px;
        }
        .book-info p {
            font-size: 17px;
            margin-bottom: 10px;
        }
        .book-info .price {
            font-size: 20px;
            font-weight: bold;
            color: #388e3c;
            margin: 20px 0;
        }

        .book-info button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 12px 20px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 6px;
            cursor: pointer;
        }

        .book-info form {
            margin-top: 20px;
        }

        @media (max-width: 768px) {
            .book-details {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }
            .book-info {
                padding-top: 20px;
            }
        }

        
    </style>
</head>
<body>

    <header class="navbar">
        <div class="container">
            <div class="logo">📘 BookstorePK</div>
            <nav class="nav-links">
                <a href="/">Home</a>
                <a href="/books">Books</a>
                <a href="/cart">Cart</a>
            </nav>
        </div>
    </header>

    <main>
        <div class="book-wrapper">
            <div class="book-details">
                <div class="book-image">
                    <img src="{{ $image }}" alt="Book image">
                </div>
                <div class="book-info">
                    <h1>{{ $title }}</h1>
                    <p><strong>Author:</strong> {{ $author }}</p>
                    <p class="price">Rs. {{ $price }}</p>
                    <p>{{ $description }}</p>

                    <form action="/add-to-cart/{{ $bookId }}" method="POST">
                        @csrf
                        <input type="hidden" name="title" value="{{ $title }}">
                        <input type="hidden" name="price" value="{{ $price }}">
                        <button type="submit">Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
