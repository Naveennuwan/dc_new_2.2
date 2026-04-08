<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>System Maintenance - Whizzlogy Solutions</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            height: 100vh;
            background: linear-gradient(135deg, #141e30, #243b55);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
        }

        .card {
            background: rgba(255,255,255,0.05);
            padding: 50px 30px;
            border-radius: 20px;
            text-align: center;
            backdrop-filter: blur(10px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.4);
            max-width: 600px;
            width: 90%;
        }

        .logo {
            max-width: 120px;
            margin-bottom: 20px;
        }

        h1 {
            font-size: 36px;
            margin-bottom: 10px;
        }

        .highlight {
            color: #00d4ff;
            font-weight: 600;
        }

        p {
            font-size: 17px;
            opacity: 0.85;
            margin-bottom: 25px;
            line-height: 1.6;
        }

        .contact {
            margin-top: 20px;
            font-size: 16px;
        }

        .contact span {
            display: block;
            margin-top: 5px;
        }

        .phone {
            font-size: 18px;
            font-weight: 600;
            color: #00ffcc;
        }

        footer {
            margin-top: 30px;
            font-size: 13px;
            opacity: 0.6;
        }

        .gear {
            font-size: 60px;
            margin-bottom: 15px;
            animation: spin 5s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>

    <div class="card">

        <!-- 🔹 Add your logo path here -->
        <img src="{{ asset('images/logo.png') }}" alt="Company Logo" class="logo">

        <div class="gear">⚙️</div>

        <h1>We'll Be Back Soon</h1>

        <p>
            This system is currently under maintenance by 
            <span class="highlight">Whizzlogy Solutions</span>.
            <br><br>
            We are improving the system to serve you better.
            Please check back shortly.
        </p>

        <div class="contact">
            <strong>Support Contact</strong>
            <span>Maintained by Naveen</span>
            <span class="phone">📞 070 574 2090</span>
        </div>

        <footer>
            © {{ date('Y') }} Whizzlogy Solutions. All Rights Reserved.
        </footer>

    </div>

</body>
</html>