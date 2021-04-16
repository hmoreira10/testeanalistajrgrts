<div class="modal" tabindex="-1" id="modal-adress" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title-adress">Adicionar Endereço</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['id' => 'form-adress']) !!}
                {!! Form::hidden('_method', null) !!}
                <div class="form-row">
                    <div class="form-group col-2">
                        {!! Form::label('cep', 'Cep') !!}
                        {!! Form::text('cep', null, ['class' => 'form-control'])!!}
                    </div>
                    <div class="form-group col-2">
                        <button onclick="searchCep()" type="button" class="btn btn-secondary">Procurar</button>
                    </div>
                    <div class="form-group col-2">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <input type="checkbox" name="fav" aria-label="...">
                            </span>
                            {!! Form::label('fav', 'Principal') !!}
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-2">
                        {!! Form::label('number', 'Número') !!}
                        {!! Form::number('number', null, ['class' => 'form-control',
                        'placeholder' => 'Número'])!!}
                    </div>
                    <div class="form-group col-5">
                        {!! Form::label('patio', 'Logradouro') !!}
                        {!! Form::text('patio', null, ['class' => 'form-control',
                        'placeholder' => 'Logradouro'])!!}
                    </div>
                    <div class="form-group col-5">
                        {!! Form::label('district', 'Bairro') !!}
                        {!! Form::text('district', null, ['class' => 'form-control',
                        'placeholder' => 'Bairro'])!!}
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-5">
                        {!! Form::label('complement', 'Complemento') !!}
                        {!! Form::text('complement', null, ['class' => 'form-control',
                        'placeholder' => 'Complemento'])!!}
                    </div>
                    <div class="form-group col-5">
                        {!! Form::label('city', 'Cidade') !!}
                        {!! Form::text('city', null, ['class' => 'form-control',
                        'placeholder' => 'Cidade'])!!}
                    </div>
                    <div class="form-group col-2">
                        {!! Form::label('state', 'Estado') !!}
                        {!! Form::text('state', null, ['class' => 'form-control',
                        'placeholder' => 'Estado'])!!}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                {{-- {!! Form::submit('Enviar', ['class' => 'btn btn-primary']) !!} --}}
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                <button type="button" class="btn btn-primary" onclick="submitButtonAdress()"> Enviar</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@push('js')
<script>
    function createAdress(client_id){

        $('#title-adress').empty();
        $('#title-adress').html('Adicionar Endereço');
        url = `/client/${client_id}/adress`;
        $('#form-adress').trigger('reset');
        $('#form-adress input[name=_method]').val('post');
        $('#modal-adress').modal('show');
    }
    function editAdress(id){
        $('#title-adress').empty();
        $('#title-adress').html('Editar Endereço');
        url = `/adress/${id}`;
        $('#form-adress').trigger('reset');
        $('#form-adress input[name=_method]').val('put');
        axios.get(url).then(res => {
        var data = res.data.data;
        $('#form-adress input[name=cep]').val(data.cep);
        $('#form-adress input[name=complement]').val(data.complement);
        $('#form-adress input[name=number]').val(data.number);
        $('#form-adress input[name=patio]').val(data.patio);
        $('#form-adress input[name=district]').val(data.district);
        $('#form-adress input[name=city]').val(data.city);
        $('#form-adress input[name=state]').val(data.state);
        if(data.fav) $('#form-adress input[name=fav]').prop('checked', true);
        })
        $('#modal-adress').modal('show');
    }

    function submitButtonAdress(){
        var form = document.getElementById("form-adress");
        var formData = new FormData(form);
        console.log(url);
        axios.post(url, formData).then(res => {
            document.location.reload(true)
        }).catch((error)=>{
            $.each(error.response.data.errors, function (key, item) {
                $.each(item, function (k, m) {
                    $(`#form-adress input[name=${key}]`)
                    .after(`<span class="is-invalid " role="alert"><small class="text-danger">${m}</small></span>`);
                    $(`#form-adress input[name=${key}]`).addClass('is-invalid')
                });
            });
        });
    }
    function searchCep(){
        var cep = $('#form-adress input[name=cep]').val();
        axios.get(`/viacep/${cep}`).then(res => {
            var data = res.data;
            console.log(data)
            $('#form-adress input[name=patio]').val(data.logradouro)
            $('#form-adress input[name=district]').val(data.bairro)
            $('#form-adress input[name=city]').val(data.localidade)
            $('#form-adress input[name=state]').val(data.uf)
        })
    }
</script>
@endpush