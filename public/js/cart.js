document.addEventListener('DOMContentLoaded', function() {

    // -------------------------
    // Quantity change listener
    // -------------------------
    const qtyInputs = document.querySelectorAll('.cart-quantity');

    qtyInputs.forEach(input => {
        input.addEventListener('input', function() {
            const id = this.dataset.id;
            let quantity = parseInt(this.value);
            if (isNaN(quantity) || quantity < 1) quantity = 1;
            this.value = quantity;

            fetch(`/cart/update/${id}`, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ quantity: quantity })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    // Update subtotal
                    document.getElementById(`subtotal-${id}`).textContent = '€' + data.subtotal;
                    // Update total
                    document.getElementById('cartTotal').textContent = '' + data.total;
                }
            })
            .catch(err => console.error(err));
        });
    });

    // -------------------------
    // Add to cart toast (ako koristiš)
    // -------------------------
    const addButtons = document.querySelectorAll('.add-to-cart');

    addButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const url = this.dataset.url;

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
                if (data.success) {
                    showToast(data.dog);
                }
            })
            .catch(err => console.error(err));
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
        toastEl.role = 'alert';
        toastEl.ariaLive = 'assertive';
        toastEl.ariaAtomic = 'true';

        toastEl.innerHTML = `
            <div class="d-flex">
                <img src="/images/${dog.image}" alt="${dog.name}" class="rounded me-2" style="width:50px; height:50px; object-fit:cover;">
                <div class="toast-body d-flex flex-column justify-content-center">
                    <span>${dog.name} added to cart!</span>
                    <a href="/cart" class="text-white fw-bold mt-1">View Cart</a>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        `;

        container.appendChild(toastEl);

        const toast = new bootstrap.Toast(toastEl, { delay: 3000 });
        toast.show();
    }

});
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.remove-item').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.dataset.id;

            fetch(`/cart/remove/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute('content'),
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    // remove row
                    document.getElementById(`cart-row-${id}`).remove();

                    // update total
                    document.getElementById('cartTotal').textContent = data.total;

                    // ako je cart prazan
                    if (document.querySelectorAll('tbody tr').length === 0) {
                        location.reload(); // prikaže "cart is empty"
                    }
                }
            })
            .catch(err => console.error(err));
        });
    });

});
