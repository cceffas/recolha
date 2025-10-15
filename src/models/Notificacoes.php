<?php
/**
 * Classe gerada automaticamente a partir da tabela `notificacoes`
 */
class Notificacoes {
    public $id; // int(11)
    public $id_usuario; // int(11)
    public $sobre; // text
    public $status; // tinyint(1)
    public $data; // int(11)

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Retorna todos os registros
    public function findAll() {
        $stmt = $this->pdo->query("SELECT * FROM `notificacoes`");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Busca por ID
    public function findById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM `notificacoes` WHERE `id` = :id LIMIT 1");
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Salva (insert/update)
    public function save() {
        $props = get_object_vars($this);
        unset($props['pdo']);
        $keys = array_keys($props);
        $values = array_values($props);

        if (!empty($this->id)) {
            // Atualiza
            $set = implode(', ', array_map(fn($k) => "$k = :$k", $keys));
            $stmt = $this->pdo->prepare("UPDATE `notificacoes` SET $set WHERE `id` = :id");
            foreach ($props as $k => $v) $stmt->bindValue(":".$k, $v);
            $stmt->bindValue(':id', $this->id);
            return $stmt->execute();
        } else {
            // Insere
            $fields = implode(', ', $keys);
            $placeholders = ':' . implode(', :', $keys);
            $stmt = $this->pdo->prepare("INSERT INTO `notificacoes` ($fields) VALUES ($placeholders)");
            foreach ($props as $k => $v) $stmt->bindValue(":".$k, $v);
            $stmt->execute();
            $this->id = $this->pdo->lastInsertId();
            return true;
        }
    }

    // Deleta por ID
    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM `notificacoes` WHERE `id` = :id");
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }
}