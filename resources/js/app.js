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
import './confetti.min.js';

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

if (window.IS_BIRTHDAY) {
    document.addEventListener("DOMContentLoaded", () => {
        for (let i = 0; i < 5; i++) {
            setTimeout(() => {
                confetti({
                    particleCount: 150,
                    spread: 200,
                    startVelocity: 40,
                    origin: {
                        x: Math.random(),
                        y: Math.random() * 0.5
                    },
                    ticks: 300
                });
            }, i * 500);
        }

        const overlay = document.createElement("div");
        overlay.style.cssText = `
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999998;
        `;

        const bigMessage = document.createElement("div");
        bigMessage.innerHTML = `
            <div style="
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background: #fff8b3;
                padding: 30px 50px;
                border-radius: 50px;
                z-index: 999999;
                text-align: center;
                color: #0C3D4A;
                font-size: 36px;
                font-weight: bold;
                box-shadow: 0 10px 30px rgba(0,0,0,0.3);
                font-family: 'Poppins', sans-serif;
            ">
                🎉 Happy Birthday, ${window.USER_FIRST_NAME} 🎂
                <div style="
                    font-size: 18px;
                    font-weight: normal;
                    margin-top: 12px;
                ">
                    All the best wishes for you!
                </div>    
            </div>
        `;

        document.body.appendChild(overlay);
        document.body.appendChild(bigMessage);

        setTimeout(() => {
            overlay.remove();
            bigMessage.remove();
        }, 4000);
    });
}

