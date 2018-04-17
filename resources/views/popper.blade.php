@extends('layouts.app')

@section('css')

@stop

@section('content')

<button class="btn btn-primary" id="button-a">A</button>

<div id="myTemplate" style="display: none;">
  <h3 size=2>Cool <span style="color: pink;">HTML</span> inside here!</h3>
</div>
@stop

@section('js')

<script type="text/javascript">
tippy('#button-a', {
  html: '#myTemplate',
  livePlacement: true,
  placement: 'right',
  size: 'large'
});
</script>

@stop