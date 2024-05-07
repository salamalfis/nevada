<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

	<div class="row justify-content-center">
		<div class="col-md-6">

			<div class="card mt-5">
				<div class="card-header">
					Form Ubah Data Barang
				</div>
				<div class="card-body">



					<form action="" class="" method="post">

						<div class="form-group">
							<input type="hidden" name="id" value="<?= $barang['id']; ?>" id="id">
						</div>



						<div class="form-group">
							<label for="idKategori">Kategori Barang</label>
							<select class="form-control" id="idKategori" name="idKategori">

								<?php foreach ($kategori as $k) : ?>
									<option <?= $k->namaKategori == $barang['idKategori'] ? "selected" : ""; ?> value="<?= $k->namaKategori ?>"><?= $k->namaKategori ?></option>

								<?php endforeach; ?>
								<!-- <option value="Philips">Philips</option>
					      <option value="Miyako">Miyako</option>
					      <option value="Hock">Hock</option>
					      <option value="Cosmos">Cosmos</option>
					      <option value="Rinnai">Rinnai</option> -->
							</select>
							<small class=" form-text text-danger"><?= form_error('Kategori'); ?></small>
						</div>

						<div class="form-group">
							<label for="namabarang">Nama Barang</label>
							<input type="text" class="form-control" id="namabarang" name="namabarang" placeholder="Nama Barang..." autocomplete="off" value="<?= $barang['namabarang']; ?>">
							<small class="form-text text-danger"><?= form_error('namabarang'); ?></small>
						</div>


						<div class="form-group">
							<label for="namabarang">Nama Barang</label>
							<input type="text" class="form-control" id="namabarang" name="namabarang" placeholder="Nama Barang..." autocomplete="off" value="<?= $barang['namabarang']; ?>">
							<small class=" form-text text-danger"><?= form_error('namabarang'); ?></small>
						</div>

						<div class="form-group">
							<label for="harga">Harga Barang</label>
							<input type="text" class="form-control" id="harga" name="harga" placeholder="Harga Barang..." autocomplete="off" value="<?= $barang['harga']; ?>">
							<small class="form-text text-danger"><?= form_error('harga'); ?></small>
						</div>

						<div class="form-group">
							<label for="stok">Stok Barang</label>
							<input type="text" class="form-control" id="stok" name="stok" placeholder="Stok Barang..." autocomplete="off" value="<?= $barang['stok']; ?>">
							<small class="form-text text-danger"><?= form_error('stok'); ?></small>
						</div>



						<a href="<?= base_url(); ?>barang" class="btn btn-secondary">Kembali</a>


						<button type="submit" class="btn btn-primary float-right mr-3">Ubah Data</button>


					</form>
				</div>
			</div>

		</div>
	</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->