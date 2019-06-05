@extends('layout.layout')

@php
	$user = (!isset($user)) ? Auth::user() : $user;
@endphp

@section('page_title')
  Utilisateurs
@endsection

@section('main_section_breadcrumb')
  @parent
  | <strong>Utilisateurs</strong>
@endsection

@section('main_section_body')


  <h2><strong>Tous les utilisateurs</strong></h2>

  @if($users->count() < 1)

    <p>Aucun utilisateur n'a été trouvé</p>

  @else

    <ul id="users_list" class="users_list">
      @foreach ($users as $u)

          <li class="users_list_item @if($u->id == $user->id) users_list_item_self @endif">
            <strong>{{$u->name}}</strong> - {{$u->email}}
            - <a href="#" title="Modifier cet utilisateur">Modifier</a>
            @if($u->id == $user->id)
              - <a href="#" onclick="confirm('Voulez-vous vraiment supprimer l\'utilisateur {{ $u->name }} ?');" title="Supprimer cet utilisateur">Supprimer</a>
            @endif
          </li>

      @endforeach
    </ul>

  @endif


  <h2><strong>Tous les membres d'équipe</strong></h2>

  @if($teamMembers->count() < 1)

    <p>Aucun utilisateur n'a été trouvé</p>

  @else

    @foreach(['web' => "Équipe web", 'cec' => "CECs", 'consultant' => "Consultants"] as $team => $teamName)

      <h3>{{$teamName}}</h3>
      <ul class="users_list">
        @foreach ($teamMembers as $tm)

          @if($tm->team == $team)

            <li class="users_list_item">
              <strong>{{$tm->first_name}} {{$tm->last_name}}</strong>
              - <a href="#" title="Modifier ce membre">Modifier</a>
              - <a href="#" onclick="confirm('Voulez-vous vraiment supprimer le membre {{ $tm->name }} ?');" title="Supprimer ce membre">Supprimer</a>
            </li>

          @endif

        @endforeach
      </ul>
      <button type="button">+</button>

    @endforeach

  @endif

@endsection
