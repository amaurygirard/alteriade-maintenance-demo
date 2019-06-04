/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/main.js":
/*!******************************!*\
  !*** ./resources/js/main.js ***!
  \******************************/
/*! no static exports found */
/***/ (function(module, exports) {

/* Blocs ouverts / fermés */
$.fn.open_close_blocs = function () {
  "use strict";
  /*
   * Crée un bouton d'ouverture/fermeture
   */

  var bloc_switcher = '<button title="Masquer le détail" class="bloc_switcher"></button>'; // Ajout du bouton dans le header du bloc

  $(this).addClass('has_button_bloc_switcher').find('.bloc_header').prepend(bloc_switcher);
  /*
   * Masque les éléments qui portent la classe 'bloc_closed'
   */

  var elements = $(this);

  for (var i = 0; i < elements.length; i++) {
    if ($(elements[i]).hasClass('bloc_closed')) {
      // Masque le bloc
      $(elements[i]).find('.bloc_details').css('display', 'none'); // Synchronise le bouton (flèche et title)

      $(elements[i]).find('.bloc_switcher').addClass('click_to_open').attr('title', 'Afficher le détail');
    }
  }
  /*
   * Crée le listener pour les clics sur le bouton
   */


  $(this).find('button.bloc_switcher').click(function (event) {
    $(this).parent().siblings('.bloc_details').slideToggle();
    $(this).toggleClass('click_to_open');

    if ($(this).attr('title') == "Afficher le détail") {
      $(this).attr('title', "Masquer le détail");
    } else {
      $(this).attr('title', "Afficher le détail");
    }
  });
};
/* Chargement du document */


$('document').ready(function () {
  "use strict";
  /* Liste des clients */

  $('body').on('keyup', '#client_input', function () {
    // Valeur recherchée
    var search = $(this).val(),
        regex = RegExp('(' + search + ')', 'i'); // Liste complète des clients

    var clients = $('#client_list').find('li'); // Teste pour chaque client la valeur recherchée

    var temoin = 0;

    for (var i = 0; i < clients.length; i++) {
      var html = $(clients[i]).find('a').html(); // Supprime les balises <b></b> préalablement insérées dans les noms des clients

      while (/<\/?b>/i.test(html)) {
        html = html.replace(/<\/?b>/i, '');
      } // Si la valeur est trouvée


      if (regex.test(html)) {
        $(clients[i]).slideDown();
        $(clients[i]).find('a').html(html.replace(regex, '<b>$&</b>'));

        if (temoin % 2 == 1) {
          $(clients[i]).css('background-color', 'rgb(255, 226, 35)');
        } else {
          $(clients[i]).css('background-color', 'rgba(0,0,0,0.05)');
        }

        temoin++;
      } // Si la valeur n'est pas trouvée
      else {
          $(clients[i]).slideUp();
          $(clients[i]).find('a').html(html);
          $(clients[i]).css('background-color', '');
        }
    }
  });
  /* Fermeture des blocs qui doivent l'être */

  $('.bloc').open_close_blocs();
});

/***/ }),

/***/ "./resources/sass/style.scss":
/*!***********************************!*\
  !*** ./resources/sass/style.scss ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!****************************************************************!*\
  !*** multi ./resources/js/main.js ./resources/sass/style.scss ***!
  \****************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /Users/Amaury/Documents/projets/alteriade_maintenance/app/resources/js/main.js */"./resources/js/main.js");
module.exports = __webpack_require__(/*! /Users/Amaury/Documents/projets/alteriade_maintenance/app/resources/sass/style.scss */"./resources/sass/style.scss");


/***/ })

/******/ });