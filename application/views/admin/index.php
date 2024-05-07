<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <?= $this->session->flashdata('msg'); ?>
    <div class="row">
        <div class="col-sm-6 d-inline-flex align-items-stretch mt-3 mt-sm-0 order-first">
            <div class="card flex-fill">
                <div class="card-body">
                    <div class="d-flex flex-fill align-items-stretch">
                        <div class="align-self-center p-4 alert-info">
                            <i class="fa fa-money-check fa-fw fa-3x"></i>
                        </div>
                        <div class="align-self-center ml-4">
                            <h5 class="card-title text-muted">Pendapatan Bulan Ini</h5>
                            <h4 class="card-subtitle mb-2 text-dark font-weight-bold text-capitalize"></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 d-inline-flex align-items-stretch mt-3 mt-sm-0 order-first">
            <div class="card flex-fill">
                <div class="card-body">
                    <div class="d-flex flex-fill align-items-stretch">
                        <div class="align-self-center p-4 alert-info">
                            <i class="fa fa-chart-line fa-fw fa-3x"></i>
                        </div>
                        <div class="align-self-center ml-4">
                            <h5 class="card-title text-muted">Keuntungan Bulan Ini</h5>
                            <h4 class="card-subtitle mb-2 text-dark font-weight-bold text-capitalize"></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <!-- Area Chart -->
            <div class="card my-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Pendapatan Perbulan Tahun <?= date('Y'); ?></h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->