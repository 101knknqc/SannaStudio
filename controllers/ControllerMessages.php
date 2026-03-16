<?php
class ControllerMessages extends Controller {
    public function __construct(array $url) {
        $this->requireAuth();
        $mm   = new MessageManager();
        $userId = Session::getUserId();
        $sub  = $url[1] ?? 'inbox';

        if ($sub === 'send' && functions::isPost()) {
            if (!functions::verifyCsrf()) { Session::flash('error','Token invalide.'); functions::redirect('messages'); }
            $toId   = (int)functions::post('to_id');
            $subj   = trim(functions::post('subject'));
            $body   = trim(functions::post('body'));
            if (!$toId || !$subj || !$body) { Session::flash('error','Tous les champs sont requis.'); functions::redirect('messages'); }
            $mm->send($userId, $toId, $subj, $body);
            // Notifier le destinataire
            $nm = new NotificationManager();
            $um = new UserManager();
            $me = $um->getById($userId);
            $nm->create($toId, 'message', 'Nouveau message de '.$me->getFirstName(), mb_substr($body,0,80), SITE_URL.'/messages');
            Session::flash('success','Message envoyé !');
            functions::redirect('messages');
        }

        if ($sub === 'read' && isset($url[2])) {
            $msg = $mm->getById((int)$url[2]);
            if ($msg && $msg['to_id'] == $userId) $mm->markRead((int)$url[2], $userId);
            $this->setView('Messages', ['tab'=>'read','message'=>$msg,'flash'=>Session::getFlash()], true, 'Messagerie — SannaStudio', 'dashboard');
            return;
        }

        $inbox = $mm->getInbox($userId);
        $sent  = $mm->getSent($userId);
        $um    = new UserManager();
        // Admins disponibles pour contacter
        $admins = array_filter($um->getAll(), fn($u) => $u->isAdmin());

        $this->setView('Messages', [
            'tab'    => $sub,
            'inbox'  => $inbox,
            'sent'   => $sent,
            'admins' => array_values($admins),
            'flash'  => Session::getFlash(),
        ], true, 'Messagerie — SannaStudio', 'dashboard');
    }
}
