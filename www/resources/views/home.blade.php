@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Clients</div>
                <div class="card-body">
                    @can('Cliente|Criar')<button onclick="createClient({{Auth::user()->company_id}})"
                        class="btn btn-primary my-2"> Criar
                        Cliente</button> @endcan
                    <table class="table mt-5" id="table-clients">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>CNPJ</th>
                                <th>Responsavel</th>
                                <th>Ações Cliente</th>
                                <th>Enderecos</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($company->clients as $client)
                            <tr>
                                <td>{{$client->name}}</td>
                                <td>{{$client->cnpj}}</td>
                                <td>{{$client->responsible}}</td>
                                <td>
                                    <div class="btn-group">
                                        @can('Cliente|Ver')
                                        <button type="button" class="btn btn-secondary"
                                            onclick="showClient({{$client->id}})"><i class="fa fa-list"></i></button>
                                        @endcan
                                        @can('Cliente|Editar')<button type="button" class="btn btn-secondary"
                                            onclick="editClient({{$client->id}})"><i
                                                class="fa fa-pencil"></i></button>@endcan
                                        @can('Cliente|Excluir')<button type="button"
                                            onclick="deleteRegistro('{{route('client.destroy', $client->id)}}')"
                                            class="btn btn-secondary"><i class="fa fa-trash"></i></button>
                                        @endcan
                                    </div>
                                </td>
                                <td>
                                    @can('Endereco|Criar')
                                    <button type="button" class="btn btn-secondary"
                                        onclick="createAdress({{$client->id}})"><i class="fa fa-plus"></i>
                                    </button>
                                    @endcan
                                    @if($client->adresses->count() < 1) Adicione um endereço. @endif @foreach ($client->
                                        adresses->sortBy('id') as $adress)
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-secondary dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Endereço {{$adress->district}} <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                @can('Endereco|Editar')
                                                <li><button type="button" onclick="editAdress({{$adress->id}})"
                                                        class="btn">Editar</button></li>
                                                @endcan
                                                @can('Endereco|Ver')
                                                <li><button onclick="showAdress({{$adress->id}})" type="button"
                                                        class="btn">Ver</button></li>
                                                @endcan
                                                @can('Endereco|Excluir')
                                                <li><button
                                                        onclick="deleteRegistro('{{route('adress.destroy', $adress->id)}}')"
                                                        type="button" class="btn">Excluir</button></li>
                                                @endcan
                                            </ul>
                                        </div>
                                        @endforeach

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@include('clients.modalClient')
@include('adresses.modalAdress')
@include('shared.modalDelete')
@include('shared.modalShow')
@endsection
@push('js')
<script>
    document.addEventListener("DOMContentLoaded", function() {
    $('#table-clients').DataTable();
    });
</script>
@endpush