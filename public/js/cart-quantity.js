document.addEventListener('DOMContentLoaded', function () {
    // Quantity update
    document.querySelectorAll('.cart-quantity').forEach(input => {
        input.addEventListener('input', function () {
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
                body: JSON.stringify({ quantity })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    document.getElementById(`subtotal-${id}`).textContent = `€${data.subtotal}`;
                    document.getElementById('cartTotal').textContent = data.total;
                }
            })
            .catch(console.error);
        });
    });
});
