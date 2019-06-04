@extends('layout.auth')

@section('page_title')
  Login
@endsection

@section('main_section_breadcrumb')
  Connexion
@endsection

@section('main_section_body')

  <div id="form_container">

      <form method="POST" action="{{ route('login') }}">
          @csrf

          <div>
              <label for="email">{{ __('E-Mail Address') }}</label>
              <input id="email" type="email" class="form-control  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

          </div>

          <div>
              <label for="password">{{ __('Password') }}</label>
              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

          </div>

          <div>
              <div>
                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label for="remember">
                    {{ __('Remember Me') }}
                </label>
                <div class="clear"></div>
          </div>

          <div>
              <button type="submit">
                  {{ __('Login') }}
              </button>
          </div>

          <div class="txtright mts">
              @if (Route::has('password.request'))
                  <a href="{{ route('password.request') }}">
                      {{ __('Forgot Your Password?') }}
                  </a>
              @endif
          </div>

      </form>

  </div>

@endsection
