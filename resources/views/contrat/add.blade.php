@extends('forms.form_container')

@section('form')

<form action="/contrat/create" method="post">
    @csrf

    <input type="hidden" name="projet_id" value="{{$projet_id}}">

    <div>
        <label for="name">Nom du contrat</label>
        <input type="text" id="name" name="name" value="" placeholder="Tapez ici le nom du contrat">
    </div>

    <div>
        <label for="name">Date de début du contrat</label>
        <input type="text" name="start_date" value="" placeholder="jj/mm/aaaa">
    </div>

    <div>
        <p class="label">Sélectionnez le type de contrat&nbsp;:</p>
        <div class="radio-to-buttons">
          <input type="radio" id="type-annuel" name="type" value="annuel"><label for="type-annuel">Annuel</label>
          <input type="radio" id="type-forfait" name="type" value="forfait"><label for="type-forfait">Forfait</label>
        </div>
    </div>

    <div>
        <label for="name">Nombre de minutes consacrées chaque mois aux sauvegardes et mises à jour</label>
        <input type="text" name="minutes_mensuelles" value="0" placeholder="">
    </div>

    <div>
        <label for="name">Si annuel : Date de fin du contrat</label>
        <input type="text" name="end_date" value="" placeholder="jj/mm/aaaa">
    </div>

    <div>
        <label for="name">Si forfait : Nombre d'heures incluses dans le contrat</label>
        <input type="text" name="minutes_in_forfait" value="" placeholder="">
    </div>

    <div>
        <input type="submit" value="Ajouter le contrat">
    </div>

</form>

@endsection
