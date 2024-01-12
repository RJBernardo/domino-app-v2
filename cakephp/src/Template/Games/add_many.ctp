<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Game $game
 */
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?= __('Partida'); ?>
        <small>
            <?php echo __('Add'); ?>
        </small>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <?php echo $this->Form->create($games, ['role' => 'form']); ?>

    <!-- general form elements -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">
                <?php echo __('Jogadores e Valores'); ?>
            </h3>

            <button type="button" class="btn btn btn-success " onclick="replicarEstrutura()">+
                Jogador</button>

        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <div class="box-body">
            <div class="row container-game-clone">

                <div class="col-xs-6">
                    <?php echo $this->Form->control('game.0.user_id', ['label' => 'Jogador', 'options' => $users, 'empty' => 'Selecione']); ?>
                </div>
                <div class="col-xs-6">
                    <?php echo $this->Form->control('game.0.value', ['type' => 'text', 'value' => '', 'class' => 'valorInput form-control']);
                    ?>
                </div>
            </div>
            <div id="container-games">
            </div>
        </div>
    </div>

    <div class="box box-primary">
        <div class="box-footer">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-4 col-lg-3 col-xl-2 mb-2">
                    <button class="btn btn btn-warning form-control" title='<?= __('Submit') ?>'
                        data-original-title='<?= __('Submit') ?>' data-toggle="tooltip" type="submit"><i
                            class="fa fa-check fa-fw"></i> Salvar e Continuar Todos
                    </button>
                    <?php echo $this->Form->control('continua_todos', ['type' => 'hidden']); ?>
                </div>

                <div class="col-12 col-sm-12 col-md-4 col-lg-3 col-xl-2  mb-2">
                    <a href="<?php echo $this->Url->build('/Games/addMany'); ?>" title='Cancelar'
                        data-original-title='Cancelar' class="btn btn-danger form-control">
                        <i class="fa fa-close fa-fw"></i>Cancelar
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php echo $this->Form->end(); ?>

    <div class="box">
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Jogador</th>
                        <th scope="col" class="text-center padding-5">Jog</th>
                        <th scope="col" class="text-center padding-5">Valor</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($results as $result): ?>
                        <tr>
                            <td class="padding-5">
                                <?= h($result['name']) ?>
                            </td>
                            <td class="text-center padding-5">
                                <?= $this->Number->format($result['qtd_games']) ?>
                            </td>
                            <td class="text-center padding-5">
                                <?= $this->Number->format($result['value'], ['places' => 2]) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<script>
    var games = <?= json_encode($games, JSON_PRETTY_PRINT) ?> || []


</script>
<script>
    let contador = games.length + 1;  // Inicializa o contador para a próxima estrutura

    function replicarEstrutura() {
        // Clone a estrutura inicial
        const estruturaClone = document.querySelector('.container-game-clone').cloneNode(true);

        // Atualize os IDs e names dentro do clone com o novo contador
        estruturaClone.querySelectorAll('[id], [name]').forEach(elemento => {
            elemento.id = elemento.id.replace(/-\d+-/, `-${contador}-`);
            elemento.name = elemento.name.replace(/\[\d+\]/g, `[${contador}]`);
        });

        estruturaClone.querySelector(`#game-${contador}-value`).addEventListener('input', function () {
            let valorInput = this.value;
            let valorFormatado = formatarComoDinheiro(valorInput);
            this.value = valorFormatado;
        });

        // Adicione o clone ao container
        document.getElementById('container-games').appendChild(estruturaClone);

        // Incrementa o contador para a próxima estrutura
        contador++;
    }

    function replicarEstruturaComValores(jogos) {
        var container = document.getElementById('container-games');

        for (var i = 1; i < jogos.length; i++) {
            // Clone a estrutura inicial
            var estruturaClone = document.querySelector('.container-game-clone').cloneNode(true);

            // Atualize os IDs e names dentro do clone com o novo contador
            estruturaClone.querySelectorAll('[id], [name]').forEach(elemento => {
                elemento.id = elemento.id.replace(/-\d+-/, `-${i}-`);
                elemento.name = elemento.name.replace(/\[\d+\]/g, `[${i}]`);
            });

            // Preencha os valores dos campos com base nos dados do jogo
            estruturaClone.querySelector(`#game-${i}-user-id`).value = jogos[i].user_id;
            estruturaClone.querySelector(`#game-${i}-value`).value = '';
            estruturaClone.querySelector(`#game-${i}-value`).addEventListener('input', function () {
                let valorInput = this.value;
                let valorFormatado = formatarComoDinheiro(valorInput);
                this.value = valorFormatado;
            });

            // Adicione o clone ao container
            container.appendChild(estruturaClone);
        }
    }

    replicarEstruturaComValores(games);

    // Função para formatar como dinheiro
    function formatarComoDinheiro(valor) {
        // Remove qualquer caractere que não seja dígito
        valor = valor.replace(/\D/g, '');

        // Converte para número
        valor = parseFloat(valor) / 100; // Divide por 100 para considerar duas casas decimais

        // Formata como dinheiro (2 casas decimais, ponto como separador decimal)
        return valor.toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }

    // Adiciona um listener de evento para formatar automaticamente ao digitar
    document.querySelectorAll('.valorInput').forEach(function (input) {
        input.addEventListener('input', function () {
            let valorInput = this.value;
            let valorFormatado = formatarComoDinheiro(valorInput);
            this.value = valorFormatado;
        });
    });
</script>