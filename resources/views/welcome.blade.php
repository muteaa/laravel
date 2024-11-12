<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warung Oyako</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body>
    <header class="header">
        <div class="logo">WARUNG OYAKO</div>
        <div class="login-button">
            <a href="{{ url('/login') }}" class="login-link">Login</a>
        </div>
    </header>
    <section class="hero">
        <div class="overlay">
            <div class="hero-content">
                <p>Tuesday - Sunday at 11:00 until 20:30 WIB</p>
                <h1>JAPANESE HOME COOKING</h1>
                <a href="{{ url('/dashboard') }}" class="dashboard-link">Go to Dashboard</a>
            </div>
        </div>
    </section>
</body>

</html>