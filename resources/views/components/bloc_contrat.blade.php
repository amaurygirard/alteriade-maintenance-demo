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
        <button id="intervention_add" data-fancybox data-type="ajax" data-src="{{route('ajax_add_intervention', ['contrat_id' => $contrat->id])}}" href="javascript:;"><span>+</span></button>
      </div>

    </div>

  </div>

  @foreach ($interventions as $intervention)
    @php
      $date_intervention = \DateTime::createFromFormat('Y-m-d H:i:s', $intervention->date);
    @endphp

    <div class="bloc_details">

      <p class="bloc_details_main bloc_details_pictoed pictoed_text pictoed_text_eab">

        <span><strong>{{$intervention->type}}</strong></span>
        <span class="flex-container">
          <span class="txtright">Intervention de : <strong>{{$intervention->minutes_spent}} minutes</strong></span>
          <span class="bloc_details_countdown txtright">le : <strong>{{ $date_intervention->format('d/m/Y') }}</strong></span>
        </span>

      </p>

      <p class="bloc_details_below">

        <span>{{$intervention->description}}</span>

      </p>

    </div>
  @endforeach

  @if($interventions->count() < 1)
    <div class="bloc_details">
      <p class="bloc_details_main">
        <span>Aucune intervention n'a encore eu lieu dans le cadre de ce contrat.</span>
      </p>
    </div>
  @endif

</article>
