<div class="content-wrapper">

    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 fontpoppins"><i class="fab fa-wpforms"></i> <b>E - NDK </b><small><i class="fa fa-angle-double-right"></i> Form Edit Data</small></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">E - NDK</a></li>
                        <li class="breadcrumb-item active">Edit Data</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <div class="content ">
        <div class="container">
            <div class="col-lg-12">
                <div class="card card-lightblue card-outline">
                    <!-- form start -->
                    <form action="<?= site_url('entry/process') ?>" method="POST" class="form-horizontal">
                        <!--ID Hidden -->
                        <input type="hidden" name="id" value="<?= $row->id ?>">
                        <div class="card-body fontpoppins-input">
                            <h6 style="color: black;padding-top:5px;padding-bottom:5px;" class="text-bold">Form Edit Data</h6>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group row">
                                        <div class="col-lg-10 col-md-10 col-sm-10">
                                            <div class="input-group">
                                                <input type="text" class="form-control form-control-sm input-area" value="<?= $row->no_ndk ?>" disabled>
                                                <label class="label">No NDK</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-group row">
                                            <div class="col-lg-10 col-md-10 col-sm-10">
                                                <div class="input-group date" id="tgl_ndk" data-target-input="nearest">
                                                    <input type="text" class="form-control form-control-sm input-area" name="tgl_ndk" value="<?= $row->tgl_ndk ?>" disabled />
                                                    <label class="label">Tanggal NDK</label>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text bg-grey"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-2">
                                                <font style="font-size: 20px" color="red"><i>*</i></font>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-group row">
                                            <div class="col-lg-10 col-md-10 col-sm-10">
                                                <div class="input-group date" id="tgl_inv" data-target-input="nearest">
                                                    <input type="text" class="form-control form-control-sm input-area datetimepicker-input" name="tgl_inv" data-target="#tgl_inv" value="<?= $row->tgl_inv ?>" />
                                                    <label class="label">Tanggal Invoice</label>
                                                    <div class="input-group-append" data-target="#tgl_inv" data-toggle="datetimepicker">
                                                        <div class="input-group-text bg-white"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            <font style="font-size: 10px" color="red"><i>kosongkan jika tidak ada !</i></font>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-group row">
                                            <div class="col-lg-10 col-md-10 col-sm-10">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="input-group">
                                                            <select class="form-control form-control-sm input-area" name="ppn_type" id="ppn_type" type="text">
                                                                <option value="" selected="selected">PPN</option>
                                                                <option value="1.1" <?= "1.1" == $row->ppn_type ? "selected" : null ?>>1.1 % </option>
                                                                <option value="11" <?= "11" == $row->ppn_type ? "selected" : null ?>>11 % </option>
                                                            </select>
                                                            <label class="label">PPN</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text form-control-sm bg-white"><b>Rp </b></span>
                                                            </div>
                                                            <input type="number" min="0" step="0.01" value="0" class="form-control form-control-sm input-area " id="ppn_amount" name="ppn_amount" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <font style="font-size: 10px;" color="red"><i> kosongkan jika tidak ada !</i></font>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-group row">
                                            <div class="col-lg-10 col-md-10 col-sm-10">
                                                <div class="input-group">
                                                    <select required class="form-control form-control-sm input-area" id="pt" name="pt" type="text" disabled>
                                                        <option disabled value="" selected>-- Pilih PT --</option>
                                                        <?php
                                                        $num = 1;
                                                        foreach ($pt as $data) { ?>
                                                            <option value="<?= $data->code ?>" <?= $data->code == $row->pt ? "selected" : null ?>><?= $num . ' - ' . $data->explanation  ?></option>
                                                        <?php $num++;
                                                        } ?>
                                                    </select>
                                                    <label class="label">Perusahaan</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-2">
                                                <font style="font-size: 20px" color="red"><i>*</i></font>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group row">
                                        <div class="col-lg-10 col-md-10 col-sm-10">
                                            <div class="input-group">
                                                <input type="text" class="form-control form-control-sm input-area" id="invoice_no" name="invoice_no" value="<?= $row->no_inv ?>">
                                                <label class="label">No Invoice</label>
                                            </div>
                                            <font style="font-size: 10px" color="red"><i>kosongkan jika tidak ada !</i></font>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-group row">
                                            <div class="col-lg-10 col-md-10 col-sm-10">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="input-group">
                                                            <select class="form-control form-control-sm input-area " name="pph_type" id="pph_type" type="text">
                                                                <option value="" selected="selected">PPH</option>
                                                                <option value="0.25" <?= "0.25" == $row->pph_type ? "selected" : null ?>>0.25 %</option>
                                                                <option value="0.5" <?= "0.5" == $row->pph_type ? "selected" : null ?>>0.5 %</option>
                                                                <option value="1.2" <?= "1.2" == $row->pph_type ? "selected" : null ?>>1.2 % </option>
                                                                <option value="2.0" <?= "2.0" == $row->pph_type ? "selected" : null ?>>2.0 % </option>
																<option value="2.5" <?= "2.5" == $row->pph_type ? "selected" : null ?>>2.5 % </option>
                                                                <option value="4.0" <?= "4.0" == $row->pph_type ? "selected" : null ?>>4.0 % </option>
                                                            </select>
                                                            <label class="label">PPH</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text form-control-sm bg-white"><b>Rp </b></span>
                                                            </div>
                                                            <input type="number" min="0" step="0.01" value="0" class="form-control form-control-sm input-area" id="pph_amount" name="pph_amount" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <font style="font-size: 10px;" color="red"><i> kosongkan jika tidak ada !</i></font>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-group row">
                                            <div class="col-lg-10 col-md-10 col-sm-10">
                                                <div class="input-group">
                                                    <input type="hidden" name="kepada" value="FIN">
                                                    <input type="text" class="form-control form-control-sm input-area" value="Dept. Finance" disabled>
                                                    <label class="label">Kepada</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-group row">
                                            <div class="col-lg-10 col-md-10 col-sm-10">
                                                <div class="input-group">
                                                    <select class="form-control form-control-sm input-area" id="currency_select" name="mata_uang" type="text" required>
                                                        <option value="1" <?= "1" == $row->mata_uang ? "selected" : null ?>> Rp - Rupiah </option>
                                                        <option value="2" <?= "2" == $row->mata_uang ? "selected" : null ?>> $ - Dollar </option>
                                                    </select>
                                                    <label class="label">Mata Uang</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-2">
                                                <font style="font-size: 20px" color="red"><i>*</i></font>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-group row">
                                            <div class="col-lg-10 col-md-10 col-sm-10">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text form-control-sm bg-white" id="currency_pot"><b>Rp </b></span>
                                                    </div>
                                                    <input type="number" min="0" step="0.01" class="form-control form-control-sm input-area" name="potongan" value="<?= $row->potongan ?>" id="potongan">
                                                    <label class="label">Potongan</label>
                                                </div>
                                                <font style="font-size: 10px;" color="red"><i> kosongkan jika tidak ada !</i></font>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-group row">
                                            <div class="col-lg-10 col-md-10 col-sm-10">
                                                <div class="input-group">
                                                    <select required class="form-control form-control-sm input-area" id="dari" name="dari" type="text" disabled>
                                                        <option disabled value="" selected>-- Pilih Department --</option>
                                                        <?php
                                                        $num = 1;
                                                        foreach ($dp as $data) { ?>
                                                            <option value="<?= $data->code ?>" <?= $data->code == $row->dari ? "selected" : null ?>><?= $num . ' - ' . $data->explanation  ?></option>
                                                        <?php $num++;
                                                        } ?>
                                                    </select>
                                                    <label class="label">Dari</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-2">
                                                <font style="font-size: 20px" color="red"><i>*</i></font>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-group row">
                                            <div class="col-lg-10 col-md-10 col-sm-10">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text form-control-sm bg-white" id="currency_nilai"><b>Rp </b></span>
                                                    </div>
                                                    <input type="number" min="0" step="0.01" class="form-control form-control-sm input-area" name="nilai_ndk" id="nilai_ndk" value="<?= $row->nilai_ndk ?>" required>
                                                    <label class="label">Nilai NDK</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-2">
                                                <font style="font-size: 20px" color="red"><i>*</i></font>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-group row">
                                            <div class="col-lg-10 col-md-10 col-sm-10">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text form-control-sm bg-white" id="currency_mat"><b>Rp </b></span>
                                                    </div>
                                                    <input type="number" min="0" step="0.01" class="form-control form-control-sm input-area" name="materai" value="<?= $row->materai ?>" id="materai">
                                                    <label class="label">Materai</label>
                                                </div>
                                                <font style="font-size: 10px;" color="red"><i> kosongkan jika tidak ada !</i></font>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- Payment Field -->
                            <h6 style="color: black;padding-bottom:5px;" class="text-bold">Payment Details</h6>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-group row">
                                            <div class="col-lg-10 col-md-10 col-sm-10">
                                                <div class="input-group">
                                                    <select class="form-control form-control-sm input-area" id="metode" name="metode" type="text" required>
                                                        <option value="" selected="selected" disabled>Pilih Metode Pembayaran</option>
                                                        <option value="C" <?= "C" == $row->metode ? "selected" : null ?>> 1 - Cash</option>
                                                        <option value="T" <?= "T" == $row->metode ? "selected" : null ?>> 2 - Transfer</option>
                                                    </select>
                                                    <label class="label">Metode Bayar</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-2">
                                                <font style="font-size: 20px" color="red"><i>*</i></font>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-group row">
                                            <div class="col-lg-10 col-md-10 col-sm-10">
                                                <div class="input-group">
                                                    <input type="text" class="form-control form-control-sm input-area" id="nama_penerima" name="nama_penerima" value="<?= $row->nama_penerima ?>" required>
                                                    <label class="label">Nama Penerima</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-2">
                                                <font style="font-size: 20px" color="red"><i>*</i></font>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4" style="display: none;" id="nrFieldRow">
                                    <div class="form-group">
                                        <div class="form-group row">
                                            <div class="col-lg-10 col-md-10 col-sm-10">
                                                <div class="input-group">
                                                    <input type="text" class="form-control form-control-sm input-area" id="no_rekening" name="no_rekening" value="<?= $row->no_rekening ?>">
                                                    <label class="label">No Rekening</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-2">
                                                <font style="font-size: 20px" color="red"><i>*</i></font>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h6 style="color: black;padding-top:5px;padding-bottom:5px;" class="text-bold">Note and Description</h6>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-group row">
                                            <div class="col-lg-10 col-md-10 col-sm-10">
                                                <div class="input-group">
                                                    <textarea class="form-control form-control-sm input-area" name="perihal" id="perihal" style="height: 100px;" required><?= $row->perihal ?></textarea>
                                                    <label class="label">Perihal</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-2">
                                                <font style="font-size: 20px" color="red"><i>*</i></font>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-group row">
                                            <div class="col-lg-10 col-md-10 col-sm-10">
                                                <div class="input-group">
                                                    <textarea class="form-control form-control-sm input-area" id="ket" name="ket" style="height: 100px;"><?= $row->ket ?></textarea>
                                                    <label class="label">Catatan</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Requester & Approver Field -->
                            <h6 style="color: black;padding-top:5px;padding-bottom:5px;" class="text-bold">Requester & Approver</h6>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-group row">
                                            <div class="col-lg-10 col-md-10 col-sm-10">
                                                <div class="input-group">
                                                    <input type="text" required class="form-control form-control-sm input-area" name="diusulkan_oleh" value="<?= $row->diusulkan_oleh ?>">
                                                    <label class="label">Diusulkan Oleh</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-2">
                                                <font style="font-size: 20px" color="red"><i>*</i></font>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-group row">
                                            <div class="col-lg-10 col-md-10 col-sm-10">
                                                <div class="input-group">
                                                    <input type="text" required class="form-control form-control-sm input-area" name="jbtn_usul" value="<?= $row->jbtn_usul ?>">
                                                    <label class="label">Jabatan</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-2">
                                                <font style="font-size: 20px" color="red"><i>*</i></font>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-group row">
                                            <div class="col-lg-10 col-md-10 col-sm-10">
                                                <div class="input-group date" id="tgl_diusulkan" data-target-input="nearest">
                                                    <input type="text" class="form-control form-control-sm input-area datetimepicker-input " name="tgl_diusulkan" data-target="#tgl_diusulkan" value="<?= $date ?>" required />
                                                    <label class="label">Tanggal Diusulkan</label>
                                                    <div class="input-group-append" data-target="#tgl_diusulkan" data-toggle="datetimepicker">
                                                        <div class="input-group-text bg-white"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-2">
                                                <font style="font-size: 20px" color="red"><i>*</i></font>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-group row">
                                            <div class="col-lg-10 col-md-10 col-sm-10">
                                                <div class="input-group">
                                                    <input type="text" required class="form-control form-control-sm input-area" name="setuju1" value="<?= $row->setuju1  ?>">
                                                    <label class="label">1. Disetujui Oleh</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-2">
                                                <font style="font-size: 20px" color="red"><i>*</i></font>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-group row">
                                            <div class="col-lg-10 col-md-10 col-sm-10">
                                                <div class="input-group">
                                                    <input type="text" required class="form-control form-control-sm input-area" name="jbtn_setuju1" value="<?= $row->jbtn_setuju1 ?>">
                                                    <label class="label">Jabatan</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-2">
                                                <font style="font-size: 20px" color="red"><i>*</i></font>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-group row">
                                            <div class="col-lg-10 col-md-10 col-sm-10">
                                                <div class="input-group date" id="tgl_setuju1" data-target-input="nearest">
                                                    <input type="text" class="form-control form-control-sm input-area datetimepicker-input " name="tgl_setuju1" value="<?= $row->tgl_setuju1 ?>" data-target="#tgl_setuju1" />
                                                    <label class="label">Tanggal Disetujui</label>
                                                    <div class="input-group-append" data-target="#tgl_setuju1" data-toggle="datetimepicker">
                                                        <div class="input-group-text bg-white"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="display:none;" id="view_more">
                                <!-- <div> -->
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <div class="form-group row">
                                                <div class="col-lg-10 col-md-10 col-sm-10">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control form-control-sm input-area" name="setuju2" value="<?= $row->setuju2 ?>">
                                                        <label class="label">2. Disetujui Oleh</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <div class="form-group row">
                                                <div class="col-lg-10 col-md-10 col-sm-10">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control form-control-sm input-area" name="jbtn_setuju2" value="<?= $row->jbtn_setuju2 ?>">
                                                        <label class="label">Jabatan</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <div class="form-group row">
                                                <div class="col-lg-10 col-md-10 col-sm-10">
                                                    <div class="input-group date" id="tgl_setuju2" data-target-input="nearest">
                                                        <input type="text" class="form-control form-control-sm input-area datetimepicker-input " name="tgl_setuju2" value="<?= $row->tgl_setuju2 ?>" data-target="#tgl_setuju2" />
                                                        <label class="label">Tanggal Disetujui</label>
                                                        <div class="input-group-append" data-target="#tgl_setuju2" data-toggle="datetimepicker">
                                                            <div class="input-group-text bg-white"><i class="fa fa-calendar"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <div class="form-group row">
                                                <div class="col-lg-10 col-md-10 col-sm-10">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control form-control-sm input-area" name="konfirm1" value="<?= $row->konfirm1 ?>">
                                                        <label class="label">1. Konfirmasi Oleh</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <div class="form-group row">
                                                <div class="col-lg-10 col-md-10 col-sm-10">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control form-control-sm input-area" name="jbtn_konfirm1" value="<?= $row->jbtn_konfirm1 ?>">
                                                        <label class="label">Jabatan</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <div class="form-group row">
                                                <div class="col-lg-10 col-md-10 col-sm-10">
                                                    <div class="input-group date" id="tgl_konfirm1" data-target-input="nearest">
                                                        <input type="text" class="form-control form-control-sm input-area datetimepicker-input " name="tgl_konfirm1" value="<?= $row->tgl_konfirm1 ?>" data-target="#tgl_konfirm1" />
                                                        <label class="label">Tanggal Dikonfirmasi</label>
                                                        <div class="input-group-append " data-target="#tgl_konfirm1" data-toggle="datetimepicker">
                                                            <div class="input-group-text bg-white"><i class="fa fa-calendar"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <div class="form-group row">
                                                <div class="col-lg-10 col-md-10 col-sm-10">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control form-control-sm input-area" name="konfirm2" value="<?= $row->konfirm2 ?>">
                                                        <label class="label">2. Konfirmasi Oleh</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <div class="form-group row">
                                                <div class="col-lg-10 col-md-10 col-sm-10">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control form-control-sm input-area" name="jbtn_konfirm2" value="<?= $row->jbtn_konfirm2 ?>">
                                                        <label class="label">Jabatan</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <div class="form-group row">
                                                <div class="col-lg-10 col-md-10 col-sm-10">
                                                    <div class="input-group date" id="tgl_konfirm2" data-target-input="nearest">
                                                        <input type="text" class="form-control form-control-sm input-area datetimepicker-input " name="tgl_konfirm2" value="<?= $row->tgl_konfirm2 ?>" data-target="#tgl_konfirm2" />
                                                        <label class="label">Tanggal Dikonfirmasi</label>
                                                        <div class="input-group-append" data-target="#tgl_konfirm2" data-toggle="datetimepicker">
                                                            <div class="input-group-text bg-white"><i class="fa fa-calendar"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <button type="button" id="view_more_button" class="btn btn-outline-primary btn-block btn-xs">VIEW MORE <i class="fa fa-arrow-down"></i> </button>
                                </div>
                            </div>
                            <br />
                            <div class="form-group row">
                                <div class="col-sm-6 ">
                                    <button type="reset" class="btn btn-danger btn-sm col-sm-3">Reset Form</button>
                                    <button type="submit" name="edit" class="btn btn-secondary btn-sm col-sm-3">Submit</button>
                                </div>
                                <div class="col-sm-6">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>