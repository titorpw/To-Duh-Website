document.addEventListener("DOMContentLoaded", function () {
    const menuButton = document.getElementById("user-menu-button");
    const dropdown = document.getElementById("user-menu-dropdown");

    if (menuButton && dropdown) {
        menuButton.addEventListener("click", function (event) {
            event.stopPropagation();
            dropdown.classList.toggle("hidden");
        });

        window.addEventListener("click", function () {
            if (!dropdown.classList.contains("hidden")) {
                dropdown.classList.add("hidden");
            }
        });

        dropdown.addEventListener("click", function (event) {
            event.stopPropagation();
        });
    }
});
