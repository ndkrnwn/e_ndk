<?php if ($this->session->has_userdata('success')) { ?>
    <div id="swalDefaultSuccess" data-flash="<?= $this->session->flashdata('success'); ?>"> </div>
<?php } else if ($this->session->has_userdata('error')) { ?>
    <div id="swalDefaultError" data-flash="<?= $this->session->flashdata('error'); ?>"> </div>
<?php } else if ($this->session->has_userdata('deleted')) { ?>
    <div id="swalDefaultDeleted" data-flash="<?= $this->session->flashdata('deleted'); ?>"> </div>
<?php } else if ($this->session->has_userdata('warning')) { ?>
    <div id="swalDefaultWarning" data-flash="<?= $this->session->flashdata('warning'); ?>"> </div>
<?php } else if ($this->session->has_userdata('login')) { ?>
    <div id="swalLogin" data-flash="<?= $this->session->flashdata('login'); ?>"> </div>
<?php } else if ($this->session->has_userdata('failed')) { ?>
    <div id="swalFailed" data-flash="<?= $this->session->flashdata('failed'); ?>"> </div>
<?php } else if ($this->session->has_userdata('relation')) { ?>
    <div id="swalRelation" data-flash="<?= $this->session->flashdata('relation'); ?>"> </div>
<?php } ?>