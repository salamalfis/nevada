<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

	<div class="row mt-3">
		<div class="col-md-6">

			<div class="card" style="width: 18rem;">

				<div class="card-body">

					<h5 class="card-title"><?= $barang['namabarang'];  ?></h5>
					<h6 class="card-text">Merk: <?= $barang['merk'] ?></h6>
					<h6 class="card-text">Kode Barang: <?= $barang['kodebarang'] ?></h6>
					<h6 class="card-text">Jumlah Barang: <?= $barang['jumlahbarang'] ?></h6>
					<h6 class="card-text">Harga Modal: Rp.<?= $barang['hargamodal'] ?></h6>
					<h6 class="card-text">Harga Jual: Rp.<?= $barang['hargajual'] ?></h6>
					<a href="<?= base_url(); ?>barang" class="btn btn-secondary">Kembali</a>
				</div>
			</div>


		</div>
	</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->