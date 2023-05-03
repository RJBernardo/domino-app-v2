$(document).ready(function(){
    $('.batida').on('change', onChangeTipoBatida);
    if(games != null){
        $('#game-0-user-id').val(games[0].user_id == 0 ? '' : games[0].user_id);
        $('#game-1-user-id').val(games[1].user_id == 0 ? '' : games[1].user_id);
        $('#game-2-user-id').val(games[2].user_id == 0 ? '' : games[2].user_id);
        $('#game-3-user-id').val(games[3].user_id == 0 ? '' : games[3].user_id);

        // dupla 1 jogador 1
        $('#game-0-type-win-first').val('');
        $('#game-0-type-win-second').val('');

        // dupla 1 jogador 2
        $('#game-1-type-win-first').val('');
        $('#game-1-type-win-second').val('');

        // dupla 2 jogador 1
        $('#game-2-type-win-first').val('');
        $('#game-2-type-win-second').val('');

        // dupla 2 jogador 2
        $('#game-3-type-win-first').val('');
        $('#game-3-type-win-second').val('');
    }
});

function validaPartida(continua){
    // Jogadores
    var dupla1_jogador1 = $('#game-0-user-id');
    var dupla1_jogador2 = $('#game-1-user-id');
    var dupla2_jogador1 = $('#game-2-user-id');
    var dupla2_jogador2 = $('#game-3-user-id');

    // dupla 1 jogador 1
    var d1_j1_batida1 = $('#game-0-type-win-first');
    var d1_j1_batida2 = $('#game-0-type-win-second');

    // dupla 1 jogador 2
    var d1_j2_batida1 = $('#game-1-type-win-first');
    var d1_j2_batida2 = $('#game-1-type-win-second');

    // dupla 2 jogador 1
    var d2_j1_batida1 = $('#game-2-type-win-first');
    var d2_j1_batida2 = $('#game-2-type-win-second');

    // dupla 2 jogador 2
    var d2_j2_batida1 = $('#game-3-type-win-first');
    var d2_j2_batida2 = $('#game-3-type-win-second');

    // variavel de pontuacao para realizar o calculo
    var pontuacao_dupla1 = 0;
    var pontuacao_dupla2 = 0;

     // Win
     var dupla1_jogador1_win = $('#game-0-win');
     var dupla1_jogador2_win = $('#game-1-win');
     var dupla2_jogador1_win = $('#game-2-win');
     var dupla2_jogador2_win = $('#game-3-win');

     //contador de batida2
     var batida2_count = 0;

    if(validaCamposIguais(dupla1_jogador1, dupla1_jogador2)
    && validaCamposIguais(dupla1_jogador1, dupla2_jogador1)
    && validaCamposIguais(dupla1_jogador1, dupla2_jogador2)
    && validaCamposIguais(dupla1_jogador2, dupla2_jogador1)
    && validaCamposIguais(dupla1_jogador2, dupla2_jogador2)
    && validaCamposIguais(dupla2_jogador1, dupla2_jogador2)){
        // Batida 1 DUpla 1
        if(d1_j1_batida1.val() == 'FFP'){
            pontuacao_dupla2 += 2;
        }else if(d1_j1_batida1.val() == 'FNP' || d1_j1_batida1.val() == 'M'){
            pontuacao_dupla2 += 1;
        }else if(d1_j1_batida1.val() != ''){
            pontuacao_dupla1 += validaBatida(d1_j1_batida1.val());
        }

        if(d1_j2_batida1.val() == 'FFP'){
            pontuacao_dupla2 += 2;
        }else if(d1_j2_batida1.val() == 'FNP' || d1_j2_batida1.val() == 'M'){
            pontuacao_dupla2 += 1;
        }else if(d1_j2_batida1.val() != ''){
            pontuacao_dupla1 += validaBatida(d1_j2_batida1.val());
        }

        // Batida 2 Dupla 1
        if(d1_j1_batida2.val() != '' && (pontuacao_dupla2 >= 2 || pontuacao_dupla1 >= 2)){
            alert('Batidas incorretas.');
            return false;
        }else if(d1_j1_batida2.val() == 'FFP'){
            pontuacao_dupla2 += 2;
            batida2_count += 1;
        }else if(d1_j1_batida2.val() == 'FNP' || d1_j1_batida2.val() == 'M'){
            pontuacao_dupla2 += 1;
        }else if(d1_j1_batida2.val() != ''){
            pontuacao_dupla1 += validaBatida(d1_j1_batida2.val());
            batida2_count += 1;
        }

        if(d1_j2_batida2.val() != '' && (pontuacao_dupla2 >= 2 || pontuacao_dupla1 >= 2)){
            alert('Batidas incorretas.');
            return false;
        }else if(d1_j2_batida2.val() == 'FFP'){
            pontuacao_dupla2 += 2;
            batida2_count += 1;
        }else if(d1_j2_batida2.val() == 'FNP' || d1_j2_batida2.val() == 'M'){
            pontuacao_dupla2 += 1;
        }else if(d1_j2_batida2.val() != ''){
            pontuacao_dupla1 += validaBatida(d1_j2_batida2.val());
            batida2_count += 1;
        }

        // Batida 1 Dupla 2
        if(d2_j1_batida1.val() == 'FFP'){
            pontuacao_dupla1 += 2;
        }else if(d2_j1_batida1.val() == 'FNP' || d2_j1_batida1.val() == 'M'){
            pontuacao_dupla1 += 1;
        }else if(d2_j1_batida1.val() != ''){
            pontuacao_dupla2 += validaBatida(d2_j1_batida1.val());
        }

        if(d2_j2_batida1.val() == 'FFP'){
            pontuacao_dupla1 += 2;
        }else if(d2_j2_batida1.val() == 'FNP' || d2_j2_batida1.val() == 'M'){
            pontuacao_dupla1 += 1;
        }else if(d2_j2_batida1.val() != ''){
            pontuacao_dupla2 += validaBatida(d2_j2_batida1.val());
        }

        // Batida 2 Dupla 2
        if(d2_j1_batida2.val() != '' && (pontuacao_dupla2 >= 2 || pontuacao_dupla1 >= 2)){
            alert('Batidas incorretas.');
            return false;
        }else if(d2_j1_batida2.val() == 'FFP'){
            pontuacao_dupla1 += 2;
            batida2_count += 1;
        }else if(d2_j1_batida2.val() == 'FNP' || d2_j1_batida2.val() == 'M'){
            pontuacao_dupla1 += 1;
        }else if(d2_j1_batida2.val() != ''){
            pontuacao_dupla2 += validaBatida(d2_j1_batida2.val());
            batida2_count += 1;
        }

        if(d2_j2_batida2.val() != '' && (pontuacao_dupla2 >= 2 || pontuacao_dupla1 >= 2)){
            alert('Batidas incorretas.');
            return false;
        }
        
        if(d2_j2_batida2.val() == 'FFP'){
            pontuacao_dupla1 += 2;
            batida2_count += 1;
        }else if(d2_j2_batida2.val() == 'FNP' || d2_j2_batida2.val() == 'M'){
            pontuacao_dupla1 += 1;
        }else if(d2_j2_batida2.val() != ''){
            pontuacao_dupla2 += validaBatida(d2_j2_batida2.val());
            batida2_count += 1;
        }

        if(batida2_count > 1){
            alert('Verifica as batidas novamente, pois a soma dos pontos foi superior ao permitido.');
            return false;
        }else if(pontuacao_dupla1 >= 2 && pontuacao_dupla2 >=2){
            alert('Verifica as batidas novamente, pois a soma dos pontos foi superior ao permitido.');
            return false;
        }else if(pontuacao_dupla1 > 3 || pontuacao_dupla2 > 3){
            alert('Verifica as batidas novamente, pois a soma dos pontos foi superior ao permitido.');
            return false;
        }
        else if(pontuacao_dupla1 >= 2){
            dupla1_jogador1_win.val(1);
            dupla1_jogador2_win.val(1);
            dupla2_jogador1_win.val(0);
            dupla2_jogador2_win.val(0);
        }else if(pontuacao_dupla2 >= 2){
            dupla1_jogador1_win.val(0);
            dupla1_jogador2_win.val(0);
            dupla2_jogador1_win.val(1);
            dupla2_jogador2_win.val(1);
        }else if(pontuacao_dupla1 <= 1 && pontuacao_dupla2 <= 1){
            alert('A partida ainda não acabou. Preencha corretamente as batidas');
            return false;
        }

        if(continua == 1){
            $('#continua').val(true);
            $('#continua-todos').val(false);
        }else if(continua == 2){
            $('#continua-todos').val(true);
            $('#continua').val(false);
        }else{
            $('#continua').val(false);
            $('#continua-todos').val(false);
        }
    }else{
        return false;
    }

}

