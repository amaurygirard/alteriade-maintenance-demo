@extends('layout.layout')


@section('main_section_tags')
  <div class="tag">LM</div>
  <div class="tag">JR</div>
@endsection

@section('main_section_breadcrumb')
  @parent
  | <strong>{{ $client->name }}</strong>
@endsection

@section('main_section_add_button')
  <button id="projet_add" data-fancybox data-type="ajax" data-src="{{route('ajax_add_projet', ['client_id' => $client->id])}}" href="javascript:;"><span>Ajouter un nouveau projet</span></button>
@endsection

@section('main_section_body')

  {{-- Si un contrat est bientôt expiré, on le fait remonter dans une section précédente --}}
  @php
    $contrats_presque_expires = [];
    $contrats_expires = [];

    foreach($projets as $projet) {
      foreach($contrats[$projet->id] as $contrat) {

        if($contrat->is_ended) {
          $contrats_expires[] = $contrat;
        }
        else if($contrat->is_close_to_end) {
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
        'contrats' => [$projet_contrat[1]],
        'interventions' => $interventions/*[$projet_contrat[1]->id]*/
      ])
      @endcomponent
    @endforeach

  @endif

  {{-- Affichage de tous les projets --}}
  <h2><strong>Tous les projets</strong></h2>

  @foreach ($projets as $projet)
    @component('components.bloc_projet', ['projet' => $projet, 'contrats' => $contrats[$projet->id], 'interventions' => $interventions])
    @endcomponent
  @endforeach

  {{-- Si aucun projet n'exite encore pour le client --}}
  @if ($projets->count() < 1)
    <p>Aucun projet n'a été trouvé pour ce client.</p>
  @endif

@endsection
