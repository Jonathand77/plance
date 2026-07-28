function toggleOpciones() {
            const menu = document.getElementById('opcionesMenu');
            const chevron = document.getElementById('chevron');
            menu.classList.toggle('show');
            chevron.className = menu.classList.contains('show')
                ? 'bi bi-chevron-up' : 'bi bi-chevron-down';
        }

        // Cerrar menú si click fuera
        document.addEventListener('click', function (e) {
            if (!e.target.closest('.opciones-wrap')) {
                document.getElementById('opcionesMenu').classList.remove('show');
                document.getElementById('chevron').className = 'bi bi-chevron-down';
            }
        });

        function imprimirComprobante() {
            window.print();
        }

        function cartaReverso() {
            document.getElementById('modalCarta').style.display = 'flex';
            document.getElementById('opcionesMenu').classList.remove('show');
        }

        function confirmarReverso(id, tipo) {
            document.getElementById('opcionesMenu').classList.remove('show');
            if (confirm('⚠️ ¿Estás seguro de reversar esta transacción?\n\nEsta acción devolverá el dinero al cliente y no se puede deshacer.')) {
                window.location.href = '../php/procesar_reverso.php?id=' + id + '&tipo=' + tipo;
            }
        }

        // Cerrar modal con ESC
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                document.getElementById('modalCarta').style.display = 'none';
            }
        });
