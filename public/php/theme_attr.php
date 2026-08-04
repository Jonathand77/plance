<?php
// theme_attr.php — atributo data-theme="claro" según la preferencia guardada.
// La preferencia real vive en BD (usuario logueado) o en sesión (invitado); ambas
// se reflejan en la cookie "tema" al guardar (Settings) y al iniciar sesión, para
// poder aplicarla en páginas que no cargan el bootstrap/autoloader (catálogo, retorno, etc.).
$__tema_pref = ($_COOKIE['tema'] ?? 'oscuro') === 'claro' ? 'claro' : 'oscuro';
$data_theme_attr = $__tema_pref === 'claro' ? ' data-theme="claro"' : '';
