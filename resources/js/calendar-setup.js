document.addEventListener("DOMContentLoaded", function () {
    const calendarEl = document.getElementById("calendar");

    if (!calendarEl) {
        return;
    }

    const calTitle = document.getElementById("cal-title");
    const prevBtn = document.getElementById("cal-prev");
    const nextBtn = document.getElementById("cal-next");
    const todayBtn = document.getElementById("cal-today");

    const calendarOptions = {
        initialView: "dayGridMonth",
        headerToolbar: false,
        events: "/api/events",
        timeZone: "local",

        eventContent: function (arg) {
            let timeHtml = "";
            if (arg.event.start) {
                const eventDate = arg.event.start;

                const baseTime = new Intl.DateTimeFormat("en-US", {
                    hour: "numeric",
                    minute: "2-digit",
                    hour12: true,
                }).format(eventDate);

                const customTime = baseTime.replace(":", ".").toLowerCase();

                timeHtml = `<span class="block text-xs">${customTime}</span>`;
            }

            const titleHtml = `<div class="whitespace-normal break-words font-semibold">${arg.event.title}</div>`;

            return { html: `<div class="p-1">${timeHtml}${titleHtml}</div>` };
        },

        datesSet: function (info) {
            if (calTitle) {
                calTitle.textContent = info.view.title;
            }
        },
    };

    const calendar = new FullCalendar.Calendar(calendarEl, calendarOptions);

    calendar.render();

    if (prevBtn) prevBtn.addEventListener("click", () => calendar.prev());
    if (nextBtn) nextBtn.addEventListener("click", () => calendar.next());
    if (todayBtn) todayBtn.addEventListener("click", () => calendar.today());
});
