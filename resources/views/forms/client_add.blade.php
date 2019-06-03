@extends('forms.form_container')

  @section('form')

    <form action="/client/create" method="post">
      @csrf

      <div>
        <label for="">Nom du client</label>
        <input type="text" name="name" value="" placeholder="Tapez ici le nom du client">
      </div>

      <div>
        <p class="label">Quels sont les membres de l'équipe en charge de ce client&nbsp;?</p>

        @foreach ($teamMembers as $teamMember)
          <input type="checkbox" name="teammembers[]" id="teammembers-{{$teamMember->id}}" value="{{$teamMember->id}}"><label for="teammembers-{{$teamMember->id}}">{{$teamMember->first_name}} {{$teamMember->last_name}}</label>
          <div class="clear"></div>
        @endforeach

      </div>

      <div>
        <input type="submit" value="Ajouter le client">
      </div>

    </form>

  @endsection
