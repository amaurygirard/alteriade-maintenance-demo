<div class="bloc_tags">
  @foreach ($users as $usr)
    @component('components.tag_user',['usr' => $usr])
    @endcomponent
  @endforeach
</div>
