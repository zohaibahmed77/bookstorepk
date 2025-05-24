<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BookstorePK - Discover Great Reads</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>
<body>
    <!-- Navbar -->
    <header class="navbar">
        <div class="container">
            <div class="logo">📚 BookstorePK</div>
         <nav class="nav-links">
    <a href="/">Home</a>
    <a href="/books">Books</a>
    <a href="/cart">Cart</a>
    <a href="/login">User</a>
    <a href="/admin">Admin</a> <!-- ✅ NEW Admin Button -->
</nav>

        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Find Your Next Favorite Book</h1>
            <p>Explore a wide collection of books, handpicked for every reader.</p>
            <a href="/books" class="hero-btn">Browse Books</a>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats">
        <div class="container">
            <div class="stat-box">
                <h2>5,000+</h2>
                <p>Total Books</p>
            </div>
            <div class="stat-box">
                <h2>2,000+</h2>
                <p>Readers Served</p>
            </div>
            <div class="stat-box">
                <h2>99%</h2>
                <p>Customer Satisfaction</p>
            </div>
            <div class="stat-box">
                <h2>50+</h2>
                <p>Book Categories</p>
            </div>
        </div>
    </section>

    <!-- Popular Categories -->
    <section class="categories">
        <h2>Popular Categories</h2>
        <div class="container category-cards">
            <div class="category-card">📖 Education</div>
            <div class="category-card">💪 Fitness</div>
            <div class="category-card">🎭 Comedy</div>
            <div class="category-card">📚 Novels</div>
            <div class="category-card">🌱 Life</div>
        </div>
    </section>

    <!-- Customer Reviews -->
    <section class="reviews">
        <h2>What Readers Say</h2>
        <div class="container review-cards">
            <div class="review-card">
                <p>“Amazing collection and fast delivery. I love it!”</p>
                <strong>- Sarah A.</strong>
            </div>
            <div class="review-card">
                <p>“Found all the books I needed for university. Highly recommend!”</p>
                <strong>- Ahmed K.</strong>
            </div>
            <div class="review-card">
                <p>“Great prices and excellent support!”</p>
                <strong>- Maria L.</strong>
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="why-us">
        <h2>Why BookstorePK?</h2>
        <div class="container reasons">
            <div class="reason">✅ Trusted by thousands</div>
            <div class="reason">📦 Fast & Free Shipping</div>
            <div class="reason">💬 24/7 Support</div>
            <div class="reason">💰 Best Price Guarantee</div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <h2>Ready to Dive Into a New Book?</h2>
        <a href="/books" class="hero-btn">Explore Now</a>
    </section>

    <!-- Footer -->
    <footer>
        <p>© 2025 BookstorePK. Made with ❤️ for book lovers.</p>
    </footer>
</body>
</html>
