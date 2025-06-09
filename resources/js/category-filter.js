document.addEventListener("DOMContentLoaded", function () {
    const categoryPills = document.querySelectorAll(".category-pill");

    if (categoryPills.length > 0) {
        categoryPills.forEach((pill) => {
            pill.addEventListener("click", function () {
                categoryPills.forEach((p) => {
                    p.classList.remove("active", "bg-[#22ACB1]", "text-white");
                    p.classList.add("bg-gray-200", "text-gray-700");
                });

                this.classList.add("active", "bg-[#22ACB1]", "text-white");
                this.classList.remove("bg-gray-200", "text-gray-700");

                const selectedCategory = this.textContent;
                console.log("Filter events by:", selectedCategory);
            });
        });
    }
});
