document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('filterForm');
    const grid = document.getElementById('kuceGrid');

    function loadResults(url, push = true) {
        fetch(url, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
            .then(res => res.text())
            .then(html => {
                // ubaci samo grid
                document.getElementById('kuceGrid').innerHTML = html;
                if (push) history.pushState({}, '', url);
            })
            .catch(console.error);
    }


    const fetchResults = debounce(() => {
        const params = new URLSearchParams(new FormData(form));
        params.delete('page'); // reset pagination
        const url = `/kuces/filter?${params.toString()}`;
        loadResults(url);
    }, 300);

    form.addEventListener('input', fetchResults);
    form.addEventListener('change', fetchResults);

    // sprečavanje default submit
    form.addEventListener('submit', e => {
        e.preventDefault();
        fetchResults();
    });

    // AJAX paginacija
    grid.addEventListener('click', e => {
        const link = e.target.closest('.pagination a');
        if (!link) return;
        e.preventDefault();
        loadResults(link.href);
    });

    // BACK / FORWARD
    window.addEventListener('popstate', () => {
        loadResults(window.location.href, false);
    });

    // RESET dugme
    const resetBtn = document.getElementById('resetFilters');
    if (resetBtn) {
        resetBtn.addEventListener('click', () => {
            form.reset();
            fetchResults();
        });
    }
});
