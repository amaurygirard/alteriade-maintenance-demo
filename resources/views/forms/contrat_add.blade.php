@extends('forms.form_container')

@section('form')

<form action="/contrat/create" method="post">
    @csrf

    <input type="hidden" name="projet_id" value="{{$projet_id}}">

    <div class="">
        <label for="name">Nom du contrat</label>
        <input type="text" id="name" name="name" value="" placeholder="Tapez ici le nom du contrat">
    </div>

    <div>
        <p>Sélectionnez le type de contrat&nbsp;:</p>
        <input type="radio" id="type-annuel" name="type" value="annuel"><label for="type">Annuel</label>
        <input type="radio" id="type-forfait" name="type" value="forfait"><label for="type">Forfait</label>
    </div>

    <div>
        <label for="name">Date de début du contrat</label>
        <input type="text" name="start_date" value="" placeholder="jj/mm/aaaa">
    </div>

    <div>
        <label for="name">Date de fin du contrat (si annuel)</label>
        <input type="text" name="end_date" value="" placeholder="jj/mm/aaaa">
    </div>

    <div>
        <label for="name">Nombre d'heures incluses dans le contrat (si forfait)</label>
        <input type="text" name="minutes_in_forfait" value="" placeholder="">
    </div>

    <div>
        <input type="submit" value="Ajouter le contrat">
    </div>

</form>

@endsection