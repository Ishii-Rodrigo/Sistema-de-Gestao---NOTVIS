@extends('layouts.app')

@section('title', 'Menu Principal - NOTVIS')

@section('header', '')

@section('styles')
<style>
    main {
        padding-top: 50px !important; 
        padding-bottom: 50px !important;
    }
    .card-module {
        transition: transform 0.2s, box-shadow 0.2s;
        min-height: 200px;
        border: none;
        border-radius: 1rem;
        cursor: pointer;
    }
    .card-module:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }
    .card-icon {
        width: 60px;
        height: 60px;
        border-radius: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
    }
    .card-icon i {
        font-size: 2rem;
        color: white;
    }
    .text-primary-notvis {
        color: rgb(20, 147, 220) !important;
    }
</style>
@endsection

@section('content')
<div class="container-fluid" style="flex-grow: 1;">
    <div class="text-center mb-5">
        <h1 class="display-6 fw-bold">Sistema de Gestão <span class="text-primary-notvis">NOTVIS</span></h1>
    </div>

    <div class="row g-4 justify-content-center">
        
        <div class="col-md-4 col-lg-3">
            <a href="{{ route('clientes.index') }}" class="text-decoration-none">
                <div class="card card-module shadow-sm h-100 p-4 text-center">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <div class="card-icon bg-primary">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <h5 class="card-title fw-bold">Clientes</h5>
                        <p class="card-text text-muted">Cadastro e Gestão de Clientes</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4 col-lg-3">
            <a href="{{ route('veiculos.index') }}" class="text-decoration-none">
                <div class="card card-module shadow-sm h-100 p-4 text-center">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <div class="card-icon" style="background-color: #0056b3;"> 
                            <i class="bi bi-car-front-fill"></i>
                        </div>
                        <h5 class="card-title fw-bold">Veículos</h5>
                        <p class="card-text text-muted">Cadastro e Gestão de Veículos</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4 col-lg-3">
            <a href="{{ route('produtos.index') }}" class="text-decoration-none">
                <div class="card card-module shadow-sm h-100 p-4 text-center">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <div class="card-icon" style="background-color: #00bcd4;">
                            <i class="bi bi-box-seam-fill"></i>
                        </div>
                        <h5 class="card-title fw-bold">Estoque</h5>
                        <p class="card-text text-muted">Cadastro e Controle de produtos</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4 col-lg-3">
            <a href="{{ route('vendas.index') }}" class="text-decoration-none">
                <div class="card card-module shadow-sm h-100 p-4 text-center">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <div class="card-icon bg-success" style="background-color: #28a745;">
                            <i class="bi bi-tools"></i>
                        </div>
                        <h5 class="card-title fw-bold">Serviços / Vendas</h5>
                        <p class="card-text text-muted">Orçamentos e Vendas Realizados</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4 col-lg-3">
            <a href="{{ route('relatorios.index') }}" class="text-decoration-none">
                <div class="card card-module shadow-sm h-100 p-4 text-center">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <div class="card-icon" style="background: linear-gradient(45deg, #673AB7, #9C27B0);">
                            <i class="bi bi-graph-up"></i>
                        </div>
                        <h5 class="card-title fw-bold">Relatórios</h5>
                        <p class="card-text text-muted">Relatórios Detalhados</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4 col-lg-3">
            <a href="#" class="text-decoration-none">
                <div class="card card-module shadow-sm h-100 p-4 text-center">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <div class="card-icon bg-info">
                            <i class="bi bi-calendar-event-fill"></i>
                        </div>
                        <h5 class="card-title fw-bold">Agenda</h5>
                        <p class="card-text text-muted">Agendamento de Serviços</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4 col-lg-3">
            <a href="#" class="text-decoration-none">
                <div class="card card-module shadow-sm h-100 p-4 text-center">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <div class="card-icon bg-secondary" style="background-color: #6c757d;">
                            <i class="bi bi-gear-fill"></i>
                        </div>
                        <h5 class="card-title fw-bold">Configurações</h5>
                        <p class="card-text text-muted">Configurações do Sistema</p>
                    </div>
                </div>
            </a>
        </div>

    </div>

    <div class="w-100 position-fixed bottom-0 start-0 bg-primary" style="height: 50px; background-image: linear-gradient(to right, #007bff, #00c6ff);">
        <div class="container text-center text-white p-2">
            <span class="fw-bold">© 2025 - NOTVIS. Todos os direitos reservados.</span>
        </div>
    </div>
</div>
@endsection