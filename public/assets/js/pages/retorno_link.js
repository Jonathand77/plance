function copyLink() {
            const text = document.getElementById('linkText').textContent.trim();
            navigator.clipboard.writeText(text).then(function () {
                const btn = document.getElementById('btnCopy');
                btn.classList.add('copied');
                btn.innerHTML = '<i class="bi bi-check2"></i> Copiado';
                setTimeout(function () {
                    btn.classList.remove('copied');
                    btn.innerHTML = '<i class="bi bi-clipboard"></i> Copiar';
                }, 2000);
            });
        }
