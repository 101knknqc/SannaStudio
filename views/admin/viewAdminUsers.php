<?php
// Traitement du changement de rôle
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['toggle_role'], $_POST['user_id'])) {
    $um     = new UserManager();
    $target = $um->getById((int)$_POST['user_id']);
    if ($target && $target->getId() !== Session::getUserId()) {
        $newRole = $target->isAdmin() ? 'client' : 'admin';
        $um->setRole($target->getId(), $newRole);
        Session::flash('success', htmlspecialchars($target->getFullName()).' est maintenant '.($newRole === 'admin' ? 'Administrateur' : 'Client').'.');
        functions::redirect('admin/users');
    }
}
?>

<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px">
    <div>
        <h2 style="font-family:'Oswald',sans-serif;font-size:1.3rem;color:var(--text);text-transform:uppercase;letter-spacing:.05em">Clients inscrits</h2>
        <p style="color:var(--muted);font-size:.85rem;margin-top:4px"><?= count($users) ?> client<?= count($users) > 1 ? 's' : '' ?> au total</p>
    </div>
</div>

<div class="db-card">
    <input type="text" class="admin-search" placeholder="🔍  Rechercher par nom, email…" id="userSearch" oninput="filterTable('userSearch','userTable')">

    <?php if (empty($users)): ?>
        <div class="db-empty">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
            <p>Aucun client inscrit pour l'instant.</p>
        </div>
    <?php else: ?>
        <table class="admin-table" id="userTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Rôle</th>
                    <th>Email vérifié</th>
                    <th>Dernière connexion</th>
                    <th>IP</th>
                    <th>Inscrit le</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $u): ?>
                <tr>
                    <td style="color:var(--muted);font-size:.8rem"><?= $u->getId() ?></td>
                    <td><strong><?= htmlspecialchars($u->getFullName()) ?></strong></td>
                    <td style="font-size:.85rem"><?= htmlspecialchars($u->getEmail()) ?></td>
                    <td style="font-size:.85rem;color:var(--muted)"><?= htmlspecialchars($u->getPhone() ?? '—') ?></td>
                    <td>
                        <span class="admin-pill <?= $u->isAdmin() ? 'admin' : 'client' ?>">
                            <?= $u->isAdmin() ? '⚙ Admin' : '★ Client' ?>
                        </span>
                    </td>
                    <td>
                        <span class="admin-pill <?= $u->isEmailVerified() ? 'verified' : 'pending' ?>">
                            <?= $u->isEmailVerified() ? '✔ Vérifié' : '⏳ En attente' ?>
                        </span>
                    </td>
                    <td style="font-size:.82rem;color:var(--muted)">
                        <?= $u->getLastLoginAt() ? date('d/m/Y H:i', strtotime($u->getLastLoginAt())) : '—' ?>
                    </td>
                    <td style="font-size:.78rem;color:var(--muted);font-family:monospace">
                        <?= htmlspecialchars($u->getLastLoginIp() ?? '—') ?>
                    </td>
                    <td style="font-size:.82rem;color:var(--muted)"><?= date('d/m/Y', strtotime($u->getCreatedAt())) ?></td>
                    <td>
                        <?php if ($u->getId() === Session::getUserId()): ?>
                            <span style="color:var(--muted);font-size:.75rem;font-family:'Rajdhani',sans-serif">C'est toi</span>
                        <?php else: ?>
                            <form method="POST" action="<?= SITE_URL ?>/admin/users" style="display:inline" onsubmit="return confirm('Changer le rôle de <?= htmlspecialchars($u->getFirstName()) ?> ?')">
                                <?= functions::csrfField() ?>
                                <input type="hidden" name="user_id" value="<?= $u->getId() ?>">
                                <button type="submit" name="toggle_role" value="1"
                                    style="background:<?= $u->isAdmin() ? 'rgba(230,48,48,.12)' : 'var(--accent-glow)' ?>;
                                           color:<?= $u->isAdmin() ? '#ff7070' : 'var(--accent-h)' ?>;
                                           border:1px solid <?= $u->isAdmin() ? 'rgba(230,48,48,.3)' : 'rgba(123,47,190,.35)' ?>;
                                           padding:4px 12px;border-radius:6px;font-size:.72rem;font-weight:700;
                                           font-family:'Oswald',sans-serif;letter-spacing:.06em;text-transform:uppercase;
                                           cursor:pointer;transition:all .15s">
                                    <?= $u->isAdmin() ? '↓ Rétrograder client' : '↑ Promouvoir admin' ?>
                                </button>
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>