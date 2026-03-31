@extends('layouts.app')
@section('title', 'Campaigns')
@section('content')
<table class="table table-hover bg-white">
<thead><tr><th>Name</th><th>Status</th><th>Type</th><th>Scheduled</th></tr></thead>
<tbody>@foreach($campaigns as $campaign)<tr><td>{{ $campaign->name }}</td><td>{{ $campaign->status }}</td><td>{{ $campaign->type }}</td><td>{{ $campaign->scheduled_at }}</td></tr>@endforeach</tbody>
</table>
{{ $campaigns->links() }}
@endsection
