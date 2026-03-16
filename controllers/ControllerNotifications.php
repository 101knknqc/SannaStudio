<?php
class ControllerNotifications extends Controller {
    public function __construct(array $url) {
        $this->requireAuth();
        header('Content-Type: application/json');
        $userId = Session::getUserId();
        $nm = new NotificationManager();
        $action = $url[1] ?? 'list';

        if ($action === 'markread') {
            $nm->markAllRead($userId);
            echo json_encode(['success'=>true]); exit;
        }

        $notifs = $nm->getByUser($userId, 15);
        $unread = $nm->countUnreadForUser($userId);
        echo json_encode([
            'success' => true,
            'unread'  => $unread,
            'items'   => array_map(fn($n) => [
                'id'      => $n->getId(),
                'type'    => $n->getType(),
                'title'   => $n->getTitle(),
                'body'    => $n->getBody(),
                'link'    => $n->getLink(),
                'read'    => $n->isRead(),
                'time'    => $n->getCreatedAt(),
            ], $notifs),
        ]);
        exit;
    }
}
