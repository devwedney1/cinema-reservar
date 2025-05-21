<form method="POST" action="processaCadeira.php">
    <input type="hidden" name="id" value="<?php echo isset($cadeira) ? $cadeira->get_id() : ''; ?>">

    <label for="sala_id">Sala:</label>
    <select name="sala_id" id="sala_id" required>
        <option value="">Selecione uma sala</option>
        <?php foreach ($salas as $sala): ?>
            <option value="<?php echo $sala->get_id(); ?>" 
                <?php echo (isset($cadeira) && $cadeira->get_sala_id() == $sala->get_id()) ? 'selected' : ''; ?>>
                <?php echo $sala->get_nome(); ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="numero_cadeira">Número da Cadeira:</label>
    <input type="number" name="numero_cadeira" id="numero_cadeira" 
           value="<?php echo isset($cadeira) ? $cadeira->get_numero_cadeira() : ''; ?>" 
           required>

    <button type="submit">Salvar</button>
</form>
