<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Power Smile | Login</title>

    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Reset */
        * {
            box-sizing: border-box;
        }

        /* Page background */
        body {
            margin: 0;
            padding: 20px;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Jost', sans-serif;
            background: linear-gradient(
                to bottom,
                #0f0c29,
                #302b63,
                #24243e
            );
        }

        /* Main login card */
        .main {
            width: 350px;
            max-width: 100%;
            min-height: 500px;
            overflow: hidden;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 5px 20px 50px rgba(0, 0, 0, 0.35);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Logo section */
        .img-box {
            width: 100%;
            min-height: 150px;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .img-box img {
            width: auto;
            max-width: 180px;
            max-height: 120px;
            object-fit: contain;
        }

        /* Login form container */
        .login {
            width: 100%;
            flex: 1;
            padding: 0 0 25px;
            background-color: #ffffff;
        }

        /* Login heading */
        .login label {
            display: block;
            text-align: center;
            margin: 10px 0 30px;
            color: #573b8a;
            font-size: 2.3rem;
            font-weight: 700;
        }

        /* Email and password fields */
        .form input[type="email"],
        .form input[type="password"] {
            display: block;
            width: 80%;
            height: 44px;
            margin: 18px auto;
            padding: 10px 12px;

            /* Input background and text colors */
            background-color: #f5f7fb;
            color: #333333;

            font-family: inherit;
            font-size: 15px;

            border: 1px solid #d5d9e2;
            border-radius: 6px;
            outline: none;

            transition: border-color 0.2s, background-color 0.2s;
        }

        /* Placeholder text */
        .form input[type="email"]::placeholder,
        .form input[type="password"]::placeholder {
            color: #8b93a1;
            opacity: 1;
        }

        /* Focus effect */
        .form input[type="email"]:focus,
        .form input[type="password"]:focus {
            background-color: #ffffff;
            color: #222222;
            border-color: #087EFF;
            box-shadow: 0 0 0 3px rgba(8, 126, 255, 0.12);
        }

        /* Login button */
        .form input[type="submit"] {
            display: block;
            width: 80%;
            height: 44px;
            margin: 25px auto 10px;

            background-color: #087EFF;
            color: #ffffff;

            font-family: inherit;
            font-size: 16px;
            font-weight: 600;

            border: none;
            border-radius: 6px;
            cursor: pointer;

            transition: background-color 0.2s, transform 0.2s;
        }

        .form input[type="submit"]:hover {
            background-color: #0666cc;
        }

        .form input[type="submit"]:active {
            transform: scale(0.98);
        }

        /* Laravel validation errors */
        .form input.is-invalid {
            border-color: #dc3545;
        }

        .error-message {
            display: block;
            width: 80%;
            margin: -10px auto 12px;
            color: #dc3545;
            font-size: 13px;
        }

        /* Mobile responsiveness */
        @media (max-width: 480px) {
            body {
                padding: 16px;
            }

            .main {
                width: 100%;
                min-height: auto;
            }

            .img-box {
                min-height: 125px;
            }

            .img-box img {
                max-width: 160px;
                max-height: 100px;
            }

            .login label {
                font-size: 2rem;
                margin-bottom: 25px;
            }

            .form input[type="email"],
            .form input[type="password"],
            .form input[type="submit"] {
                width: 85%;
            }
        }
    </style>
</head>

<body>

    <div class="main">

        <!-- Logo -->
        <div class="img-box">
            <img
                src="{{ asset('images/logo2.png') }}"
                alt="Power Smile Logo"
            >
        </div>

        <!-- Login Form -->
        <div class="login">

            <form method="POST" class="form" action="{{ route('login') }}">
                @csrf

                <label for="email">Login</label>

                <!-- Email -->
                <input
                    id="email"
                    type="email"
                    name="email"
                    placeholder="Enter Email"
                    class="@error('email') is-invalid @enderror"
                    value="{{ old('email') }}"
                    required
                    autocomplete="email"
                    autofocus
                >

                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror

                <!-- Password -->
                <input
                    id="password"
                    type="password"
                    name="password"
                    placeholder="Enter Password"
                    class="@error('password') is-invalid @enderror"
                    required
                    autocomplete="current-password"
                >

                @error('password')
                    <span class="error-message">{{ $message }}</span>
                @enderror

                <!-- Submit -->
                <input
                    class="button submit"
                    id="submit"
                    type="submit"
                    value="Log in"
                >

            </form>

        </div>

    </div>

</body>
</html>
