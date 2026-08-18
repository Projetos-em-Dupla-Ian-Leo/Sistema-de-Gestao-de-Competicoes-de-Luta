<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COLISEU - Informação dos Lutadores</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="yakuza-header">
        <div class="header-content">
            <div class="logo">
                <h1>COLISEU</h1>
                <span>
                    <?php 
                    if (isset($id_buscado) && isset($lutadores) && count($lutadores) === 1) {
                        echo 'Lutador ID: ' . htmlspecialchars($id_buscado);
                    } else {
                        echo 'Informação dos Lutadores';
                    }
                    ?>
                </span>
            </div>
            
            <div class="header-compact">
                <div class="ordenacao-compacta">
                    <div class="ordenacao-info">
                        Ordenar por: 
                        <form action="index.php" method="get" class="form-ordenacao">
                            <select name="ordenar" onchange="this.form.submit()" class="select-ordenacao">
                                <option value="id" <?php echo (isset($ordenacao_atual) && $ordenacao_atual == 'id') ? 'selected' : ''; ?>>ID</option>
                                <option value="nome_ringue" <?php echo (isset($ordenacao_atual) && $ordenacao_atual == 'nome_ringue') ? 'selected' : ''; ?>>Nome Ringue</option>
                                <option value="nome_real" <?php echo (isset($ordenacao_atual) && $ordenacao_atual == 'nome_real') ? 'selected' : ''; ?>>Nome Real</option>
                                <option value="vitorias" <?php echo (isset($ordenacao_atual) && $ordenacao_atual == 'vitorias') ? 'selected' : ''; ?>>Vitórias</option>
                                <option value="derrotas" <?php echo (isset($ordenacao_atual) && $ordenacao_atual == 'derrotas') ? 'selected' : ''; ?>>Derrotas</option>
                                <option value="winrate" <?php echo (isset($ordenacao_atual) && $ordenacao_atual == 'winrate') ? 'selected' : ''; ?>>Win Rate</option>
                                <option value="health" <?php echo (isset($ordenacao_atual) && $ordenacao_atual == 'health') ? 'selected' : ''; ?>>Health</option>
                                <option value="attack" <?php echo (isset($ordenacao_atual) && $ordenacao_atual == 'attack') ? 'selected' : ''; ?>>Attack</option>
                                <option value="defense" <?php echo (isset($ordenacao_atual) && $ordenacao_atual == 'defense') ? 'selected' : ''; ?>>Defense</option>
                                <option value="agility" <?php echo (isset($ordenacao_atual) && $ordenacao_atual == 'agility') ? 'selected' : ''; ?>>Agility</option>
                             </select>
                             <?php if (isset($ordenacao_atual)): ?>
                                <input type="hidden" name="dir" value="<?php echo $direcao_atual ?? 'asc'; ?>">
                            <?php endif; ?>
                        </form>
                    </div>

                    <?php if (isset($ordenacao_atual)): ?>
                        <?php 
                        $direcao_atual = $direcao_atual ?? 'asc';
                        $nova_direcao = $direcao_atual == 'asc' ? 'desc' : 'asc';
                        ?>
                        <a href="index.php?ordenar=<?php echo $ordenacao_atual; ?>&dir=<?php echo $nova_direcao; ?>" 
                        class="btn-direcao">
                        <?php echo $direcao_atual == 'asc' ? '↑' : '↓'; ?>
                        </a>
                    <?php endif; ?>
                </div>

                <form action="index.php?action=buscar" method="post" class="busca-compacta">
                    <input type="number" name="id_busca" placeholder="Buscar por ID" 
                        min="1" class="input-busca"
                        value="<?php echo isset($id_buscado) ? htmlspecialchars($id_buscado) : ''; ?>">
                    <button type="submit" class="btn-busca">🔍</button>
                </form>

                <div class="acoes-compactas">
                    <?php if (isset($id_buscado) && isset($lutadores) && count($lutadores) === 1): ?>
                        <a href="index.php" class="btn-acao">↻</a>
                    <?php else: ?>
                        <a href="index.php?action=criar" class="btn btn-primary btn-novo">Novo Lutador</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>

    <div class="container">

        <?php if (isset($mensagem) && isset($tipoMensagem) && $tipoMensagem == 'erro'): ?>
            <div class="mensagem erro" 
                style="background: var(--danger); color: white; padding: 15px; border-radius: 5px; margin-bottom: 20px; text-align: center; border: 1px solid var(--secondary);">
                <?php echo htmlspecialchars($mensagem); ?>
            </div>
        <?php endif; ?>
        
        <?php if (!isset($id_buscado) || !isset($lutadores) || count($lutadores) !== 1): ?>
            <div class="stats-grid">
                <div class="stat-card">
                    <h3>Total de Lutadores</h3>
                    <p><?php echo isset($lutadores) ? count($lutadores) : 0; ?></p>
                </div>
                <div class="stat-card">
                    <h3>Campeão Atual</h3>
                    <p class="champion-name">
                        <?php 
                        if (isset($campeao)) {
                            echo htmlspecialchars($campeao->getNomeRingue());
                        } else {
                            echo 'Nenhum';
                        }
                        ?>
                    </p>
                </div>
            </div>
        <?php endif; ?>
        
        <div class="fighters-table">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome no Ringue</th>
                        <th>Nome Real</th>
                        <th>Estilo</th>
                        <th>Afiliação</th>
                        <th>Vitórias</th>
                        <th>Derrotas</th>
                        <th>Empates</th>
                        <th>Taxa Vitória</th>
                        <th>Stats RPG</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($lutadores) && !empty($lutadores)): ?>
                        <?php foreach ($lutadores as $lutador): ?>
                        <tr>
                            <td>#<?php echo str_pad($lutador->getId(), 3, '0', STR_PAD_LEFT); ?></td>
                            <td><strong><?php echo htmlspecialchars($lutador->getNomeRingue()); ?></strong></td>
                            <td><?php echo htmlspecialchars($lutador->getNomeReal()); ?></td>
                            <td><?php echo htmlspecialchars($lutador->getEstilo()); ?></td>
                            <td><?php echo htmlspecialchars($lutador->getAfiliacao()); ?></td>
                            <td class="wins-column"><?php echo $lutador->getVitorias(); ?></td>
                            <td class="losses-column"><?php echo $lutador->getDerrotas(); ?></td>
                            <td class="draws-column"><?php echo $lutador->getEmpates(); ?></td>
                            <td class="win-rate-column"><?php echo $lutador->getTaxaVitoria(); ?>%</td>
                            <td>
                                <div class="rpg-stats">
                                    <div class="stat-item">
                                        <span class="stat-rank <?php echo $lutador->getRank('health')['class']; ?>">
                                            <?php echo $lutador->getRank('health')['rank']; ?>
                                        </span>
                                        <span class="stat-name">Health</span>
                                        <span class="stat-value"><?php echo $lutador->getHealth(); ?></span>
                                    </div>
                                    <div class="stat-item">
                                        <span class="stat-rank <?php echo $lutador->getRank('attack')['class']; ?>">
                                            <?php echo $lutador->getRank('attack')['rank']; ?>
                                        </span>
                                        <span class="stat-name">Attack</span>
                                        <span class="stat-value"><?php echo $lutador->getAttack(); ?></span>
                                    </div>
                                    <div class="stat-item">
                                        <span class="stat-rank <?php echo $lutador->getRank('defense')['class']; ?>">
                                            <?php echo $lutador->getRank('defense')['rank']; ?>
                                        </span>
                                        <span class="stat-name">Defense</span>
                                        <span class="stat-value"><?php echo $lutador->getDefense(); ?></span>
                                    </div>
                                    <div class="stat-item">
                                        <span class="stat-rank <?php echo $lutador->getRank('agility')['class']; ?>">
                                            <?php echo $lutador->getRank('agility')['rank']; ?>
                                        </span>
                                        <span class="stat-name">Agility</span>
                                        <span class="stat-value"><?php echo $lutador->getAgility(); ?></span>
                                    </div>
                                </div>
                            </td>
                            <td class="action-buttons">
                                <a href="index.php?action=editar&id=<?php echo $lutador->getId(); ?>" class="btn btn-edit">Editar</a>
                                <a href="index.php?action=excluir&id=<?php echo $lutador->getId(); ?>" class="btn btn-delete" 
                                    onclick="return confirm('Tem certeza que deseja excluir o lutador <?php echo addslashes($lutador->getNomeRingue()); ?>?')">Excluir</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="11" style="text-align: center; padding: 30px; color: var(--secondary);">
                                Nenhum lutador encontrado.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <footer>
        <p>Coliseu &copy; 2025 - Sistema de Gerenciamento de Lutadores</p>
    </footer>

    <script src="js/script.js"></script>
</body>
</html>