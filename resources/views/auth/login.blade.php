<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('main.css') }}">
  <style>
    body {
      background-color: rgb(255, 255, 255);
    }
  </style>
</head>

<body>
  <br>
  <br>
  <div class="cont">
    {{-- LOGIN FORM --}}
    <form class="form sign-in" method="POST" action="{{ route('login') }}">
      @csrf
      <h2>Welcome</h2>

      @if ($errors->any())
      <div style="color: red; font-size: 14px">
      {{ $errors->first() }}
      </div>
    @endif

      <label>
        <span>Email</span>
        <input type="email" name="email" required />
      </label>
      <label>
        <span>Password</span>
        <input type="password" name="password" required />
      </label>
      <p class="forgot-pass">Forgot password?</p>
      <button type="submit" class="submit">Sign In</button>
    </form>

    {{-- REGISTER FORM --}}
    <div class="sub-cont">
      <div class="img">
        <div class="img__text m--up">
          <h3>Don't have an account? Please Sign up!</h3>
        </div>
        <div class="img__text m--in">
          <h3>If you already have an account, just sign in.</h3>
        </div>
        <div class="img__btn">
          <span class="m--up">Sign Up</span>
          <span class="m--in">Sign In</span>
        </div>
      </div>

      <form class="form sign-up" method="POST" action="{{ route('register') }}">
        @csrf
        <h2>Create your Account</h2>
        <label>
          <span>Name</span>
          <input type="text" name="name" required />
        </label>
        <label>
          <span>Email</span>
          <input type="email" name="email" required />
        </label>
        <label>
          <span>Password</span>
          <input type="password" name="password" required />
        </label>
        <label>
          <span>Confirm Password</span>
          <input type="password" name="password_confirmation" required />
        </label>
        <button type="submit" class="submit">Sign Up</button>
      </form>
    </div>
  </div>

  <script>
    document.querySelector('.img__btn').addEventListener('click', function () {
      document.querySelector('.cont').classList.toggle('s--signup');
    });
  </script>
</body>

</html>