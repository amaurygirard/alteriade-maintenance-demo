<div class="bloc_tags">
  @foreach ($teamMembers as $tm)
    @component('components.tag_teammember',['tm' => $tm])
    @endcomponent
  @endforeach
</div>
