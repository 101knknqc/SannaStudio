<?php
class RdvManager extends Model {
    protected $_table = 'rdv_demandes';
    protected $_obj   = 'RdvDemande';

    public function create(array $data): int {
        return $this->insert([
            'client_id'      => $data['client_id'] ?? null,
            'nom'            => $data['nom'],
            'email'          => $data['email'],
            'telephone'      => $data['telephone'] ?? null,
            'service'        => $data['service'],
            'date_souhaitee' => $data['date'] ?? null,
            'duree'          => $data['duree'] ?? null,
            'plateformes'    => $data['plateformes'] ?? null,
            'message'        => $data['message'],
            'statut'         => 'nouveau',
        ]);
    }

    public function getByClient(int $clientId): array {
        return $this->getBy(['client_id' => $clientId]);
    }

    public function countNew(): int {
        return (int)$this->getDb()
            ->query("SELECT COUNT(*) FROM `{$this->_table}` WHERE statut='nouveau'")
            ->fetchColumn();
    }

    public function getRecent(int $limit = 10): array {
        $sql = $this->getDb()->prepare(
            "SELECT * FROM `{$this->_table}` ORDER BY created_at DESC LIMIT $limit"
        );
        $sql->execute();
        $rows = [];
        while ($r = $sql->fetch(PDO::FETCH_ASSOC)) $rows[] = new RdvDemande($r);
        return $rows;
    }
}
