{{-- Bouton de modification --}}
<a class="modifier reveal_on_hover" data-fancybox data-type="ajax" data-src="{{route('ajax_edit_'.$item->type,[$item->modelName.'_id' => $item->id])}}" href="javascript:;" title="Modifier le {{$item->modelName}}">[Modifier]</a>
