<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Kantin Thariq bin Ziyad Boarding School</title>
  <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}" sizes="16x16">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  @vite(['resources/sass/app.scss', 'resources/js/app.js'])

  <!-- Bootstrap core CSS -->
  <link href="{{ asset('assets/css/lib/bootstrap.min.css') }}" rel="stylesheet">

  <style>
    html, body {
      height: 100%;
    }

    body {
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: #f5f5f5;
      padding: 40px 0;
    }

    .form-signin {
      width: 100%;
      max-width: 360px;
      padding: 20px;
      margin: auto;
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, 0.05);
    }

    .form-signin .form-floating:focus-within {
      z-index: 2;
    }

    .form-signin input[type="text"],
    .form-signin input[type="email"] {
      margin-bottom: -1px;
      border-bottom-right-radius: 0;
      border-bottom-left-radius: 0;
    }

    .form-signin input[type="password"] {
      margin-bottom: 10px;
      border-top-left-radius: 0;
      border-top-right-radius: 0;
    }
  </style>
</head>

<body class="text-center">
  <main class="form-signin">
    <form method="POST" action="{{ route('login') }}">
      @csrf

      <img class="mb-3" src="{{ asset('assets/images/logo.png') }}" alt="Logo" width="72">
      <h1 class="h4 fw-bold">Selamat Datang di Kantin Thariq Bin Ziyad</h1>
      <p class="text-muted mb-4">Masuk untuk melanjutkan</p>

      <div class="form-floating mb-3">
        <input 
          type="text" 
          class="form-control @error('email') is-invalid @enderror" 
          id="email" 
          name="email" 
          value="{{ old('email') }}" 
          required 
          autocomplete="email" 
          autofocus>
        <label for="email">Username</label>
        @error('email')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>

      <div class="form-floating mb-3">
        <input 
          type="password" 
          class="form-control @error('password') is-invalid @enderror" 
          id="password" 
          name="password" 
          required 
          autocomplete="current-password">
        <label for="password">Password</label>
        @error('password')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>

      <button class="w-100 btn btn-lg btn-success" type="submit">
        {{ __('Login') }}
      </button>

      <p class="mt-4 mb-0 text-muted">&copy; 2025 - Kantin TBZ Boarding School</p>
    </form>
  </main>
</body>
</html>
