<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// Home + Public Pages
Route::get('/', fn() => view('home'));
Route::get('/books', fn() => view('books'));
Route::get('/book/{id}', fn($id) => view('book', ['id' => $id]));

// Cart
Route::get('/cart', function () {
    if (!session()->has('user')) {
        return redirect('/login')->with('error', 'Please login to view cart');
    }

    $cart = session('cart', []);
    return view('cart', ['cart' => $cart]);
});

Route::post('/add-to-cart/{id}', function (Request $request, $id) {
    if (!session()->has('user')) {
        return redirect('/login')->with('error', 'Please login first.');
    }

    $cart = session()->get('cart', []);
    $cart[] = [
        'title' => $request->input('title'),
        'price' => (int) $request->input('price'),
    ];
    session(['cart' => $cart]);

    return redirect()->back()->with('success', 'Book added to cart!');
});

Route::post('/remove-from-cart/{index}', function ($index) {
    $cart = session()->get('cart', []);
    unset($cart[$index]);
    session(['cart' => array_values($cart)]);
    return redirect('/cart')->with('success', 'Item removed!');
});

Route::post('/clear-cart', function () {
    session()->forget('cart');
    return redirect('/cart')->with('success', 'Cart cleared!');
});

Route::post('/checkout/submit', function (Request $request) {
    $name = $request->input('name');
    $email = $request->input('email');
    $phone = $request->input('phone');
    $address = $request->input('address');
    $orders = session()->get('orders', []);
    $completed = session()->get('completed_orders', []);

    if ($request->has('buy_all')) {
        foreach (session('cart', []) as $order) {
            $orders[] = array_merge($order, compact('name', 'email', 'phone', 'address'));
        }
        session()->forget('cart');
        session(['orders' => $orders]);
        return redirect('/cart')->with('success', 'Order placed for all books!');
    }

    $index = $request->input('index');
    $cart = session()->get('cart', []);
    $item = $cart[$index];
    unset($cart[$index]);
    session(['cart' => array_values($cart)]);

    $orders[] = array_merge($item, compact('name', 'email', 'phone', 'address'));
    session(['orders' => $orders]);

    return redirect('/cart')->with('success', 'Order placed for selected book!');
});

// User Login/Signup
Route::get('/login', function () {
    if (session()->has('user')) {
        return redirect('/cart');
    }
    return view('login');
});

Route::post('/signup', function (Request $request) {
    $users = session()->get('users', []);
    $email = $request->input('email');

    if (isset($users[$email])) {
        return redirect('/login')->with('error', 'Email already registered');
    }

    $users[$email] = [
        'name' => $request->input('name'),
        'email' => $email,
        'password' => $request->input('password'),
    ];

    session(['users' => $users]);
    return redirect('/login')->with('success', 'Signup successful. Please log in.');
});

Route::post('/login', function (Request $request) {
    $users = session('users', []);
    $email = $request->input('email');
    $password = $request->input('password');

    // Admin login
    if ($email === 'admin@bookstorepk.com' && $password === 'admin') {
        session(['admin_logged_in' => true]);
        return redirect('/admin');
    }

    // User login
    if (isset($users[$email]) && $users[$email]['password'] === $password) {
        session(['user' => $users[$email]]);
        return redirect('/cart')->with('success', 'Logged in successfully');
    }

    return redirect('/login')->with('error', 'Invalid email or password');
});

Route::get('/logout', function () {
    session()->forget('user');
    return redirect('/login')->with('success', 'Logged out successfully');
});

// Admin Panel
Route::get('/admin', function () {
    return view('admin');
});

Route::post('/admin/login', function (Request $request) {
    $email = $request->input('email');
    $password = $request->input('password');

    if ($email === 'admin@bookstorepk.com' && $password === 'admin') {
        session(['admin_logged_in' => true]);
        return redirect('/admin');
    }

    return redirect('/admin')->with('error', 'Invalid credentials');
});

Route::get('/admin/logout', function () {
    session()->forget('admin_logged_in');
    return redirect('/admin')->with('success', 'Logged out successfully');
});

Route::post('/admin/mark-completed/{index}', function ($index) {
    $completed = session()->get('completed_orders', []);
    if (!in_array($index, $completed)) {
        $completed[] = $index;
        session(['completed_orders' => $completed]);
    }
    return redirect('/admin')->with('success', 'Marked as completed.');
});
