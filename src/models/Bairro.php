<?php
/**
 * Classe gerada automaticamente a partir da tabela `bairro`
 */
class Bairro {
    public $id; // int(11)
    public $nome; // varchar(100)
    public $extensao; // varchar(45)
    public $qtd_habitantes; // varchar(45)
    public $qtd_ruas; // varchar(45)
    public $descricao; // varchar(255)
    public $area; // varchar(60)

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Retorna todos os registros
    public function findAll() {
        $stmt = $this->pdo->query("SELECT * FROM `bairro`");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Busca por ID
    public function findById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM `bairro` WHERE `id` = :id LIMIT 1");
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
            $stmt = $this->pdo->prepare("UPDATE `bairro` SET $set WHERE `id` = :id");
            foreach ($props as $k => $v) $stmt->bindValue(":".$k, $v);
            $stmt->bindValue(':id', $this->id);
            return $stmt->execute();
        } else {
            // Insere
            $fields = implode(', ', $keys);
            $placeholders = ':' . implode(', :', $keys);
            $stmt = $this->pdo->prepare("INSERT INTO `bairro` ($fields) VALUES ($placeholders)");
            foreach ($props as $k => $v) $stmt->bindValue(":".$k, $v);
            $stmt->execute();
            $this->id = $this->pdo->lastInsertId();
            return true;
        }
    }

    // Deleta por ID
    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM `bairro` WHERE `id` = :id");
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }
}