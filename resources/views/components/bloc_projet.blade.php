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

  <div class="bloc_details bloc_marked bloc_warning">

    <p class="bloc_details_main bloc_details_pictoed pictoed_calendar">

      <span><strong>Lorem ipsum dolor.</strong></span>
      <span>
        <span class="txtright">Date de début du contrat</span>
        <span class="bloc_details_countdown txtright">Temps restant</span>
      </span>

    </p>

    <p class="bloc_details_below">

      <span>Dernière intervention</span>
      <span>le : Date</span>

    </p>

  </div>

</article>
