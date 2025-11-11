<form id="actor-form" action="{{ route('api.actors.store') }}" method="POST" novalidate>
    @csrf
    <div class="mb-4">
        <label for="email" class="form-label fw-semibold">Email address</label>
        <input
            type="email"
            id="email"
            name="email"
            class="form-control form-control-lg rounded-3"
            placeholder="example@email.com"
            required
        >
    </div>

    <div class="mb-4">
        <label for="description" class="form-label fw-semibold">Actor description</label>
        <textarea
            id="description"
            name="description"
            class="form-control form-control-lg rounded-3"
            rows="4"
            placeholder="Describe the actor..."
            required
        ></textarea>
        <div class="form-text">
            Please include first name, last name, and address in your description.
        </div>
    </div>

    <div class="d-grid">
        <button type="submit" class="btn btn-primary btn-lg rounded-3 py-2">
            <span class="spinner-border spinner-border-sm me-2 d-none" role="status" aria-hidden="true"></span>
            Submit
        </button>
    </div>
</form>
