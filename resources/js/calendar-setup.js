document.addEventListener("DOMContentLoaded", function () {
    const calendarEl = document.getElementById("calendar");

    if (!calendarEl) {
        return;
    }

    const calTitle = document.getElementById("cal-title");
    const prevBtn = document.getElementById("cal-prev");
    const nextBtn = document.getElementById("cal-next");
    const todayBtn = document.getElementById("cal-today");

    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: "dayGridMonth",
        headerToolbar: false,
        events: "/api/events",

        datesSet: function (info) {
            if (calTitle) {
                calTitle.textContent = info.view.title;
            }
        },
    });

    calendar.render();

    if (prevBtn) prevBtn.addEventListener("click", () => calendar.prev());
    if (nextBtn) nextBtn.addEventListener("click", () => calendar.next());
    if (todayBtn) todayBtn.addEventListener("click", () => calendar.today());
});
