<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login / Signup</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <script>
        function showForm(type) {
            document.getElementById('loginForm').style.display = (type === 'login') ? 'block' : 'none';
            document.getElementById('signupForm').style.display = (type === 'signup') ? 'block' : 'none';
            document.getElementById('loginBtn').classList.toggle('active', type === 'login');
            document.getElementById('signupBtn').classList.toggle('active', type === 'signup');
        }
    </script>
</head>
<body>

    <!-- Navbar (same as Home) -->
    <header class="navbar">
        <div class="container">
            <div class="logo">🔐 Bookstore Login</div>
            <nav class="nav-links">
                <a href="/">Home</a>
                <a href="/books">Books</a>
                <a href="/cart">Cart</a>
            </nav>
        </div>
    </header>

    <div class="auth-box">
        <!-- Toggle Buttons -->
        <div class="toggle-btns">
            <button id="loginBtn" class="active" onclick="showForm('login')">Login</button>
            <button id="signupBtn" onclick="showForm('signup')">Sign Up</button>
        </div>

        <!-- Login Form -->
        <form method="POST" action="/login" id="loginForm">
            @csrf
            <h2>Login</h2>
            <label>Email</label>
            <input type="email" name="email" required>
            <label>Password</label>
            <input type="password" name="password" required>
            <button type="submit">Login</button>
        </form>

        <!-- Signup Form -->
        <form method="POST" action="/signup" id="signupForm" style="display: none;">
            @csrf
            <h2>Sign Up</h2>
            <label>Name</label>
            <input type="text" name="name" required>
            <label>Email</label>
            <input type="email" name="email" required>
            <label>Password</label>
            <input type="password" name="password" required>
            <button type="submit">Sign Up</button>
        </form>

        @if(session('success'))
            <p class="msg">{{ session('success') }}</p>
        @endif

        @if(session('error'))
            <p class="error">{{ session('error') }}</p>
        @endif
    </div>
</body>
</html>
