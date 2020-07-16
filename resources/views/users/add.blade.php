@extends('forms.form_container')

  @section('form')

    <form action="/users/create" method="post">
      @csrf

      <div>
        <label for="first_name">Prénom</label>
        <input type="text" name="first_name" id="first_name" value="">
      </div>

      <div>
        <label for="last_name">Nom</label>
        <input type="text" name="last_name" id="last_name" value="">
      </div>

      <div>
        <label for="team">Équipe</label>
        <select name="team" id="team">
          <option value="web" {{($team == 'web') ? 'selected' : '' }}>Web</option>
          <option value="cec" {{($team == 'cec') ? 'selected' : '' }}>Chef de projet</option>
          <option value="consultant" {{($team == 'consultant') ? 'selected' : '' }}>Consultant</option>
        </select>
      </div>

      <div>
        <label for="email">Email</label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}" required autocomplete="email">
      </div>

      <div>
          <label for="password">Mot de passe</label>
          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" required autocomplete="new-password">
      </div>

      <input type="submit" value="Ajouter le projet">

    </form>

  @endsection
