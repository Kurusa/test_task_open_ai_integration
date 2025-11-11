@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card border-0 shadow-lg rounded-4">
                    <div class="card-body p-5">
                        <h2 class="text-center mb-3 fw-bold text-primary">Add new actor</h2>
                        <p class="text-center text-muted mb-5">
                            Provide actor details to extract information using AI.
                        </p>

                        @include('actors.partials.form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/actors/create.js') }}"></script>
@endpush
