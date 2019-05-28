<article class="bloc">

  <div class="bloc_header">

    <div class="bloc_header_container">

      <h3><strong><a href="{{ route('projet_single', ['id' => $projet->id]) }}">{{ $projet->name }}</a></strong></h3>

      @component('components.tag_teammember_container',['teamMembers' => $projet->teammembers])
      @endcomponent

    </div>

  </div>



  @foreach ($contrats as $contrat)
    @php
      // echo '<pre>';
      // $contrats[0]->calculateExpiration();
      // var_dump($contrat);
      // echo '</pre>';
    @endphp
    @php

      $startDate = \DateTime::createFromFormat('Y-m-d H:i:s', $contrat->start_date);

      // Temps restant
      $temps_restant = 'Temps restant : ';

      if($contrat->type == 'annuel') {

        // Picto
        $picto = 'pictoed_calendar';

        // Year
        $temps_restant .= ($contrat->diff->y > 0) ? $contrat->diff->y.' an, ' : '';
        // Mois
        $temps_restant .= ($contrat->diff->m > 0) ? $contrat->diff->m.' mois et ' : '';
        // Jours
        $temps_restant .= ($contrat->diff->d > 0) ? $contrat->diff->d.' jour' .(($contrat->diff->d > 1) ? 's' : '') : '';

      }
      else {

          // Picto
          $picto = 'pictoed_clock';

          // Heures
          $temps_restant .= ($contrat->diff->h > 0) ? $contrat->diff->h.'h ' : '';
          // Minutes
          $temps_restant .= ($contrat->diff->i > 0) ? $contrat->diff->i.'min' : '';

      }

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

      <p class="bloc_details_main bloc_details_pictoed {{ $picto }}">

        <span><strong>{{ $contrat->name }}</strong></span>
        <span>
          <span class="txtright">Date de début du contrat : {{ $startDate->format('d/m/Y') }}</span>
          <span class="bloc_details_countdown txtright">{{ $temps_restant }}</span>
        </span>

      </p>

      <p class="bloc_details_below">

        @if ($interventions[$contrat->id])
          @php
            $date_intervention = \DateTime::createFromFormat('Y-m-d H:i:s', $interventions[$contrat->id]->date);
          @endphp

          <span>Dernière intervention : {{ $interventions[$contrat->id]->type }}</span>
          <span>le : {{ $date_intervention->format('d/m/Y') }}</span>
        @else

          <span>Aucune intervention n'a encore eu lieu dans le cadre de ce contrat.</span>

        @endif


      </p>

    </div>

  @endforeach

  @if (count($contrats) < 1)
    <div class="bloc_details">
      <p class="bloc_details_main">Aucun contrat de maintenance n'a été trouvé pour ce projet.</p>
    </div>
  @endif

</article>
