@extends('layout.layoutAuth')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h4>Login Admin</h4>
        </div>

        <div class="card-body">
            <form method="POST" action="/login" class="needs-validation" novalidate="">
                @csrf
                <div class="form-group">
                    <label for="username">Username</label>
                    <input id="username" type="username" class="form-control" name="username" tabindex="1" required
                        autofocus>
                    <div class="invalid-feedback">
                        Masukkan username
                    </div>
                </div>

                <div class="form-group">
                    <div class="d-block">
                        <label for="password" class="control-label">Password</label>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                    <div class="invalid-feedback">
                        Masukkan password
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
