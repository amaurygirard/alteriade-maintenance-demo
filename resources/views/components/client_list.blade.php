<aside id="clients">

  <div id="client_search">

    <h2 class="h1-like"><strong>Clients</strong></h2>

    <input type="text" name="client" id="client_input">

  </div>

  @if (count($clients) < 1)

    <ul id="client_list"><li class="client_item"><div class="pam txtcenter">Aucun client n'a été trouvé</div></li></ul>

  @else

    <ul id="client_list">

      @foreach ($clients as $client)
        <li class="client_item"><a href="#">{{ $client->name }}</a></li>
      @endforeach

    </ul>

  @endif

  <button id="client_add" data-fancybox data-type="ajax" data-src="{{route('ajax_add_client')}}" href="javascript:;">Ajouter un nouveau client</button>

</aside>
