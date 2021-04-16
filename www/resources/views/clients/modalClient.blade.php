<div class="modal" tabindex="-1" id="modal-client" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title-client"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['id' => 'form-client']) !!}
                <div class="form-row">
                    <div class="form-group col-4">
                        {!! Form::hidden('_method', null) !!}
                        {!! Form::label('name', 'Nome') !!}
                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nome',
                        'required'])
                        !!}
                    </div>
                    <div class="form-group col-4">
                        {!! Form::label('email', 'Email') !!}
                        {!! Form::email('email', null, ['class' => 'form-control', 'required'])
                        !!}
                    </div>
                    <div class="form-group col-4">
                        {!! Form::label('cnpj', 'CNPJ') !!}
                        {!! Form::text('cnpj', null, ['class' => 'form-control','required']) !!}
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-4">
                        {!! Form::label('phone', 'Telefone de Contato') !!}
                        {!! Form::number('phone', null, ['class' => 'form-control','required']) !!}
                    </div>
                    <div class="form-group col-8">
                        {!! Form::label('responsible', 'Responsável') !!}
                        {!! Form::text('responsible', null, ['class' => 'form-control','required'])!!}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                <button type="button" class="btn btn-primary" onclick="submitButtonClient()"> Enviar</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@push('js')
<script>
    let url = '';
    function createClient(company_id){
        $('#title-client').empty();
        $('#title-client').html('Criar Cliente');
        url = `/company/${company_id}/client`;
        $('#form-client').trigger('reset');
        $('#form-client input[name=_method]').val('post');
        $('#modal-client').modal('show');
    }
    function editClient(id){
        $('#title-client').empty();
        $('#title-client').html('Editar Cliente');
        url = `/client/${id}`;
        $('#form-client').trigger('reset');
        $('#form-client input[name=_method]').val('put');
        axios.get(url).then(res  => {
            var data = res.data.data;
            $('#form-client input[name=name]').val(data.name);
            $('#form-client input[name=cnpj]').val(data.cnpj);
            $('#form-client input[name=email]').val(data.email);
            $('#form-client input[name=phone]').val(data.phone);
            $('#form-client input[name=responsible]').val(data.responsible);
        })
        $('#modal-client').modal('show');
    }

    function submitButtonClient(){
        $('.is-invalid').empty();
        var form = document.getElementById("form-client");
        var formData = new FormData(form);
        axios.post(url, formData).then(res => {
            document.location.reload(true)
        }).catch((error)=>{
            $.each(error.response.data.errors, function (key, item) {
                $.each(item, function (k, m) {
                    $(`#form-client input[name=${key}]`)
                    .after(`<span class="is-invalid " role="alert"><small class="text-danger">${m}</small></span>`);
                    $(`#form-client input[name=${key}]`).addClass('is-invalid')
                });
            });
        });
    }
</script>
@endpush