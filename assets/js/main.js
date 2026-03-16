const nav = document.querySelector('nav');
window.addEventListener('scroll', () => nav.classList.toggle('scrolled', window.scrollY > 50));

const hamburger = document.querySelector('.hamburger');
const navLinks = document.querySelector('.nav-links');
hamburger?.addEventListener('click', () => navLinks.classList.toggle('open'));
document.querySelectorAll('.nav-links a').forEach(a => a.addEventListener('click', () => navLinks.classList.remove('open')));

const reveals = document.querySelectorAll('.reveal');
const observer = new IntersectionObserver((entries) => {
  entries.forEach((e, i) => {
    if (e.isIntersecting) { setTimeout(() => e.target.classList.add('visible'), i * 80); observer.unobserve(e.target); }
  });
}, { threshold: 0.1 });
reveals.forEach(el => observer.observe(el));

const rdvForm = document.getElementById('rdv-form');
rdvForm?.addEventListener('submit', async (e) => {
  e.preventDefault();
  const btn = rdvForm.querySelector('.form-submit');
  const msg = document.getElementById('rdv-msg');
  btn.textContent = 'Envoi en cours…'; btn.disabled = true;
  try {
    const fd = new FormData(rdvForm);
    // Combine checkbox values into a single string
    const plateformes = [...rdvForm.querySelectorAll('input[name="plateformes[]"]:checked')].map(cb => cb.value);
    fd.delete('plateformes[]');
    fd.append('plateformes', plateformes.length ? plateformes.join(', ') : 'Non précisées');
    const res = await fetch('/rdv', { method: 'POST', body: fd });
    const json = await res.json();
    msg.style.display = 'block';
    if (json.success) {
      msg.className = 'form-msg success'; msg.textContent = '✓ Demande reçue ! Nous vous contacterons sous 24h.'; rdvForm.reset();
    } else {
      msg.className = 'form-msg error'; msg.textContent = '✕ Erreur : ' + (json.error || 'Veuillez réessayer.');
    }
  } catch { msg.style.display = 'block'; msg.className = 'form-msg error'; msg.textContent = '✕ Erreur de connexion. Veuillez réessayer.'; }
  btn.textContent = 'Envoyer la demande'; btn.disabled = false;
});

const devisItems = [
  { id: 'tournage_d', name: 'Tournage événementiel (demi-journée)', price: 350 },
  { id: 'tournage_j', name: 'Tournage événementiel (journée complète)', price: 600 },
  { id: 'drone', name: 'Prise de vue drone', price: 200 },
  { id: 'multistream', name: 'Diffusion multi-plateformes simultanée', price: 150 },
  { id: 'obs_config', name: 'Configuration OBS Studio avancée', price: 180 },
  { id: 'install', name: 'Installation permanente (poste complet)', price: 800 },
  { id: 'formation', name: 'Formation du personnel (demi-journée)', price: 250 },
  { id: 'maintenance', name: 'Maintenance mensuelle', price: 120 },
];

function buildDevis() {
  const tbody = document.getElementById('devis-items');
  if (!tbody) return;
  tbody.innerHTML = devisItems.map(item => `
    <div class="devis-row">
      <span class="devis-item-name">${item.name}</span>
      <input type="number" class="devis-item-qty" value="0" min="0" max="99" data-id="${item.id}" data-price="${item.price}" onchange="updateDevisTotal()">
      <span style="text-align:right;font-family:'Space Mono',monospace;font-size:13px;color:#666;">${item.price.toLocaleString('fr-CA')} $/u</span>
      <span class="devis-item-total" id="total-${item.id}">—</span>
    </div>`).join('');
  updateDevisTotal();
}

function updateDevisTotal() {
  let subtotal = 0;
  devisItems.forEach(item => {
    const qty = parseInt(document.querySelector(`[data-id="${item.id}"]`)?.value || 0);
    const line = qty * item.price; subtotal += line;
    const el = document.getElementById(`total-${item.id}`);
    if (el) el.textContent = line > 0 ? line.toLocaleString('fr-CA') + ' $' : '—';
  });
  let total = subtotal;
  const opts = [
    { id: 'deplacement', add: 75 },
    { id: 'son', add: 150 },
    { id: 'longt', discount: 0.1 },
    { id: 'urgence', surcharge: 0.25 },
  ];
  opts.forEach(opt => {
    const cb = document.getElementById('opt-' + opt.id);
    if (!cb?.checked) return;
    if (opt.add) total += opt.add;
    if (opt.discount) total *= (1 - opt.discount);
    if (opt.surcharge) total *= (1 + opt.surcharge);
  });
  const el = document.getElementById('devis-total');
  if (el) el.textContent = Math.round(total).toLocaleString('fr-CA') + ' $';
}

