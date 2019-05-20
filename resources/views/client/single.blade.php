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
