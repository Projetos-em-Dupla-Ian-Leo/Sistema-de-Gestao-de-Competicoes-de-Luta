<?php
$lutador = $lutador ?? null;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $lutador ? 'Editar Lutador' : 'Novo Lutador'; ?> - COLISEU</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="yakuza-header">
        <div class="header-content">
            <div class="logo">
                <h1>COLISEU</h1>
                <span><?php echo $lutador ? 'Editar Lutador' : 'Cadastrar Novo Lutador'; ?></span>
            </div>
            <a href="index.php" class="btn btn-primary">← Voltar</a>
        </div>
    </header>

    <div class="container">
        <div class="form-container">
            <form action="index.php?action=<?php echo $lutador ? 'editar' : 'criar'; ?>" method="post">
                <?php if ($lutador): ?>
                    <input type="hidden" name="id" value="<?php echo $lutador->getId(); ?>">
                <?php endif; ?>
                
                <div class="form-grid">
                    <div class="form-group">
                        <label for="nome_ringue">Nome no Ringue *</label>
                        <input type="text" id="nome_ringue" name="nome_ringue" 
                               value="<?php echo $lutador ? htmlspecialchars($lutador->getNomeRingue()) : ''; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="nome_real">Nome Real *</label>
                        <input type="text" id="nome_real" name="nome_real" 
                                value="<?php echo $lutador ? htmlspecialchars($lutador->getNomeReal()) : ''; ?>" 
                                placeholder="Vazio = Desconhecido">
                    </div>  
                    
                    <div class="form-group">
                        <label for="estilo">Estilo de Luta *</label>
                        <input type="text" id="estilo" name="estilo" 
                               value="<?php echo $lutador ? htmlspecialchars($lutador->getEstilo()) : ''; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="afiliacao">Afiliação *</label>
                        <input type="text" id="afiliacao" name="afiliacao" 
                                value="<?php echo $lutador ? htmlspecialchars($lutador->getAfiliacao()) : ''; ?>" 
                                placeholder="Vazio = Independente">
                    </div>
                </div>

                <h3>Recorde de Lutas</h3>
                <div class="form-grid">
                    <div class="form-group">
                        <label for="vitorias">Vitórias</label>
                        <input type="number" id="vitorias" name="vitorias" min="0"
                               value="<?php echo $lutador ? $lutador->getVitorias() : 0; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="derrotas">Derrotas</label>
                        <input type="number" id="derrotas" name="derrotas" min="0"
                               value="<?php echo $lutador ? $lutador->getDerrotas() : 0; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="empates">Empates</label>
                        <input type="number" id="empates" name="empates" min="0"
                               value="<?php echo $lutador ? $lutador->getEmpates() : 0; ?>">
                    </div>
                </div>

                <h3>Estatísticas RPG</h3>
                <div class="form-grid">
                    <div class="form-group">
                        <label for="health">Health (0-1000)</label>
                        <input type="number" id="health" name="health" min="0" max="1000"
                               value="<?php echo $lutador ? $lutador->getHealth() : 500; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="attack">Attack (0-1000)</label>
                        <input type="number" id="attack" name="attack" min="0" max="1000"
                               value="<?php echo $lutador ? $lutador->getAttack() : 500; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="defense">Defense (0-1000)</label>
                        <input type="number" id="defense" name="defense" min="0" max="1000"
                               value="<?php echo $lutador ? $lutador->getDefense() : 500; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="agility">Agility (0-1000)</label>
                        <input type="number" id="agility" name="agility" min="0" max="1000"
                               value="<?php echo $lutador ? $lutador->getAgility() : 500; ?>">
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <?php echo $lutador ? 'Atualizar Lutador' : 'Cadastrar Lutador'; ?>
                    </button>
                    <a href="index.php" class="btn btn-delete">Cancelar</a>
                </div>
            </form>
        </div>
    </div>

    <script src="js/script.js"></script>
</body>
</html>