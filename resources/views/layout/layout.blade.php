<!doctype html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Document sans nom</title>

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

			<div class="tag">LM</div>
			<div class="tag">JR</div>

			<h1><a href="#">Home</a> | <strong>Nom du projet</strong></h1>

			<button id="projet_add"><span>Ajouter un nouveau projet</span></button>



			<h2><strong>Contrats bientôt expirés</strong></h2>

			<article class="bloc">

				<div class="bloc_header">

					<div class="bloc_header_container">

						<h3><strong><a href="#">Lorem ipsum dolor.</a></strong></h3>

						<div class="bloc_tags">
							<div class="bloc_tag tag">LM</div>
							<div class="bloc_tag tag">JR</div>
						</div>

					</div>

				</div>

				<div class="bloc_details bloc_marked bloc_warning">

					<p class="bloc_details_main bloc_details_pictoed pictoed_calendar">

						<span><strong>Lorem ipsum dolor.</strong></span>
						<span>
							<span class="txtright">Date de début du contrat</span>
							<span class="bloc_details_countdown txtright">Temps restant</span>
						</span>

					</p>

					<p class="bloc_details_below">

						<span>Dernière intervention</span>
						<span>le : Date</span>

					</p>

				</div>

			</article>


			<h2><strong>Tous les projets</strong></h2>

			<article class="bloc bloc_closed">

				<div class="bloc_header">

					<div class="bloc_header_container">

						<h3><strong><a href="#">Nom du projet</a></strong></h3>

						<div class="bloc_tags">
							<div class="bloc_tag tag">LM</div>
							<div class="bloc_tag tag">JR</div>
						</div>

					</div>

				</div>

				<div class="bloc_details bloc_marked">

					<p class="bloc_details_main bloc_details_pictoed pictoed_clock">

						<span><strong>Lorem ipsum dolor.</strong></span>
						<span>
							<span class="txtright">Date de début du contrat</span>
							<span class="bloc_details_countdown txtright">Date de fin de contrat</span>
						</span>

					</p>

					<p class="bloc_details_below">

						<span>Dernière intervention</span>
						<span>le : Date</span>

					</p>

				</div>

			</article>

			<article class="bloc bloc_closed">

				<div class="bloc_header">

					<div class="bloc_header_container">

						<h3><strong><a href="#">Lorem ipsum dolor.</a></strong></h3>

						<div class="bloc_tags">
							<div class="bloc_tag tag">LM</div>
							<div class="bloc_tag tag">JR</div>
						</div>

					</div>

				</div>

				<div class="bloc_details bloc_marked">

					<p class="bloc_details_main bloc_details_pictoed pictoed_clock">

						<span><strong>Lorem ipsum dolor.</strong></span>
						<span>
							<span class="txtright">Date de début du contrat</span>
							<span class="bloc_details_countdown txtright">Date de fin de contrat</span>
						</span>

					</p>

					<p class="bloc_details_below">

						<span>Dernière intervention</span>
						<span>le : Date</span>

					</p>

				</div>

			</article>

			<article class="bloc bloc_closed">

				<div class="bloc_header">

					<div class="bloc_header_container">

						<h3><strong><a href="#">Lorem ipsum dolor.</a></strong></h3>

						<div class="bloc_tags">
							<div class="bloc_tag tag">LM</div>
							<div class="bloc_tag tag">JR</div>
						</div>

					</div>

				</div>

				<div class="bloc_details bloc_marked">

					<p class="bloc_details_main bloc_details_pictoed pictoed_clock">

						<span><strong>Lorem ipsum dolor.</strong></span>
						<span>
							<span class="txtright">Date de début du contrat</span>
							<span class="bloc_details_countdown txtright">Date de fin de contrat</span>
						</span>

					</p>

					<p class="bloc_details_below">

						<span>Dernière intervention</span>
						<span>le : Date</span>

					</p>

				</div>

				<div class="bloc_details bloc_marked bloc_darkened">

					<p class="bloc_details_main bloc_details_pictoed pictoed_clock">

						<span><strong>Lorem ipsum dolor.</strong></span>
						<span>
							<span class="txtright">Date de début du contrat</span>
							<span class="bloc_details_countdown txtright">Date de fin de contrat</span>
						</span>

					</p>
				</div>

			</article>


			<h2><strong>Détail des contrats</strong></h2>

			<article class="bloc bloc_closed">

				<div class="bloc_header bloc_marked bloc_header_pictoed pictoed_clock">

					<div class="bloc_header_container">

						<h3><strong><a href="#">Nom du contrat</a></strong></h3>

						<div class="bloc_tags">
							<div class="bloc_tag tag">LM</div>
							<div class="bloc_tag tag">JR</div>
						</div>

					</div>

				</div>

				<div class="bloc_details">

					<p class="bloc_details_main bloc_details_pictoed pictoed_text pictoed_text_eab">

						<span><strong>Nom de l'intervention</strong></span>
						<span class="flex-container">
							<span class="txtright">Intervention de : <strong>temps passé</strong></span>
							<span class="bloc_details_countdown txtright">le : <strong>date</strong></span>
						</span>

					</p>

					<p class="bloc_details_below">

						<span>Description</span>

					</p>

				</div>

				<div class="bloc_details bloc_marked bloc_darkened">

					<p class="bloc_details_main bloc_details_pictoed pictoed_clock">

						<span><strong>Lorem ipsum dolor.</strong></span>
						<span>
							<span class="txtright">Date de début du contrat</span>
							<span class="bloc_details_countdown txtright">Date de fin de contrat</span>
						</span>

					</p>
				</div>

			</article>

		</section>

		@component('components.client_list')
		@endcomponent

	</main>

	<footer><a href="#" title="alteriade">Copyright alteriade 2018</a></footer>

</body>

</html>
