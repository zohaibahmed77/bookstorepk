<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f7f9fb;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .navbar {
            background-color: #4CAF50;
            padding: 15px 0;
        }
        .container {
            max-width: 1100px;
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
        .box {
            max-width: 400px;
            margin: 50px auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
        }
        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        button {
            width: 100%;
            margin-top: 20px;
            background: #4CAF50;
            border: none;
            padding: 12px;
            color: white;
            font-weight: bold;
            border-radius: 6px;
            cursor: pointer;
        }
        .dashboard {
            padding: 40px 20px;
            max-width: 1100px;
            margin: auto;
        }
        .order-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.05);
        }
        .order-card h3 {
            margin-bottom: 10px;
        }
        .order-card p {
            margin: 5px 0;
        }
        .order-card form {
            margin-top: 10px;
        }
        .completed {
            background: #dff0d8;
            border-left: 5px solid #4CAF50;
        }
        .stats {
            margin-bottom: 30px;
            padding: 20px;
            background: #eaf5ed;
            border-radius: 10px;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 20px;
        }
        .stat-box {
            flex: 1 1 200px;
            background: white;
            padding: 15px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 3px 8px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>
    <header class="navbar">
        <div class="container">
            <div class="logo">📊 Admin Panel</div>
            <nav class="nav-links">
                <a href="/">Home</a>
                <a href="/admin/logout">Logout</a>
            </nav>
        </div>
    </header>

    @if(!session('admin_logged_in'))
        <div class="box">
            <h2>Admin Login</h2>
            <form method="POST" action="/admin/login">
                @csrf
                <label>Email</label>
                <input type="email" name="email" required>
                <label>Password</label>
                <input type="password" name="password" required>
                <button type="submit">Login</button>
            </form>
            @if(session('error'))
                <p style="color: red; text-align: center; margin-top: 10px;">{{ session('error') }}</p>
            @endif
        </div>
    @else
        <div class="dashboard">
            <div class="stats">
                <div class="stat-box">
                    <h3>Total Orders</h3>
                    <p>{{ count(session('orders', [])) }}</p>
                </div>
                <div class="stat-box">
                    <h3>Completed Orders</h3>
                    <p>{{ count(session('completed_orders', [])) }}</p>
                </div>
                <div class="stat-box">
                    <h3>Pending Orders</h3>
                    <p>{{ count(session('orders', [])) - count(session('completed_orders', [])) }}</p>
                </div>
            </div>

            @forelse(session('orders', []) as $index => $order)
                <div class="order-card {{ in_array($index, session('completed_orders', [])) ? 'completed' : '' }}">
                    <h3>{{ $order['title'] }}</h3>
                    <p><strong>Name:</strong> {{ $order['name'] }}</p>
                    <p><strong>Email:</strong> {{ $order['email'] }}</p>
                    <p><strong>Phone:</strong> {{ $order['phone'] }}</p>
                    <p><strong>Address:</strong> {{ $order['address'] }}</p>
                    @if(!in_array($index, session('completed_orders', [])))
                        <form method="POST" action="/admin/mark-completed/{{ $index }}">
                            @csrf
                            <button type="submit">Mark as Completed</button>
                        </form>
                    @else
                        <p style="color: green; font-weight: bold;">✔ Order Completed</p>
                    @endif
                </div>
            @empty
                <p style="text-align: center; font-size: 18px;">No orders yet.</p>
            @endforelse
        </div>
    @endif
</body>
</html>
