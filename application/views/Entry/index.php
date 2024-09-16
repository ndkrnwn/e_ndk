<div class="content-wrapper">

    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 fontpoppins"><i class="fab fa-wpforms"></i> <b>E - NDK </b><small><i class="fa fa-angle-double-right"></i> <?= $title ?></small></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">E - NDK</a></li>
                        <li class="breadcrumb-item active"><?= $title ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <div class="content">
        <?php $this->view('message') ?>
        <div class="container">
            <div class="col-lg-12">
                <div class="card card-lightblue card-outline fontpoppins-index">
                    <?php if ($datatable == 'db_user') { ?>
                        <div class="card-header">
                            <button id="export" data-target="#modal-default" data-toggle="modal" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-file-export"></i> <b>Report Data</b>
                            </button>
                        </div>
                    <?php }  ?>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="<?= $datatable ?>" class="table table-bordered table-hover table-sm small">
                            <thead>

                                <th class="text-center align-middle">#</th>
                                <th class="text-center align-middle">Tgl NDK</th>
                                <!-- <th class="text-center align-middle">PT</th> -->
                                <th class="text-center align-middle" width="120px">No NDK</th>
                                <th class="text-center align-middle" width="120px">No Invoice</th>
                                <th class="text-center align-middle">Perihal</th>
                                <th class="text-center align-middle">Total Nilai NDK</th>
                                <th class="text-center align-middle">Diusulkan Oleh</th>
                                <!-- <th class="text-center align-middle">Tgl Diusulkan</th> -->
                                <th class="text-center align-middle">Actions</th>

                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modal-detail">
        <div class="modal-dialog modal-lg">
            <div class="modal-content fontpoppins-index">
                <div class="modal-header">
                    <h4 class="modal-title">Detail NDK</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    </br>
                    <div class="form-group row mb-4">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="input-group">
                                <span class="form-control form-control-border form-control-sm detail-area" id="tgl_ndk"></span>
                                <label class="label-detail">Tanggal NDK</label>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="input-group">
                                <span class="form-control form-control-border form-control-sm detail-area" id="no_ndk"></span>
                                <label class="label-detail">No. NDK</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="input-group">
                                <span class="form-control form-control-border form-control-sm detail-area" id="pt"></span>
                                <label class="label-detail">PT</label>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="input-group">
                                <span class="form-control form-control-border form-control-sm detail-area" id="no_inv"></span>
                                <label class="label-detail">No. Invoice</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="input-group">
                                <span class="form-control form-control-border form-control-sm detail-area" id="kepada"></span>
                                <label class="label-detail">Kepada</label>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="input-group">
                                <span class="form-control form-control-border form-control-sm detail-area" id="dari"></span>
                                <label class="label-detail">Dari</label>
                            </div>
                        </div>
                    </div>
                    <div style="height: 80px;" class="form-group row mb-4">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="input-group">
                                <span class="form-control form-control-border form-control-sm detail-area" id="perihal"></span>
                                <label class="label-detail">Perihal</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="input-group">
                                <span class="form-control form-control-border form-control-sm detail-area" id="nilai_ndk"></span>
                                <label class="label-detail">Total Tagihan</label>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="input-group">
                                <span class="form-control form-control-border form-control-sm detail-area" id="ppn_amount"></span>
                                <label class="label-detail">PPN <span id="ppn_type"></span> %</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="input-group">
                                <span class="form-control form-control-border form-control-sm detail-area" id="pph_amount"></span>
                                <label class="label-detail">PPH <span id="pph_type"></span> %</label>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="input-group">
                                <span class="form-control form-control-border form-control-sm detail-area" id="potongan"></span>
                                <label class="label-detail">Potongan</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="input-group">
                                <span class="form-control form-control-border form-control-sm detail-area" id="materai"></span>
                                <label class="label-detail">Materai </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="input-group">
                                <span class="form-control form-control-border form-control-sm detail-area" id="total_nilai_ndk"></span>
                                <label class="label-detail">Total Dibayarkan</label>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="input-group">
                                <span class="form-control form-control-border form-control-sm detail-area" id="metode"></span>
                                <label class="label-detail">Metode Pembayaran</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="input-group">
                                <span class="form-control form-control-border form-control-sm detail-area" id="nama_penerima"></span>
                                <label class="label-detail">Nama Penerima</label>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="input-group">
                                <span class="form-control form-control-border form-control-sm detail-area" id="no_rekening"></span>
                                <label class="label-detail">No Rekening</label>
                            </div>
                        </div>
                    </div>
                    <div style="height: 80px;" class="form-group row mb-4">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="input-group">
                                <span class="form-control form-control-border form-control-sm detail-area" id="ket"></span>
                                <label class="label-detail">Keterangan</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="input-group">
                                <button type="button" id="view_more_button_detail" class="btn btn-outline-primary btn-xs">VIEW MORE <i class="fa fa-arrow-down"></i> </button>
                            </div>
                        </div>
                    </div>
                    <div style="display: none;" id="view_more_detail">
                        <div class="form-group row mb-4">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="input-group">
                                    <span class="form-control form-control-border form-control-sm detail-area" id="diusulkan_oleh"></span>
                                    <label class="label-detail">Diusulkan Oleh</label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="input-group">
                                    <span class="form-control form-control-border form-control-sm detail-area" id="tgl_diusulkan"></span>
                                    <label class="label-detail">Tanggal Diusulkan</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="input-group">
                                    <span class="form-control form-control-border form-control-sm detail-area" id="setuju1"></span>
                                    <label class="label-detail">1. Disetujui Oleh</label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="input-group">
                                    <span class="form-control form-control-border form-control-sm detail-area" id="tgl_setuju1"></span>
                                    <label class="label-detail">Tanggal Disetujui</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="input-group">
                                    <span class="form-control form-control-border form-control-sm detail-area" id="setuju2"></span>
                                    <label class="label-detail">2. Disetujui Oleh</label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="input-group">
                                    <span class="form-control form-control-border form-control-sm detail-area" id="tgl_setuju2"></span>
                                    <label class="label-detail">Tanggal Disetujui</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="input-group">
                                    <span class="form-control form-control-border form-control-sm detail-area" id="konfirm1"></span>
                                    <label class="label-detail">1. Konfirmasi Oleh </label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="input-group">
                                    <span class="form-control form-control-border form-control-sm detail-area" id="tgl_konfirm1"></span>
                                    <label class="label-detail">Tanggal Dikonfirmasi</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="input-group">
                                    <span class="form-control form-control-border form-control-sm detail-area" id="konfirm2"></span>
                                    <label class="label-detail">2. Konfirmasi Oleh</label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="input-group">
                                    <span class="form-control form-control-border form-control-sm detail-area" id="tgl_konfirm2"></span>
                                    <label class="label-detail">Tanggal Dikonfirmasi</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div><!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </div>

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <h4 class="modal-title"> <b>Print Excel</b></h4> -->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body fontpoppins-index">
                    <form action="<?= site_url('entry/print_excel') ?>" method="POST" class="form-horizontal">
                        <!-- <h6 style="color: black;padding-top:5px;padding-bottom:10px;" class="text-bold">Select Date Between</h6> -->
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <div class="input-group date" id="tgl_from" data-target-input="nearest">
                                    <input type="text" class="form-control form-control-sm datetimepicker-input input-area" name="tgl_from" data-target="#tgl_from" required />
                                    <label class="label">From</label>
                                    <div class="input-group-append" data-target="#tgl_from" data-toggle="datetimepicker">
                                        <div class="input-group-text rounded-0"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <div class="input-group date" id="tgl_to" data-target-input="nearest">
                                    <input type="text" class="form-control form-control-sm datetimepicker-input input-area" name="tgl_to" data-target="#tgl_to" required />
                                    <label class="label">To</label>
                                    <div class="input-group-append" data-target="#tgl_to" data-toggle="datetimepicker">
                                        <div class="input-group-text rounded-0"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                            </div>
                            <div class="col-6">
                                <button type="submit" name="export" value="export" class="btn btn-outline-primary btn-sm float-right"><i class="fas fa-download"></i> Download</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>