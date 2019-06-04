@extends('layout.auth')

@section('page_title')
  Verify
@endsection

@section('main_section_breadcrumb')
  Verify
@endsection

@section('main_section_body')
    <h2>{{ __('Verify Your Email Address') }}</h2>

    <div class="card-body">
        @if (session('resent'))
            <div class="alert alert-success" role="alert">
                {{ __('A fresh verification link has been sent to your email address.') }}
            </div>
        @endif

        {{ __('Before proceeding, please check your email for a verification link.') }}
        {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
    </div>

@endsection
