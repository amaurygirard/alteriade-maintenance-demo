@extends('layout.layout')

@section('main_section_tags')
  @component('components.tag_user_container',['users' => $projet->users])
  @endcomponent
@endsection

@section('main_section_breadcrumb')
  @parent
  | <a href="{{ route('client_single',['id'=>$projet->client->id]) }}">{{ $projet->client->name }}</a>
  | <strong>{{ $projet->name }}</strong>
@endsection

@section('main_section_add_button')
  <button id="projet_add" data-fancybox data-type="ajax" data-src="{{route('ajax_add_contrat', ['projet_id' => $projet->id])}}" href="javascript:;"><span>Ajouter un nouveau contrat</span></button>
@endsection

@section('main_section_body')

  @if ($projet->contrats->count() < 1)

    <p class="mtl">Aucun contrat n'a été trouvé pour ce projet.</p>

  @else

    <h2><strong>Tous les contrats</strong></h2>

    @foreach ($projet->contrats as $contrat)
      @component('components.bloc_contrat', [
        'contrat' => $contrat
      ])
      @endcomponent
    @endforeach

  @endif

@endsection
