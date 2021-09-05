<div class="row mt-4">
    <div class="col-md-12 col-sm-12">
        <div>
            <div class="card-body">
                <form method="POST" action="{{ route('user.update_password') }}">
                    @csrf

                    @foreach ($errors->all() as $error)
                    <p class="alert alert-danger py-0">{{ $error }}</p>
                    @endforeach

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right text-muted">Mot de passe
                            actuel</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="current_password"
                                autocomplete="current-password">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right text-muted">Nouveau Mot de
                            passe</label>

                        <div class="col-md-6">
                            <input id="new_password" type="password" class="form-control" name="new_password"
                                autocomplete="current-password">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right text-muted">Confirmez le mot
                            de
                            passe</label>

                        <div class="col-md-6">
                            <input id="new_confirm_password" type="password" class="form-control"
                                name="new_confirm_password" autocomplete="current-password">
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-outline-secondary"><i class="fa fa-user-lock mr-2"></i>
                                Mettre à jour
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>