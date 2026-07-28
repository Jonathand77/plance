(function () {
    const data = window.__activityData || {};
    const grid = document.getElementById('calGrid');
    const months = document.getElementById('calMonths');
    const calTotal = document.getElementById('calTotal');

    const total = Object.values(data).reduce((a, b) => a + b, 0);
    calTotal.textContent = total + ' actividad' + (total !== 1 ? 'es' : '') + ' en el último año';

    const today = new Date();
    const end = new Date(today);
    const start = new Date(today);
    start.setDate(start.getDate() - 364);
    start.setDate(start.getDate() - start.getDay());

    const MONTHS = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];

    function toKey(d) {
        return d.getFullYear() + '-' +
            String(d.getMonth() + 1).padStart(2, '0') + '-' +
            String(d.getDate()).padStart(2, '0');
    }

    function getLevel(cnt) {
        if (!cnt) return 0;
        if (cnt === 1) return 1;
        if (cnt === 2) return 2;
        if (cnt <= 4) return 3;
        return 4;
    }

    let monthLabels = [];
    let lastMonth = -1;
    let colIndex = 0;

    const cur = new Date(start);
    while (cur <= end) {
        const col = document.createElement('div');
        col.className = 'cal-col';

        const m = cur.getMonth();
        if (m !== lastMonth) {
            monthLabels.push({ col: colIndex, label: MONTHS[m] });
            lastMonth = m;
        }

        for (let d = 0; d < 7; d++) {
            const cell = document.createElement('div');

            if (cur > end) {
                cell.className = 'cal-cell empty';
            } else {
                const key = toKey(cur);
                const cnt = data[key] || 0;
                const level = getLevel(cnt);
                cell.className = 'cal-cell' + (level ? ' level-' + level : '');

                const label = cnt
                    ? cnt + ' actividad' + (cnt > 1 ? 'es' : '') + ' — ' + key
                    : 'Sin actividad — ' + key;
                cell.title = label;
            }

            col.appendChild(cell);
            cur.setDate(cur.getDate() + 1);
        }

        grid.appendChild(col);
        colIndex++;
    }

    const colW = 16;
    let lastLabelRight = -999;
    monthLabels.forEach(({ col, label }) => {
        const left = col * colW;
        if (left - lastLabelRight < 28) return;
        const span = document.createElement('div');
        span.className = 'cal-month-label';
        span.style.width = '28px';
        span.textContent = label;
        months.appendChild(span);
        lastLabelRight = left + 28;
    });
})();
