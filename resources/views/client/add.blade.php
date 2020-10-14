@extends('forms.form_container')

  @section('form')

    <form action="/client/create" method="post">
      @csrf

      <div>
        <label for="name">Nom du client</label>
        <input type="text" name="name" id="name" value="" placeholder="Tapez ici le nom du client">
      </div>

      <div>
        <p class="label">Quels sont les membres de l'équipe en charge de ce client&nbsp;?</p>

        @foreach ($usermetas as $u)
          <input type="checkbox" name="users[]" id="users-{{$u->user_id}}" value="{{$u->user_id}}"><label for="users-{{$u->user_id}}">{{$u->first_name}} {{$u->last_name}}</label>
          <div class="clear"></div>
        @endforeach

      </div>

      <div>
        <input type="submit" value="Ajouter le client">
      </div>

    </form>

  @endsection
