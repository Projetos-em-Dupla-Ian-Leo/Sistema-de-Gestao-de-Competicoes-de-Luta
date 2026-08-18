<?php
require_once __DIR__ . '/../util/Conexao.php';
require_once __DIR__ . '/../model/Lutador.php';

class LutadorDAO {
    
    public function salvar(Lutador $lutador) {
        $conn = Conexao::getConexao();
        $stmt = $conn->prepare("INSERT INTO lutadores (nome_ringue, nome_real, estilo, afiliacao, vitorias, derrotas, empates, health, attack, defense, agility) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssiiiiiii", 
            $lutador->getNomeRingue(),
            $lutador->getNomeReal(),
            $lutador->getEstilo(),
            $lutador->getAfiliacao(),
            $lutador->getVitorias(),
            $lutador->getDerrotas(),
            $lutador->getEmpates(),
            $lutador->getHealth(),
            $lutador->getAttack(),
            $lutador->getDefense(),
            $lutador->getAgility()
        );
        $stmt->execute();
        $stmt->close();
        $conn->close();
    }

    public function atualizar(Lutador $lutador) {
        $conn = Conexao::getConexao();
        $stmt = $conn->prepare("UPDATE lutadores SET nome_ringue=?, nome_real=?, estilo=?, afiliacao=?, vitorias=?, derrotas=?, empates=?, health=?, attack=?, defense=?, agility=? WHERE id=?");
        $stmt->bind_param("ssssiiiiiiii", 
            $lutador->getNomeRingue(),
            $lutador->getNomeReal(),
            $lutador->getEstilo(),
            $lutador->getAfiliacao(),
            $lutador->getVitorias(),
            $lutador->getDerrotas(),
            $lutador->getEmpates(),
            $lutador->getHealth(),
            $lutador->getAttack(),
            $lutador->getDefense(),
            $lutador->getAgility(),
            $lutador->getId()
        );
        $stmt->execute();
        $stmt->close();
        $conn->close();
    }

    public function excluir(Lutador $lutador) {
        $conn = Conexao::getConexao();
        $stmt = $conn->prepare("DELETE FROM lutadores WHERE id=?");
        $stmt->bind_param("i", $lutador->getId());
        $stmt->execute();
        $stmt->close();
        $conn->close();
    }

    public function listar() {
        $conn = Conexao::getConexao();
        $sql = "SELECT * FROM lutadores";
        $result = $conn->query($sql);
        
        $lutadores = [];
        while ($row = $result->fetch_assoc()) {
            $lutador = new Lutador();
            $lutador->setId($row['id']);
            $lutador->setNomeRingue($row['nome_ringue']);
            $lutador->setNomeReal($row['nome_real']);
            $lutador->setEstilo($row['estilo']);
            $lutador->setAfiliacao($row['afiliacao']);
            $lutador->setVitorias($row['vitorias']);
            $lutador->setDerrotas($row['derrotas']);
            $lutador->setEmpates($row['empates']);
            $lutador->setHealth($row['health']);
            $lutador->setAttack($row['attack']);
            $lutador->setDefense($row['defense']);
            $lutador->setAgility($row['agility']);
            $lutadores[] = $lutador;
        }
        $conn->close();
        return $lutadores;
    }

    public function buscarPorId(Lutador $lutador) {
        $conn = Conexao::getConexao();
        $stmt = $conn->prepare("SELECT * FROM lutadores WHERE id = ?");
        $id = $lutador->getId();
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($row = $result->fetch_assoc()) {
            $lutadorEncontrado = new Lutador();
            $lutadorEncontrado->setId($row['id']);
            $lutadorEncontrado->setNomeRingue($row['nome_ringue']);
            $lutadorEncontrado->setNomeReal($row['nome_real']);
            $lutadorEncontrado->setEstilo($row['estilo']);
            $lutadorEncontrado->setAfiliacao($row['afiliacao']);
            $lutadorEncontrado->setVitorias($row['vitorias']);
            $lutadorEncontrado->setDerrotas($row['derrotas']);
            $lutadorEncontrado->setEmpates($row['empates']);
            $lutadorEncontrado->setHealth($row['health']);
            $lutadorEncontrado->setAttack($row['attack']);
            $lutadorEncontrado->setDefense($row['defense']);
            $lutadorEncontrado->setAgility($row['agility']);
            return $lutadorEncontrado;
        }
        
        $stmt->close();
        $conn->close();
        return null;
    }
}
?>