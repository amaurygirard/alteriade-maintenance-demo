@extends('layout.layout')


@section('main_section_tags')
  <div class="tag">LM</div>
  <div class="tag">JR</div>
@endsection

@section('main_section_breadcrumb')
  @parent
  | <a href="{{ route('client_single',['id'=>$client->id]) }}">{{ $client->name }}</a>
  | <strong>{{ $projet->name }}</strong>
@endsection

@section('main_section_add_button')
  <button id="projet_add" data-fancybox data-type="ajax" data-src="{{route('ajax_add_contrat', ['projet_id' => $projet->id])}}" href="javascript:;"><span>Ajouter un nouveau contrat</span></button>
@endsection


@section('main_section_body')
@endsection
