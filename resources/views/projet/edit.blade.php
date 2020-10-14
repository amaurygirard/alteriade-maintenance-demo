@extends('forms.form_container')

  @section('form')

    <form action="/projet/{{$projet->id}}/edit" method="post">
      @csrf
      @method('PATCH')

      <div>
        <label for="name">Nom du projet</label>
        <input type="text" name="name" id="name" value="{{$projet->name}}" placeholder="Tapez ici le nom du projet">
      </div>

      <div>
        @foreach ($usermetas as $u)
          <input type="checkbox" name="users[]" id="users-{{$u->user_id}}" value="{{$u->user_id}}"@if($projet->users->contains($u->user_id)) checked="checked"@endif><label for="users-{{$u->user_id}}">{{$u->first_name}} {{$u->last_name}}</label>
          <div class="clear"></div>
        @endforeach
      </div>

      <input type="submit" value="Enregistrer les modifications">

    </form>

  @endsection
