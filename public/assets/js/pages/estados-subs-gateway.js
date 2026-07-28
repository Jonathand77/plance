const razones = {
            'aprobada-token': [{ v: 'APPROVED_TRANSACTION', l: 'APPROVED_TRANSACTION (00) — Con token' }],
            'aprobada-sin': [{ v: 'APPROVED_TRANSACTION', l: 'APPROVED_TRANSACTION (00) — Sin token' }],
            'pendiente': [{ v: 'PENDING_TRANSACTION', l: 'PENDING_TRANSACTION (?-)' }, { v: 'PENDING_VALIDATION', l: 'PENDING_VALIDATION (?V)' }],
            'rechazada': [{ v: 'CANCELLED_TRANSACTION', l: 'CANCELLED_TRANSACTION (?C)' }, { v: 'FAILED_TRANSACTION', l: 'FAILED_TRANSACTION (?F)' }, { v: 'REJECTED_TRANSACTION', l: 'REJECTED_TRANSACTION (?R)' }]
        };

        function selectEstado(estado, el) {
            document.querySelectorAll('.estado-btn').forEach(b => b.classList.remove('selected'));
            el.classList.add('selected');
            document.getElementById('estadoElegido').value = estado;

            const select = document.getElementById('razonSelect');
            select.innerHTML = '';
            razones[estado].forEach(function (r) {
                const opt = document.createElement('option');
                opt.value = r.v; opt.textContent = r.l;
                select.appendChild(opt);
            });
            actualizarRazon();
        }

        function actualizarRazon() {
            document.getElementById('razonElegida').value = document.getElementById('razonSelect').value;
        }

        document.getElementById('razonSelect').addEventListener('change', actualizarRazon);

        function procesar() {
            actualizarRazon();
            document.getElementById('btnProcesar').disabled = true;
            document.getElementById('btnProcesar').innerHTML = '<i class="bi bi-hourglass-split"></i> Procesando...';
            document.getElementById('estadoForm').submit();
        }

        selectEstado('aprobada-token', document.querySelector('.estado-btn.aprobada-token'));
