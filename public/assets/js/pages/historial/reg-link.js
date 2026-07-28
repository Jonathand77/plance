function copyLink(btn) {
            const link = btn.getAttribute('data-link');
            navigator.clipboard.writeText(link).then(function () {
                const original = btn.innerHTML;
                btn.classList.add('copied');
                btn.innerHTML = '<i class="bi bi-check2"></i> Copiado';
                setTimeout(function () {
                    btn.classList.remove('copied');
                    btn.innerHTML = original;
                }, 2000);
            });
        }
