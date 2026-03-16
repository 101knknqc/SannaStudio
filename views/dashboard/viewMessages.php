<style>
.msg-grid { display:grid; grid-template-columns:280px 1fr; gap:0; border:1px solid var(--border); border-radius:4px; overflow:hidden; min-height:500px; }
.msg-sidebar { background:var(--surface); border-right:1px solid var(--border); display:flex; flex-direction:column; }
.msg-sidebar-header { padding:16px; border-bottom:1px solid var(--border); display:flex; justify-content:space-between; align-items:center; }
.msg-sidebar-header span { font-family:'Oswald',sans-serif; font-size:13px; letter-spacing:1px; text-transform:uppercase; color:#fff; }
.msg-tabs { display:flex; border-bottom:1px solid var(--border); }
.msg-tab { flex:1; padding:10px; text-align:center; font-family:'Oswald',sans-serif; font-size:11px; letter-spacing:1px; text-transform:uppercase; color:#666; cursor:pointer; border-bottom:2px solid transparent; transition:.2s; }
.msg-tab.active { color:var(--accent-h); border-bottom-color:var(--accent); }
.msg-list { flex:1; overflow-y:auto; }
.msg-item { padding:14px 16px; border-bottom:1px solid rgba(255,255,255,.04); cursor:pointer; transition:.15s; text-decoration:none; display:block; }
.msg-item:hover { background:rgba(123,47,190,.08); }
.msg-item.unread { background:rgba(123,47,190,.05); border-left:3px solid var(--accent); }
.msg-item-from { font-size:13px; font-weight:600; color:#ddd; margin-bottom:3px; }
.msg-item-subject { font-size:12px; color:#888; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; margin-bottom:2px; }
.msg-item-time { font-size:10px; color:#555; }
.msg-main { padding:28px; background:var(--surface2); display:flex; flex-direction:column; }
.msg-compose { background:var(--surface); border:1px solid var(--border); border-radius:4px; padding:24px; }
.msg-compose h3 { font-family:'Oswald',sans-serif; font-size:18px; text-transform:uppercase; letter-spacing:1px; margin-bottom:20px; color:#fff; }
.msg-compose .auth-group { margin-bottom:16px; }
.msg-compose label { font-family:'Space Mono',monospace; font-size:11px; letter-spacing:2px; text-transform:uppercase; color:#666; display:block; margin-bottom:6px; }
.msg-compose input, .msg-compose select, .msg-compose textarea { width:100%; background:var(--surface2); border:1px solid var(--border); color:#fff; padding:12px 14px; font-family:'Rajdhani',sans-serif; font-size:15px; outline:none; transition:.2s; border-radius:2px; }
.msg-compose input:focus, .msg-compose select:focus, .msg-compose textarea:focus { border-color:var(--accent); }
.msg-compose textarea { min-height:120px; resize:vertical; }
.msg-compose select option { background:var(--surface); }
.msg-read { background:var(--surface); border:1px solid var(--border); border-radius:4px; padding:24px; }
.msg-read-header { border-bottom:1px solid var(--border); padding-bottom:16px; margin-bottom:20px; }
.msg-read-subject { font-family:'Oswald',sans-serif; font-size:22px; color:#fff; margin-bottom:8px; }
.msg-read-meta { font-size:12px; color:#666; }
.msg-read-body { color:#ccc; font-size:15px; line-height:1.8; white-space:pre-wrap; }
@media(max-width:768px){ .msg-grid{grid-template-columns:1fr;} .msg-sidebar{min-height:200px;} }
</style>

<div class="db-card" style="padding:0;overflow:hidden">
    <?php if (($tab ?? 'inbox') === 'read' && !empty($message)): ?>
    <!-- Vue lecture message -->
    <div style="padding:20px;border-bottom:1px solid var(--border);display:flex;gap:12px;align-items:center">
        <a href="<?= SITE_URL ?>/messages" class="db-btn-secondary" style="padding:8px 16px;font-size:12px">← Retour</a>
    </div>
    <div style="padding:28px" class="msg-read">
        <div class="msg-read-header">
            <div class="msg-read-subject"><?= htmlspecialchars($message['subject']) ?></div>
            <div class="msg-read-meta">
                De : <strong><?= htmlspecialchars(($message['from_first']??'').' '.($message['from_last']??'')) ?></strong>
                · <?= date('d/m/Y à H:i', strtotime($message['created_at'])) ?>
            </div>
        </div>
        <div class="msg-read-body"><?= htmlspecialchars($message['body']) ?></div>
    </div>
    <?php else: ?>
    <!-- Vue liste + compose -->
    <div class="msg-grid">
        <!-- Sidebar -->
        <div class="msg-sidebar">
            <div class="msg-sidebar-header">
                <span>Messagerie</span>
            </div>
            <div class="msg-tabs">
                <div class="msg-tab <?= ($tab ?? 'inbox') === 'inbox' ? 'active' : '' ?>" onclick="showTab('inbox')">Reçus</div>
                <div class="msg-tab <?= ($tab ?? '') === 'sent' ? 'active' : '' ?>" onclick="showTab('sent')">Envoyés</div>
            </div>
            <div class="msg-list" id="msgListInbox" style="display:<?= ($tab ?? 'inbox') === 'inbox' ? 'block' : 'none' ?>">
                <?php if (empty($inbox)): ?>
                    <div style="padding:24px;text-align:center;color:#555;font-size:13px">Aucun message reçu</div>
                <?php else: ?>
                    <?php foreach ($inbox as $m): ?>
                    <a href="<?= SITE_URL ?>/messages/read/<?= $m['id'] ?>" class="msg-item <?= !$m['read_at'] ? 'unread' : '' ?>">
                        <div class="msg-item-from"><?= htmlspecialchars(($m['first_name']??'').' '.($m['last_name']??'')) ?></div>
                        <div class="msg-item-subject"><?= htmlspecialchars($m['subject']) ?></div>
                        <div class="msg-item-time"><?= date('d/m/Y', strtotime($m['created_at'])) ?></div>
                    </a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="msg-list" id="msgListSent" style="display:<?= ($tab ?? '') === 'sent' ? 'block' : 'none' ?>">
                <?php if (empty($sent)): ?>
                    <div style="padding:24px;text-align:center;color:#555;font-size:13px">Aucun message envoyé</div>
                <?php else: ?>
                    <?php foreach ($sent as $m): ?>
                    <div class="msg-item">
                        <div class="msg-item-from">À : <?= htmlspecialchars(($m['first_name']??'').' '.($m['last_name']??'')) ?></div>
                        <div class="msg-item-subject"><?= htmlspecialchars($m['subject']) ?></div>
                        <div class="msg-item-time"><?= date('d/m/Y', strtotime($m['created_at'])) ?></div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Compose -->
        <div class="msg-main">
            <div class="msg-compose">
                <h3>✉ Nouveau message</h3>
                <form method="POST" action="<?= SITE_URL ?>/messages/send">
                    <?= functions::csrfField() ?>
                    <div class="auth-group">
                        <label>Destinataire</label>
                        <select name="to_id" required>
                            <option value="">Choisir…</option>
                            <?php foreach (($admins ?? []) as $admin): ?>
                                <option value="<?= $admin->getId() ?>"><?= htmlspecialchars($admin->getFullName()) ?> (Équipe SannaStudio)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="auth-group">
                        <label>Sujet</label>
                        <input type="text" name="subject" placeholder="Votre sujet…" required>
                    </div>
                    <div class="auth-group">
                        <label>Message</label>
                        <textarea name="body" placeholder="Écrivez votre message…" required></textarea>
                    </div>
                    <button type="submit" class="auth-btn" style="margin-top:8px">Envoyer →</button>
                </form>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<script>
function showTab(tab) {
    document.getElementById('msgListInbox').style.display = tab === 'inbox' ? 'block' : 'none';
    document.getElementById('msgListSent').style.display  = tab === 'sent'  ? 'block' : 'none';
    document.querySelectorAll('.msg-tab').forEach((el, i) => el.classList.toggle('active', (i === 0 && tab==='inbox') || (i===1 && tab==='sent')));
}
</script>
