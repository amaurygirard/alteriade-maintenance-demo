/* Blocs ouverts / fermés */

$.fn.open_close_blocs = function() {

	"use strict";

	// Affiche le pointeur pour signaler l'interaction
	$(this).css('cursor','pointer');

	// Masque les éléments qui portent la classe 'bloc_closed'
	var elements = $(this);

	for(var i = 0; i < elements.length; i++) {

		if($(elements[i]).hasClass('bloc_closed')) {
			$(elements[i]).find('.bloc_details').slideUp();
		}

	}

	// Crée le listener pour les clics
	$(this).click(function(event){

		if( !$(event.target).closest('a, button').length > 0 && !$(event.target).is('a, button') ) {
			$(this).find('.bloc_details').slideToggle();
		}
	});

};


/* Chargement du document */

$('document').ready(function(){

	"use strict";

	/* Liste des clients */
	$('body').on('keyup', '#client_input', function(){

		// Valeur recherchée
		var search = $(this).val(),
			regex = RegExp('('+search+')', 'i');

		// Liste complète des clients
		var clients = $('#client_list').find('li');

		// Teste pour chaque client la valeur recherchée
		var temoin = 0;
		for (var i = 0; i < clients.length; i++) {

			var html = $(clients[i]).find('a').html();

			// Supprime les balises <b></b> préalablement insérées dans les noms des clients
			while(/<\/?b>/i.test(html)) {
				html = html.replace(/<\/?b>/i, '');
			}

			// Si la valeur est trouvée
			if(regex.test(html)){

				$(clients[i]).slideDown();
				$(clients[i]).find('a').html( html.replace(regex, '<b>$&</b>') );

				if(temoin % 2 == 1) {
					$(clients[i]).css('background-color','rgb(255, 226, 35)');
				}
				else {
					$(clients[i]).css('background-color','rgba(0,0,0,0.05)');
				}

				temoin++;
			}

			// Si la valeur n'est pas trouvée
			else {

				$(clients[i]).slideUp();
				$(clients[i]).find('a').html(html);
				$(clients[i]).css('background-color','');

			}

		}

	});


	/* Fermeture des blocs qui doivent l'être */
	$('.bloc').open_close_blocs();

});
