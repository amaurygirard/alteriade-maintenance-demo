@component('components.bloc.bloc')

{{-- Classes du header --}}
@php

  /*
   * Picto selon le type de contrat
   */
  $picto = ($contrat->type == 'annuel') ? 'pictoed_calendar' : 'pictoed_clock';

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

@endphp

@slot('bloc_header_classes')
  bloc_marked {{$warning}} bloc_header_pictoed {{$picto}}
@endslot


{{-- Titre et boutons du header--}}
@php
 /*
  * L'utilisateur est-il un membre de l'équipe web
  */
  $is_web_team = (Auth::user()->usermeta->team == 'web') ? true : false;


@endphp

@slot('header_title')
  <strong>{{ $contrat->name }}
  ({{$contrat->id}})</strong>

  {{-- Bouton de modification : uniquement pour l'équipe web --}}
  @if($is_web_team)
    @component('components.modifier',['item' => $contrat])
    @endcomponent
  @endif
@endslot

@slot('header_buttons')
    {{-- Bouton ajouter une intervention : uniquement pour l'équipe web --}}
    @if($is_web_team)
      <button class="intervention_add" data-fancybox data-type="ajax" data-src="{{route('ajax_add_intervention', ['contrat_id' => $contrat->id])}}" href="javascript:;" title="Ajouter une intervention"><span>+</span></button>
    @endif
@endslot


@php

  /*
   * Date de début du contrat
   */
  $startDate = \DateTime::createFromFormat('Y-m-d H:i:s', $contrat->start_date);

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

    // Contrat expiré
    if($contrat->is_ended) $temps_restant = 'Contrat expiré le '.\DateTime::createFromFormat('Y-m-d H:i:s', $contrat->end_date)->format('d/m/Y');

  }
  else {

      // Heures
      $time = ($contrat->diff->h > 0) ? $contrat->diff->h.'h ' : '';
      // Minutes
      $time .= ($contrat->diff->i > 0) ? $contrat->diff->i.'min' : '';

      // Contrat expiré
      if($contrat->is_ended) $temps_restant = 'Contrat dépassé de : ';

      // Rappel du forfait
      $temps_restant = 'Forfait de '.($contrat->minutes_in_forfait/60).'h - '.$temps_restant;

      $temps_restant .= $time;

  }
@endphp

@slot('header_details')
  <span class="txtright">Date de début du contrat : {{$startDate->format('d/m/Y')}}</span>
  <span class="txtright">{{$temps_restant}}</span>
@endslot


{{-- Corps du bloc --}}
@php
  /*
   * Affichage lisible du temps consacré aux sauvegardes mensuelles
   */
  $temps_sauvegardes = ((floor($contrat->minutes_spent_monthly/60) > 0) ? floor($contrat->minutes_spent_monthly/60).'h' : '') . ( (($contrat->minutes_spent_monthly % 60) > 0) ? ($contrat->minutes_spent_monthly % 60) . 'min' : '' );
@endphp

{{-- @section('bloc_content') --}}

  {{-- Affichage du temps consacré aux sauvegardes et mises à jour mensuelles --}}
  @if ($contrat->minutes_spent_monthly)
    <li class="bloc_details">
      <p class="bloc_details_main"><span>Cumul des opérations de sauvegardes et de mises à jour de sécurité ({{$contrat->minutes_mensuelles}} minutes par mois)&nbsp;: <strong>{{$temps_sauvegardes}}</strong></span></p>
    </li>
  @endif

  {{-- Affichage détaillé des interventions --}}
  @if($contrat->interventions->count() < 1)

    <li class="bloc_details">
      <p class="bloc_details_main">
        <span>Aucune intervention n'a encore eu lieu dans le cadre de ce contrat.</span>
      </p>
    </li>

  @else

    @foreach ($contrat->interventions->sortByDesc('date') as $intervention)
      @php
        $date_intervention = \DateTime::createFromFormat('Y-m-d H:i:s', $intervention->date);
      @endphp

      <li class="bloc_details">

        @component('components.tag_user_container',['users' => $intervention->users])
        @endcomponent

        {{-- Informations générales de l'intervention --}}
        <p class="bloc_details_main bloc_details_tagged{{-- bloc_details_pictoed pictoed_text pictoed_text_eab --}}">

          <span>

            <strong>{{$intervention->readable_type}}</strong>

            {{-- Bouton de modification : uniquement pour l'équipe web --}}
            @if($is_web_team)
              @component('components.modifier',['item' => $intervention])
              @endcomponent
            @endif

          </span>

          <span class="flex-container">
            <span class="txtright">
              Intervention de : <strong>{{$intervention->minutes_spent}} minutes</strong>
              @if ($intervention->is_probono)
                <span>(à titre grâcieux)</span>
              @endif
            </span>
            <span class="bloc_details_countdown txtright">
              le : <strong>{{ $date_intervention->format('d/m/Y') }}</strong>
            </span>
          </span>

        </p>

        {{-- Descriptif de l'intervention --}}
        <p class="bloc_details_below">

          <span>{{$intervention->description}}</span>

        </p>

      </li>
    @endforeach

  @endif

@endcomponent
