@extends('forms.form_container')

@section('form')

<form action="/intervention/create" method="post">
    @csrf

    <input type="hidden" name="contrat_id" value="{{$contrat_id}}">

    <div>
        <label for="name">Date de l'intervention</label>
        <input type="text" name="date" value="" placeholder="jj/mm/aaaa">
    </div>

    <div>
        <label for="name">Durée de l'intervention (en minutes)</label>
        <input type="text" name="minutes_spent" value="" placeholder="">
    </div>

    <div>
        <label for="name">Description</label>
        <textarea name="description" rows="8" cols="80" placeholder="Décrivez ici brièvement l'intervention"></textarea>
    </div>

    <div>
        <p>S'agit-il d'une intervetion pro bono&nbsp;?</p>
        <input type="radio" id="probono_non" name="type" value="0"><label for="probono_non">Non</label>
        <input type="radio" id="probono_oui" name="type" value="1"><label for="probono_oui">Oui</label>
    </div>

    <div>
        <input type="submit" value="Créer l'intervention">
    </div>

</form>

@endsection
