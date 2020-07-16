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

  <header class="bloc_header {{$bloc_header_classes}}">
    <div class="bloc_header_container">
      <h3>
        {{$header_title}}
      </h3>

      <span>
        {{$header_details}}
      </span>

      {{$header_buttons}}

    </div><!--/.bloc_header_container-->
  </header>

  <ul class="bloc_details_container">

    {{$slot}}

  </ul>

</article>
