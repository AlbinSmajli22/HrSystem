document.addEventListener("DOMContentLoaded", () => {
  const calendar = document.querySelector(".Calendar");
  if (!calendar) return;

  const errorMessage = calendar.querySelector(".calendar-error");

  calendar.addEventListener("click", async (event) => {
    if (!(event.target instanceof Element)) return;
    const button = event.target.closest(".bck, .forward, .calendar-today");
    if (!button || !calendar.contains(button)) return;

    const currentDate = calendar.querySelector(".currentDate");
    const date = new Date(
      Number(currentDate.dataset.year),
      Number(currentDate.dataset.month) - 1,
      1
    );
    const isToday = button.classList.contains("calendar-today");
    if (!isToday) {
      date.setMonth(date.getMonth() + (button.classList.contains("bck") ? -1 : 1));
    }

    const requestUrl = new URL("calendarFragment.php", window.location.href);
    if (!isToday) {
      requestUrl.searchParams.set("month", date.getMonth() + 1);
      requestUrl.searchParams.set("year", date.getFullYear());
    }

    const dashboardUrl = new URL(window.location.href);
    if (isToday) {
      dashboardUrl.searchParams.delete("month");
      dashboardUrl.searchParams.delete("year");
    } else {
      dashboardUrl.searchParams.set("month", date.getMonth() + 1);
      dashboardUrl.searchParams.set("year", date.getFullYear());
    }

    calendar.querySelectorAll("button").forEach((control) => {
      control.disabled = true;
    });
    errorMessage.hidden = true;

    try {
      const response = await fetch(requestUrl, {
        headers: { "X-Requested-With": "XMLHttpRequest" },
      });
      if (!response.ok) {
        throw new Error(`Calendar request failed with status ${response.status}`);
      }

      const markup = await response.text();
      const nextCalendarBody = new DOMParser()
        .parseFromString(markup, "text/html")
        .querySelector(".calendarBody");
      const currentCalendarBody = calendar.querySelector(".calendarBody");
      if (!nextCalendarBody || !currentCalendarBody) {
        throw new Error("Calendar response did not contain a calendar body");
      }

      currentCalendarBody.replaceWith(nextCalendarBody);
      window.history.replaceState(null, "", dashboardUrl);
    } catch (error) {
      errorMessage.textContent = "The calendar could not be updated. Please try again.";
      errorMessage.hidden = false;
      console.error(error);
    } finally {
      calendar.querySelectorAll("button").forEach((control) => {
        control.disabled = false;
      });
    }
  });
});
