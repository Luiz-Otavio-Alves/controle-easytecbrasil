//Alerta sobre exclusão de usuários
$(document).ready(function(){
    $('a[data-confirm]').click(function(ev){
        var href = $(this).attr('href');

        if(!$('#confirm-delete').lenght){
            $('body').append('<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog"aria-labelledby="exampleModalCenterTitle" aria-hidden="true"><div class="modal-dialog modal-dialog-centered" role="document"><div class="modal-content"><div class="modal-header bg-danger text-white"><h5 class="modal-title">Remover Item</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body">Tem certeza de que deseja excluir este usuário?</div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button><a class="btn btn-danger text-white" id="dataConfirmOKD">Excluir</a></div></div></div></div>');
        }

        $('#dataConfirmOKD').attr('href', href);
        $('#confirm-delete').modal({shown:true});

        return false;
    });
});
