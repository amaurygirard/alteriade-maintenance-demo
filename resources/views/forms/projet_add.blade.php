@extends('forms.form_container')

  @section('form')

    <form action="/projet/create" method="post">
      @csrf

      <input type="hidden" name="client_id" value="{{$client_id}}">
      
      <div>
        <input type="text" name="name" value="" placeholder="Tapez ici le nom du projet">
      </div>

      <div>
        @foreach ($teamMembers as $teamMember)
          <input type="checkbox" name="teammembers[]" id="teammembers-{{$teamMember->id}}" value="{{$teamMember->id}}"><label for="teammembers-{{$teamMember->id}}">{{$teamMember->first_name}} {{$teamMember->last_name}}</label>
        @endforeach
      </div>

      <input type="submit" value="Ajouter le projet">

    </form>

  @endsection
