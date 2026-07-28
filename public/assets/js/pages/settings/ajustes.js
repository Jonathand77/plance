const sidebarLinks = document.querySelectorAll('.sidebar-link');

        sidebarLinks.forEach(link => {
            link.addEventListener('click', function () {
                sidebarLinks.forEach(item => item.classList.remove('active'));
                this.classList.add('active');
            });
        });

        window.addEventListener('scroll', () => {
            const cuenta = document.getElementById('mi-cuenta');
            const configuracion = document.getElementById('configuracion');

            const cuentaTop = cuenta.getBoundingClientRect().top;
            const configTop = configuracion.getBoundingClientRect().top;

            sidebarLinks.forEach(item => item.classList.remove('active'));

            if (configTop <= 140) {
                sidebarLinks[1].classList.add('active');
            } else {
                sidebarLinks[0].classList.add('active');
            }
        });
