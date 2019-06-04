@php
  /*
   * Si la variable $show_client n'est pas passée
   * dans les paramètres d'appel du composant (hors Home)
   * on la définit par défaut à false
   */
  $show_client = isset($show_client) ? $show_client : false;

  /*
   * Si la variable $bloc_closed n'est pas passée
   * dans les paramètres d'appel du composant
   * on la définit par défaut à false
   */
  $bloc_closed = isset($bloc_closed) ? $bloc_closed : false;

  /*
   * Bloc ouvert ou fermé
   */
   $closed = ($bloc_closed) ? ' bloc_closed' : '';
@endphp

<article class="bloc{{$closed}}">


  {{-- En-tête du bloc : partie concernant le projet --}}
  <div class="bloc_header">

    <div class="bloc_header_container">

      <h3>
        {{-- Affiche ou non le nom du client --}}
        @if ($show_client)
          <strong><a href="{{ route('client_single', ['id' => $projet->client->id]) }}">{{ $projet->client->name }}</a></strong> |
        @endif

        {{-- Affiche le nom du projet --}}
        <strong><a href="{{ route('projet_single', ['id' => $projet->id]) }}">{{ $projet->name }}</a></strong>
      </h3>

      {{-- Affiche les Team Members associés au projet --}}
      @component('components.tag_teammember_container',['teamMembers' => $projet->teammembers])
      @endcomponent

    </div>

  </div>


  {{-- Corps du bloc : partie concernant les contrats --}}
  @if (count($contrats) < 1)

    <div class="bloc_details">
      <p class="bloc_details_main">Aucun contrat de maintenance n'a été trouvé pour ce projet.</p>
    </div>

  @else

    @foreach ($contrats as $contrat)

      @php

        /*
         * Date de début du contrat
         */
        $startDate = \DateTime::createFromFormat('Y-m-d H:i:s', $contrat->start_date);

        /*
         * Picto différent suivant le type de contrat
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
          $temps_restant = 'Contrat expiré';
        }
        else {
          $warning = '';
        }

      @endphp

      <div class="bloc_details bloc_marked{{ $warning }}">

        {{-- Affichage des informations générales du contrat --}}
        <p class="bloc_details_main bloc_details_pictoed {{ $picto }}">

          <span><strong>{{ $contrat->name }}</strong></span>
          <span>
            <span class="txtright">Date de début du contrat : {{ $startDate->format('d/m/Y') }}</span>
            <span class="bloc_details_countdown txtright">{{ $temps_restant }}</span>
          </span>

        </p>

        {{-- Dernière opération de maintenance en date pour ce contrat --}}
        @if (!$contrat->is_ended)

          <p class="bloc_details_below">

            @if($contrat->interventions->count() > 0)

              @php
                $date_intervention = \DateTime::createFromFormat('Y-m-d H:i:s', $contrat->latest_intervention->date);
              @endphp

              <span>Dernière intervention : {{ $contrat->latest_intervention->type }}</span>
              <span>le : {{ $date_intervention->format('d/m/Y') }}</span>

            @else

              <span>Aucune intervention n'a encore eu lieu dans le cadre de ce contrat.</span>

            @endif

          </p>

        @endif

      </div>

    @endforeach

  @endif

</article>
