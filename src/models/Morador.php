<?php
/**
 * Classe gerada automaticamente a partir da tabela `morador`
 */
class Morador {
    public $id; // int(11)
    public $id_comissao_de_moradores; // int(11)
    public $id_ecoponto; // int(11)
    public $nome; // varchar(100)
    public $documento_id; // varchar(45)
    public $documento_nome; // varchar(45)
    public $documento_ficheiro; // varchar(120)
    public $nivel_de_renda; // varchar(45)
    public $contactos_telefonicos; // varchar(45)
    public $email; // varchar(45)
    public $nome_da_rua; // varchar(45)
    public $numero_da_casa; // varchar(45)
    public $zona; // varchar(45)

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Retorna todos os registros
    public function findAll() {
        $stmt = $this->pdo->query("SELECT * FROM `morador`");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Busca por ID
    public function findById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM `morador` WHERE `id` = :id LIMIT 1");
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
            $stmt = $this->pdo->prepare("UPDATE `morador` SET $set WHERE `id` = :id");
            foreach ($props as $k => $v) $stmt->bindValue(":".$k, $v);
            $stmt->bindValue(':id', $this->id);
            return $stmt->execute();
        } else {
            // Insere
            $fields = implode(', ', $keys);
            $placeholders = ':' . implode(', :', $keys);
            $stmt = $this->pdo->prepare("INSERT INTO `morador` ($fields) VALUES ($placeholders)");
            foreach ($props as $k => $v) $stmt->bindValue(":".$k, $v);
            $stmt->execute();
            $this->id = $this->pdo->lastInsertId();
            return true;
        }
    }

    // Deleta por ID
    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM `morador` WHERE `id` = :id");
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }
}