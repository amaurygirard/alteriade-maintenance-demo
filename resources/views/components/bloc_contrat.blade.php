@php
  /*
   * Si la variable $bloc_closed n'est pas passée
   * dans les paramètres d'appel du composant
   * on la définit par défaut à false
   */
  $bloc_closed = isset($bloc_closed) ? $bloc_closed : false;

  /*
   * Date de début du contrat
   */
  $startDate = \DateTime::createFromFormat('Y-m-d H:i:s', $contrat->start_date);

  /*
   * Picto selon le type de contrat
   */
  $picto = ($contrat->type == 'annuel') ? 'pictoed_calendar' : 'pictoed_clock';

  /*
   * Calcul du temps restant à afficher
   */
  $temps_restant = 'Temps restant : ';

  if($contrat->type == 'annuel') {

    // Années
    $temps_restant .= ($contrat->diff->y > 0) ? $contrat->diff->y.' an, ' : '';
    // Mois
    $temps_restant .= ($contrat->diff->m > 0) ? $contrat->diff->m.' mois et ' : '';
    // Jours
    $temps_restant .= ($contrat->diff->d > 0) ? $contrat->diff->d.' jour' .(($contrat->diff->d > 1) ? 's' : '') : '';

  }
  else {

      // Heures
      $temps_restant .= ($contrat->diff->h > 0) ? $contrat->diff->h.'h ' : '';
      // Minutes
      $temps_restant .= ($contrat->diff->i > 0) ? $contrat->diff->i.'min' : '';

  }

  /*
   * Expiration du contrat
   */
  if( $contrat->is_close_to_end ) {
      $warning = ' bloc_warning';
  }
  else if( $contrat->is_ended ) {
      $warning = ' bloc_darkened';
  }
  else {
      $warning = '';
  }

  /*
   * Bloc ouvert ou fermé
   */
   $closed = ($bloc_closed) ? ' bloc_closed' : '';

@endphp

<article class="bloc{{$closed}}">

  {{-- En-tête du bloc : informations générales du contrat --}}
  <div class="bloc_header bloc_marked{{ $warning }} bloc_header_pictoed {{ $picto }}">

    <div class="bloc_header_container">

      <h3><strong>{{-- <a href="{{ route('contrat_single', ['id' => $contrat->id]) }}"> --}}{{ $contrat->name }}{{-- </a> --}}</strong></h3>

      <span>
        <span class="txtright">Date de début du contrat : {{$startDate->format('d/m/Y')}}</span>
        <span class="txtright">{{$temps_restant}}</span>
      </span>

      {{-- Bouton ajouter une intervention --}}
      <button id="intervention_add" data-fancybox data-type="ajax" data-src="{{route('ajax_add_intervention', ['contrat_id' => $contrat->id])}}" href="javascript:;" title="Ajouter une intervention"><span>+</span></button>

    </div>

  </div>

  {{-- Corps du bloc : affichage détaillé des interventions --}}
  @if($contrat->interventions->count() < 1)

    <div class="bloc_details">
      <p class="bloc_details_main">
        <span>Aucune intervention n'a encore eu lieu dans le cadre de ce contrat.</span>
      </p>
    </div>

  @else

    @foreach ($contrat->interventions->sortByDesc('date') as $intervention)
      @php
        $date_intervention = \DateTime::createFromFormat('Y-m-d H:i:s', $intervention->date);
      @endphp

      <div class="bloc_details">

        @component('components.tag_user_container',['users' => $intervention->users])
        @endcomponent

        {{-- Informations générales de l'intervention --}}
        <p class="bloc_details_main bloc_details_tagged{{-- bloc_details_pictoed pictoed_text pictoed_text_eab --}}">

          <span><strong>{{$intervention->readable_type}}</strong></span>

          <span class="flex-container">
            <span class="txtright">Intervention de : <strong>{{$intervention->minutes_spent}} minutes</strong></span>
            <span class="bloc_details_countdown txtright">le : <strong>{{ $date_intervention->format('d/m/Y') }}</strong></span>
          </span>

        </p>

        {{-- Descriptif de l'intervention --}}
        <p class="bloc_details_below">

          <span>{{$intervention->description}}</span>

        </p>

      </div>
    @endforeach

  @endif

</article>
