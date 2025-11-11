document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('actor-form');
    if (!form) return;

    const feedback = document.createElement('div');
    feedback.className = 'mt-3';
    form.appendChild(feedback);

    const submitBtn = form.querySelector('button[type="submit"]');

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        feedback.innerHTML = '';
        submitBtn.disabled = true;
        submitBtn.innerText = 'Submitting...';

        const data = {
            email: form.email.value.trim(),
            description: form.description.value.trim()
        };

        try {
            const response = await fetch(form.action, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(data)
            });

            let result = {};
            try {
                result = await response.json();
            } catch {
                result = {};
            }

            if (response.ok) {
                window.location.href = '/actors';
                return;
            }

            const message = result.message || 'Request failed.';
            const details = result.error ? `<br><small>${result.error}</small>` : '';
            feedback.innerHTML = `
                <div class="alert alert-danger" role="alert">
                    ${message}${details}
                </div>
            `;
        } catch (err) {
            console.error(err);
            feedback.innerHTML = `
                <div class="alert alert-warning" role="alert">
                    Network error: could not reach the server.
                </div>
            `;
        } finally {
            submitBtn.disabled = false;
            submitBtn.innerText = 'Submit';
        }
    });
});
