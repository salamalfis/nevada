<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

	<div class="row justify-content-center">
		<div class="col-lg-8">

			<div class="card mt-5">
				<div class="card-header">
					Form Tambah Data Barang
				</div>
				<div class="card-body">

					<?php if (validation_errors()) : ?>

						<div class="alert alert-danger" role="alert">

							<?= validation_errors(); ?>

						</div>

					<?php endif; ?>

					<form action="" method="post">

						<div class="form-group">
							<label for="idKategori">Kategori</label>
							<select id="idKategori" name="idKategori" class="form-control">
								<option value="">Pilih Kategori</option>
								<?php foreach ($kategori as $k) : ?>
									<option value="<?= $k->namaKategori ?>"><?= $k->namaKategori ?></option>
								<?php endforeach; ?>

								<!-- <option value="Oven">Oven</option>
								<option value="MagicCom">Magic Com</option>
								<option value="Piring">Piring</option>
								<option value="Kompor">Kompor</option>
								<option value="Blender">Blender</option> -->
							</select>
							<?= form_error('idKategori'); ?>
						</div>


						<div class="form-group">
							<label for="namabarang">Nama Barang</label>
							<input type="text" class="form-control" id="namabarang" name="namabarang" placeholder="Nama Barang..." autocomplete="off">
							<small class="form-text text-danger"><?= form_error('namabarang'); ?></small>
						</div>

						<div class="form-group">
							<label for="harga">Harga Barang</label>
							<input type="text" class="form-control" id="harga" name="harga" placeholder="Harga Barang..." autocomplete="off">
							<small class="form-text text-danger"><?= form_error('harga'); ?></small>
						</div>

						<div class="form-group">
							<label for="stok">Stok Barang</label>
							<input type="text" class="form-control" id="stok" name="stok" placeholder="Stok Barang..." autocomplete="off">
							<small class="form-text text-danger"><?= form_error('stok'); ?></small>
						</div>



						<a href="<?= base_url(); ?>barang" class="btn btn-secondary">Kembali</a>


						<button type="submit" class="btn btn-primary float-right mr-3" name="tambah">Tambah Data</button>

						<button type="reset" class="btn btn-danger float-right mr-3" name="reset">Hapus</button>
					</form>
				</div>
			</div>



		</div>
	</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->