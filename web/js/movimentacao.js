
$(function () {
    $('.field-movimentacaosearch-nome_feira').hide();

    if ($('#movimentacaosearch-entrada_saida').val() == 1) {
        $('#divES').show();
    } else {
        $('#divES').hide();
    }

    $('#movimentacaosearch-entrada_saida').change(function () {
        if ($('#movimentacaosearch-entrada_saida').val() == 1) {
            $('#divES').show();
        } else {
            $('#movimentacaosearch-cliente').val('');
            $('#movimentacaosearch-cliente_fk').val('');
            $('#movimentacaosearch-status').val('');
            $('#movimentacaosearch-data_entrega').val('');

            $('#movimentacaosearch-valor_frete-disp').val('');
            $('#movimentacaosearch-valor_pago-disp').val('');
            $('#movimentacaosearch-parcelas-disp').val('');
            $('#movimentacaosearch-parcela_atual-disp').val('');
            $('#divES').hide();
        }
    });



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

    $('#itensmovimentacaosearch-valor_desconto-disp, #itensmovimentacaosearch-quantidade').change(function ( ) {

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
                $('#itensmovimentacaosearch-qnt_estoque').val(dados.qnt_disponivel);
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
    $('#itensmovimentacaosearch-qnt_estoque').val(dados.qnt_disponivel);
    $('#qnt_estoque').html('Quantidade estoque: ' + dados.qnt_disponivel);
    $('#itensmovimentacaosearch-valor_desconto-disp').val(dados.valor_desconto);
    $('#itensmovimentacaosearch-valor_unitario').val(dados.valor_unitario);
    $('#itensmovimentacaosearch-quantidade').val(dados.quantidade);
    
    $('#itensmovimentacaosearch-valor_total').val((dados.valor_unitario * dados.quantidade) - (dados.quantidade * dados.valor_desconto));
    $('#itensmovimentacaosearch-status').val(dados.status);


    if (acao == 'view') {
        bloqueaForm(true);
    } else {
        $('#botaoSalvar').html('Alterar registro');
        bloqueaForm(false);
    }
    if(dados.id){
        $('#itensmovimentacaosearch-estoque_fk').attr('disabled', true);
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
    $('#itensmovimentacaosearch-valor_total').val('');
    $('#itensmovimentacaosearch-valor_desconto-disp').val('')


}
;
function  retiraFormatoMoeda(valor) {
    valor = (valor) ? valor.replace(/\./g, "").replace(",", ".") : 0;
    return valor;
}


function  calculaTotalItem( ) {

    $('#itensmovimentacaosearch-valor_total').val(
            (retiraFormatoMoeda($('#itensmovimentacaosearch-quantidade').val()) * ($('#itensmovimentacaosearch-valor_unitario').val()) -
                    (retiraFormatoMoeda($('#itensmovimentacaosearch-valor_desconto-disp').val()) * retiraFormatoMoeda($('#itensmovimentacaosearch-quantidade').val()))
                    ));
    ;
}