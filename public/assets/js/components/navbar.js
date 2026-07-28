(function () {
        document.querySelectorAll('.navbar .dropdown').forEach(function (dd) {
            var btn = dd.querySelector('.dropbtn');
            if (!btn) return;
            btn.addEventListener('click', function (e) {
                e.stopPropagation();
                var wasOpen = dd.classList.contains('open');
                document.querySelectorAll('.dropdown.open').forEach(function (o) { o.classList.remove('open'); });
                if (!wasOpen) dd.classList.add('open');
            });
        });
        document.addEventListener('click', function () {
            document.querySelectorAll('.dropdown.open').forEach(function (o) { o.classList.remove('open'); });
        });
    })();