function validaBatida(batida){
    // batidas especiais valem 2 pontos B, BL, L
    var batida_especial = ['B', 'BL', 'L'];

    var batida_ganhou = ['S', 'FFG', 'FNG'];

    if(batida_especial.indexOf(batida) != -1){
        return 2;
    }

    if(batida_ganhou.indexOf(batida) != -1){
        return 1;
    }

    return 0;
}

function validaCamposIguais(campo1, campo2){
    if(campo1.val() == campo2.val()){
        campo1.parent('.form-group').addClass('has-error');
        campo2.parent('.form-group').addClass('has-error');
        return false;
    }else{
        campo1.parent('.form-group').removeClass('has-error');
        campo2.parent('.form-group').removeClass('has-error');
        return true;
    }
}

function onChangeTipoBatida(){
    var tipo_batida = $(this);
    var pontuacao = validaBatida(tipo_batida.val())

    tipo_batida.parent('.form-group').removeClass('has-success');
    tipo_batida.parent('.form-group').removeClass('has-warning');
    tipo_batida.parent('.form-group').removeClass('has-error');

    if(pontuacao == 1){
        tipo_batida.parent('.form-group').addClass('has-success');
    }else if(pontuacao == 2){
        tipo_batida.parent('.form-group').addClass('has-warning');
    }else if(tipo_batida.val() == 'FFP' || tipo_batida.val() == 'M'){
        tipo_batida.parent('.form-group').addClass('has-error');
    }
}