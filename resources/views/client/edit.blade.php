@extends('forms.form_container')

  @section('form')

    <form action="/client/{{$client->id}}/edit" method="post">
      @csrf
      @method('PATCH')

      <div>
        <label for="">Nom du client</label>
        <input type="text" name="name" value="{{$client->name}}" placeholder="Tapez ici le nom du client">
      </div>

      <div>
        <p class="label">Quels sont les membres de l'équipe en charge de ce client&nbsp;?</p>

        @foreach ($usermetas as $u)
          <input type="checkbox" name="users[]" id="users-{{$u->user_id}}" value="{{$u->user_id}}"@if($client->users->contains($u->user_id)) checked="checked"@endif><label for="users-{{$u->user_id}}">{{$u->first_name}} {{$u->last_name}}</label>
          <div class="clear"></div>
        @endforeach

      </div>

      <div>
        <input type="submit" value="Enregistrer les modifications">
      </div>

    </form>

  @endsection
