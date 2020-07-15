@extends('layout.layout')


@section('main_section_breadcrumb')
  Home
@endsection


@section('main_section_body')

  @if($close_to_end_contrats->count() > 0)

    <h2><strong>Contrats bientôt expirés</strong></h2>

    @foreach($close_to_end_contrats as $contrat)
      @component('components.bloc.projet',[
        'projet' => $contrat->projet,
        'contrats' => [$contrat],
        'interventions' => $contrat->interventions,
        'show_client' => true
      ])
      @endcomponent
    @endforeach

  @endif


  <h2><strong>Dernières interventions</strong></h2>

  @foreach($latest_interventions as $int)

    @component('components.bloc.projet',[
      'projet' => $int->contrat->projet,
      'contrats' => [$int->contrat,],
      'interventions' => $int,
      'show_client' => true
    ])
    @endcomponent

  @endforeach

@endsection
