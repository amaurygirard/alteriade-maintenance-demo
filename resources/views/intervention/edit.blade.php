@extends('forms.form_container')

@section('form')

<form action="/intervention/{{$intervention_id}}/edit" method="post">
    @csrf
    @method('PATCH')

    {{-- <input type="hidden" name="contrat_id" value="{{$contrat_id}}"> --}}

    @php
      $date_intervention = \DateTime::createFromFormat('Y-m-d H:i:s',$intervention->date);
    @endphp
    <div>
        <label for="date">Date de l'intervention</label>
        <input type="text" name="date" id="date" value="{{$date_intervention->format('d/m/Y')}}" placeholder="jj/mm/aaaa">
    </div>

    <div>
        <label for="minutes_spent">Durée de l'intervention (en minutes)</label>
        <input type="text" name="minutes_spent" id="minutes_spent" value="{{$intervention->minutes_spent}}" placeholder="">
    </div>

    <div>
        <label for="description">Description</label>
        <textarea name="description" id="description" rows="8" cols="80" placeholder="Décrivez ici brièvement l'intervention">{{$intervention->description}}</textarea>
    </div>

    <div>
        <p class="label">S'agit-il d'une intervention pro bono&nbsp;?</p>
        <div class="radio-to-buttons">
          <input type="radio" id="probono_non" name="is_probono" value="0" @if(!$intervention->is_probono) checked="checked" @endif><label for="probono_non">Non</label>
          <input type="radio" id="probono_oui" name="is_probono" value="1" @if($intervention->is_probono) checked="checked" @endif><label for="probono_oui">Oui</label>
        </div>
    </div>

    <div>
      <label for="type">Sélectionnez un type d'intervention</label>
      <select name="type" id="type">
        @foreach([
          'correctif' => "Correction de bug",
          'update' => "Mise à jour",
          'sauvegarde' => "Sauvegarde",
          'minor_change' => "Modification mineure",
          'assistance' => "Assitance",
          'new_feature' => "Ajout de fonctionnalité",
          'autre' => "Autre",
        ] as $key => $value)
          <option value="{{$key}}"@if($intervention->type == $key) selected="selected"@endif>{{$value}}</option>
        @endforeach
      </select>
    </div>

    <div>
      <p class="label">Qui a réalisé cette intervention&nbsp;?</p>

      @foreach ($usermetas as $u)
        <input type="checkbox" name="users[]" id="users-{{$u->user_id}}" value="{{$u->user_id}}"@if($intervention->users->contains($u->user_id)) checked="checked"@endif><label for="users-{{$u->user_id}}">{{$u->first_name}} {{$u->last_name}}</label>
        <div class="clear"></div>
      @endforeach

    </div>

    <div>
        <input type="submit" value="Enregistrer les modifications">
    </div>

</form>

@endsection
