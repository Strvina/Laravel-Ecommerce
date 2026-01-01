// cart-quantity.js
document.addEventListener('DOMContentLoaded', () => {
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
                // ukloni red
                document.getElementById(`cart-row-${id}`)?.remove();

                // update total
                document.getElementById('cartTotal').textContent = data.total;

                // ako je prazno
                if (document.querySelectorAll('tbody tr').length === 0) {
                    location.reload();
                }
            }
        })
        .catch(console.error);
    });
});
});
