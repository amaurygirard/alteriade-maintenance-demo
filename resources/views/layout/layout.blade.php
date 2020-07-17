@php
	$user = (!isset($user)) ? Auth::user() : $user;
@endphp

<!doctype html>
<html>

<head>
	<meta charset="UTF-8">
	<meta name="robots" content="noindex, nofollow">
	<title>@yield('page_title', 'Gestionnaire de maintenance') | alteriade</title>

	<!--CSS-->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
	<link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css" media="all">

	<!--JS-->
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" type="text/javascript"></script>
	<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
	<script src="{{ asset('js/main.js') }}" type="text/javascript"></script>

</head>

<body>

	<main>

		<section id="main_section">

			{{-- Header de la section principale --}}

			{{-- Tags des consultants et CECs --}}
			@section('main_section_tags')
			@show

			{{-- Titre de la page & Fil d'Ariane --}}
			<h1>
				@section('main_section_breadcrumb')
					<a href="/">Home</a>
				@show
			</h1>

			{{-- Bouton 'ajouter' --}}
			@section('main_section_add_button')
			@show


			{{--  Body de la section principale --}}
			@section('main_section_body')
			@show

		</section>

		{{-- Liste des clients : composant appelé par défaut --}}
		@section('client_list')
			@component('client.list')
			@endcomponent
		@show

	</main>


	{{-- Footer --}}
	@php
		$today = new \DateTime();
	@endphp

	<footer>

		<a @if(!$user) class="w100 txtcenter bfc" @endif href="https://alteriade.fr/" title="alteriade">Copyright alteriade {{$today->format('Y')}}</a>

		@if($user)
			<div>
				{{ $user->name }}
				@if($user->usermeta->team == "web")|&nbsp;<a href="/users">Gérer les utilisateurs</a>@endif
				|&nbsp;<a href="/logout">Se déconnecter</a>
			</div>
		@endif

	</footer>

</body>

</html>
