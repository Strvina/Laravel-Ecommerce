document.addEventListener('DOMContentLoaded', () => {

    // delegiramo na document da pokrije sva buduća dugmad
    document.addEventListener('click', function(e) {
        const btn = e.target.closest('.add-to-cart');
        if (!btn) return;

        e.preventDefault();
        if (btn.disabled) return;

        btn.disabled = true;
        btn.classList.add('disabled');

        const url = btn.dataset.url;

        fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) showToast(data.dog);
        })
        .catch(console.error)
        .finally(() => {
            btn.disabled = false;
            btn.classList.remove('disabled');
        });
    });

    function showToast(dog) {
        let container = document.getElementById('cartToastContainer');
        if (!container) {
            container = document.createElement('div');
            container.id = 'cartToastContainer';
            container.className = 'position-fixed bottom-0 end-0 p-3';
            container.style.zIndex = '1080';
            document.body.appendChild(container);
        }

        const toastEl = document.createElement('div');
        toastEl.className = 'toast align-items-center text-white bg-success border-0 mb-2';
        toastEl.innerHTML = `
            <div class="d-flex">
                <img src="/images/${dog.image}" class="rounded me-2" width="50">
                <div class="toast-body">
                    ${dog.name} added to cart!
                    <br>
                    <a href="/cart" class="text-white fw-bold">View cart</a>
                </div>
                <button class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        `;
        container.appendChild(toastEl);
        new bootstrap.Toast(toastEl, { delay: 7000 }).show();
    }
});
