<div class="modal" tabindex="-1" id="modal-show" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> Mostrando informações</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="show-info">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
            </div>
        </div>
    </div>
</div>
@push('js')
<script>
    let urlShow = '';
    function showClient(client_id){
        urlShow = `/client/${client_id}`;
        $('#show-info').empty();
        axios.get(urlShow).then(res => {
            var data = res.data.data
            
            var content = $(`
                <h5>Cliente</h5>
                <ul>
                <li><strong>Nome:</strong> ${data.name}</li>
                <li><strong>CNPJ:</strong> ${data.cnpj}</li>
                <li><strong>Email:</strong> ${data.email}</li>
                <li><strong>Telefone:</strong> ${data.phone}</li>
                <li><strong>Responsável:</strong> ${data.responsible}</li>
                </ul>
            `);
            $('#show-info').append(content);
            if(data.adresses.length > 0){
                var hr = $('<hr/><h5>Endereços</h5>');
                $('#show-info').append(hr);
                data.adresses.forEach(element => {
                    var adress = $(`<p>Endereço ${element.district}</p>
                    <ul><li>
                    <p>
                        CEP: ${element.cep} <br/>
                        Endereço: ${element.district}, 
                        ${element.patio} <br/> 
                        ${(element.complement)? `Complemento: `+ element.complement+`, `: ``}
                        ${(element.number)? `Num. `+ element.number+`, `: ``} 
                        ${element.city} - ${element.state}
                        </p></li>
                        </ul><br/>`)
                    $('#show-info').append(adress);
                })
            }
        })
        $('#modal-show').modal('show');
    }
    function showAdress(adress_id){
        urlShow = `/adress/${adress_id}`;
        $('#show-info').empty();
        axios.get(urlShow).then(res => {
            console.log(res)
            var data = res.data.data
            var adress = $(`<p>Endereço ${data.district}</p>
            <ul><li>
                <p>
                CEP: ${data.cep} <br />
                Endereço: ${data.district},
                ${data.patio} <br />
                ${(data.complement)? `Complemento: `+ data.complement+`, `: ``}
                ${(data.number)? `Num. `+ data.number+`, `: ``}
                ${data.city} - ${data.state}
                </p>    
            </li></ul>
            <br />`)
            $('#show-info').append(adress);
        })
        $('#modal-show').modal('show');
    }
</script>
@endpush