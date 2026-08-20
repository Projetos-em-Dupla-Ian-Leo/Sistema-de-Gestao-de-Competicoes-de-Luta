<?php
require_once __DIR__ . '/../model/Lutador.php';
require_once __DIR__ . '/../dao/LutadorDAO.php';

class LutadorController
{
    private $lutadorDAO;

    public function __construct() {
        $this->lutadorDAO = new LutadorDAO();
    }

    public function listar() {
        $ordenacao = $_GET['ordenar'] ?? 'id';
        $direcao = $_GET['dir'] ?? 'asc';

        $lutadores = $this->lutadorDAO->listar();
        $lutadores = $this->aplicarOrdenacao($lutadores, $ordenacao, $direcao);
        $campeao = $this->calcularCampeao($lutadores);
        $dadosView = [
            'lutadores' => $lutadores,
            'ordenacao_atual' => $ordenacao,
            'direcao_atual' => $direcao,
            'campeao' => $campeao,
            'id_buscado' => null, 
            'mensagem' => null,
            'tipoMensagem' => null
        ];
        
        extract($dadosView);
        require_once __DIR__ . '/../view/Lutador_view.php';
    }

    private function aplicarOrdenacao($lutadores, $ordenacao, $direcao) {
        usort($lutadores, function($a, $b) use ($ordenacao, $direcao) {
            $valueA = $this->getValueForSorting($a, $ordenacao);
            $valueB = $this->getValueForSorting($b, $ordenacao);
            
            $result = 0;
            if ($valueA < $valueB) $result = -1;
            if ($valueA > $valueB) $result = 1;
            
            return $direcao === 'desc' ? -$result : $result;
        });
        
        return $lutadores;
    }

    private function getValueForSorting($lutador, $ordenacao) {
        switch ($ordenacao) {
            case 'id':
                return $lutador->getId();
            case 'nome_ringue':
                return $lutador->getNomeRingue();
            case 'nome_real':
                return $lutador->getNomeReal();
            case 'vitorias':
                return $lutador->getVitorias();
            case 'derrotas':
                return $lutador->getDerrotas();
            case 'winrate':
                return $lutador->getTaxaVitoria();
            case 'health':
                return $lutador->getHealth();
            case 'attack':
                return $lutador->getAttack();
            case 'defense':
                return $lutador->getDefense();
            case 'agility':
                return $lutador->getAgility();
            default:
                return $lutador->getId();
        }
    }

    private function calcularCampeao($lutadores) {
        if (empty($lutadores)) {
            return null;
        }
        
        $campeao = $lutadores[0];
        foreach ($lutadores as $lutador) {
            if ($lutador->getTaxaVitoria() > $campeao->getTaxaVitoria()) {
                $campeao = $lutador;
            }
        }
        
        return $campeao;
    }

    public function criar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $lutador = new Lutador();
            
            $lutador->setNomeRingue($_POST['nome_ringue']);
            $nomeReal = trim($_POST['nome_real']);
            $lutador->setNomeReal(empty($nomeReal) ? 'Desconhecido' : $nomeReal);
            $lutador->setEstilo($_POST['estilo']);
            $afiliacao = trim($_POST['afiliacao']);
            $lutador->setAfiliacao(empty($afiliacao) ? 'Independente' : $afiliacao);
            $lutador->setVitorias($_POST['vitorias']);
            $lutador->setDerrotas($_POST['derrotas']);
            $lutador->setEmpates($_POST['empates']);
            $lutador->setHealth($_POST['health']);
            $lutador->setAttack($_POST['attack']);
            $lutador->setDefense($_POST['defense']);
            $lutador->setAgility($_POST['agility']);

            $this->lutadorDAO->salvar($lutador);
            header('Location: index.php');
            exit();
        }
        
        require_once __DIR__ . '/../view/Lutador_form.php';
    }

    public function editar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $lutador = new Lutador();
            
            $lutador->setId($_POST['id']);
            $lutador->setNomeRingue($_POST['nome_ringue']);
            $nomeReal = trim($_POST['nome_real']);
            $lutador->setNomeReal(empty($nomeReal) ? 'Desconhecido' : $nomeReal);
            $lutador->setEstilo($_POST['estilo']);
            $afiliacao = trim($_POST['afiliacao']);
            $lutador->setAfiliacao(empty($afiliacao) ? 'Independente' : $afiliacao);
            $lutador->setVitorias($_POST['vitorias']);
            $lutador->setDerrotas($_POST['derrotas']);
            $lutador->setEmpates($_POST['empates']);
            $lutador->setHealth($_POST['health']);
            $lutador->setAttack($_POST['attack']);
            $lutador->setDefense($_POST['defense']);
            $lutador->setAgility($_POST['agility']);

            $this->lutadorDAO->atualizar($lutador);
            header('Location: index.php');
            exit();
        } else {
            $id = $_GET['id'];
            $lutadorBusca = new Lutador();
            $lutadorBusca->setId($id);
            $lutador = $this->lutadorDAO->buscarPorId($lutadorBusca);
            
            $dadosView = ['lutador' => $lutador];
            extract($dadosView);
            
            require_once __DIR__ . '/../view/Lutador_form.php';
        }
    }

    public function excluir() {
        $lutador = new Lutador();
        $lutador->setId($_GET['id']);
        $this->lutadorDAO->excluir($lutador);
        header('Location: index.php');
        exit();
    }

    public function buscar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_busca'])) {
            $id = $_POST['id_busca'];
            $lutadorBusca = new Lutador();
            $lutadorBusca->setId($id);
            
            $lutador = $this->lutadorDAO->buscarPorId($lutadorBusca);
            
            if ($lutador) {
                $lutadores = [$lutador];
                $id_buscado = $id;
                $campeao = $lutador;
                $ordenacao_atual = 'id';
                $direcao_atual = 'asc';
            } else {
                $mensagem = '❌ Lutador não encontrado! Verifique o ID.';
                $tipoMensagem = 'erro';
                
                $ordenacao = $_GET['ordenar'] ?? 'id';
                $direcao = $_GET['dir'] ?? 'asc';
                $lutadores = $this->lutadorDAO->listar();
                $lutadores = $this->aplicarOrdenacao($lutadores, $ordenacao, $direcao);
                $ordenacao_atual = $ordenacao;
                $direcao_atual = $direcao;
                $id_buscado = $id;
                $campeao = $this->calcularCampeao($lutadores);
            }
            
            $dadosView = [
                'lutadores' => $lutadores,
                'id_buscado' => $id_buscado ?? null,
                'mensagem' => $mensagem ?? null,
                'tipoMensagem' => $tipoMensagem ?? null,
                'ordenacao_atual' => $ordenacao_atual ?? null,
                'direcao_atual' => $direcao_atual ?? null,
                'campeao' => $campeao ?? null
            ];
            
            extract($dadosView);
            require_once __DIR__ . '/../view/Lutador_view.php';
            
        } else {
            header('Location: index.php');
            exit();
        }
    }
}