<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>eFootball Mobile — Monedas</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link
    href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@400;600;700;800&family=Barlow:wght@400;500;600&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
  <link rel="stylesheet" href="assets/css/">
    <link rel="stylesheet" href="../assets/css/estilos.css">
</head>
<link rel="stylesheet" href="../assets/css/pages/games/efootball.css">

<body>
  <?php
  $nav_back_url = "juegos.php";
  $nav_back_text = "Atras";
  $nav_base = "../";
  require_once '../php/navbar.php';
  ?>

  <!-- ── GAME BANNER ── -->
  <div class="game-banner">
    <div class="game-banner__tag">
      <img src="https://www.konami.com/efootball/s/img/main_page_1.png?v=930" class="card-img-top" alt=""
        class="game-icon">
      eFootball Mobile — Monedas
    </div>
    <div class="banner-player-id">
      <label for="jugadorIdInput">🆔 ID de jugador</label>
      <input type="text" id="jugadorIdInput" placeholder="Ej: AAAA-123-456-789" autocomplete="off" />
    </div>
  </div>

  <!-- ── MAIN LAYOUT ── -->
  <main class="shop-layout">

    <!-- LEFT: Products Panel -->
    <section class="products-panel">
      <div class="section-block">
        <p class="section-label">Elige el importe</p>
        <div class="products-grid" id="productsGrid">

          <div class="product-card" data-id="1" data-pts="120" data-price="5000" data-original="" data-discount="">
            <img src="https://cdn.unipin.com/images/merchant_denominations/1763006539-icon-300.png"
              style="height: 40px; width: 40px" alt="">
            <div class="product-card__pts">120</div>
            <div class="product-card__label">Monedas</div>
            <div class="product-card__price">5.000 COP</div>
          </div>

          <div class="product-card popular-card" data-id="2" data-pts="300" data-price="10500" data-original="14000"
            data-discount="25">
            <img src="https://cdn.unipin.com/images/merchant_denominations/1763006543-icon-500.png"
              style="height: 40px; width: 40px" alt="">
            <div class="product-card__pts">300</div>
            <div class="product-card__label">Monedas</div>
            <div class="product-card__price-old">14.000 COP</div>
            <div class="product-card__price">10.500 COP <span class="discount-tag">-25%</span></div>
          </div>

          <div class="product-card" data-id="3" data-pts="660" data-price="21000" data-original="28000"
            data-discount="25">
            <img src="https://cdn.unipin.com/images/merchant_denominations/1763006553-icon-1040.png"
              style="height: 40px; width: 40px" alt="">
            <div class="product-card__pts">660</div>
            <div class="product-card__label">Monedas</div>
            <div class="product-card__price-old">28.000 COP</div>
            <div class="product-card__price">21.000 COP <span class="discount-tag">-25%</span></div>
          </div>

          <div class="product-card" data-id="4" data-pts="1320" data-price="39000" data-original="54000"
            data-discount="28">
            <img src="https://cdn.unipin.com/images/merchant_denominations/1763006553-icon-1040.png"
              style="height: 40px; width: 40px" alt="">
            <div class="product-card__pts">1320</div>
            <div class="product-card__label">Monedas</div>
            <div class="product-card__price-old">54.000 COP</div>
            <div class="product-card__price">39.000 COP <span class="discount-tag">-28%</span></div>
          </div>

          <div class="product-card" data-id="5" data-pts="2640" data-price="72000" data-original="98000"
            data-discount="27">
            <img src="https://cdn.unipin.com/images/merchant_denominations/1763006560-icon-2130.png"
              style="height: 40px; width: 40px" alt="">
            <div class="product-card__pts">2640</div>
            <div class="product-card__label">Monedas</div>
            <div class="product-card__price-old">98.000 COP</div>
            <div class="product-card__price">72.000 COP <span class="discount-tag">-27%</span></div>
          </div>

          <div class="product-card" data-id="6" data-pts="5280" data-price="130000" data-original="180000"
            data-discount="28">
            <img src="https://cdn.unipin.com/images/merchant_denominations/1763006564-icon-3250.png"
              style="height: 40px; width: 40px" alt="">
            <div class="product-card__pts">5280</div>
            <div class="product-card__label">Monedas</div>
            <div class="product-card__price-old">180.000 COP</div>
            <div class="product-card__price">130.000 COP <span class="discount-tag">-28%</span></div>
          </div>

          <div class="product-card" data-id="7" data-pts="10560" data-price="240000" data-original="330000"
            data-discount="27">
            <img src="https://cdn.unipin.com/images/merchant_denominations/1763006574-icon-12800.png"
              style="height: 40px; width: 40px" alt="">
            <div class="product-card__pts">10560</div>
            <div class="product-card__label">Monedas</div>
            <div class="product-card__price-old">330.000 COP</div>
            <div class="product-card__price">240.000 COP <span class="discount-tag">-27%</span></div>
          </div>

        </div>
      </div>
    </section>

    <!-- RIGHT: Checkout Panel -->
    <aside class="checkout-panel" id="checkoutPanel">

      <div class="checkout-summary">
        <div class="checkout-product-name">
          <img id="checkoutImg" src="" alt="" />
          <span id="checkoutName"></span>
        </div>

        <div class="checkout-row">
          <span class="checkout-label">Plazo de entrega</span>
          <span class="checkout-delivery">Instante</span>
        </div>

        <div class="checkout-divider"></div>

        <div class="checkout-row checkout-total-row">
          <span class="checkout-label">Total</span>
          <div class="checkout-pricing">
            <span class="checkout-original" id="checkoutOriginal">14.000 COP</span>
            <div class="checkout-final-row">
              <span class="checkout-badge" id="checkoutBadge">-25%</span>
              <span class="checkout-final-price" id="checkoutPrice">10.500 COP</span>
            </div>
          </div>
        </div>

        <button class="btn-buy" id="btnBuy">
          <span>Comprar ahora</span>
          <span class="btn-arrow">→</span>
        </button>

        <div class="trust-badges">
          <div class="trust-item"><i class="bi bi-shield-check fs-6"></i><span>Garantía de reembolso · P2P</span></div>
          <div class="trust-item"><i class="bi bi-lightning-fill fs-6"></i><span>Pago rápido · Apple Pay / G Pay</span>
          </div>
          <div class="trust-item"><i class="bi bi-headset fs-6"></i><span>Asistencia en directo 24/7 — ¡A tu
              lado!</span></div>
        </div>
      </div>

      <div class="delivery-instructions">
        <p class="section-label">Instrucciones de entrega</p>
        <div class="instruction-text" id="instructionText">
          KONAMI® | 300 Monedas 🎮<br>
          <span class="flag">🌐</span> Region: Global<br>
          <span class="flag warn">⚠️</span> IMPORTANT NOTE BEFORE PURCHASE
        </div>
        <button class="btn-instructions">Ver todas las instrucciones ▾</button>
      </div>

      <div class="vendor-box">
        <p class="section-label">Designer</p>
        <div class="vendor-info">
          <div class="vendor-avatar">JM</div>
          <div>
            <div class="vendor-name">Jair ✔</div>
            <div class="vendor-rating">👍 2026 · <a href="#">Evertec Placetopay SAS</a></div>
          </div>
        </div>
      </div>

    </aside>
  </main>

  <!-- JS -->
  <script>
    (function () {

      const products = {
        1: { name: ' 120 Monedas', price: '5.000 COP', original: '', badge: '', delivery: 'Instante' },
        2: { name: ' 300 Monedas', price: '10.500 COP', original: '14.000 COP', badge: '-25%', delivery: 'Instante' },
        3: { name: ' 660 Monedas', price: '21.000 COP', original: '28.000 COP', badge: '-25%', delivery: 'Instante' },
        4: { name: ' 1320 Monedas', price: '39.000 COP', original: '54.000 COP', badge: '-28%', delivery: 'Instante' },
        5: { name: ' 2640 Monedas', price: '72.000 COP', original: '98.000 COP', badge: '-27%', delivery: 'Instante' },
        6: { name: ' 5280 Monedas', price: '130.000 COP', original: '180.000 COP', badge: '-28%', delivery: 'Instante' },
        7: { name: ' 10560 Monedas', price: '240.000 COP', original: '330.000 COP', badge: '-27%', delivery: 'Instante' },
      };

      function updateCheckout(id) {
        const p = products[id];
        if (!p) return;

        document.getElementById('checkoutName').textContent = p.name;
        document.getElementById('checkoutPrice').textContent = p.price;

        const imgEl = document.getElementById('checkoutImg');
        const cardImg = document.querySelector('.product-card[data-id="' + id + '"] img');
        if (imgEl && cardImg) {
          imgEl.src = cardImg.getAttribute('src');
          imgEl.style.display = '';
        } else if (imgEl) {
          imgEl.style.display = 'none';
        }

        const origEl = document.getElementById('checkoutOriginal');
        const badgeEl = document.getElementById('checkoutBadge');

        if (p.original) {
          origEl.textContent = p.original;
          badgeEl.textContent = p.badge;
          origEl.style.display = '';
          badgeEl.style.display = '';
        } else {
          origEl.style.display = 'none';
          badgeEl.style.display = 'none';
        }

        document.getElementById('instructionText').innerHTML =
          'KONAMI\u00ae | ' + p.name.replace(/[\u{1FA99}\u{1F4B0}]/gu, '').trim() +
          ' \uD83C\uDFAE<br>' +
          '<span class="flag">\uD83C\uDF10</span> Region: Global<br>' +
          '<span class="flag warn">\u26D4</span> IMPORTANT NOTE BEFORE PURCHASE';
      }

      function initCards() {
        const cards = document.querySelectorAll('.product-card');
        if (cards.length === 0) { setTimeout(initCards, 100); return; }

        cards.forEach(function (card) {
          card.addEventListener('click', function () {
            cards.forEach(function (c) { c.classList.remove('selected'); });
            card.classList.add('selected');
            updateCheckout(parseInt(card.getAttribute('data-id')));
          });
        });

        var def = document.querySelector('.product-card[data-id="2"]');
        if (def) { def.classList.add('selected'); updateCheckout(2); }
      }

      if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initCards);
      } else {
        initCards();
      }

      // Buy button
      document.addEventListener('click', function (e) {
        var btn = e.target.closest('#btnBuy');
        if (!btn) return;

        var jugadorId = document.getElementById('jugadorIdInput').value.trim();
        if (!jugadorId) {
          alert('⚠️ Por favor ingresa tu ID de jugador antes de continuar.');
          document.getElementById('jugadorIdInput').focus();
          return;
        }

        var producto = document.getElementById('checkoutName').textContent.trim();
        var precio = document.getElementById('checkoutPrice').textContent.replace(/[^0-9]/g, '');

        var form = document.createElement('form');
        form.method = 'POST';
        form.action = '../php/crear_orden.php';

        [['producto', producto], ['precio', precio], ['jugador_id', jugadorId]].forEach(function (pair) {
          var input = document.createElement('input');
          input.type = 'hidden';
          input.name = pair[0];
          input.value = pair[1];
          form.appendChild(input);
        });

        document.body.appendChild(form);
        form.submit();
      });

    })();
  </script>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/validaciones.js"></script>
<script src="assets/js/script.js"></script>

</html>