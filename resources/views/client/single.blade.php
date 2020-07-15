@extends('layout.layout')

@section('main_section_tags')
  @component('components.tag_user_container',['users' => $client->users])
  @endcomponent
@endsection

@section('main_section_breadcrumb')
  @parent
  | <span>
      <strong>{{ $client->name }}</strong>
      @if(Auth::user()->usermeta->team == "web")
        @component('components.modifier',['item' => $client])
        @endcomponent
      @endif
    </span>
@endsection

@section('main_section_add_button')
  @if(Auth::user()->usermeta->team == "web")
    <button id="projet_add" data-fancybox data-type="ajax" data-src="{{route('ajax_add_projet', ['client_id' => $client->id])}}" href="javascript:;"><span>Ajouter un nouveau projet</span></button>
  @endif
@endsection

@section('main_section_body')

  {{-- Si aucun projet n'existe encore pour le client --}}
  @if ($client->projets->count() < 1)

    <p class="mtl">Aucun projet n'a été trouvé pour ce client.</p>

  @else

    {{-- Si un contrat est bientôt expiré, on le fait remonter dans une section mise en avant --}}
    @php
      $contrats_presque_expires = [];

      foreach($client->projets as $projet) {
        foreach($projet->contrats as $contrat) {

          if($contrat->is_close_to_end) {
            $contrats_presque_expires[] = [$projet, $contrat];
          }

        }
      }
    @endphp

    {{-- Contrats bientôt expirés --}}
    @if (count($contrats_presque_expires) > 0)

      <h2><strong>Contrats bientôt expirés</strong></h2>

      @foreach ($contrats_presque_expires as $projet_contrat)
        @component('components.bloc_projet', [
          'projet' => $projet_contrat[0],
          'contrats' => [$projet_contrat[1]]
        ])
        @endcomponent
      @endforeach

    @endif

    {{-- Affichage de tous les projets --}}
    <h2><strong>Tous les projets</strong></h2>

    @foreach ($client->projets as $projet)
      @component('components.bloc_projet', [
        'projet' => $projet,
        'contrats' => $projet->contrats,
        'bloc_closed' => true,
      ])
      @endcomponent
    @endforeach

  @endif

@endsection
