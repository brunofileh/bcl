
$(function () {

    $('#incluir-desenho').click(function () {
        openModal('desenho');
        limpaForm('desenho');

    });

    $('#incluir-classificacao').click(function () {
        openModal('classificacao');
        limpaForm(2);


    });


    $('#incluir-produto').click(function () {
        openModal('produto');
        limpaForm('produto');


    });

    $('#incluir-cor-pano').click(function () {
        openModal('corpano');
        limpaForm('corpano');


    });


    $('#botaoDesenho').click(function ( ) {
        adiciona('desenho', urlDesenho);
        return false;
    });

  $('#botaoClassificacao').click(function ( ) {
        adiciona('classificacao', urlClassificacao);
        return false;
    });


  $('#botaoCorPano').click(function ( ) {
        adiciona('corpano', urlCorPano);
        return false;
    });
    
    
  $('#botaoProduto').click(function ( ) {
        adiciona('produto', urlProduto);
        return false;
    });
    
  $('#desvincular').click(function ( ) {
        desvincularBotao();
    });

if($('#produtocomercialsearch-preco_fk').val()){
  $('#visprodutocomercialsearch-preco_fk_'+$('#produtocomercialsearch-preco_fk').val()).attr('checked','true').change();  
}

});

function HabilitarBotao(dados) {
    $('#produtocomercialsearch-preco_fk').val(dados);
    $('#precosearch-risco').val('');
    $('#precosearch-pano').val('');
    $('#precosearch-linha').val('');
    $('#precosearch-bordado').val('');
    $('#precosearch-costureira').val('');
    $('#precosearch-enchimento').val('');
    $('#divPreco').hide();
    $('#desvincular').show();
}

function desvincularBotao() {
    $('#produtocomercialsearch-preco_fk').val('');
    $('#divPreco').show();
    $('#desvincular').hide();
    $.pjax.reload({container:"#grid_precos"});
}



function adiciona(tipo, url){
    
        var form = $('#form-produto_comercial');
        var formAuxiliar = $('#form-'+tipo);
        if (formAuxiliar.find('.has-error').length) {
            return false;
        }
        
        
     $.ajax({
            url: url,
            type: 'post',
            data: form.serialize( ),
            success: function (response) {

                var dados = $.parseJSON(response);

                if (!dados.dados)
                {
                        $('#errorAuxiliares-'+tipo).html(dados.msg.descricao);
                        $('#errorAuxiliares-'+tipo).show();
                    
                } else {

                    limpaForm(tipo);
                  
                    if(tipo=='classificacao'){
                        $('#classificacaosearch-fk_classificacao').html(dados.dados);
                    }
                                       
                    
                    $('#errorAuxiliares-'+tipo).hide();
                    $('#modal-'+tipo).modal('hide');
                    
                    if(tipo=='corpano'){
                      tipo = 'cor_pano';
                    }
                    
                                      
                    $('#produtocomercialsearch-'+tipo+'_fk').html(dados.dados);
                    
                   $('#produtocomercialsearch-'+tipo+'_fk option[value="'+dados.valor+'"]').attr('selected','selected').change();

                }
            }
        });
}

function openModal(tipo) {

        $('#modal-'+tipo).modal('show').find('#modalContent').load( );
}
;


function limpaForm(tipo) {
    if (tipo == '2') {
        $('#classificacaosearch-descricao').val('');
        $('#classificacaosearch-fk_classificacao').val('');
        setTimeout(function () {
            $('#classificacaosearch-descricao').focus();

        }, 700);

    } else {
        $('#' + tipo + 'search-descricao').val('');
        setTimeout(function () {
            $('#' + tipo + 'search-descricao').focus();

        }, 700);
    }

}
;