<article class="bloc">

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

  <div class="bloc_header bloc_marked{{ $warning }} bloc_header_pictoed {{ $picto }}">

    <div class="bloc_header_container">

      <h3><strong><a href="{{ route('contrat_single', ['id' => $contrat->id]) }}">{{ $contrat->name }}</a></strong></h3>

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
