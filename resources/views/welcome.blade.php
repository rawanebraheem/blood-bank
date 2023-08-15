<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Blood Bank</title>

  
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  
</head>
<body class="hold-transition login-page">
<div class="login-box">
  

  <div class="card">
    <div class="card-body login-card-body">
      
      <div class="social-auth-links text-center mb-3">
        @auth
        <a href="{{ url('/dashboard') }}" class="btn btn-block btn-primary">
            <i >your dashboard</i> 
          </a>
          @else

         <a href="{{ route('login') }}" class="btn btn-block btn-primary">
          <i >log in</i> 
        </a>
        {{-- <a href="{{ route('login') }}" class="btn btn-block btn-primary">
          <i >register</i> 
        </a> --}}
        @endauth
       
      </div>
    </div>
   
  </div>
</div>
</body>
</html>




<div >
    {{-- @if (Route::has('login'))
        <div >
            @auth
                <a href="{{ url('/dashboard') }}" >Dashboard</a>
            @else
                <a href="{{ route('login') }}">Log in</a>

                @if (Route::has('register'))
                    <a href="c" >Register</a>
                @endif
            @endauth
        </div>
    @endif 
    </div> --}}
    








