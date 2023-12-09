@extends('template')

@php
$title = 'Home'
@endphp

@section('content')
    <div id="history"></div>
@stop

@section('js')

<script type="text/javascript">
    var data = "{{ $data }}";
    data = data.replace(/&quot;/g, '"');
    data = JSON.parse(data);
</script>
<script type="text/javascript" src="{{ asset('js/history.js?v=1.0.0') }}"></script>

@stop
