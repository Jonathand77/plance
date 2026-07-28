let estadoActual = 'aprobada';

        const razonesPorEstado = {
            aprobada: ['APPROVED_TRANSACTION (00)'],
            pendiente: ['PENDING_TRANSACTION (?-)', 'PENDING_VALIDATION (?V)'],
            rechazada: ['CANCELLED_TRANSACTION (?C)', 'FAILED_TRANSACTION (?F)', 'REJECTED_TRANSACTION (?R)']
        };

        const valoresPorEstado = {
            aprobada: ['APPROVED_TRANSACTION'],
            pendiente: ['PENDING_TRANSACTION', 'PENDING_VALIDATION'],
            rechazada: ['CANCELLED_TRANSACTION', 'FAILED_TRANSACTION', 'REJECTED_TRANSACTION']
        };

        function selectEstado(estado, el) {
            estadoActual = estado;
            document.querySelectorAll('.estado-btn').forEach(b => b.classList.remove('selected'));
            el.classList.add('selected');
            document.getElementById('estadoElegido').value = estado;

            // Actualizar razones
            const select = document.getElementById('razonSelect');
            select.innerHTML = '';
            razonesPorEstado[estado].forEach(function (label, i) {
                const opt = document.createElement('option');
                opt.value = valoresPorEstado[estado][i];
                opt.textContent = label;
                select.appendChild(opt);
            });
            actualizarRazon();
        }

        function actualizarRazon() {
            const select = document.getElementById('razonSelect');
            document.getElementById('razonElegida').value = select.value;
        }

        document.getElementById('razonSelect').addEventListener('change', actualizarRazon);

        function procesar() {
            actualizarRazon();
            document.getElementById('btnProcesar').disabled = true;
            document.getElementById('btnProcesar').innerHTML = '<i class="bi bi-hourglass-split"></i> Procesando...';
            document.getElementById('estadoForm').submit();
        }

        // Init
        selectEstado('aprobada', document.querySelector('.estado-btn.aprobada'));
