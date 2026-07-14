import {
  $,
  $$,
  colorize,
  getSelectedOptionValue,
  safeJsonParse,
  copyToClipboard,
} from "../../core/utils.js";
import { URLS } from "../../core/constants.js";

export function initRequest(state) {
  if (!state.currentTab) state.currentTab = "preview";
  if (!state.card) state.card = "4111111111111111";
  if (!state.lastBody) state.lastBody = {};

  bindRequestEvents(state);

  return {
    updateAll: () => updateAll(state),
    buildBody: () => buildBody(state),
    genAuth: () => genAuth(),
    setTab: (tab, el) => setTab(state, tab, el),
    resetBody: () => resetBody(state),
    beautify: () => beautify(state),
    copyJson: (event) => copyJson(state, event),
  };
}

function bindRequestEvents(state) {
  $("#btnResetBody")?.addEventListener("click", () => resetBody(state));
  $("#btnBeautify")?.addEventListener("click", () => beautify(state));
  $("#btnCopyJson")?.addEventListener("click", (e) => copyJson(state, e));

  $$(".json-tab[data-tab]").forEach((tabEl) => {
    tabEl.addEventListener("click", () =>
      setTab(state, tabEl.dataset.tab, tabEl),
    );
  });
}

export function initEditor(state) {
  const textarea = $("#jsonEditor");
  if (!textarea || typeof CodeMirror === "undefined") return;

  state.cmEditor = CodeMirror.fromTextArea(textarea, {
    mode: "application/json",
    lineNumbers: true,
    lineWrapping: true,
    indentUnit: 2,
    tabSize: 2,
  });

  state.cmEditor.on("change", () => {
    const parsed = safeJsonParse(state.cmEditor.getValue(), null);
    if (!parsed) return;
    state.lastBody = parsed;
    if (state.currentTab === "preview")
      $("#jsonPreview").innerHTML = colorize(state.lastBody);
  });
}

export function genAuth() {
  const seed = new Date().toISOString();
  const nonce = (
    Math.random().toString(36).slice(2) + Math.random().toString(36).slice(2)
  ).slice(0, 32);
  const nonceB64 = btoa(nonce);
  const tranKey = btoa(nonce + seed).slice(0, 44) + "==";

  $("#fSeed") && ($("#fSeed").value = seed);
  $("#fNonce") && ($("#fNonce").value = nonceB64.slice(0, 20) + "...");
  $("#fTranKey") && ($("#fTranKey").value = tranKey.slice(0, 20) + "...");

  return { login: $("#fLogin")?.value || "", tranKey, nonce: nonceB64, seed };
}

export function buildBody(state) {
  const auth = genAuth();
  const ref = $("#fRef")?.value || "";
  const desc = $("#fDesc")?.value || "";
  const cur = $("#fCurrency")?.value || "COP";
  const amt = parseFloat($("#fAmount")?.value || 0) || 0;
  const ep = getSelectedOptionValue("serviceOption");

  if (ep === "gw_process") {
    return {
      auth,
      payer: {
        name: "Usuario Demo",
        surname: "Plance",
        email: "demo@plance.co",
      },
      payment: {
        reference: ref,
        description: desc,
        amount: { currency: cur, total: amt },
      },
      instrument: {
        card: { number: state.card, expiration: "12/26", cvv: "123" },
      },
    };
  }

  if (ep === "link") {
    return {
      auth,
      reference: ref,
      description: desc,
      payment: { amount: { currency: cur, total: amt } },
    };
  }

  return {
    auth,
    payment: {
      reference: ref,
      description: desc,
      amount: { currency: cur, total: amt },
    },
    returnUrl: "https://tu-sitio.com/retorno",
  };
}

export function updateAll(state) {
  if (state.currentTab !== "edit") {
    state.lastBody = buildBody(state);
  }

  const ep = getSelectedOptionValue("serviceOption");
  $("#urlDisplay") &&
    ($("#urlDisplay").textContent = URLS[ep] || "https://docs.placetopay.dev/");

  if (state.currentTab === "preview")
    $("#jsonPreview").innerHTML = colorize(state.lastBody);
  if (state.currentTab === "raw")
    $("#jsonRaw").textContent = JSON.stringify(state.lastBody, null, 2);
}

export function resetBody(state) {
  state.lastBody = buildBody(state);
  if (state.currentTab === "edit" && state.cmEditor)
    state.cmEditor.setValue(JSON.stringify(state.lastBody, null, 2));
  updateAll(state);
}

export function beautify(state) {
  const rawTab = $$('.json-tab[data-tab="raw"]')[0];
  if (rawTab) setTab(state, "raw", rawTab);
  $("#jsonRaw") &&
    ($("#jsonRaw").textContent = JSON.stringify(state.lastBody, null, 2));
}

export function setTab(state, tab, el) {
  state.currentTab = tab;
  $$(".json-tab").forEach((t) => t.classList.remove("active"));
  el?.classList.add("active");

  $("#jsonPreview").style.display = "none";
  $("#jsonRaw").style.display = "none";
  $("#editorContainer").classList.remove("active");
  $("#editBanner").classList.remove("show");

  if (tab === "preview") {
    $("#jsonPreview").style.display = "block";
    $("#jsonPreview").innerHTML = colorize(state.lastBody);
  } else if (tab === "raw") {
    $("#jsonRaw").style.display = "block";
    $("#jsonRaw").textContent = JSON.stringify(state.lastBody, null, 2);
  } else if (tab === "edit") {
    $("#editorContainer").classList.add("active");
    $("#editBanner").classList.add("show");
    if (state.cmEditor) {
      state.cmEditor.setValue(JSON.stringify(state.lastBody, null, 2));
      setTimeout(() => state.cmEditor?.refresh?.(), 80);
    }
  }
}

export async function copyJson(state, event) {
  await copyToClipboard(JSON.stringify(state.lastBody, null, 2));
  const btn = event?.currentTarget || $("#btnCopyJson");
  if (!btn) return;
  const old = btn.innerHTML;
  btn.innerHTML = '<i class="bi bi-check2"></i> Copiado!';
  setTimeout(() => (btn.innerHTML = old), 1200);
}
