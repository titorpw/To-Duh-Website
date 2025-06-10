document.addEventListener("DOMContentLoaded", function () {
    const searchForm = document.getElementById("search-form");
    const searchInput = document.getElementById("main_search");

    if (searchForm && searchInput) {
        const dashboardUrl = searchForm.dataset.baseUrl;
        let initialSearchValue = searchInput.value;

        searchInput.addEventListener("input", function (event) {
            const currentSearchValue = event.target.value;

            if (initialSearchValue !== "" && currentSearchValue === "") {
                window.location.href = dashboardUrl;
            }
        });
    }
});
