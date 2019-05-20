@extends('forms.form_container')

  @section('form')

    <form action="/projet/create" method="post">
      @csrf

      <input type="hidden" name="client_id" value="{{$client_id}}">
      <input type="text" name="name" value="" placeholder="Tapez ici le nom du projet">
      <input type="submit" value="Ajouter le projet">

    </form>

  @endsection
