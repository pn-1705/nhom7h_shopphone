<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Css Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">


    <title>Shop 7H</title>
    <style>

        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap');
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }
        .alert{position:relative;padding:.75rem 1.25rem;margin-bottom:1rem;border:1px solid transparent;border-radius:.25rem}
        .alert-heading{color:inherit}
        .alert-link{font-weight:700}
        .alert-dismissible{padding-right:4rem}

        .alert-dismissible .close{position:absolute;top:0;right:0;padding:.75rem 1.25rem;color:inherit}
        .alert-primary{color:#004085;background-color:#cce5ff;border-color:#b8daff}
        .alert-primary hr{border-top-color:#9fcdff}
        .alert-primary .alert-link{color:#002752}
        .alert-secondary{color:#383d41;background-color:#e2e3e5;border-color:#d6d8db}
        .alert-secondary hr{border-top-color:#c8cbcf}
        .alert-secondary .alert-link{color:#202326}
        .alert-success{color:#155724;background-color:#d4edda;border-color:#c3e6cb}
        .alert-success hr{border-top-color:#b1dfbb}
        .alert-success .alert-link{color:#0b2e13}
        .alert-info{color:#0c5460;background-color:#d1ecf1;border-color:#bee5eb}
        .alert-info hr{border-top-color:#abdde5}
        .alert-info .alert-link{color:#062c33}
        .alert-warning{color:#856404;background-color:#fff3cd;border-color:#ffeeba}
        .alert-warning hr{border-top-color:#ffe8a1}
        .alert-warning .alert-link{color:#533f03}
        .alert-danger{color:#721c24;background-color:#f8d7da;border-color:#f5c6cb}
        .alert-danger hr{border-top-color:#f1b0b7}
        .alert-danger .alert-link{color:#491217}
        .alert-light{color:#818182;background-color:#fefefe;border-color:#fdfdfe}
        .alert-light hr{border-top-color:#ececf6}
        .alert-light .alert-link{color:#686868}
        .alert-dark{color:#1b1e21;background-color:#d6d8d9;border-color:#c6c8ca}
        .alert-dark hr{border-top-color:#b9bbbe}
        .alert-dark .alert-link{color:#040505}

        body{
            background-color: #c9d6ff;
            background: linear-gradient(to right, #e2e2e2, #c9d6ff);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            height: 100vh;
        }

        .container{
            background-color: #fff;
            border-radius: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.35);
            position: relative;
            overflow: hidden;
            width: 800px;
            max-width: 100%;
            min-height: 530px;
        }

        .container p{
            font-size: 14px;
            line-height: 20px;
            letter-spacing: 0.3px;
            margin: 20px 0;
        }

        .container span{
            font-size: 12px;
        }

        .container a{
            color: #333;
            font-size: 13px;
            text-decoration: none;
            margin: 15px 0 10px;
        }

        .container button{
            background-color: #7fad39;
            color: #fff;
            font-size: 12px;
            padding: 10px 45px;
            border: 1px solid transparent;
            border-radius: 8px;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            margin-top: 10px;
            cursor: pointer;
        }

        .container button.hidden{
            background-color: transparent;
            border-color: #fff;
        }

        .container form{
            background-color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 40px;
            height: 100%;
        }

        .container input{
            background-color: #eee;
            border: none;
            margin: 8px 0;
            padding: 10px 15px;
            font-size: 13px;
            border-radius: 8px;
            width: 100%;
            outline: none;
        }

        .form-container{
            position: absolute;
            top: 0;
            height: 100%;
            transition: all 0.6s ease-in-out;
        }

        .sign-in{
            left: 0;
            width: 50%;
            z-index: 2;
        }

        .container.active .sign-in{
            transform: translateX(100%);
        }

        .sign-up{
            left: 0;
            width: 50%;
            opacity: 0;
            z-index: 1;
        }

        .container.active .sign-up{
            transform: translateX(100%);
            opacity: 1;
            z-index: 5;
            animation: move 0.6s;
        }

        @keyframes move{
            0%, 49.99%{
                opacity: 0;
                z-index: 1;
            }
            50%, 100%{
                opacity: 1;
                z-index: 5;
            }
        }

        .social-icons{
            margin: 20px 0;
        }

        .social-icons a{
            border: 1px solid #ccc;
            border-radius: 20%;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            margin: 0 3px;
            width: 40px;
            height: 40px;
        }

        .toggle-container{
            position: absolute;
            top: 0;
            left: 50%;
            width: 50%;
            height: 100%;
            overflow: hidden;
            transition: all 0.6s ease-in-out;
            border-radius: 150px 0 0 100px;
            z-index: 1000;
        }

        .container.active .toggle-container{
            transform: translateX(-100%);
            border-radius: 0 150px 100px 0;
        }

        .toggle{
            background-color: #7fad39;
            height: 100%;
            background: linear-gradient(to right, #94bd5e, #7fad39);
            color: #fff;
            position: relative;
            left: -100%;
            height: 100%;
            width: 200%;
            transform: translateX(0);
            transition: all 0.6s ease-in-out;
        }

        .container.active .toggle{
            transform: translateX(50%);
        }

        .toggle-panel{
            position: absolute;
            width: 50%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 30px;
            text-align: center;
            top: 0;
            transform: translateX(0);
            transition: all 0.6s ease-in-out;
        }

        .toggle-left{
            transform: translateX(-200%);
        }

        .container.active .toggle-left{
            transform: translateX(0);
        }

        .toggle-right{
            right: 0;
            transform: translateX(0);
        }

        .container.active .toggle-right{
            transform: translateX(200%);
        }
        .popup-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .popup-content {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .close-btn {
            color: #000;
            font-size: 20px;
            font-weight: bold;
            cursor: pointer;
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .close-btn:hover {
            color: #ff0000;
        }
    </style>

</head>

<body>

<div class="container" id="container">
    <div class="form-container sign-up">
        <form action="/create" method="POST">
            <h1>Create Account</h1>
            <div class="social-icons">
                <a href="/google" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                <a href="/facebook" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
            </div>
            <span>or use your email for registeration</span>
            <input type="text" placeholder="Họ" name="Ho">
            <input type="text" placeholder="Tên" name="Ten">
            <input type="email" placeholder="Email" name="email">
            <input type="password" placeholder="Password" name="password">
            <input type="password" placeholder="Confirm Password" name="confirmpassword">
            <button>Sign Up</button>
            @include('User.alert')
            @csrf
        </form>
    </div>
    <div class="form-container sign-in">
        <form action="/store" method="POST">
            <h1>Sign In</h1>
            <div class="social-icons">
                <a href="/google" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                <a href="/facebook" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
            </div>
            <span>or use your email password</span>
            <input type="email" placeholder="Email" name = "email">
            <input type="password" placeholder="Password" name = "password">
            <a href="/forget">Forget Your Password?</a>
            <button>Sign In</button>
            @include('User.alert')
            @csrf
        </form>

    </div>
    <div class="toggle-container">
        <div class="toggle">
            <div class="toggle-panel toggle-left">
                <h1>Welcome Back!</h1>
                <p>Enter your personal details to use all of site features</p>
                <button class="hidden" id="login">Sign In</button>
            </div>
            <div class="toggle-panel toggle-right">
                <h1>Hello, Friend!</h1>
                <p>Register with your personal details to use all of site features</p>
                <button class="hidden" id="register">Sign Up</button>
            </div>
        </div>
    </div>
</div>
</body>
<script>
    const container = document.getElementById('container');
    const registerBtn = document.getElementById('register');
    const loginBtn = document.getElementById('login');

    registerBtn.addEventListener('click', () => {
        container.classList.add("active");
    });

    loginBtn.addEventListener('click', () => {
        container.classList.remove("active");
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</html>
