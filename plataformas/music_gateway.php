<?php
session_start();
if (!isset($_SESSION['usuario'])) { header("Location: ../index.php"); exit(); }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Música — API Gateway</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
</head>
<style>
    :root {
        --bg-base: #0d0e10; --bg-surface: #16181c; --bg-card: #1e2128;
        --bg-card-hover: #252830; --bg-selected: #0a1a10; --border: #2e3038;
        --accent: #1db954; --accent-glow:rgba(29,185,84,0.25); --accent-dark: #17a248;
        --text-primary: #f0f1f3; --text-secondary: #8a8d96; --text-muted: #555860;
        --font-display:'Barlow',sans-serif; --font-body:'Barlow',sans-serif;
        --radius-sm:6px; --radius-md:10px; --radius-lg:14px;
    }
    *,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
    body{background-color:var(--bg-base);color:var(--text-primary);font-family:var(--font-body);min-height:100vh;-webkit-font-smoothing:antialiased;}
    .navbar{background-color:#0f0f0fa9!important;backdrop-filter:blur(8px);border-bottom:1px solid var(--border);}

    .security-warning{background:rgba(224,82,82,0.08);border-left:4px solid #e05252;border-radius:0 8px 8px 0;padding:0.9rem 1.2rem;margin:1rem 2rem;display:flex;gap:0.8rem;align-items:flex-start;font-size:0.83rem;color:#f0f1f3;line-height:1.6;}
    .security-warning i{color:#e05252;font-size:1.2rem;flex-shrink:0;margin-top:0.1rem;}
    .security-warning strong{color:#e05252;}

    .game-banner{display:flex;align-items:center;justify-content:space-between;padding:0.6rem 2rem;background:var(--bg-surface);border-bottom:1px solid var(--border);gap:1rem;}
    .game-banner__tag{display:flex;align-items:center;gap:0.5rem;font-family:var(--font-display);font-weight:700;font-size:1rem;letter-spacing:0.04em;color:var(--text-primary);}
    .gw-badge{background:rgba(29,185,84,0.15);color:var(--accent);font-size:0.72rem;font-weight:700;padding:0.2rem 0.6rem;border-radius:20px;letter-spacing:0.05em;font-family:var(--font-display);}
    .sub-badge{background:rgba(29,185,84,0.12);color:var(--accent);font-size:0.72rem;font-weight:700;padding:0.2rem 0.6rem;border-radius:20px;letter-spacing:0.05em;font-family:var(--font-display);}

    .shop-layout{display:grid;grid-template-columns:1fr 370px;gap:1.5rem;max-width:1200px;margin:1.5rem auto;padding:0 1.5rem 3rem;align-items:start;}

    .section-block{margin-bottom:1.8rem;}
    .platform-header{display:flex;align-items:center;gap:0.6rem;margin-bottom:0.75rem;padding-bottom:0.5rem;border-bottom:1px solid var(--border);}
    .platform-header span{font-family:var(--font-display);font-size:1.1rem;font-weight:800;letter-spacing:0.04em;color:var(--text-primary);}

    .products-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:0.65rem;}
    .product-card{position:relative;background:var(--bg-card);border:1.5px solid var(--border);border-radius:var(--radius-md);padding:1rem 0.85rem 0.9rem;cursor:pointer;transition:all 0.18s ease;display:flex;flex-direction:column;gap:0.15rem;overflow:hidden;}
    .product-card:hover{background:var(--bg-card-hover);border-color:rgba(29,185,84,0.4);transform:translateY(-2px);box-shadow:0 6px 20px rgba(0,0,0,0.35);}
    .product-card.selected{background:var(--bg-selected);border-color:var(--accent);box-shadow:0 0 0 1px var(--accent),0 4px 24px var(--accent-glow);}
    .product-card.selected::after{content:'✔';position:absolute;top:0.5rem;right:0.55rem;width:18px;height:18px;background:var(--accent);border-radius:50%;color:#0d0e10;font-size:0.65rem;display:flex;align-items:center;justify-content:center;font-weight:900;line-height:18px;text-align:center;}
    .badge-popular{position:absolute;top:-1px;left:-1px;background:var(--accent);color:#0d0e10;font-family:var(--font-display);font-size:0.68rem;font-weight:800;letter-spacing:0.05em;padding:0.15rem 0.5rem;border-radius:var(--radius-sm) 0 var(--radius-sm) 0;}
    .product-card__platform{font-size:0.7rem;font-weight:600;color:var(--accent);text-transform:uppercase;letter-spacing:0.08em;margin-bottom:0.1rem;}
    .product-card__pts{font-family:var(--font-display);font-size:1.1rem;font-weight:800;color:var(--text-primary);line-height:1.1;}
    .product-card__label{font-size:0.72rem;color:var(--text-secondary);margin-bottom:0.3rem;}
    .product-card__price{font-family:var(--font-display);font-size:1rem;font-weight:700;color:var(--accent);display:flex;align-items:center;gap:0.35rem;flex-wrap:wrap;margin-top:auto;}
    .sub-tag{background:rgba(29,185,84,0.12);color:var(--accent);font-size:0.65rem;font-weight:700;padding:0.1rem 0.35rem;border-radius:3px;}

    .checkout-panel{display:flex;flex-direction:column;gap:1rem;position:sticky;top:16px;}
    .checkout-box{background:var(--bg-surface);border:1px solid var(--border);border-radius:var(--radius-lg);padding:1.2rem 1.3rem;}
    .checkout-product-name{font-family:var(--font-display);font-size:1.1rem;font-weight:800;color:var(--text-primary);margin-bottom:0.6rem;}
    .checkout-price-row{display:flex;justify-content:space-between;align-items:center;margin-bottom:0.6rem;}
    .checkout-price{font-family:var(--font-display);font-size:1.4rem;font-weight:800;color:var(--text-primary);}
    .checkout-divider{height:1px;background:var(--border);margin:0.7rem 0;}

    .token-info{background:rgba(29,185,84,0.08);border:1px solid rgba(29,185,84,0.2);border-radius:8px;padding:0.7rem 1rem;margin-bottom:0.8rem;font-size:0.8rem;color:#86efac;display:flex;gap:0.5rem;align-items:flex-start;}

    .field-group{margin-bottom:0.65rem;}
    .field-label{font-size:0.73rem;font-weight:600;color:var(--text-secondary);margin-bottom:0.25rem;display:block;}
    .field-input{width:100%;background:var(--bg-card);border:1.5px solid var(--border);border-radius:8px;color:var(--text-primary);font-family:var(--font-body);font-size:0.83rem;padding:0.4rem 0.7rem;outline:none;transition:border-color 0.2s;}
    .field-input:focus{border-color:var(--accent);}
    .field-input::placeholder{color:var(--text-muted);}
    .field-row{display:grid;grid-template-columns:1fr 1fr;gap:0.5rem;}
    .section-label-sm{font-family:var(--font-display);font-size:0.73rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:var(--text-secondary);margin-bottom:0.5rem;display:block;}

    .btn-pagar{width:100%;margin-top:0.8rem;padding:0.8rem;background:var(--accent);border:none;border-radius:var(--radius-md);color:#0a0a0b;font-family:var(--font-display);font-size:1rem;font-weight:800;letter-spacing:0.06em;text-transform:uppercase;cursor:pointer;transition:all 0.18s ease;display:flex;align-items:center;justify-content:center;gap:0.5rem;}
    .btn-pagar:hover{background:var(--accent-dark);transform:translateY(-1px);box-shadow:0 6px 20px var(--accent-glow);}

    .sim-mode-wrap{margin-top:0.9rem;}
    .sim-mode-label{font-family:var(--font-display);font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:var(--text-secondary);margin-bottom:0.45rem;display:block;}
    .sim-mode-toggle{display:grid;grid-template-columns:1fr 1fr;gap:0.4rem;background:var(--bg-card);border:1.5px solid var(--border);border-radius:var(--radius-md);padding:0.3rem;}
    .sim-mode-opt{border:none;background:transparent;cursor:pointer;padding:0.55rem 0.4rem;border-radius:var(--radius-sm);font-family:var(--font-body);font-size:0.8rem;font-weight:600;color:var(--text-secondary);transition:all 0.18s ease;display:flex;align-items:center;justify-content:center;gap:0.35rem;}
    .sim-mode-opt:hover{color:var(--text-primary);}
    .sim-mode-opt.active{background:rgba(66, 133, 77, 0.12);color:var(--accent);box-shadow:inset 0 0 0 1.5px var(--accent);}
    .sim-mode-hint{font-size:0.72rem;color:var(--text-muted);margin-top:0.4rem;line-height:1.4;}
    .security-note{display:flex;align-items:center;gap:0.4rem;font-size:0.73rem;color:var(--text-muted);margin-top:0.5rem;justify-content:center;}

    /* 3DS */
    .tds-badge{background:rgba(60, 255, 0, 0.15);color: #03ff03; font-size:0.72rem;font-weight:700;padding:0.2rem 0.6rem;border-radius:20px;letter-spacing:0.05em;font-family:var(--font-display);}
    .tds-check-wrap{display:flex;align-items:flex-start;gap:0.5rem;padding:0.7rem 0.8rem;margin-top:0.8rem;background:rgba(29,185,84,0.06);border:1.5px solid rgba(29,185,84,0.2);border-radius:8px;cursor:pointer;}
    .tds-check-wrap input[type="checkbox"]{width:16px;height:16px;accent-color:var(--accent);flex-shrink:0;margin-top:2px;}
    .tds-check-label{font-size:0.81rem;color:#16a34a;line-height:1.4;}
    .tds-check-label strong{color:var(--accent);}
    .tds-panel{display:none;background:rgba(29,185,84,0.05);border:1.5px solid rgba(29,185,84,0.25);border-radius:10px;padding:1rem;margin-top:0.8rem;text-align:center;}
    .tds-panel.show{display:block;}
    .tds-panel-title{font-family:var(--font-display);font-size:1rem;font-weight:800;color:var(--accent);letter-spacing:0.04em;margin-bottom:0.3rem;}
    .tds-panel-sub{font-size:0.78rem;color:var(--text-secondary);margin-bottom:0.8rem;line-height:1.5;}
    .tds-inputs{display:flex;gap:0.4rem;justify-content:center;margin-bottom:0.8rem;}
    .tds-digit{width:42px;height:48px;background:var(--bg-card);border:1.5px solid var(--border);border-radius:8px;color:var(--text-primary);font-size:1.3rem;font-weight:800;text-align:center;outline:none;transition:border-color 0.2s;font-family:var(--font-display);}
    .tds-digit:focus{border-color:var(--accent);}
    .tds-digit.error{border-color:#e05252;}
    .tds-digit.success{border-color:#3ecf8e;}
    .tds-hint{font-size:0.75rem;color:var(--text-muted);margin-bottom:0.6rem;}
    .tds-hint span{color:var(--accent);font-weight:700;}
    .tds-status{font-size:0.82rem;font-weight:700;padding:0.4rem 0.8rem;border-radius:6px;display:none;margin-bottom:0.5rem;}
    .tds-status.ok{display:block;background:rgba(62,207,142,0.12);color:#3ecf8e;}
    .tds-status.err{display:block;background:rgba(224,82,82,0.12);color:#e05252;}

    @keyframes fadeSlideIn{from{opacity:0;transform:translateY(6px);}to{opacity:1;transform:translateY(0);}}
    .products-panel{animation:fadeSlideIn 0.4s ease both;}
    .checkout-panel{animation:fadeSlideIn 0.4s 0.1s ease both;}
    @media(max-width:900px){.shop-layout{grid-template-columns:1fr;}.checkout-panel{position:static;}.products-grid{grid-template-columns:repeat(2,1fr);}}
    @media(max-width:600px){.products-grid{grid-template-columns:1fr;}.game-banner{flex-direction:column;align-items:flex-start;}}
</style>
<body>
    <?php
    $nav_back_url  = "suscripciones.php";
    $nav_back_text = "Volver";
    $nav_base      = "../";
    require_once '../php/navbar.php';
    ?>

    <div class="game-banner">
        <div class="game-banner__tag">
            <i class="bi bi-music-note-list"></i> Música — Suscripción Pura
            <span class="gw-badge"><i class="bi bi-lightning-charge-fill"></i> API Gateway</span>
            <span class="sub-badge"><i class="bi bi-shield-lock-fill"></i> Tokenización</span>
            <span class="tds-badge"><i class="bi bi-shield-lock-fill"></i> 3DS</span>
        </div>
    </div>

    <div class="security-warning">
        <i class="bi bi-shield-exclamation"></i>
        <div>
            <strong>⚠️ Aviso para comercios:</strong> La integración con API Gateway implica el manejo directo de datos sensibles del usuario. Para operar en producción es <strong>obligatorio</strong> contar con certificación <strong>PCI-DSS</strong> y se recomienda implementar <strong>3D Secure (3DS)</strong> para reducir el riesgo de fraude. Esta demo es solo con fines ilustrativos.

            <br>
            La base de datos de esta web <strong>NO! Guarda datos sensibles </strong> como el <strong> Numero de tarjeta, Fecha y CVV</strong> o <strong>Numeros de cuenta</strong> esta es solo una demostracion del servicio <strong></strong>
        </div>
    </div>

    <main class="shop-layout">
        <section class="products-panel">

            <!-- SPOTIFY -->
            <div class="section-block">
                <div class="platform-header">
                    <img src="https://www.google.com/s2/favicons?domain=spotify.com&sz=32" alt="Spotify" style="width:24px;height:24px;border-radius:4px;">
                    <span>Spotify</span>
                </div>
                <div class="products-grid">
                    <div class="product-card popular-card" data-id="1" data-servicio="Spotify" data-plan="Individual" data-precio="14900">
                        <div class="badge-popular">★ Popular</div>
                        <div class="product-card__platform">Spotify</div>
                        <div class="product-card__pts">Individual</div>
                        <div class="product-card__label">Sin anuncios · Descargas · 1 cuenta</div>
                        <div class="product-card__price">14.900 COP <span class="sub-tag">/ mes</span></div>
                    </div>
                    <div class="product-card" data-id="2" data-servicio="Spotify" data-plan="Duo" data-precio="19900">
                        <div class="product-card__platform">Spotify</div>
                        <div class="product-card__pts">Duo</div>
                        <div class="product-card__label">Sin anuncios · Descargas · 2 cuentas</div>
                        <div class="product-card__price">19.900 COP <span class="sub-tag">/ mes</span></div>
                    </div>
                    <div class="product-card" data-id="3" data-servicio="Spotify" data-plan="Familiar" data-precio="24900">
                        <div class="product-card__platform">Spotify</div>
                        <div class="product-card__pts">Familiar</div>
                        <div class="product-card__label">Sin anuncios · Descargas · 6 cuentas</div>
                        <div class="product-card__price">24.900 COP <span class="sub-tag">/ mes</span></div>
                    </div>
                </div>
            </div>

            <!-- DEEZER -->
            <div class="section-block">
                <div class="platform-header">
                    <img src="https://www.google.com/s2/favicons?domain=deezer.com&sz=32" alt="Deezer" style="width:24px;height:24px;border-radius:4px;">
                    <span>Deezer</span>
                </div>
                <div class="products-grid">
                    <div class="product-card" data-id="4" data-servicio="Deezer" data-plan="Premium" data-precio="12900">
                        <div class="product-card__platform">Deezer</div>
                        <div class="product-card__pts">Premium</div>
                        <div class="product-card__label">Sin anuncios · HD · 1 cuenta</div>
                        <div class="product-card__price">12.900 COP <span class="sub-tag">/ mes</span></div>
                    </div>
                    <div class="product-card popular-card" data-id="5" data-servicio="Deezer" data-plan="Familia" data-precio="19900">
                        <div class="badge-popular">★ Popular</div>
                        <div class="product-card__platform">Deezer</div>
                        <div class="product-card__pts">Familia</div>
                        <div class="product-card__label">Sin anuncios · HD · 6 cuentas</div>
                        <div class="product-card__price">19.900 COP <span class="sub-tag">/ mes</span></div>
                    </div>
                </div>
            </div>
            <!-- Modo de simulación -->
            <div class="sim-mode-wrap">
                <span class="sim-mode-label">Modo de simulación</span>
                <div class="sim-mode-toggle">
                        <button type="button" class="sim-mode-opt active" id="modoElegir" onclick="setModo('elegir')">
                            <i class="bi bi-sliders"></i> Elegir estado
                        </button>
                        <button type="button" class="sim-mode-opt" id="modoAuto" onclick="setModo('auto')">
                            <i class="bi bi-lightning-charge-fill"></i> Pago normal
                        </button>
                </div>
                <div class="sim-mode-hint" id="modoHint">Elige manualmente cómo termina la suscripción.</div>
            </div>

        </section>

        <!-- CHECKOUT -->
        <aside class="checkout-panel">
            <div class="checkout-box">
                <div class="checkout-product-name" id="checkoutName">🎵 Spotify — Individual</div>
                <div class="checkout-price-row">
                    <span style="font-size:0.85rem;color:var(--text-secondary);">Total / mes</span>
                    <span class="checkout-price" id="checkoutPrice">14.900 COP</span>
                </div>

                <div class="checkout-divider"></div>

                <div class="token-info">
                    <i class="bi bi-shield-lock-fill"></i>
                    <span>Suscripción pura — tu tarjeta será tokenizada de forma segura para futuros cobros.</span>
                </div>

                <span class="section-label-sm">Datos de la tarjeta</span>
                <div class="field-group">
                    <label class="field-label">Número de tarjeta</label>
                    <input type="text" class="field-input" id="cardNumber" placeholder="0000 0000 0000 0000" maxlength="19">
                </div>
                <div class="field-row">
                    <div class="field-group">
                        <label class="field-label">Vencimiento</label>
                        <input type="text" class="field-input" id="cardExpiry" placeholder="MM/AA" maxlength="5">
                    </div>
                    <div class="field-group">
                        <label class="field-label">CVV</label>
                        <input type="text" class="field-input" id="cardCvv" placeholder="123" maxlength="4">
                    </div>
                </div>
                <div class="field-group">
                    <label class="field-label">Nombre en la tarjeta</label>
                    <input type="text" class="field-input" id="cardNameOnCard" placeholder="Como aparece en la tarjeta">
                </div>

                <div class="checkout-divider"></div>
                <span class="section-label-sm">Datos del titular</span>
                <div class="field-group">
                    <label class="field-label">Nombre completo</label>
                    <input type="text" class="field-input" id="gwNombre" placeholder="Nombre y apellido">
                </div>
                <div class="field-group">
                    <label class="field-label">Correo electrónico</label>
                    <input type="email" class="field-input" id="gwCorreo"
                           value="<?php echo htmlspecialchars($_SESSION['correo'] ?? ''); ?>">
                </div>
                <div class="field-group">
                    <label class="field-label">Teléfono</label>
                    <input type="text" class="field-input" id="gwTelefono" placeholder="3001234567">
                </div>
                <div class="field-row">
                    <div class="field-group">
                        <label class="field-label">Tipo de documento</label>
                        <select class="field-input" id="gwTipoDoc">
                            <option value="CC">Cédula</option>
                            <option value="CE">Cédula Extranjería</option>
                            <option value="NIT">NIT</option>
                            <option value="PP">Pasaporte</option>
                        </select>
                    </div>
                    <div class="field-group">
                        <label class="field-label">Número de documento</label>
                        <input type="text" class="field-input" id="gwNumDoc" placeholder="1234567890">
                    </div>
                </div>

                <!-- 3DS checkbox -->
                <label class="tds-check-wrap">
                    <input type="checkbox" id="tdsCheck">
                    <span class="tds-check-label">
                        🔐 <strong>Autenticar con 3D Secure (3DS)</strong><br>
                        Activa una capa extra de seguridad para proteger tu tarjeta.
                    </span>
                </label>

                <!-- Panel 3DS -->
                <div class="tds-panel" id="tdsPanel">
                    <div class="tds-panel-title">🔐 Verificación 3D Secure</div>
                    <div class="tds-panel-sub">Ingresa el código de 6 dígitos enviado a tu banco para autenticar la transacción.</div>
                    <div class="tds-inputs">
                        <input type="text" class="tds-digit" maxlength="1" inputmode="numeric">
                        <input type="text" class="tds-digit" maxlength="1" inputmode="numeric">
                        <input type="text" class="tds-digit" maxlength="1" inputmode="numeric">
                        <input type="text" class="tds-digit" maxlength="1" inputmode="numeric">
                        <input type="text" class="tds-digit" maxlength="1" inputmode="numeric">
                        <input type="text" class="tds-digit" maxlength="1" inputmode="numeric">
                    </div>
                    <div class="tds-hint">💡 Código de demo: <span>1 2 3 4 5 6</span></div>
                    <div class="tds-status" id="tdsStatus"></div>
                </div>



                <button class="btn-pagar" id="btnPagar">
                    <i class="bi bi-lock-fill"></i> Registrar suscripción
                </button>
                <div class="security-note">
                    <i class="bi bi-shield-check"></i>
                    Pago seguro · API Gateway · Evertec PlacetoPay
                </div>
            </div>
        </aside>
    </main>

    <script>
    (function() {
        const products = {
            1:{name:'🎵 Spotify — Individual',servicio:'Spotify',plan:'Individual',precio:14900,price:'14.900 COP'},
            2:{name:'🎵 Spotify — Duo',       servicio:'Spotify',plan:'Duo',       precio:19900,price:'19.900 COP'},
            3:{name:'🎵 Spotify — Familiar',  servicio:'Spotify',plan:'Familiar',  precio:24900,price:'24.900 COP'},
            4:{name:'🎶 Deezer — Premium',    servicio:'Deezer', plan:'Premium',   precio:12900,price:'12.900 COP'},
            5:{name:'🎶 Deezer — Familia',    servicio:'Deezer', plan:'Familia',   precio:19900,price:'19.900 COP'},
        };

        function updateCheckout(id) {
            const p = products[id];
            if (!p) return;
            document.getElementById('checkoutName').textContent  = p.name;
            document.getElementById('checkoutPrice').textContent = p.price;
        }

        function initCards() {
            const cards = document.querySelectorAll('.product-card');
            if (cards.length === 0) { setTimeout(initCards, 100); return; }
            cards.forEach(function(card) {
                card.addEventListener('click', function() {
                    cards.forEach(c => c.classList.remove('selected'));
                    card.classList.add('selected');
                    updateCheckout(parseInt(card.getAttribute('data-id')));
                });
            });
            var def = document.querySelector('.product-card[data-id="1"]');
            if (def) { def.classList.add('selected'); updateCheckout(1); }
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initCards);
        } else { initCards(); }

        // Formatear número de tarjeta
        document.getElementById('cardNumber').addEventListener('input', function() {
            let v = this.value.replace(/\D/g,'').substring(0,16);
            this.value = v.replace(/(.{4})/g,'$1 ').trim();
        });
        // Formatear fecha
        document.getElementById('cardExpiry').addEventListener('input', function() {
            let v = this.value.replace(/\D/g,'').substring(0,4);
            if (v.length >= 2) v = v.substring(0,2) + '/' + v.substring(2);
            this.value = v;
        });

        // ── 3DS ──
        const tdsCheck  = document.getElementById('tdsCheck');
        const tdsPanel  = document.getElementById('tdsPanel');
        const tdsStatus = document.getElementById('tdsStatus');
        const tdsDigits = document.querySelectorAll('.tds-digit');
        const TDS_CODE  = '123456';
        let tdsVerified = false;

        tdsCheck.addEventListener('change', function() {
            tdsPanel.classList.toggle('show', this.checked);
            if (!this.checked) {
                tdsVerified = false;
                tdsDigits.forEach(d => { d.value = ''; d.className = 'tds-digit'; });
                tdsStatus.className = 'tds-status';
            }
        });

        tdsDigits.forEach(function(input, idx) {
            input.addEventListener('input', function() {
                this.value = this.value.replace(/\D/g, '');
                if (this.value && idx < tdsDigits.length - 1) tdsDigits[idx + 1].focus();
                const code = Array.from(tdsDigits).map(d => d.value).join('');
                if (code.length === 6) verifyTds(code);
            });
            input.addEventListener('keydown', function(e) {
                if (e.key === 'Backspace' && !this.value && idx > 0) tdsDigits[idx - 1].focus();
            });
        });

        function verifyTds(code) {
            if (code === TDS_CODE) {
                tdsVerified = true;
                tdsDigits.forEach(d => d.classList.add('success'));
                tdsStatus.className = 'tds-status ok';
                tdsStatus.textContent = '✅ Autenticación 3DS exitosa — puedes proceder.';
            } else {
                tdsVerified = false;
                tdsDigits.forEach(d => d.classList.add('error'));
                tdsStatus.className = 'tds-status err';
                tdsStatus.textContent = '❌ Código incorrecto. Inténtalo de nuevo.';
                setTimeout(function() {
                    tdsDigits.forEach(d => { d.value = ''; d.className = 'tds-digit'; });
                    tdsDigits[0].focus();
                    tdsStatus.className = 'tds-status';
                }, 1500);
            }
        }

        // ── Modo de simulación ──
        let modoSimulacion = 'elegir';
        window.setModo = function(modo) {
            modoSimulacion = modo;
            document.getElementById('modoElegir').classList.toggle('active', modo === 'elegir');
            document.getElementById('modoAuto').classList.toggle('active', modo === 'auto');
            document.getElementById('modoHint').textContent = (modo === 'elegir')
                ? 'Elige manualmente cómo termina la suscripción.'
                : 'El estado se asigna automáticamente, como un pago real.';
        };

        document.getElementById('btnPagar').addEventListener('click', function() {
            if (tdsCheck.checked && !tdsVerified) {
                alert('⚠️ Debes completar la verificación 3D Secure antes de continuar.');
                tdsDigits[0].focus(); return;
            }
            const selected = document.querySelector('.product-card.selected');
            if (!selected) { alert('⚠️ Selecciona un plan primero.'); return; }

            const cardNum  = document.getElementById('cardNumber').value.replace(/\s/g,'');
            const expiry   = document.getElementById('cardExpiry').value;
            const cvv      = document.getElementById('cardCvv').value;
            const cardName = document.getElementById('cardNameOnCard').value.trim();
            const nombre   = document.getElementById('gwNombre').value.trim();
            const correo   = document.getElementById('gwCorreo').value.trim();
            const telefono = document.getElementById('gwTelefono').value.trim();
            const tipoDoc  = document.getElementById('gwTipoDoc').value;
            const numDoc   = document.getElementById('gwNumDoc').value.trim();

            if (!cardNum || cardNum.length < 15) { alert('⚠️ Ingresa un número de tarjeta válido.'); return; }
            if (!expiry)  { alert('⚠️ Ingresa la fecha de vencimiento.'); return; }
            if (!cvv)     { alert('⚠️ Ingresa el CVV.'); return; }
            if (!cardName){ alert('⚠️ Ingresa el nombre en la tarjeta.'); return; }
            if (!nombre || !correo || !numDoc || !telefono) {
                alert('⚠️ Por favor completa todos los campos del titular.'); return;
            }

            const id = parseInt(selected.getAttribute('data-id'));
            const p  = products[id];

            const form = document.createElement('form');
            form.method = 'POST';
            form.action = (modoSimulacion === 'auto')
                ? '../php/crear_suscription_gateway.php'
                : '../estados-subs-gateway.php';

            [['servicio', p.servicio], ['plan', p.plan], ['precio', p.precio],
             ['nombre', nombre], ['correo', correo], ['telefono', telefono],
             ['tipo_doc', tipoDoc], ['num_doc', numDoc]].forEach(function(pair) {
                const input = document.createElement('input');
                input.type = 'hidden'; input.name = pair[0]; input.value = pair[1];
                form.appendChild(input);
            });

            document.body.appendChild(form);
            form.submit();
        });
    })();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>