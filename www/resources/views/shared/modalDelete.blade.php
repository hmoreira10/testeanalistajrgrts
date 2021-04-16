<div class="modal" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Confirmar Exclusão</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['id' => 'form-delete']) !!}
            {!! Form::hidden('_method', 'delete') !!}
            <div class="modal-body">
                <p>Você tem certeza que deseja excluir esse Item? Esta ação não pode ser desfeita</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white text-black" data-dismiss="modal">Cancelar</button>
                {!! Form::submit('Sim, Excluir', ['class' => 'btn btn-danger']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@push('js')
<script type="text/javascript">
    let urlDelete = '';
    function deleteRegistro(url) {
        urlDelete = url;
        $('#form-delete').attr('action', url)
        $('#form-delete').attr('method', 'post')
        $('#deleteModal').modal('show');
    }

</script>
@endpush