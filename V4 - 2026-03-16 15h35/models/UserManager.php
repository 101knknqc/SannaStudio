<?php
class UserManager extends Model {
    protected $_table = 'users';
    protected $_obj   = 'User';

    public function getById(int $id): ?User {
        $sql = $this->getDb()->prepare("SELECT * FROM `{$this->_table}` WHERE id=? LIMIT 1");
        $sql->execute([$id]);
        $r = $sql->fetch(PDO::FETCH_ASSOC);
        return $r ? new User($r) : null;
    }

    public function getByEmail(string $email): ?User {
        $sql = $this->getDb()->prepare("SELECT * FROM `{$this->_table}` WHERE email=? LIMIT 1");
        $sql->execute([$email]);
        $r = $sql->fetch(PDO::FETCH_ASSOC);
        return $r ? new User($r) : null;
    }

    public function getByEmailToken(string $token): ?User {
        $sql = $this->getDb()->prepare("SELECT * FROM `{$this->_table}` WHERE email_token=? LIMIT 1");
        $sql->execute([$token]);
        $r = $sql->fetch(PDO::FETCH_ASSOC);
        return $r ? new User($r) : null;
    }

    public function getByResetToken(string $token): ?User {
        $sql = $this->getDb()->prepare(
            "SELECT * FROM `{$this->_table}` WHERE reset_token=? AND reset_token_exp > NOW() LIMIT 1"
        );
        $sql->execute([$token]);
        $r = $sql->fetch(PDO::FETCH_ASSOC);
        return $r ? new User($r) : null;
    }

    public function create(array $data): int {
        $token = bin2hex(random_bytes(32));
        return $this->insert([
            'first_name'       => $data['first_name'],
            'last_name'        => $data['last_name'],
            'email'            => $data['email'],
            'phone'            => $data['phone'] ?? null,
            'password_hash'    => password_hash($data['password'], PASSWORD_BCRYPT),
            'email_token'      => $token,
            'email_verified'   => 0,
            'accepted_tos'     => 1,
            'accepted_privacy' => 1,
        ]);
    }

    public function getEmailToken(int $id): string {
        $sql = $this->getDb()->prepare("SELECT email_token FROM `{$this->_table}` WHERE id=?");
        $sql->execute([$id]);
        return $sql->fetchColumn() ?? '';
    }

    public function verifyEmail(int $id): bool {
        return $this->updateById($id, ['email_verified' => 1, 'email_token' => null]);
    }

    public function recordLogin(int $id, string $ip): void {
        $this->updateById($id, [
            'last_login_at' => date('Y-m-d H:i:s'),
            'last_login_ip' => $ip,
        ]);
    }

    public function setResetToken(int $id, string $token): bool {
        return $this->updateById($id, [
            'reset_token'     => $token,
            'reset_token_exp' => date('Y-m-d H:i:s', strtotime('+1 hour')),
        ]);
    }

    public function updatePassword(int $id, string $password): bool {
        return $this->updateById($id, [
            'password_hash'   => password_hash($password, PASSWORD_BCRYPT),
            'reset_token'     => null,
            'reset_token_exp' => null,
        ]);
    }

    public function countAll(): int {
        return (int)$this->getDb()->query("SELECT COUNT(*) FROM `{$this->_table}`")->fetchColumn();
    }


    public function getAll(): array {
        $sql = $this->getDb()->query("SELECT * FROM `{$this->_table}` ORDER BY created_at DESC");
        $rows = [];
        while ($r = $sql->fetch(PDO::FETCH_ASSOC)) $rows[] = new User($r);
        return $rows;
    }

    public function getRecent(int $limit = 5): array {
        $sql = $this->getDb()->prepare("SELECT * FROM `{$this->_table}` ORDER BY created_at DESC LIMIT $limit");
        $sql->execute();
        $rows = [];
        while ($r = $sql->fetch(PDO::FETCH_ASSOC)) $rows[] = new User($r);
        return $rows;
    }

    public function setRole(int $id, string $role): bool {
        return $this->updateById($id, ['role' => $role]);
    }}