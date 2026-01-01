document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.querySelector('input[name="breed"]');
    const gridContainer = document.querySelector('#kuceGrid');

    const fetchResults = debounce(() => {
        const breed = searchInput.value;
        const params = new URLSearchParams({ breed });

        fetch(`/kuces/search?${params.toString()}`, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(res => res.text())
            .then(html => gridContainer.innerHTML = html)
            .catch(console.error);
    }, 300);

    searchInput.addEventListener('input', fetchResults);
});
    