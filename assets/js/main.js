document.addEventListener('DOMContentLoaded', () => {
    const themeToggle = document.querySelector('[data-theme-toggle]');
    const savedTheme = localStorage.getItem('svu-theme');

    if (savedTheme === 'dark') document.documentElement.dataset.theme = 'dark';
    themeToggle?.addEventListener('click', () => {
        const isDark = document.documentElement.dataset.theme !== 'dark';
        document.documentElement.dataset.theme = isDark ? 'dark' : 'light';
        localStorage.setItem('svu-theme', isDark ? 'dark' : 'light');
    });

    const search = document.querySelector('[data-event-search]');
    const category = document.querySelector('[data-event-category]');
    const date = document.querySelector('[data-event-date]');
    const cards = [...document.querySelectorAll('[data-event-card]')];
    const emptyState = document.querySelector('[data-empty-state]');

    function filterEvents() {
        const query = (search?.value || '').trim().toLocaleLowerCase();
        const selectedCategory = category?.value || '';
        const selectedDate = date?.value || '';
        let visible = 0;

        cards.forEach((card) => {
            const matchesQuery = !query || card.dataset.search.includes(query);
            const matchesCategory = !selectedCategory || card.dataset.category === selectedCategory;
            const matchesDate = !selectedDate || card.dataset.date === selectedDate;
            const show = matchesQuery && matchesCategory && matchesDate;
            card.hidden = !show;
            if (show) visible += 1;
        });

        if (emptyState) emptyState.hidden = visible > 0;
    }

    [search, category, date].forEach((control) => {
        control?.addEventListener(control === search ? 'input' : 'change', filterEvents);
    });
    filterEvents();

    const contactForm = document.querySelector('[data-contact-form]');
    contactForm?.addEventListener('submit', (event) => {
        if (!contactForm.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }
        contactForm.classList.add('was-validated');
    });

    document.querySelectorAll('[data-share-event]').forEach((button) => {
        button.addEventListener('click', async () => {
            const shareData = { title: button.dataset.title, url: window.location.href };
            try {
                if (navigator.share) await navigator.share(shareData);
                else {
                    await navigator.clipboard.writeText(window.location.href);
                    button.textContent = 'تم نسخ الرابط';
                    window.setTimeout(() => { button.textContent = 'شارك الفعالية'; }, 1800);
                }
            } catch (error) {
                if (error.name !== 'AbortError') window.prompt('انسخ رابط الفعالية:', window.location.href);
            }
        });
    });

    document.querySelectorAll('[data-calendar-event]').forEach((button) => {
        button.addEventListener('click', () => {
            const eventInfo = JSON.parse(button.dataset.calendarEvent);
            const start = eventInfo.date.replaceAll('-', '');
            const endDate = new Date(`${eventInfo.date}T00:00:00`);
            endDate.setDate(endDate.getDate() + 1);
            const end = [endDate.getFullYear(), String(endDate.getMonth() + 1).padStart(2, '0'), String(endDate.getDate()).padStart(2, '0')].join('');
            const escapeIcs = (value) => value.replaceAll('\\', '\\\\').replaceAll(',', '\\,').replaceAll(';', '\\;').replaceAll('\n', '\\n');
            const ics = ['BEGIN:VCALENDAR', 'VERSION:2.0', 'PRODID:-//SVU Events//AR', 'BEGIN:VEVENT', `DTSTART;VALUE=DATE:${start}`, `DTEND;VALUE=DATE:${end}`, `SUMMARY:${escapeIcs(eventInfo.title)}`, `LOCATION:${escapeIcs(eventInfo.location)}`, `DESCRIPTION:${escapeIcs(eventInfo.description)}`, 'END:VEVENT', 'END:VCALENDAR'].join('\r\n');
            const link = document.createElement('a');
            link.href = URL.createObjectURL(new Blob([ics], { type: 'text/calendar;charset=utf-8' }));
            link.download = 'svu-event.ics';
            link.click();
            URL.revokeObjectURL(link.href);
        });
    });
});