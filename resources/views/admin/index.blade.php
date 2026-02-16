@extends('contact-form::layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('Contact Submissions') }}</span>
                    <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger">Logout</button>
                    </form>
                </div>

                <div class="card-body">
                    <form method="GET" action="{{ route('admin.contact-submissions') }}" class="mb-4">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" name="user_name" class="form-control" placeholder="Filter by Name" value="{{ request('user_name') }}">
                            </div>
                            <div class="col-md-4">
                                <input type="date" name="date" class="form-control" placeholder="Filter by Date" value="{{ request('date') }}">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <a href="{{ route('admin.contact-submissions') }}" class="btn btn-secondary">Reset</a>
                            </div>
                        </div>
                    </form>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Submitted At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($submissions as $submission)
                            <tr>
                                <td>{{ $submission->id }}</td>
                                <td>{{ $submission->name }}</td>
                                <td>{{ $submission->email }}</td>
                                <td>{{ $submission->subject }}</td>
                                <td>{{ $submission->created_at->format('Y-m-d H:i') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">No submissions found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{ $submissions->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
