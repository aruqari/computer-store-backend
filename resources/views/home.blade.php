@extends('layout.layout')

@section('content')
    <!-- Main Content -->
    <div class="section-header">
        <h1>Admin Page</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Hi {{ Auth::user()->username }}</h4>
                    </div>
                    <div class="card-body">
                        Ini adalah halaman admin.
                    </div>
                </div>
            </div>
        </div>
    @endsection
