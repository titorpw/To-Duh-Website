document.addEventListener("DOMContentLoaded", function () {
    const headers = document.querySelectorAll(".collapsible-header");

    headers.forEach((header) => {
        header.addEventListener("click", function () {
            const content = this.nextElementSibling;
            const icon = this.querySelector(".collapsible-icon");

            if (content && icon) {
                content.classList.toggle("hidden");

                icon.classList.toggle("rotate-180");
            }
        });
    });
});
