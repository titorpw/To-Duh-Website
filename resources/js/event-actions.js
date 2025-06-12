document.addEventListener("DOMContentLoaded", function () {
    const upcomingList = document.getElementById("upcoming-events-list");

    if (upcomingList) {
        // Mengambil CSRF token dari meta tag
        const csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content");

        const deleteModal = document.getElementById(
            "delete-confirmation-modal"
        );
        const confirmDeleteBtn = document.getElementById("confirm-delete-btn");
        const cancelDeleteBtn = document.getElementById("cancel-delete-btn");

        let eventToDeleteUrl = null;
        let eventToDeleteElement = null;

        function checkAndDisplayEmptyMessage(listElement, message) {
            setTimeout(() => {
                if (listElement && listElement.children.length === 0) {
                    listElement.innerHTML = `<p class="text-center text-gray-500 py-4">${message}</p>`;
                }
            }, 10);
        }

        document.querySelectorAll(".event-checkbox").forEach((checkbox) => {
            checkbox.addEventListener("click", async function () {
                const url = this.dataset.url;
                const eventItem = this.closest(".event-item");
                const eventDetails = eventItem.querySelector(
                    ".event-details p:first-child"
                );
                const checkIcon = this.querySelector("svg");

                try {
                    const response = await fetch(url, {
                        method: "PATCH",
                        headers: {
                            "X-CSRF-TOKEN": csrfToken,
                            Accept: "application/json",
                        },
                    });

                    if (!response.ok) throw new Error("Request failed.");

                    this.classList.add("bg-teal-500", "border-teal-500");
                    checkIcon.classList.remove("hidden");
                    eventDetails.classList.add("line-through", "text-gray-400");

                    setTimeout(() => {
                        eventItem.style.transition =
                            "opacity 0.5s ease, transform 0.5s ease";
                        eventItem.style.opacity = "0";
                        eventItem.style.transform = "translateX(20px)";
                        setTimeout(() => {
                            eventItem.remove();
                            checkAndDisplayEmptyMessage(
                                upcomingList,
                                "No upcoming events found."
                            );
                        }, 500);
                    }, 1000);
                } catch (error) {
                    console.error("Error completing event:", error);
                }
            });
        });

        document.querySelectorAll(".event-delete-btn").forEach((button) => {
            button.addEventListener("click", function () {
                eventToDeleteUrl = this.dataset.url;
                eventToDeleteElement = this.closest(".event-item");
                if (deleteModal) deleteModal.classList.remove("hidden");
            });
        });

        if (confirmDeleteBtn) {
            confirmDeleteBtn.addEventListener("click", async function () {
                if (!eventToDeleteUrl || !eventToDeleteElement) return;

                try {
                    const response = await fetch(eventToDeleteUrl, {
                        method: "DELETE",
                        headers: {
                            "X-CSRF-TOKEN": csrfToken,
                            Accept: "application/json",
                        },
                    });

                    if (!response.ok) throw new Error("Request failed.");

                    const parentList = eventToDeleteElement.parentElement;
                    eventToDeleteElement.style.transition = "opacity 0.3s ease";
                    eventToDeleteElement.style.opacity = "0";
                    setTimeout(() => {
                        eventToDeleteElement.remove();
                        if (parentList.id === "upcoming-events-list") {
                            checkAndDisplayEmptyMessage(
                                parentList,
                                "No upcoming events found."
                            );
                        } else if (parentList.id === "completed-events-list") {
                            checkAndDisplayEmptyMessage(
                                parentList,
                                "No completed events yet."
                            );
                        }
                    }, 300);

                    if (deleteModal) deleteModal.classList.add("hidden");
                } catch (error) {
                    console.error("Error deleting event:", error);
                    if (deleteModal) deleteModal.classList.add("hidden");
                }

                eventToDeleteUrl = null;
                eventToDeleteElement = null;
            });
        }

        if (cancelDeleteBtn) {
            cancelDeleteBtn.addEventListener("click", function () {
                if (deleteModal) deleteModal.classList.add("hidden");
                eventToDeleteUrl = null;
                eventToDeleteElement = null;
            });
        }
    }
});
