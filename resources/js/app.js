import "./bootstrap";
import "flatpickr/dist/flatpickr.min.css";
import flatpickr from "flatpickr";
import "./password-toggle.js";
import "./dashboard-collapsible.js";
import "./user-menu-dropdown.js";
import "./category-filter.js";
import "./search-reset.js";
import "./event-actions.js";
import "./calendar-setup.js";

document.addEventListener("DOMContentLoaded", () => {
    flatpickr(".time-picker", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: false,
    });
});

document.addEventListener("DOMContentLoaded", () => {
    flatpickr(".time-picker", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: false,
    });

    flatpickr(".date-picker", {
        dateFormat: "Y-m-d",
    });
});

document.addEventListener("DOMContentLoaded", () => {
    const dropdown = document.getElementById("category-dropdown");

    if (dropdown) {
        const dropdownButton = document.getElementById(
            "category-dropdown-button"
        );
        const dropdownPanel = document.getElementById(
            "category-dropdown-panel"
        );
        const hiddenInput = document.getElementById("category_id");
        const selectedText = document.getElementById("category-selected-text");
        const arrowIcon = document.getElementById("category-arrow");

        const closeDropdown = () => {
            dropdownPanel.classList.add("hidden");
            arrowIcon.style.transform = "rotate(0deg)";
        };

        const initialValue = hiddenInput.value;
        if (initialValue) {
            const initialOption = dropdownPanel.querySelector(
                `div[data-value="${initialValue}"]`
            );
            if (initialOption) {
                selectedText.textContent = initialOption.dataset.text;
            }
        }

        dropdownButton.addEventListener("click", (e) => {
            e.stopPropagation();
            const isHidden = dropdownPanel.classList.toggle("hidden");

            if (!isHidden) {
                arrowIcon.style.transform =
                    "rotate(180deg) translateY(-1px)  translateX(15px)";
            } else {
                arrowIcon.style.transform = "rotate(0deg)";
            }
        });

        dropdownPanel.querySelectorAll("div[data-value]").forEach((option) => {
            option.addEventListener("click", () => {
                selectedText.textContent = option.dataset.text;
                hiddenInput.value = option.dataset.value;
                closeDropdown();
            });
        });

        document.addEventListener("click", () => {
            if (!dropdownPanel.classList.contains("hidden")) {
                closeDropdown();
            }
        });
    }
});
