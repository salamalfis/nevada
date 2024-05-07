<!-- Begin Page Content -->
<div class="container-fluid mx-auto">

	<!-- Page Heading -->
	<h1 class="h3 mb-3 text-gray-800"><?= $title; ?></h1>


	<div class="row justify-content-center">
		<div class="col-md-12 ">

			<?php if ($this->session->flashdata('flash')) : ?>

				<div class="row mt 4">

					<div class="col-md-6">
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							Data barang <strong>Behasil</strong> <?= $this->session->flashdata('flash'); ?>.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>

							</button>
						</div>
					</div>
				</div>

			<?php endif; ?>



			<div class="row mt-3">
				<div class="col-md-6">
					<form action="" method="post">
						<div class="input-group">
							<input type="text" class="form-control" placeholder="Masukan Keyword Pencarian" name="keyword" autocomplete="off">

							<div class="input-group-append ml-2" id="button-addon4">
								<button class="btn btn-success" type="submit">Cari</button>
								<button class="btn 	btn-danger ml-2" type="reset">Hapus</button>
							</div>
						</div>

					</form>
				</div>
			</div>

			<div class="row mt-5">
				<div class="col-md-10">
					<h4 mt-3> Data Barang</h4>
					<?php if (empty($barang)) : ?>
						<div class="alert alert-danger" role="alert">
							Data Barang Tidak DItemukan!
						</div>
					<?php endif ?>

					<div class="card-body p-0 table-responsive">
						<table class="table table-striped mb-0 datatable">
							<thead>
								<tr>
									<th>No.</th>
									<th>Nama Barang</th>
									<th>Kategori</th>
									<th>Stok</th>
									<th>Harga</th>
									<th>Opsi</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = 1;
								foreach ($barang as $row) : ?>
									<tr>
										<td><?= $no++; ?>.</td>

										<td><?= $row['namabarang']; ?></td>
										<td><?= $row['idKategori']; ?></td>
										<td>
											<?= $row['stok']; ?>
										</td>
										<td> <?= format_uang($row['harga']); ?></td>
										<td>
											<div class="btn-group">

												<a href="<?= base_url(); ?>barang/ubah/<?= $row['id']; ?>" class="btn btn-sm btn-secondary">
													<i class="fa fa-edit"></i>
												</a>
												<a onclick="return confirm('Yakin ingin hapus data?')" href="<?= base_url(); ?>barang/hapus/<?= $row['id']; ?> " class="btn btn-sm btn-secondary">
													<i class="fa fa-trash"></i>
												</a>
											</div>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>



			</div>
		</div>

	</div>
	<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->