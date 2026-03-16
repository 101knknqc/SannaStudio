<?php
class ClientManager extends Model {
    protected $_table = 'clients';
    protected $_obj   = 'Client';

    public function getByEmail(string $email): ?Client {
        $rows = $this->getBy(['email' => $email], 1);
        return $rows[0] ?? null;
    }

    public function getByToken(string $token): ?Client {
        $rows = $this->getBy(['token_verify' => $token], 1);
        return $rows[0] ?? null;
    }

    public function getByResetToken(string $token): ?Client {
        $sql = $this->getDb()->prepare(
            "SELECT * FROM `{$this->_table}` WHERE token_reset=? AND token_reset_exp > NOW() LIMIT 1"
        );
        $sql->execute([$token]);
        $r = $sql->fetch(PDO::FETCH_ASSOC);
        return $r ? new Client($r) : null;
    }

    public function create(array $data): int {
        $token = bin2hex(random_bytes(32));
        return $this->insert([
            'prenom'           => $data['prenom'],
            'nom'              => $data['nom'],
            'email'            => $data['email'],
            'telephone'        => $data['telephone'] ?? null,
            'password_hash'    => password_hash($data['password'], PASSWORD_BCRYPT),
            'token_verify'     => $token,
            'email_verified'   => 0,
            'accepte_cgu'      => 1,
            'accepte_politique'=> 1,
        ]);
    }

    public function verifyEmail(int $id): bool {
        return $this->updateById($id, ['email_verified' => 1, 'token_verify' => null]);
    }

    public function setResetToken(int $id, string $token): bool {
        return $this->updateById($id, [
            'token_reset'     => $token,
            'token_reset_exp' => date('Y-m-d H:i:s', strtotime('+1 hour')),
        ]);
    }

    public function updatePassword(int $id, string $newPassword): bool {
        return $this->updateById($id, [
            'password_hash'   => password_hash($newPassword, PASSWORD_BCRYPT),
            'token_reset'     => null,
            'token_reset_exp' => null,
        ]);
    }

    public function countAll(): int {
        return (int)$this->getDb()->query("SELECT COUNT(*) FROM `{$this->_table}`")->fetchColumn();
    }

    public function getById(int $id): ?Client {
        $rows = $this->getBy(['id' => $id], 1);
        return $rows[0] ?? null;
    }

    public function getTokenVerifyFor(int $id): string {
        $sql = $this->getDb()->prepare("SELECT token_verify FROM `{$this->_table}` WHERE id=?");
        $sql->execute([$id]);
        return $sql->fetchColumn() ?? '';
    }
}