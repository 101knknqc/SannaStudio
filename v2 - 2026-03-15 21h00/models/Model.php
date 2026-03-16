<?php
abstract class Model {
    private static $db = null;

    private static function setDb(): void {
        self::$db = new PDO(
            'mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8mb4',
            DB_USER, DB_PASS
        );
        self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    protected function getDb(): PDO {
        if (self::$db === null) self::setDb();
        return self::$db;
    }

    protected $_table = null;
    protected $_obj   = null;

    protected function getAll(): array {
        $sql = $this->getDb()->query("SELECT * FROM `{$this->_table}` ORDER BY id DESC");
        $rows = [];
        while ($r = $sql->fetch(PDO::FETCH_ASSOC)) $rows[] = new $this->_obj($r);
        return $rows;
    }

    protected function getById(int $id) {
        $sql = $this->getDb()->prepare("SELECT * FROM `{$this->_table}` WHERE id=?");
        $sql->execute([$id]);
        if (!$sql->rowCount()) return null;
        return new $this->_obj($sql->fetch(PDO::FETCH_ASSOC));
    }

    protected function getBy(array $by, ?int $limit = null): array {
        $where = []; $params = [];
        foreach ($by as $k => $v) {
            if ($v === null) $where[] = "`$k` IS NULL";
            else { $where[] = "`$k`=:$k"; $params[$k] = $v; }
        }
        $q = "SELECT * FROM `{$this->_table}` WHERE ".implode(' AND ', $where);
        if ($limit) $q .= " LIMIT $limit";
        $sql = $this->getDb()->prepare($q);
        $sql->execute($params);
        $rows = [];
        while ($r = $sql->fetch(PDO::FETCH_ASSOC)) $rows[] = new $this->_obj($r);
        return $rows;
    }

    protected function insert(array $params): int {
        $cols = implode(',', array_map(fn($k) => "`$k`", array_keys($params)));
        $vals = implode(',', array_map(fn($k) => ":$k", array_keys($params)));
        $sql  = $this->getDb()->prepare("INSERT INTO `{$this->_table}` ($cols) VALUES ($vals)");
        $sql->execute($params);
        return (int) $this->getDb()->lastInsertId();
    }

    protected function updateById(int $id, array $params): bool {
        unset($params['id']);
        $sets = implode(',', array_map(fn($k) => "`$k`=:$k", array_keys($params)));
        $sql  = $this->getDb()->prepare("UPDATE `{$this->_table}` SET $sets WHERE id=:id");
        $params['id'] = $id;
        $sql->execute($params);
        return (bool) $sql->rowCount();
    }

    protected function deleteById(int $id): bool {
        $sql = $this->getDb()->prepare("DELETE FROM `{$this->_table}` WHERE id=?");
        $sql->execute([$id]);
        return (bool) $sql->rowCount();
    }

    protected function countAll(): int {
        return (int) $this->getDb()->query("SELECT COUNT(*) FROM `{$this->_table}`")->fetchColumn();
    }
}