function generateDevis() {
  const clientName = document.getElementById('client-nom')?.value || 'Client';
  const clientEmail = document.getElementById('client-email')?.value || '';
  const total = document.getElementById('devis-total')?.textContent || '0 $';
  const lines = devisItems.map(item => {
    const qty = parseInt(document.querySelector(`[data-id="${item.id}"]`)?.value || 0);
    if (!qty) return null;
    return { name: item.name, qty, price: item.price, total: qty * item.price };
  }).filter(Boolean);
  if (!lines.length) { alert('Ajoutez au moins un service au devis.'); return; }
  const date = new Date().toLocaleDateString('fr-CA');
  const devisNum = 'SST-' + Date.now().toString().slice(-6);

  // Remove old modal if exists
  document.getElementById('devis-modal')?.remove();

  const modal = document.createElement('div');
  modal.id = 'devis-modal';
  modal.innerHTML = `
    <div class="devis-modal-overlay" id="devis-modal-overlay">
      <div class="devis-modal-box">
        <button class="devis-modal-close" onclick="document.getElementById('devis-modal').remove()">✕</button>
        <div class="devis-modal-header">
          <div>
            <h2 class="devis-modal-brand">SANNA<span>STUDIO</span></h2>
            <p class="devis-modal-sub">Webdiffusion &amp; Intégration Audiovisuelle</p>
          </div>
          <div class="devis-modal-meta">
            <strong>DEVIS ${devisNum}</strong>
            <span>Date : ${date}</span>
            <span>Client : ${clientName}</span>
            ${clientEmail ? `<span>${clientEmail}</span>` : ''}
          </div>
        </div>
        <table class="devis-modal-table">
          <thead><tr><th>Service</th><th>Qté</th><th>Prix/u</th><th>Total</th></tr></thead>
          <tbody>
            ${lines.map(l => `<tr><td>${l.name}</td><td>${l.qty}</td><td>${l.price.toLocaleString('fr-CA')} $</td><td>${l.total.toLocaleString('fr-CA')} $</td></tr>`).join('')}
            <tr class="devis-modal-total-row"><td colspan="3">TOTAL ESTIMÉ</td><td>${total}</td></tr>
          </tbody>
        </table>
        <p class="devis-modal-note">* Devis indicatif valable 30 jours — <strong>contact@ssp.en.gp</strong></p>
        <div class="devis-modal-actions">
          <button onclick="window.print()" class="devis-modal-print">🖨 Imprimer / PDF</button>
          <button onclick="document.getElementById('devis-modal').remove()" class="devis-modal-cancel">Fermer</button>
        </div>
      </div>
    </div>`;
  document.body.appendChild(modal);
  document.getElementById('devis-modal-overlay').addEventListener('click', (e) => {
    if (e.target === e.currentTarget) modal.remove();
  });
}

// (init handled below)

// ── PROCESS DOT — SCROLL TRIGGERED ──
function initProcessDot() {
  const dot = document.querySelector('.process-dot-moving');
  const wrapper = document.querySelector('.process-wrapper');
  if (!dot || !wrapper) return;

  let triggered = false;
  let loopTimer = null;

  function runDot() {
    // Reset
    dot.style.transition = 'none';
    dot.style.left = '-3%';
    dot.classList.remove('dot-active');

    // Force reflow
    void dot.offsetWidth;

    // Animate
    dot.style.transition = 'left 2s cubic-bezier(0.25, 0.46, 0.45, 0.94), opacity 0.3s ease';
    dot.classList.add('dot-active');

    requestAnimationFrame(() => {
      requestAnimationFrame(() => {
        dot.style.left = '103%';
      });
    });

    // Loop: restart after 3.2s
    loopTimer = setTimeout(() => {
      dot.style.transition = 'opacity 0.3s ease';
      dot.classList.remove('dot-active');
      setTimeout(runDot, 400);
    }, 3200);
  }

  const scrollObs = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting && !triggered) {
        triggered = true;
        runDot();
      } else if (!entry.isIntersecting) {
        // Reset when scrolled out so it re-triggers on next scroll in
        triggered = false;
        clearTimeout(loopTimer);
        dot.style.transition = 'none';
        dot.style.left = '-3%';
        dot.classList.remove('dot-active');
      }
    });
  }, { threshold: 0.4 });

  scrollObs.observe(wrapper);
}

