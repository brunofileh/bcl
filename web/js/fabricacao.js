
$(function () {

    $('#incluir-desenho').click(function () {

        limpaForm(1);
        openModal(1);

    });

    $('#incluir-classificacao').click(function () {
        limpaForm(2);
        openModal(2);

    });
    
    $('#botaoDesenho').click(function ( ) {

        var form = $('#form-fabricacao');
        var formAuxiliar = $('#formDesenho');
        if (formAuxiliar.find('.has-error').length) {
            return false;
        }

        $.ajax({
            url: urlDesenho,
            type: 'post',
            data: form.serialize( ),
            success: function (response) {

                var dados = $.parseJSON(response);

                if (! dados.dados )
                {
                    $.each(dados, function (index, value) {
                        $('#errorAuxiliares').html(dados.msg);
                        $('#errorAuxiliares').show();
                    });
                } else {

                    $('#fabricacao-desenho_fk').html(dados.dados);
                    limpaForm(1);
                    $('#errorAuxiliares').hide();
                    $('#modalDesenho').modal('hide');

                }
            }
        });
        return false;
    });
    
    
    
     $('#botaoClassificacao').click(function ( ) {

        var form = $('#form-fabricacao');
        var formAuxiliar = $('#formClassificacao');
        if (formAuxiliar.find('.has-error').length) {
            return false;
        }

        $.ajax({
            url: urlClassificacao,
            type: 'post',
            data: form.serialize( ),
            success: function (response) {

                var dados = $.parseJSON(response);

                if (! dados.dados )
                {
                    $.each(dados, function (index, value) {
                        $('#errorAuxiliares').html(dados.msg);
                        $('#errorAuxiliares').show();
                    });
                } else {

                    $('#fabricacao-classificacao_fk').html(dados.dados);
                    $('#classificacaosearch-fk_classificacao').html(dados.dados);
                    limpaForm(1);
                    $('#errorAuxiliares').hide();
                    $('#modalClassificacao').modal('hide');

                }
            }
        });
        return false;
    });
    
    
    
});



function openModal(tipo) {

    if (tipo == 1) {
        setTimeout(function () {
            $('#descricao').focus();

        }, 750);
        $('#modalDesenho').modal('show').find('#modalContent').load( );
    }else if(tipo == 2){
        
         setTimeout(function () {
            $('#descricao').focus();

        }, 750);
        $('#modalClassificacao').modal('show').find('#modalContent').load( );
    }
    
}
;
function  limpaForm(tipo) {

    if (tipo == 1) {
        $('#desenhosearch-descricao').val('');
    }else if(tipo==2){
        $('#classificacaosearch-descricao').val('');
        $('#classificacaosearch-fk_classificacao').val('');
    }

}