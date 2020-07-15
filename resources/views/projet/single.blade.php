@extends('layout.layout')

@section('main_section_tags')
  @component('components.tag_user_container',['users' => $projet->users])
  @endcomponent
@endsection

@section('main_section_breadcrumb')
  @parent
  | <a href="{{ route('client_single',['id'=>$projet->client->id]) }}">{{ $projet->client->name }}</a>
  | <span>
      <strong>{{ $projet->name }}</strong>

      @if(Auth::user()->usermeta->team == "web")
        @component('components.modifier',['item' => $projet])
        @endcomponent
      @endif

    </span>
@endsection

@section('main_section_add_button')
  @if(Auth::user()->usermeta->team == "web")
    <button id="projet_add" data-fancybox data-type="ajax" data-src="{{route('ajax_add_contrat', ['projet_id' => $projet->id])}}" href="javascript:;"><span>Ajouter un nouveau contrat</span></button>
  @endif
@endsection

@section('main_section_body')

  @if ($projet->contrats->count() < 1)

    <p class="mtl">Aucun contrat n'a été trouvé pour ce projet.</p>

  @else

    <h2><strong>Tous les contrats</strong></h2>

    @foreach ($projet->contrats as $contrat)
      @component('components.bloc.contrat', [
        'contrat' => $contrat
      ])
      @endcomponent
    @endforeach

  @endif

@endsection
