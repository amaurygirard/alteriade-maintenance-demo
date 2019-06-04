@extends('layout.auth')

@section('page_title')
  Reset Password
@endsection

@section('main_section_breadcrumb')
  Reset Password
@endsection

@section('main_section_body')

  <div id="form_container">
      <form method="POST" action="{{ route('password.email') }}">
          @csrf

          <div>
              <label for="email">{{ __('E-Mail Address') }}</label>

              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
          </div>

          <div>
              <button type="submit" >
                  {{ __('Send Password Reset Link') }}
              </button>
          </div>
      </form>
  </div>
@endsection
