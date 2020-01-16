@extends('forms.form_container')

@section('form')

<form action="/contrat/{{$contrat->id}}/edit" method="post">
    @csrf
    @method('PATCH')

    <div>
        <label for="name">Nom du contrat</label>
        <input type="text" id="name" name="name" value="{{$contrat->name}}" placeholder="Tapez ici le nom du contrat">
    </div>

    @php
      /*
       * Date de début du contrat
       */
      $start_date = \DateTime::createFromFormat("Y-m-d H:i:s", $contrat->start_date);

    @endphp
    <div>
        <label for="name">Date de début du contrat</label>
        <input type="text" name="start_date" value="{{$start_date->format('d/m/Y')}}" placeholder="jj/mm/aaaa">
    </div>

    <div>
        <p class="label">Sélectionnez le type de contrat&nbsp;:</p>
        <div class="radio-to-buttons">
          <input type="radio" id="type-annuel" name="type" value="annuel"@if($contrat->type == "annuel") checked="checked"@endif><label for="type-annuel">Annuel</label>
          <input type="radio" id="type-forfait" name="type" value="forfait"@if($contrat->type == "forfait") checked="checked"@endif><label for="type-forfait">Forfait</label>
        </div>
    </div>

    <div>
        <label for="name">Nombre de minutes consacrées chaque mois aux sauvegardes et mises à jour</label>
        <input type="text" name="minutes_mensuelles" value="{{$contrat->minutes_mensuelles}}" placeholder="">
    </div>

    @php
      /*
       * Date de début du contrat
       */
      $end_date = ($contrat->end_date) ? \DateTime::createFromFormat("Y-m-d H:i:s", $contrat->end_date)->format('d/m/Y') : null;

    @endphp
    <div>
        <label for="name">Si annuel : Date de fin du contrat</label>
        <input type="text" name="end_date" value="{{$end_date}}" placeholder="jj/mm/aaaa">
    </div>

    <div>
        <label for="name">Si forfait : Nombre d'heures incluses dans le contrat</label>
        <input type="text" name="minutes_in_forfait" value="{{($contrat->minutes_in_forfait / 60)}}" placeholder="">
    </div>

    <div>
        <input type="submit" value="Enregistrer les modifications">
    </div>

</form>

@endsection
