
$(function () {
    
    ;
});


function getProdutoPreco(dados, url) {

    $.ajax({
        url: url,
        type: 'post',
        data: {produto_fk: $('#produtopreco-produto_fk').val(), produto_preco_fk: $('#produtopreco-id').val()},
        success: function (response) {
            var response = $.parseJSON(response);
            $('#produtopreco-risco-disp').val(response.risco);
            $('#produtopreco-pano-disp').val(response.pano);
            $('#produtopreco-linha-disp').val(response.linha);
            $('#produtopreco-bordado-disp').val(response.bordado);
            $('#produtopreco-costureira-disp').val(response.costureira);
            $('#produtopreco-enchimento-disp').val(response.enchimento);
        }
    });
}

function verificaExite(dados, url) {
    if ($('#produtopreco-cor_pano_fk').val()) {
        $.ajax({
            url: url,
            type: 'post',
            data: {produto_fk: $('#produtopreco-produto_fk').val(), cor_pano_fk: $('#produtopreco-cor_pano_fk').val()},
            success: function (response) {
                var response = $.parseJSON(response);

                if (response) {
                    alert('produto já cadastrado');
                    $("#produtopreco-cor_pano_fk").select2("val", "");
                    return false;
                    // $('#produtopreco-cor_pano_fk').val(null);
                }
            }
        });
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