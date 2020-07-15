@php

  /*
   * Bloc ouvert ou fermé
   *
   * Si la variable $bloc_closed n'est pas passée
   * dans les paramètres d'appel du composant
   * on la définit par défaut à false
   */
  $bloc_closed = isset($bloc_closed) ? $bloc_closed : false;
  $closed = ($bloc_closed) ? ' bloc_closed' : '';

@endphp

<article class="bloc{{$closed}}">

  <header class="bloc_header @yield('bloc_header_classes')">
    <div class="bloc_header_container">
      <h3>
        @section('header_title')
        @show
      </h3>

      <span>
        @section('header_details')
        @show
      </span>

      @section('header_buttons')
      @show

    </div><!--/.bloc_header_container-->
  </header>

  <ul class="bloc_details_container">

    @section('bloc_content')
    @show

  </ul>

</article>
