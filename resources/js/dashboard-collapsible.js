document.addEventListener("DOMContentLoaded", function () {
    const headers = document.querySelectorAll(".collapsible-header");

    headers.forEach((header) => {
        header.addEventListener("click", function () {
            const content = this.nextElementSibling;

            if (content) {
                content.classList.toggle("hidden");
            }

            this.classList.toggle("open");
        });
    });
});
