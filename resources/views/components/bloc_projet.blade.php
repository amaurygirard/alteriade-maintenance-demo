<article class="bloc">

  <div class="bloc_header">

    <div class="bloc_header_container">

      <h3><strong><a href="{{ route('projet_single', ['id' => $projet->id]) }}">{{ $projet->name }}</a></strong></h3>

      <div class="bloc_tags">
        <div class="bloc_tag tag">LM</div>
        <div class="bloc_tag tag">JR</div>
      </div>

    </div>

  </div>

  @foreach ($contrats as $contrat)

    @php

      $startDate = \DateTime::createFromFormat('Y-m-d H:i:s', $contrat->start_date);

      if($contrat->type == 'annuel') {
          // Picto
          $picto = 'pictoed_calendar';

          // Date de fin
          $endDate = \DateTime::createFromFormat('Y-m-d H:i:s', $contrat->end_date);
          $now =  new \DateTime();

          if( $endDate->getTimestamp() < $now->getTimestamp() ) {
            $warning = ' bloc_warning';
          }
          else {
            $warning = '';
          }

      }
      else {
          // Picto
          $picto = 'pictoed_clock';
          $warning = '';

      }

    @endphp

    <div class="bloc_details bloc_marked{{ $warning }}">

      <p class="bloc_details_main bloc_details_pictoed {{ $picto }}">

        <span><strong>{{ $contrat->name }}</strong></span>
        <span>
          <span class="txtright">Date de début du contrat : {{ $startDate->format('d/m/Y') }}</span>
          <span class="bloc_details_countdown txtright">Temps restant</span>
        </span>

      </p>

      <p class="bloc_details_below">

        <span>Dernière intervention</span>
        <span>le : Date</span>

      </p>

    </div>

  @endforeach

  @if (count($contrats) < 1)
    <div class="bloc_details">
      <p class="bloc_details_main">Aucun contrat de maintenance n'a été trouvé pour ce projet.</p>
    </div>
  @endif

</article>
