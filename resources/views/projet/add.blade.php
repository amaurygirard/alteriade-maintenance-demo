@extends('forms.form_container')

  @section('form')

    <form action="/projet/create" method="post">
      @csrf

      <input type="hidden" name="client_id" value="{{$client_id}}">

      <div>
        <label for="name">Nom du projet</label>
        <input type="text" name="name" id="name" value="" placeholder="Tapez ici le nom du projet">
      </div>

      <div>
        @foreach ($usermetas as $u)
          <input type="checkbox" name="users[]" id="users-{{$u->user_id}}" value="{{$u->user_id}}"><label for="users-{{$u->user_id}}">{{$u->first_name}} {{$u->last_name}}</label>
          <div class="clear"></div>
        @endforeach
      </div>

      <input type="submit" value="Ajouter le projet">

    </form>

  @endsection