// init consolidated below

// ── PROCESS STICKY SCROLL TIMELINE ──
const STEPS = [
  {
    num: '01', title: 'Consultation', icon: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg>',
    desc: 'On prend le temps de comprendre votre projet, vos besoins techniques et vos objectifs de diffusion.',
    details: [
      { icon: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>', label: 'Analyse du lieu', sub: 'Contraintes techniques & acoustiques' },
      { icon: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg>', label: 'Choix des plateformes', sub: 'YouTube, TikTok, Facebook, Zoom…' },
      { icon: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z"/><circle cx="12" cy="13" r="3"/></svg>', label: 'Évaluation du matériel', sub: 'Inventaire & recommandations' },
      { icon: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>', label: 'Budget & calendrier', sub: 'Estimation transparente' },
    ]
  },
  {
    num: '02', title: 'Planification', icon: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="2" width="6" height="4" rx="1"/><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><path d="M12 11h4"/><path d="M12 16h4"/><path d="M8 11h.01"/><path d="M8 16h.01"/></svg>',
    desc: 'On prépare chaque détail avant le jour J — devis précis, plan de câblage et configuration OBS.',
    details: [
      { icon: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>', label: 'Devis détaillé', sub: 'Transparent, sans surprise' },
      { icon: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="3 6 9 3 15 6 21 3 21 18 15 21 9 18 3 21"/><line x1="9" y1="3" x2="9" y2="18"/><line x1="15" y1="6" x2="15" y2="21"/></svg>', label: 'Schéma technique', sub: 'Plan de câblage & disposition' },
      { icon: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>', label: 'Config OBS à distance', sub: 'Scènes & encodage pré-paramétrés' },
      { icon: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>', label: "Planning d'installation", sub: 'Horaires & coordination logistique' },
    ]
  },
  {
    num: '03', title: 'Installation', icon: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>',
    desc: 'Déploiement complet sur site — caméras, son, encodage, réseau. Tout est testé avant que le live commence.',
    details: [
      { icon: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2" ry="2"/></svg>', label: 'Caméras & câblage', sub: 'Installation et positionnement' },
      { icon: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"/><path d="M19.07 4.93a10 10 0 0 1 0 14.14M15.54 8.46a5 5 0 0 1 0 7.07"/></svg>', label: 'Audio multi-piste', sub: 'Micros, mixage & monitoring' },
      { icon: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1.42 9a16 16 0 0 1 21.16 0"/><path d="M5 12.55a11 11 0 0 1 14.08 0"/><path d="M10.54 16.1a6 6 0 0 1 2.92 0"/><line x1="12" y1="20" x2="12.01" y2="20"/></svg>', label: 'Réseau & bande passante', sub: 'Tests de débit & stabilité' },
      { icon: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" y1="21" x2="4" y2="14"/><line x1="4" y1="10" x2="4" y2="3"/><line x1="12" y1="21" x2="12" y2="12"/><line x1="12" y1="8" x2="12" y2="3"/><line x1="20" y1="21" x2="20" y2="16"/><line x1="20" y1="12" x2="20" y2="3"/><line x1="1" y1="14" x2="7" y2="14"/><line x1="9" y1="8" x2="15" y2="8"/><line x1="17" y1="16" x2="23" y2="16"/></svg>', label: 'Calibration A/V', sub: 'Couleur, exposition & son' },
    ]
  },
  {
    num: '04', title: 'Diffusion', icon: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4.5 16.5c-1.5 1.26-2 5-2 5s3.74-.5 5-2c.71-.84.7-2.13-.09-2.91a2.18 2.18 0 0 0-2.91-.09z"/><path d="m12 15-3-3a22 22 0 0 1 2-3.95A12.88 12.88 0 0 1 22 2c0 2.72-.78 7.5-6 11a22.35 22.35 0 0 1-4 2z"/><path d="M9 12H4s.55-3.03 2-4c1.62-1.08 5 0 5 0"/><path d="M12 15v5s3.03-.55 4-2c1.08-1.62 0-5 0-5"/></svg>',
    desc: "On gère la régie en temps réel — transitions, alertes, qualité du stream. Vous n'avez qu'à performer.",
    details: [
      { icon: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>', label: 'Régie live', sub: 'Caméras, scènes & transitions' },
      { icon: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>', label: 'Monitoring stream', sub: 'Qualité & stabilité en continu' },
      { icon: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>', label: 'Gestion des incidents', sub: 'Réaction immédiate si problème' },
      { icon: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><rect x="8" y="2" width="8" height="4" rx="1" ry="1"/></svg>', label: 'Rapport post-événement', sub: 'Stats, retours & recommandations' },
    ]
  }
];


function initProcessTimeline() {
  const container  = document.getElementById('process-scroll-container');
  const fill       = document.getElementById('ptlFill');
  const dot        = document.getElementById('ptlDot');
  const card       = document.getElementById('ptlCard');
  const cardNum    = document.getElementById('ptlCardNum');
  const cardTitle  = document.getElementById('ptlCardTitle');
  const cardDesc   = document.getElementById('ptlCardDesc');
  const cardDets   = document.getElementById('ptlCardDetails');
  const stepEls    = document.querySelectorAll('.ptl-step');
  const scrollBar  = document.getElementById('processScrollBar');

  if (!container) return;

  const N = STEPS.length; // 4
  let lastStep = -1;
  let rafId = null;
  let currentPct = 0; // pour l'animation fluide

  // ── Mettre à jour l'étape affichée ──
  function setStep(idx) {
    if (idx === lastStep) return;
    lastStep = idx;
    const step = STEPS[idx];

    stepEls.forEach((el, i) => {
      el.classList.remove('active', 'done');
      if (i < idx)  el.classList.add('done');
      if (i === idx) el.classList.add('active');
    });

    // Transition fluide de la card : fade out → swap → fade in
    card.style.opacity = '0';
    card.style.transform = 'translateY(10px)';
    clearTimeout(card._swapTimer);
    card._swapTimer = setTimeout(() => {
      if (cardNum)   cardNum.textContent   = step.num;
      if (cardTitle) cardTitle.textContent = step.title;
      if (cardDesc)  cardDesc.textContent  = step.desc;
      if (cardDets)  cardDets.innerHTML    = step.details.map(d =>
        `<li>
          <span class="ptl-box-icon">${d.icon}</span>
          <span class="ptl-box-text">
            <strong>${d.label}</strong>
            <em>${d.sub}</em>
          </span>
        </li>`
      ).join('');
      card.classList.add('open');
      // Re-afficher avec transition
      requestAnimationFrame(() => {
        card.style.transition = 'opacity .35s ease, transform .35s ease';
        card.style.opacity = '1';
        card.style.transform = 'translateY(0)';
      });
    }, 160);
  }

  // ── Calcul du progrès depuis la position scroll ──
  function getProgress() {
    const rect  = container.getBoundingClientRect();
    const total = container.offsetHeight - window.innerHeight;
    return Math.min(1, Math.max(0, -rect.top / total));
  }

  // ── Boucle RAF pour animation fluide ──
  function animateFrame() {
    const targetPct = getProgress() * 100;
    // Lerp vers la cible (fluidité)
    currentPct += (targetPct - currentPct) * 0.12;
    if (Math.abs(targetPct - currentPct) < 0.05) currentPct = targetPct;

    // Line fill + dot
    if (fill) fill.style.width = currentPct + '%';
    if (dot)  dot.style.left   = currentPct + '%';

    // Barre de progression en bas
    if (scrollBar) scrollBar.style.width = currentPct + '%';

    // Quelle étape ? zones égales
    const stepIdx = Math.min(N - 1, Math.floor((currentPct / 100) * N));
    setStep(stepIdx);

    rafId = requestAnimationFrame(animateFrame);
  }

  // ── Démarrage ──
  setStep(0);
  card.style.opacity = '1';
  card.style.transform = 'translateY(0)';
  card.classList.add('open');
  animateFrame(); // RAF tourne en continu
}

document.addEventListener('DOMContentLoaded', () => {
  buildDevis();
  initProcessDot();
  initProcessTimeline();
});