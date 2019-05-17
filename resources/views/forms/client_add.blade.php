@extends('forms.form_container')

  @section('form')

    <form action="/client/create" method="post">
      @csrf

      <input type="text" name="name" value="" placeholder="Tapez ici le nom du client">
      <input type="submit" value="Ajouter le client">

    </form>

  @endsection
