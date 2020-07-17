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

	@foreach( [
		'Équipe Web' => [
			'collection' => $users_web,
			'team' => 'web'
		],
		'Chefs de projet' => [
			'collection' => $users_cec,
			'team' => 'cec'
		],
		'Consultants' => [
			'collection' => $users_consultant,
			'team' => 'consultant'
		],
	] as $key => $value)

	<h3 class="mtm">{{$key}}</h3>

	  @if($value['collection']->count() < 1)

	    <p>Aucun utilisateur n'a été trouvé</p>

	  @else

	    <ul id="users_list" class="users_list">
	      @foreach ($value['collection'] as $u)

	          <li class="users_list_item @if($u->user_id == $user->id) users_list_item_self @endif">
	            <strong>{{$u->first_name}} {{$u->last_name}}</strong> - {{$u->user->email}}
	            {{-- - <a href="#" title="Modifier cet utilisateur">Modifier</a>
	            @if($u->user_id != $user->id)
	              - <a href="#" onclick="confirm('Voulez-vous vraiment supprimer l\'utilisateur {{$u->first_name}} {{$u->last_name}} ?');" title="Supprimer cet utilisateur">Supprimer</a>
	            @endif --}}
					 	</li>

	      @endforeach
	    </ul>

	  @endif

		<button class="add_user" data-fancybox data-type="ajax" data-src="{{route('ajax_add_user', ['team' => $value['team']])}}" href="javascript:;"><span>Ajouter un nouvel utilisateur</span></button>

	@endforeach

@endsection
