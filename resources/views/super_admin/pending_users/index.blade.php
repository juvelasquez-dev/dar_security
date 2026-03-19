@extends('layouts.app')

@section('content')
<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Pending Users</h3>
  </div>

  @if(session('swal'))
    <script>
      document.addEventListener('DOMContentLoaded', function(){
        Swal.fire(@json(session('swal')));
      });
    </script>
  @endif

  <div class="card">
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-striped mb-0">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Email</th>
              <th>Role</th>
              <th>Registered</th>
              <th class="text-end">Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse($pending as $u)
            <tr>
              <td>{{ $u->id }}</td>
              <td>{{ $u->name }}</td>
              <td>{{ $u->email }}</td>
              <td>{{ $u->role?->name ?? '-' }}</td>
              <td>{{ $u->created_at->diffForHumans() }}</td>
              <td class="text-end">
                <form method="POST" action="{{ route('superadmin.pending.verify', $u) }}" class="d-inline">
                  @csrf
                  <button class="btn btn-sm btn-success" onclick="return confirm('Verify this user?')">Verify</button>
                </form>
              </td>
            </tr>
            @empty
            <tr><td colspan="6" class="text-center">No pending users.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
