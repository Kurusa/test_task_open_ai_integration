@extends('layouts.app')

@section('title', 'Actors List')

@section('content')
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Actors</h2>
            <a href="{{ route('actors.create') }}" class="btn btn-primary">Add new</a>
        </div>

        @if($actors->isEmpty())
            <div class="alert alert-info text-center">
                No actors have been added yet.
            </div>
        @else
            <div class="table-responsive shadow-sm rounded">
                <table class="table table-striped align-middle mb-0">
                    <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Address</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Height</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($actors as $index => $actor)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $actor->first_name }}</td>
                            <td>{{ $actor->address }}</td>
                            <td>{{ $actor->gender ?? '—' }}</td>
                            <td>{{ $actor->height ?? '—' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
