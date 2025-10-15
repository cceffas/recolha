<?php
/**
 * Classe gerada automaticamente a partir da tabela `instituicao`
 */
class Instituicao {
    public $id; // int(11)
    public $id_bairro; // int(11)
    public $nome; // varchar(100)
    public $nif; // varchar(45)
    public $endereco; // varchar(100)
    public $rua; // varchar(45)
    public $zona; // varchar(45)
    public $numero_da_casa; // varchar(45)
    public $tipo_de_instituicao; // varchar(60)
    public $especificacao_da_actividade; // varchar(45)
    public $classificacao_da_empresa; // varchar(45)
    public $contactos_telefonicos; // varchar(45)
    public $emails; // varchar(60)
    public $site; // varchar(45)
    public $ano_de_inicio_da_actividade; // varchar(45)
    public $tipo_de_lixo_que_produz; // varchar(45)

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Retorna todos os registros
    public function findAll() {
        $stmt = $this->pdo->query("SELECT * FROM `instituicao`");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Busca por ID
    public function findById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM `instituicao` WHERE `id` = :id LIMIT 1");
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
            $stmt = $this->pdo->prepare("UPDATE `instituicao` SET $set WHERE `id` = :id");
            foreach ($props as $k => $v) $stmt->bindValue(":".$k, $v);
            $stmt->bindValue(':id', $this->id);
            return $stmt->execute();
        } else {
            // Insere
            $fields = implode(', ', $keys);
            $placeholders = ':' . implode(', :', $keys);
            $stmt = $this->pdo->prepare("INSERT INTO `instituicao` ($fields) VALUES ($placeholders)");
            foreach ($props as $k => $v) $stmt->bindValue(":".$k, $v);
            $stmt->execute();
            $this->id = $this->pdo->lastInsertId();
            return true;
        }
    }

    // Deleta por ID
    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM `instituicao` WHERE `id` = :id");
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }
}