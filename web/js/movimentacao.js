
$(function () {

    $('#incluir-itens').click(function () {
        limpaForm();
        openModal();
        $('#botaoSalvar').html('Incluir registro');
    });

    $('#botaoSalvar').click(function ( ) {

        var form = $('#movimentacaoPop');
        var formAuxiliar = $('#itens-movimentacao-index');
        if (formAuxiliar.find('.has-error').length) {
            return false;
        }   

        $.ajax({
            url: urlInclusao,
            type: 'post',
            data: form.serialize( ),
            success: function (response) {

                var dados = $.parseJSON(response);

                if (!dados.grid)
                {
                    $.each(dados, function (index, value) {
                        $('#errorAuxiliares').html(dados.msg);
                        $('#errorAuxiliares').show();
                    });
                } else {
                    
                    $('#divGridItens').html(dados.grid);
                    $('#errorAuxiliares').hide();
                    $('#modalItens').modal('hide');

                }
            }
        });
        return false;
    });
});


function preencheForm(dados, acao) {
    $('#itensmovimentacaosearch-id').val(dados.id);
    $('#itensmovimentacaosearch-novo').val(dados.novo);
    
    $('#itensmovimentacaosearch-estoque_fk').val(dados.estoque_fk);
    $('#itensmovimentacaosearch-valor_desconto').val(dados.valor_desconto);
    $('#itensmovimentacaosearch-valor_unitario').val(dados.valor_unitario);
    $('#itensmovimentacaosearch-quantidade').val(dados.quantidade);
    $('#itensmovimentacaosearch-desenho').val(dados.desenho);
    $('#itensmovimentacaosearch-status').val(dados.status);
    
    if (acao == 'view') {
        bloqueaForm(true);
    } else {
        $('#botaoSalvar').html('Alterar registro');
        bloqueaForm(false);
    }
}

function bloqueaForm(valor) {
    $('input[id^=\"itensmovimentacaosearch\"]').attr('disabled', valor);
    $('select[id^=\"itensmovimentacaosearch\"]').attr('disabled', valor);
    if (valor == true) {
        $('#botaoSalvar').hide( );
    } else {
        $('#botaoSalvar').show( );
    }
}

function openModal( ) {
    setTimeout(function () {
        $('#itensmovimentacaosearch-movimentacao_fk').focus();

    }, 750);
    $('#modalItens').modal('show').find('#modalContent').load( );
}
;
function  limpaForm( ) {
       $('#itensmovimentacaosearch-id').val('');
    $('#itensmovimentacaosearch-novo').val('');
    $('#itensmovimentacaosearch-estoque_fk').val('');
    $('#itensmovimentacaosearch-valor_desconto').val('');
    $('#itensmovimentacaosearch-valor_unitario').val('');
    $('#itensmovimentacaosearch-quantidade').val('');
    $('#itensmovimentacaosearch-desenho').val('');
    $('#itensmovimentacaosearch-status').val('');
        

}