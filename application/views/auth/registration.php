<div class="container">

    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Daftar</h1>
                                </div>
                                <form class="user" method="post" action="<?= base_url('auth/registration') ?>">

                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="name" name="name" placeholder="Nama Lengkap" value="<?= set_value('name'); ?>" autocomplete="off">

                                        <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>

                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Alamat Email" value="<?= set_value('email'); ?>" autocomplete="off">

                                        <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>

                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password" autocomplete="off">

                                            <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>

                                        </div>
                                        <div class="col-sm-6">
                                            <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Konfirmasi Password" autocomplete=" off">

                                            <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>

                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-secondary btn-user btn-block">
                                        Daftar
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="<?= base_url('auth/forgotpassword') ?>">Lupa Password</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href=" <?= base_url('auth') ?>">Sudah Punya Akun? Masuk Sekarang</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>