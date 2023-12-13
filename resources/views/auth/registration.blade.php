@extends('app')
@section('content')
    <main class="signup-form">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card">
                        <h3 class="card-header text-center">Register User</h3>
                        <div class="card-body">
                            <form action="{{ route('register.custom') }}" method="POST">
                                @csrf
                                <div class="form-group mb-3">
                                    <input type="text" placeholder="Name" id="name" class="form-control" name="nom"
                                        required autofocus>
                                    @if ($errors->has('nom'))
                                        <span class="text-danger">{{ $errors->first('nom') }}</span>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <input type="text" placeholder="prenom" id="prenom" class="form-control" name="prenom"
                                        required autofocus>
                                    @if ($errors->has('prenom'))
                                        <span class="text-danger">{{ $errors->first('prenom') }}</span>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <input type="text" placeholder="profession" id="profession" class="form-control"
                                        name="profession" required autofocus>
                                    @if ($errors->has('profession'))
                                        <span class="text-danger">{{ $errors->first('profession') }}</span>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <input type="tel" placeholder="phone" id="phone" class="form-control" name="phone"
                                        required autofocus>
                                    @if ($errors->has('phone'))
                                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <input type="text" placeholder="Name" id="biographie" class="form-control"
                                        name="biographie" required autofocus>
                                    @if ($errors->has('biographie'))
                                        <span class="text-danger">{{ $errors->first('biographie') }}</span>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <input type="text" placeholder="Email" id="email_address" class="form-control"
                                        name="email" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <input type="password" placeholder="Password" id="password" class="form-control"
                                        name="password" required>
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <div class="checkbox">
                                        <label><input type="checkbox" name="remember"> Remember Me</label>
                                    </div>
                                </div>
                                <div class="d-grid mx-auto">
                                    <button type="submit" class="btn btn-dark btn-block">Sign up</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
