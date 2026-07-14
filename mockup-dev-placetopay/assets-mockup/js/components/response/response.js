import { $, colorize, getSelectedOptionValue } from "../../core/utils.js";
import { SIM } from "../../core/constants.js";

export function initResponse(state) {
  $("#btnSend")?.addEventListener("click", () => sendReq(state));
  $("#btnClearResp")?.addEventListener("click", () => clearResp());

  return {
    sendReq: () => sendReq(state),
    clearResp,
  };
}

export function sendReq(state) {
  const btn = $("#btnSend");
  if (!btn) return;

  btn.disabled = true;
  btn.innerHTML = '<i class="bi bi-hourglass-split"></i> Enviando...';

  $("#sdot").className = "sdot loading";
  $("#stext").textContent = "Procesando...";
  $("#respEmpty").style.display = "none";
  $("#respBody").style.display = "none";

  const ep = getSelectedOptionValue("serviceOption");
  const sim = getSelectedOptionValue("simMode");
  const t0 = Date.now();

  setTimeout(() => {
    const ms = Date.now() - t0;
    const cfg = SIM[sim] ||
      SIM.auto || {
        kind: "ok",
        http: "200 OK",
        status: "OK",
        reason: "00",
        message: "OK",
      };

    const resp = {
      status: {
        status: cfg.status,
        reason: cfg.reason,
        message: cfg.message,
        date: new Date().toISOString(),
      },
      reference: $("#fRef")?.value || "",
      service: ep,
    };

    const kind = cfg.kind || "ok";
    $("#sdot").className = `sdot ${kind}`;
    $("#stext").textContent = cfg.http;
    $("#respBody").innerHTML = colorize(resp);
    $("#respBody").style.display = "block";

    $("#rcode").textContent = cfg.http;
    $("#rcode").className = `rcode ${kind}`;
    $("#rtime").textContent = `${ms}ms`;
    $("#rgw").textContent = ep;
    $("#respMeta").style.display = "flex";

    btn.disabled = false;
    btn.innerHTML = '<i class="bi bi-send-fill"></i> Enviar request';
  }, 600);
}

export function clearResp() {
  $("#respEmpty").style.display = "flex";
  $("#respBody").style.display = "none";
  $("#respMeta").style.display = "none";
  $("#sdot").className = "sdot idle";
  $("#stext").textContent = "En espera";
}
