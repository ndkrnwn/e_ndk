<div class="content-wrapper">

    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> <i class="fas fa-user mr-3"></i><b>User </b><small><i class="fa  fa-angle-double-right"></i> Edit Profile</small></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">User</a></li>
                        <li class="breadcrumb-item active">Edit Profile</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <div class="content">
        <div class="container">
            <div class="col-lg-10">
                <div class="card card-lightblue card-outline">
                    <!-- <div class="card-header">
                        <h3 class="card-title" style="
                font-family:Helvetica Neue,Helvetica,Arial,sans-serif;
                font-size:18px;
                color:gray;
                ">Edit Form</h3>
                    </div> -->
                    <!-- form start -->
                    <form action="" method="POST" class="form-horizontal">
                        <div class="card-body fontpoppins-input">
                            <h6 style="color: black;padding-top:5px;padding-bottom:5px;" class="text-bold">Form Edit Profile</h6>
                            <input type="hidden" name="id" value="<?= $row->id ?>">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="text" class="form-control form-control-sm input-area" name="nik" value="<?= $row->nik ?>">
                                            <label class="label">NIK</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="text" class="form-control form-control-sm input-area" name="fullname" value="<?= $row->name ?>" required>
                                            <label class="label">Full Name</label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">


                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <select class="form-control form-control-sm input-area" id="pt" name="pt" type="text">
                                                <option disabled value="" selected>-Choose PT-</option>
                                                <?php
                                                $num = 1;
                                                foreach ($pt as $data) { ?>
                                                    <option value="<?= $data->code ?>" <?= $data->code == $row->pt ? "selected" : null ?>><?= $num . ' - ' . $data->explanation  ?></option>
                                                <?php $num++;
                                                } ?>
                                            </select>
                                            <label class="label">PT</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="text" required class="form-control form-control-sm input-area" name="username" value="<?= $row->username ?>" readonly>
                                            <label class="label">Username</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <select required class="form-control form-control-sm input-area" id="department" name="department" type="text">
                                                <option disabled value="" selected>-Choose Department-</option>
                                                <?php
                                                $num = 1;
                                                foreach ($dp as $data) { ?>
                                                    <option value="<?= $data->code ?>" <?= $data->code == $row->dept_code ? "selected" : null ?>><?= $num . ' - ' . $data->explanation  ?></option>
                                                <?php $num++;
                                                } ?>
                                            </select>
                                            <label class="label">Department</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="password" class="form-control form-control-sm input-area" name="password" value="<?= $this->input->post('password') ?>" placeholder="********">
                                            <label class="label">Password</label>
                                        </div>
                                        <font style="font-size: 12px" color="red"><i><?= form_error('password') ?></i></font>

                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="input-group">

                                            <input type="text" class="form-control form-control-sm input-area" name="position" value="<?= $row->position ?>">
                                            <label class="label">Position</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="password" class="form-control form-control-sm input-area" name="pass-conf" value="<?= $this->input->post('pass-conf') ?>" placeholder="********">
                                            <label class="label">Re-Type Password</label>
                                        </div>
                                        <font style="font-size: 12px;" color="red"><i><?= form_error('pass-conf') ?></i></font>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="form-group row">
                                <div class="col-sm-6 ">
                                    <button type="submit" class="btn btn-secondary btn-sm col-sm-3">Submit</button>
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