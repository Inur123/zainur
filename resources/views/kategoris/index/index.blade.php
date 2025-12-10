@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Kategori Items</div>
                <div class="card-body">
                    @include('kategoris.index.filter')
                    @include('kategoris.index.table')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
@include('kategoris.index.js')
@endsection
