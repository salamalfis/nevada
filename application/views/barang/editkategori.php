<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header bg-white">
                    <div class="row">
                        <div class="col d-flex">
                            <h3 class="h5 mb-0 card-title align-self-center">
                                Ubah <?= $title; ?>
                            </h3>
                        </div>
                        <div class="col text-right">
                            <a href="<?= base_url('barang/kategori') ?>" class="btn btn-sm btn-secondary">
                                <i class="fas fa-chevron-left"></i> Batal
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="" class="" method="post">
                        <div class="form-group">
                            <input type="hidden" name="idKategori" id="idKategori" value="<?= $kategoriBarang['idKategori']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="namaKategori">Nama Kategori</label>
                            <input type="text" class="form-control" id="namaKategori" name="namaKategori" placeholder="Kategori" autocomplete="off" value="<?= $kategoriBarang['namaKategori']; ?>">
                            <small class="form-text text-danger"><?= form_error('Nama'); ?></small>
                        </div>
                        <button type="submit" class="btn btn-block btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>