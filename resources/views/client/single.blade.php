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

  <h2><strong>Tous les projets</strong></h2>

  @foreach ($projets as $projet)
    @component('components.bloc_projet', ['projet' => $projet, 'contrats' => $contrats[$projet->id]])
    @endcomponent
  @endforeach

  @if ($projets->count() < 1)
    <p>Aucun projet n'a été trouvé pour ce client.</p>
  @endif

@endsection
