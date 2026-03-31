@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="row g-3">
    @foreach($kpis as $label => $value)
        <div class="col-md-3"><div class="card shadow-sm rounded-4"><div class="card-body"><small>{{ str($label)->replace('_', ' ')->title() }}</small><h4>{{ $value }}</h4></div></div></div>
    @endforeach
</div>
<div class="card mt-4 shadow-sm rounded-4"><div class="card-body"><canvas id="campaignChart" height="100"></canvas></div></div>
<script>
new Chart(document.getElementById('campaignChart'), {type:'line',data:{labels:['Mon','Tue','Wed','Thu','Fri'],datasets:[{label:'Emails Sent',data:[12,19,7,23,18]}]}})
</script>
@endsection
