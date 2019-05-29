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
        <input type="radio" id="probono_non" name="is_probono" value="0"><label for="probono_non">Non</label>
        <input type="radio" id="probono_oui" name="is_probono" value="1"><label for="probono_oui">Oui</label>
    </div>

    <div>
      <p>Sélectionnez un type d'intervention</p>
      <select name="type">
        <option value="correctif">Correction de bug</option>
        <option value="update">Mise à jour</option>
        <option value="sauvegarde">Sauvegarde</option>
        <option value="minor_change">Modification mineure</option>
        <option value="assistance">Assitance</option>
        <option value="new_feature">Ajout de fonctionnalité</option>
        <option value="autre">Autre</option>
      </select>
    </div>

    <div>
      <p>Qui a réalisé cette intervention&nbsp;?</p>

      @foreach ($teamMembers as $teamMember)
        <input type="checkbox" name="teammembers[]" id="teammembers-{{$teamMember->id}}" value="{{$teamMember->id}}"><label for="teammembers-{{$teamMember->id}}">{{$teamMember->first_name}} {{$teamMember->last_name}}</label>
      @endforeach

    </div>

    <div>
        <input type="submit" value="Créer l'intervention">
    </div>

</form>

@endsection
