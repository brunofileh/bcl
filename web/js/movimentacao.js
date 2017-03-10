
$(function () {
    $('.field-movimentacaosearch-nome_feira').hide();


    $('#movimentacaosearch-canal_venda').change(function () {
        if ($('#movimentacaosearch-canal_venda').val() == 1) {
            $('.field-movimentacaosearch-nome_feira').show();
        } else {
            $('#movimentacaosearch-nome_feira').val('')
            $('.field-movimentacaosearch-nome_feira').hide();
        }
    });


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

    $('#itensmovimentacaosearch-valor_desconto, #itensmovimentacaosearch-quantidade').change(function ( ) {
        calculaTotalItem();

    });


    $('#itensmovimentacaosearch-estoque_fk').change(function ( ) {
        var form = $('#movimentacaoPop');
        $.ajax({
            url: urlConsulta,
            type: 'post',
            data: form.serialize( ),
            success: function (response) {

                var dados = $.parseJSON(response);
                $('#qnt_estoque').html('Quantidade estoque: ' + dados.qnt_disponivel);
                $('#qnt_estoque').html('Quantidade estoque: ' + dados.qnt_disponivel);
                $('#itensmovimentacaosearch-qnt_estoque').val(dados.valor_comercial);
                $('#itensmovimentacaosearch-valor_unitario').val(dados.valor_comercial);
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
;
function  retiraFormatoMoeda(valor) {
    valor = (valor) ? valor.replace(/\./g, "").replace(",", ".") : 0;
    return valor;
}


function  calculaTotalItem( ) {
    $('#itensmovimentacaosearch-valor_desconto').val(
            retiraFormatoMoeda($('#itensmovimentacaosearch-quantidade').val()) *
            ($('#itensmovimentacaosearch-valor_unitario').val() -
                    retiraFormatoMoeda($('#itensmovimentacaosearch-valor_desconto').val())
                    ));
    ;
}