@extends('layouts.app')
@section('title', 'Contacts')
@section('content')
<div class="d-flex justify-content-between mb-3">
    <form method="GET" class="d-flex gap-2"><input name="search" class="form-control" placeholder="Search email"><button class="btn btn-primary">Search</button></form>
    <a class="btn btn-outline-success" href="{{ route('contacts.export') }}">Export CSV</a>
</div>
<table class="table table-striped bg-white rounded-4 overflow-hidden">
<thead><tr><th>Name</th><th>Email</th><th>Status</th></tr></thead>
<tbody>@forelse($contacts as $contact)<tr><td>{{ $contact->first_name }} {{ $contact->last_name }}</td><td>{{ $contact->email }}</td><td>{{ $contact->status }}</td></tr>@empty<tr><td colspan="3">No contacts yet.</td></tr>@endforelse</tbody>
</table>
{{ $contacts->links() }}
@endsection
