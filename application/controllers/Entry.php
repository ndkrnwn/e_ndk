<?php
defined('BASEPATH') or exit('No direct script access allowed');

// require APPPATH . 'third_party/phpoffice/vendor/autoload.php';

// use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Entry extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model(['m_parameter', 'm_entry']);
        $this->load->library(['fungsi', 'pdf', 'pagination']);
    }

    // fn Get Data by User Id
    public function index()
    {
        $data['title'] = 'List Data';
        $data['datatable'] = 'db_user';
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('entry/index', $data);
        $this->load->view('template/footer');
        $this->load->view('datatables/datatable');
    }

    // fn Get Data Deleted
    public function deleted()
    {
        check_admin();
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('entry/deleted');
        $this->load->view('template/footer');
        $this->load->view('datatables/datatable');
    }

    // fn Get All Data
    public function all()
    {
        check_admin();
        $data['title'] = 'List All Data';
        $data['datatable'] = 'db_all';
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('entry/index', $data);
        $this->load->view('template/footer');
        $this->load->view('datatables/datatable');
    }

    // fn return $data ServerSide
    function fn($data)
    {
        return $data;
    }

    // fn ServerSidePagination - All Data
    public function get_all()
    {
        $list = $this->m_entry->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $field) {

            // Convert Output
            $metodeEl =  $field->metode == 'T' ? 'Transfer' : 'Cash';
            $no_rekeningEl = $field->no_rekening == null ? '-' : $field->no_rekening;
            $tgl_setuju1El = $field->tgl_setuju1 == null ? '-' : indo_date($field->tgl_setuju1);
            $setuju2El = $field->setuju2 == null ? '-' : $field->setuju2;

            // New Field Invoice, Potongan, PPH, & PPN
            $tgl_inv = $field->tgl_inv == null ? '-' : indo_date($field->tgl_inv);
            $no_inv = $field->no_inv == null ? '-' : $field->no_inv;
            $pph_type = $field->pph_type == null ? '-' : $field->pph_type;
            $ppn_type = $field->ppn_type == null ? '-' : $field->ppn_type;
            $pph_amount = $field->mata_uang == 1 ? indo_currency($field->pph_amount) : usd_currency($field->pph_amount);
            $ppn_amount = $field->mata_uang == 1 ? indo_currency($field->ppn_amount) : usd_currency($field->ppn_amount);
            $potongan = $field->mata_uang == 1 ? indo_currency($field->potongan) : usd_currency($field->potongan);
            $materai = $field->mata_uang == 1 ? indo_currency($field->materai) : usd_currency($field->materai);
            // End

            $jbtn_setuju2El = $field->jbtn_setuju2 == null ? '-' : $field->jbtn_setuju2;
            $tgl_setuju2El = $field->tgl_setuju2 == null ? '-' : indo_date($field->tgl_setuju2);
            $konfirm1El = $field->konfirm1 == null ? '-' : $field->konfirm1;
            $jbtn_konfirm1El = $field->jbtn_konfirm1 == null ? '-' : $field->jbtn_konfirm1;
            $tgl_konfirm1El = $field->tgl_konfirm1 == null ? '-' : indo_date($field->tgl_konfirm1);
            $konfirm2El = $field->konfirm2 == null ? '-' : $field->konfirm2;
            $jbtn_konfirm2El = $field->jbtn_konfirm2 == null ? '-' : $field->jbtn_konfirm2;
            $tgl_konfirm2El = $field->tgl_konfirm2 == null ? '-' : indo_date($field->tgl_konfirm2);
            $nilai_ndkEl = $field->mata_uang == 1 ? indo_currency($field->nilai_ndk) : usd_currency($field->nilai_ndk);
            $total_nilai_ndkEl = $field->mata_uang == 1 ? indo_currency($field->total_nilai_ndk) : usd_currency($field->total_nilai_ndk);


            // Convert urlCopy
            $urlCopy = site_url('entry/copy/' . $field->id . '/' . $field->createdby);
            $CopyEl = nl2br(<<<HTML
                <a href="{$urlCopy}" class="btn btn-outline-secondary btn-sm" data-toggle="tooltip" title="Copy"><i class="fas fa-copy"></i>
                </a>
                HTML);

            // Convert urlCetak
            $urlCetak = site_url('entry/cetak_ndk/' . $field->id);
            $CetakEl = nl2br(<<<HTML
                <a href="{$urlCetak}" class="btn btn-outline-primary btn-sm" target="_blank" data-toggle="tooltip" title="Print"><i class="fas fa-print"></i>
                </a>
                HTML);

            $urlEdit = site_url('entry/edit_adm/' . $field->id);
            $EditEl = nl2br(<<<HTML
                <a href="{$urlEdit}" class="btn btn-outline-info btn-sm" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i>
                </a>
                HTML);

            // jika data sudah pernah dicetak 
            if ($field->print == 'Y') {

                // Delete ( Dipindahkan ke table tn_entry_del )
                $DelEl = <<<HTML
                <button id="move" data-id="{$field->id}" class="btn btn-outline-danger btn-sm" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></button>
                HTML;
            } else {

                // Delete
                $DelEl = <<<HTML
                <button id="delete" data-id="{$field->id}" class="btn btn-outline-danger btn-sm" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i>
                </button>
                HTML;
            }

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = indo_date($field->tgl_ndk);
            $row[] = $field->no_ndk;
            $row[] = $no_inv;
            $row[] = $field->perihal;
            $row[] = $total_nilai_ndkEl;
            $row[] = $field->diusulkan_oleh;

            $row[] = <<<HTML
                <div class="">
                <button id="detail" 
                                 data-target="#modal-detail" 
                                 data-toggle="modal" 
                                 class="btn btn-outline-warning btn-sm" 
                                 data-pt="{$field->pt}" 
                                 data-tgl_inv="{$tgl_inv}"
                                 data-no_inv="{$no_inv}"
                                 data-no_ndk="{$field->no_ndk}" 
                                 data-metode="{$metodeEl}" 
                                 data-tgl_ndk="{$this->fn(indo_date($field->tgl_ndk))}" 
                                 data-kepada="{$field->kepada}" 
                                 data-dari="{$field->dari}" 
                                 data-perihal="{$field->perihal}" 
                                 data-nilai_ndk="{$nilai_ndkEl}" 

                                 data-ppn_type="{$ppn_type}" 
                                 data-pph_type="{$pph_type}" 
                                 data-ppn_amount="{$ppn_amount}" 
                                 data-pph_amount="{$pph_amount}" 
                                 data-potongan="{$potongan}" 
                                 data-materai="{$materai}" 
                                 data-total_nilai_ndk="{$total_nilai_ndkEl}" 

                                 data-ket="{$field->ket}" 
                                 data-nama_penerima="{$field->nama_penerima}" 
                                 data-no_rekening="{$no_rekeningEl}" 
                                 data-diusulkan_oleh="{$field->diusulkan_oleh}" 
                                 data-jbtn_usul="{$field->jbtn_usul}" 
                                 data-tgl_diusulkan="{$this->fn(indo_date($field->tgl_diusulkan))}" 
                                 data-setuju2="{$setuju2El}" 
                                 data-jbtn_setuju2="{$jbtn_setuju2El}" 
                                 data-tgl_setuju2="{$tgl_setuju2El}" 
                                 data-setuju1="{$field->setuju1}" 
                                 data-jbtn_setuju1="{$field->jbtn_setuju1}" 
                                 data-tgl_setuju1="{$tgl_setuju1El}" 
                                 data-konfirm2="{$konfirm2El}" 
                                 data-jbtn_konfirm2="{$jbtn_konfirm2El}" 
                                 data-tgl_konfirm2="{$tgl_konfirm2El}" 
                                 data-konfirm1="{$konfirm1El}" 
                                 data-jbtn_konfirm1="{$jbtn_konfirm1El}" 
                                 data-tgl_konfirm1="{$tgl_konfirm1El}" 
                                 data-toggle="tooltip" 
                                 title="Detail"> 
                             <i class="fa fa-info"></i>
                                </button>
                                {$EditEl}
                                {$CopyEl}
                                {$CetakEl}
                                {$DelEl}
                </div>
            HTML;

            $data[] = $row;
        }

        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->m_entry->count_all(),
            "recordsFiltered" => $this->m_entry->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    // fn ServerSidePagination - Data by User Id
    public function get_data_user()
    {
        $id = $this->session->userdata('ses_id');
        $list = $this->m_entry->get_datatables($id);
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $field) {

            // Convert Output
            $metodeEl =  $field->metode == 'T' ? 'Transfer' : 'Cash';
            $no_rekeningEl = $field->no_rekening == null ? '-' : $field->no_rekening;
            $tgl_setuju1El = $field->tgl_setuju1 == null ? '-' : indo_date($field->tgl_setuju1);
            $setuju2El = $field->setuju2 == null ? '-' : $field->setuju2;

            // New Field Invoice, Potongan, PPH, & PPN
            $tgl_inv = $field->tgl_inv == null ? '-' : indo_date($field->tgl_inv);
            $no_inv = $field->no_inv == null ? '-' : $field->no_inv;
            $pph_type = $field->pph_type == null ? '-' : $field->pph_type;
            $ppn_type = $field->ppn_type == null ? '-' : $field->ppn_type;
            $pph_amount = $field->mata_uang == 1 ? indo_currency($field->pph_amount) : usd_currency($field->pph_amount);
            $ppn_amount = $field->mata_uang == 1 ? indo_currency($field->ppn_amount) : usd_currency($field->ppn_amount);
            $potongan = $field->mata_uang == 1 ? indo_currency($field->potongan) : usd_currency($field->potongan);
            $materai = $field->mata_uang == 1 ? indo_currency($field->materai) : usd_currency($field->materai);
            // End

            $jbtn_setuju2El = $field->jbtn_setuju2 == null ? '-' : $field->jbtn_setuju2;
            $tgl_setuju2El = $field->tgl_setuju2 == null ? '-' : indo_date($field->tgl_setuju2);
            $konfirm1El = $field->konfirm1 == null ? '-' : $field->konfirm1;
            $jbtn_konfirm1El = $field->jbtn_konfirm1 == null ? '-' : $field->jbtn_konfirm1;
            $tgl_konfirm1El = $field->tgl_konfirm1 == null ? '-' : indo_date($field->tgl_konfirm1);
            $konfirm2El = $field->konfirm2 == null ? '-' : $field->konfirm2;
            $jbtn_konfirm2El = $field->jbtn_konfirm2 == null ? '-' : $field->jbtn_konfirm2;
            $tgl_konfirm2El = $field->tgl_konfirm2 == null ? '-' : indo_date($field->tgl_konfirm2);
            $nilai_ndkEl = $field->mata_uang == 1 ? indo_currency($field->nilai_ndk) : usd_currency($field->nilai_ndk);
            $total_nilai_ndkEl = $field->mata_uang == 1 ? indo_currency($field->total_nilai_ndk) : usd_currency($field->total_nilai_ndk);

            // Convert urlCopy
            $urlCopy = site_url('entry/copy/' . $field->id . '/' . $field->createdby);
            $CopyEl = nl2br(<<<HTML
             <a href="{$urlCopy}" class="btn btn-outline-secondary btn-sm" data-toggle="tooltip" title="Copy"><i class="fas fa-copy"></i>
             </a>
             HTML);

            // Convert urlCetak
            $urlCetak = site_url('entry/cetak_ndk/' . $field->id);
            $CetakEl = nl2br(<<<HTML
             <a href="{$urlCetak}" class="btn btn-outline-primary btn-sm" target="_blank" data-toggle="tooltip" title="Print"><i class="fas fa-print"></i>
             </a>
             HTML);

            // jika data sudah pernah dicetak 
            if ($field->print == 'Y') {
                // Edit ( Tidak Bisa Edit Data)
                $EditEl = <<<HTML
             <button id="button-edit" class="btn btn-outline-info btn-sm" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></button>
             HTML;
                // Delete ( Dipindahkan ke tb_entry_del )
                $DelEl = <<<HTML
             <button id="move" data-id="{$field->id}" class="btn btn-outline-danger btn-sm" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></button>
             HTML;
            } else {
                // Edit
                $urlEdit = site_url('entry/edit/' . $field->id);
                $EditEl = nl2br(<<<HTML
                 <a href="{$urlEdit}" class="btn btn-outline-info btn-sm" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i>
                 </a>
                 HTML);

                // Delete
                $DelEl = <<<HTML
             <button id="delete" data-id="{$field->id}" class="btn btn-outline-danger btn-sm" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i>
             </button>
             HTML;
            }

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = indo_date($field->tgl_ndk);
            $row[] = $field->no_ndk;
            $row[] = $no_inv;
            $row[] = $field->perihal;
            $row[] = $total_nilai_ndkEl;
            $row[] = $field->diusulkan_oleh;

            $row[] = <<<HTML
             <div class="">
             <button id="detail" 
                                 data-target="#modal-detail" 
                                 data-toggle="modal" 
                                 class="btn btn-outline-warning btn-sm" 
                                 data-pt="{$field->pt}" 
                                 data-tgl_inv="{$tgl_inv}"
                                 data-no_inv="{$no_inv}"
                                 data-no_ndk="{$field->no_ndk}" 
                                 data-metode="{$metodeEl}" 
                                 data-tgl_ndk="{$this->fn(indo_date($field->tgl_ndk))}" 
                                 data-kepada="{$field->kepada}" 
                                 data-dari="{$field->dari}" 
                                 data-perihal="{$field->perihal}" 
                                 data-nilai_ndk="{$nilai_ndkEl}" 

                                 data-ppn_type="{$ppn_type}" 
                                 data-pph_type="{$pph_type}" 
                                 data-ppn_amount="{$ppn_amount}" 
                                 data-pph_amount="{$pph_amount}" 
                                 data-potongan="{$potongan}" 
                                 data-materai="{$materai}" 
                                 data-total_nilai_ndk="{$total_nilai_ndkEl}" 

                                 data-ket="{$field->ket}" 
                                 data-nama_penerima="{$field->nama_penerima}" 
                                 data-no_rekening="{$no_rekeningEl}" 
                                 data-diusulkan_oleh="{$field->diusulkan_oleh}" 
                                 data-jbtn_usul="{$field->jbtn_usul}" 
                                 data-tgl_diusulkan="{$this->fn(indo_date($field->tgl_diusulkan))}" 
                                 data-setuju2="{$setuju2El}" 
                                 data-jbtn_setuju2="{$jbtn_setuju2El}" 
                                 data-tgl_setuju2="{$tgl_setuju2El}" 
                                 data-setuju1="{$field->setuju1}" 
                                 data-jbtn_setuju1="{$field->jbtn_setuju1}" 
                                 data-tgl_setuju1="{$tgl_setuju1El}" 
                                 data-konfirm2="{$konfirm2El}" 
                                 data-jbtn_konfirm2="{$jbtn_konfirm2El}" 
                                 data-tgl_konfirm2="{$tgl_konfirm2El}" 
                                 data-konfirm1="{$konfirm1El}" 
                                 data-jbtn_konfirm1="{$jbtn_konfirm1El}" 
                                 data-tgl_konfirm1="{$tgl_konfirm1El}" 
                                 data-toggle="tooltip" 
                                 title="Detail"> 
                             <i class="fa fa-info"></i>
                             </button>
                             {$EditEl}
                             {$CopyEl}
                             {$CetakEl}
                             {$DelEl}
             </div>
         HTML;

            $data[] = $row;
        }

        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->m_entry->count_all($id),
            "recordsFiltered" => $this->m_entry->count_filtered($id),
            "data" => $data,
        );
        echo json_encode($output);
    }

    // fn ServerSidePagination - All Deleted Data
    public function get_data_deleted()
    {
        $list = $this->m_entry->get_datatables_deleted();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $field) {

            // Convert Output
            $metodeEl =  $field->metode == 'T' ? 'Transfer' : 'Cash';
            $no_rekeningEl = $field->no_rekening == null ? '-' : $field->no_rekening;
            $tgl_setuju1El = $field->tgl_setuju1 == null ? '-' : indo_date($field->tgl_setuju1);
            $setuju2El = $field->setuju2 == null ? '-' : $field->setuju2;

            // New Field Invoice, Potongan, PPH, & PPN
            $tgl_inv = $field->tgl_inv == null ? '-' : indo_date($field->tgl_inv);
            $no_inv = $field->no_inv == null ? '-' : $field->no_inv;
            $pph_type = $field->pph_type == null ? '-' : $field->pph_type;
            $ppn_type = $field->ppn_type == null ? '-' : $field->ppn_type;
            $pph_amount = $field->mata_uang == 1 ? indo_currency($field->pph_amount) : usd_currency($field->pph_amount);
            $ppn_amount = $field->mata_uang == 1 ? indo_currency($field->ppn_amount) : usd_currency($field->ppn_amount);
            $potongan = $field->mata_uang == 1 ? indo_currency($field->potongan) : usd_currency($field->potongan);
            $materai = $field->mata_uang == 1 ? indo_currency($field->materai) : usd_currency($field->materai);
            // End

            $jbtn_setuju2El = $field->jbtn_setuju2 == null ? '-' : $field->jbtn_setuju2;
            $tgl_setuju2El = $field->tgl_setuju2 == null ? '-' : indo_date($field->tgl_setuju2);
            $konfirm1El = $field->konfirm1 == null ? '-' : $field->konfirm1;
            $jbtn_konfirm1El = $field->jbtn_konfirm1 == null ? '-' : $field->jbtn_konfirm1;
            $tgl_konfirm1El = $field->tgl_konfirm1 == null ? '-' : indo_date($field->tgl_konfirm1);
            $konfirm2El = $field->konfirm2 == null ? '-' : $field->konfirm2;
            $jbtn_konfirm2El = $field->jbtn_konfirm2 == null ? '-' : $field->jbtn_konfirm2;
            $tgl_konfirm2El = $field->tgl_konfirm2 == null ? '-' : indo_date($field->tgl_konfirm2);
            $nilai_ndkEl = $field->mata_uang == 1 ? indo_currency($field->nilai_ndk) : usd_currency($field->nilai_ndk);
            $total_nilai_ndkEl = $field->mata_uang == 1 ? indo_currency($field->total_nilai_ndk) : usd_currency($field->total_nilai_ndk);

            // Restore
            $RestEl = <<<HTML
                  <button id="restore" data-id="{$field->id}" class="btn btn-outline-primary btn-sm" data-toggle="tooltip" title="Restore"><i class="fa fa-trash-restore"></i></button>
                  HTML;

            // Delete
            $DelEl = <<<HTML
                  <button id="del_idx2" data-id="{$field->id}" class="btn btn-outline-danger btn-sm" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i>
                  </button>
                  HTML;

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = indo_date($field->tgl_ndk);
            $row[] = $field->no_ndk;
            $row[] = $no_inv;
            $row[] = $field->perihal;
            $row[] = $total_nilai_ndkEl;
            $row[] = $field->diusulkan_oleh;

            $row[] = <<<HTML
                   <div class="">
                   <button id="detail" 
                   data-target="#modal-detail" 
                                      data-toggle="modal" 
                                      class="btn btn-outline-warning btn-sm" 
                                      data-pt="{$field->pt}" 
                                      data-tgl_inv="{$tgl_inv}"
                                      data-no_inv="{$no_inv}"
                                      data-no_ndk="{$field->no_ndk}" 
                                      data-metode="{$metodeEl}" 
                                      data-tgl_ndk="{$this->fn(indo_date($field->tgl_ndk))}" 
                                      data-kepada="{$field->kepada}" 
                                      data-dari="{$field->dari}" 
                                      data-perihal="{$field->perihal}" 
                                      data-nilai_ndk="{$nilai_ndkEl}"
                                      
                                      data-ppn_type="{$ppn_type}" 
                                      data-pph_type="{$pph_type}" 
                                      data-ppn_amount="{$ppn_amount}" 
                                      data-pph_amount="{$pph_amount}" 
                                      data-potongan="{$potongan}" 
                                      data-materai="{$materai}" 
                                      data-total_nilai_ndk="{$total_nilai_ndkEl}" 

                                      data-ket="{$field->ket}" 
                                      data-nama_penerima="{$field->nama_penerima}" 
                                      data-no_rekening="{$no_rekeningEl}" 
                                      data-diusulkan_oleh="{$field->diusulkan_oleh}" 
                                      data-jbtn_usul="{$field->jbtn_usul}" 
                                      data-tgl_diusulkan="{$this->fn(indo_date($field->tgl_diusulkan))}" 
                                      data-setuju2="{$setuju2El}" 
                                      data-jbtn_setuju2="{$jbtn_setuju2El}" 
                                      data-tgl_setuju2="{$tgl_setuju2El}" 
                                      data-setuju1="{$field->setuju1}" 
                                      data-jbtn_setuju1="{$field->jbtn_setuju1}" 
                                      data-tgl_setuju1="{$tgl_setuju1El}" 
                                      data-konfirm2="{$konfirm2El}" 
                                      data-jbtn_konfirm2="{$jbtn_konfirm2El}" 
                                      data-tgl_konfirm2="{$tgl_konfirm2El}" 
                                      data-konfirm1="{$konfirm1El}" 
                                      data-jbtn_konfirm1="{$jbtn_konfirm1El}" 
                                      data-tgl_konfirm1="{$tgl_konfirm1El}" 
                                      data-toggle="tooltip" 
                                      title="Detail"> 
                                   <i class="fa fa-info"></i>
                                   </button>
                                   {$RestEl}
                                   {$DelEl}
                   </div>
               HTML;

            $data[] = $row;
        }

        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->m_entry->count_all_deleted(),
            "recordsFiltered" => $this->m_entry->count_filtered_deleted(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    // fn Add New Data NDK
    public function add()
    {
        $date = new DateTime();
        $timezone = new DateTimeZone('Asia/Kuala_Lumpur');
        $date->setTimezone($timezone);

        $currentDateTime = $date->format('Y-m-d');

        $data['pt'] = $this->m_parameter->get_pt();
        $data['dp'] = $this->m_parameter->get_dept();
        $data['date'] = $currentDateTime;
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('entry/add', $data);
        $this->load->view('template/footer');
    }

    //Fn Edit Data NDK
    public function edit($id)
    {
        $date = new DateTime();
        $timezone = new DateTimeZone('Asia/Kuala_Lumpur');
        $date->setTimezone($timezone);

        $currentDateTime = $date->format('Y-m-d');

        $user_id = $this->session->userdata('ses_id');
        $query = $this->m_entry->get($id, $user_id);
        if ($query->num_rows() > 0) {
            $data['pt'] = $this->m_parameter->get_pt();
            $data['dp'] = $this->m_parameter->get_dept();
            $data['date'] = $currentDateTime;
            $data['row'] = $query->row();
            $this->load->view('template/header');
            $this->load->view('template/navbar');
            $this->load->view('entry/edit', $data);
            $this->load->view('template/footer');
        } else {
            echo "<script>alert('Data cannot be found');";
            echo "window.location='" . site_url('entry') . "';</script>";
        }
    }

    // fn Edit Data NDK - Admin ( Modul NDK ALL )
    public function edit_adm($id)
    {
        $date = new DateTime();
        $timezone = new DateTimeZone('Asia/Kuala_Lumpur');
        $date->setTimezone($timezone);

        $currentDateTime = $date->format('Y-m-d');

        $query = $this->m_entry->get_adm($id);
        if ($query->num_rows() > 0) {
            $data['pt'] = $this->m_parameter->get_pt();
            $data['dp'] = $this->m_parameter->get_dept();
            $data['date'] = $currentDateTime;
            $data['row'] = $query->row();
            $this->load->view('template/header');
            $this->load->view('template/navbar');
            $this->load->view('entry/edit', $data);
            $this->load->view('template/footer');
        } else {
            echo "<script>alert('Data cannot be found');";
            echo "window.location='" . site_url('entry/all') . "';</script>";
        }
    }

    // fn Copy Data NDK
    public function copy($id, $createdby)
    {
        $date = new DateTime();
        $timezone = new DateTimeZone('Asia/Kuala_Lumpur');
        $date->setTimezone($timezone);

        $currentDateTime = $date->format('Y-m-d');

        $query = $this->m_entry->get($id, $createdby);
        if ($query->num_rows() > 0) {
            $data['pt'] = $this->m_parameter->get_pt();
            $data['dp'] = $this->m_parameter->get_dept();
            $data['date'] = $currentDateTime;
            $data['row'] = $query->row();
            $this->load->view('template/header');
            $this->load->view('template/navbar');
            $this->load->view('entry/copy', $data);
            $this->load->view('template/footer');
        } else {
            echo "<script>alert('Data cannot be found');";
            echo "window.location='" . site_url('entry') . "';</script>";
        }
    }

    // fn Process Edit , Add, & Copy
    public function process()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($_POST['add'])) {
            $this->m_entry->add($post);
            $this->m_entry->no_ndk($post);
        } else if (isset($_POST['edit'])) {
            $this->m_entry->edit($post);
        } else if (isset($_POST['copy'])) {
            $this->m_entry->add($post);
            $this->m_entry->no_ndk($post);
        }

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'success message');
        }
        echo "<script>window.location='" . site_url('entry') . "';</script>";
    }

    // fn Print Data NDK - PDF
    public function cetak_ndk()
    {
        $id = $this->uri->segment(3);
        $this->m_entry->cetak_updt($id);

        $DB = $this->load->database("second", TRUE);
        $query = "SELECT a.* , b.explanation as pt_name  , c.position , c.name as fullname
        FROM tb_entry a 
        JOIN $DB->database.ms_parameter b ON a.pt = b.code
        JOIN $DB->database.ms_user c ON a.createdby = c.id 
        WHERE a.id='$id' ";

        $result = $this->db->query($query);
        $row = $result->row(); // menggunakan method row() agar mengambil hanya 1 row saja
        $data = array(
            'pt' => $row->pt_name,
            'position' => $row->position,
            'no_ndk' => $row->no_ndk,
            'tgl_inv' => $row->tgl_inv,
            'no_inv' => $row->no_inv,
            'tgl_ndk' => $row->tgl_ndk,
            'perihal' => $row->perihal,
            'ket' => $row->ket,
            'mata_uang' => $row->mata_uang,
            'nilai_ndk' => $row->nilai_ndk,
            // new
            'pph_type' => $row->pph_type,
            'pph_amount' => $row->pph_amount,
            'ppn_type' => $row->ppn_type,
            'ppn_amount' => $row->ppn_amount,
            'potongan' => $row->potongan,
            'materai' => $row->materai,
            'total_nilai_ndk' => $row->total_nilai_ndk,
            'fullname' => $row->fullname,
			// end new.
            'diusulkan_oleh' => $row->diusulkan_oleh,
            'jbtn_usul' => $row->jbtn_usul,
            'tgl_diusulkan' => $row->tgl_diusulkan,
            'setuju1' => $row->setuju1,
            'jbtn_setuju1' => $row->jbtn_setuju1,
            'tgl_setuju1' => $row->tgl_setuju1,
            'setuju2' => $row->setuju2,
            'jbtn_setuju2' => $row->jbtn_setuju2,
            'tgl_setuju2' => $row->tgl_setuju2,
            'konfirm1' => $row->konfirm1,
            'jbtn_konfirm1' => $row->jbtn_konfirm1,
            'tgl_konfirm1' => $row->tgl_konfirm1,
            'konfirm2' => $row->konfirm2,
            'jbtn_konfirm2' => $row->jbtn_konfirm2,
            'tgl_konfirm2' => $row->tgl_konfirm2,
        );

        // Jika ppn/pph true maka akan ke form_ndk_new
        // if ($row->is_pph_ppn == 1) {
        //     $cetak_file = 'temp/form_ndk_2';
        // } else {
        $cetak_file = 'temp/form_ndk';
        // }
        $this->load->view($cetak_file, $data);
        // redirect('temp/form_ndk', $data);
    }

    // fn Delete Data NDK 
    public function del()
    {
        $id = $this->input->post('id', TRUE);

        if (isset($_POST['delete'])) {
            $this->m_entry->del($id);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('deleted', 'deleted message');
            }
        } else if (isset($_POST['del_idx2'])) {
            $this->m_entry->del_idx2($id);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('deleted', 'deleted message');
            }
        }
    }

    // fn Delete Data NDK - Printed
    public function move()
    {
        $id = $this->input->post('id', TRUE);

        if (isset($_POST['move'])) {
            $this->m_entry->insert_into($id);
            $this->m_entry->del($id);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('deleted', 'deleted message');
            }
        }
    }

    // fn Restore Deleted Data
    public function restore()
    {
        $id = $this->input->post('id', TRUE);

        if (isset($_POST['restore'])) {
            $this->m_entry->restore_into($id);
            $this->m_entry->del_idx2($id);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('deleted', 'deleted message');
            }
        }
    }

    public function print_excel()
    {
        include APPPATH . 'third_party/PHPExcel/Classes/PHPExcel.php';
        include APPPATH . 'third_party/PHPExcel/Classes/PHPExcel/Writer/Excel2007.php';

        $objPHPExcel = new PHPExcel();

        $idrFormat = '_-Rp* #,##0_-;[Red]-Rp* #,##0_-';
        $usdFormat = '_($* #,##0.00_);_($* (#,##0.00);_($* "-"??_);_(@_)';

        $objPHPExcel->getProperties()->setTitle("Report Data");
        $objPHPExcel->getProperties()->setSubject("");
        $objPHPExcel->getProperties()->setDescription("");

        $style_col = [
            'font' => ['bold' => true],
            'alignment' => [
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allborders' => ['style' =>  PHPExcel_Style_Border::BORDER_THIN],
            ],
        ];

        if (isset($_POST['export'])) { // Cek apakah user telah memilih filter dan klik tombol tampilkan           
            $tgl1 = $_POST['tgl_from'];
            $tgl2 = $_POST['tgl_to'];
            $id = $this->session->userdata('ses_id');
            $dataNdk = $this->m_entry->get_excel($tgl1, $tgl2, $id);

            $objPHPExcel->getActiveSheet()->setCellValue('A1', "REPORT DATA NDK");

            $objPHPExcel->getActiveSheet()->mergeCells('A1:U2');
            $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
            $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

            for ($column = 'A'; $column <= 'U'; $column++) {
                $objPHPExcel->setActiveSheetIndex(0)->getStyle($column . '3')->applyFromArray($style_col);
            }

            $objPHPExcel->getActiveSheet()->setCellValue('A3', "No");
            $objPHPExcel->getActiveSheet()->setCellValue('B3', "PT");
            $objPHPExcel->getActiveSheet()->setCellValue('C3', "No NDK");
            $objPHPExcel->getActiveSheet()->setCellValue('D3', "Tanggal");
            $objPHPExcel->getActiveSheet()->setCellValue('E3', "No Inovice");
            $objPHPExcel->getActiveSheet()->setCellValue('F3', "Dari");
            $objPHPExcel->getActiveSheet()->setCellValue('G3', "Perihal");
            $objPHPExcel->getActiveSheet()->setCellValue('H3', "Nilai");
            $objPHPExcel->getActiveSheet()->setCellValue('I3', "PPH");
            $objPHPExcel->getActiveSheet()->setCellValue('J3', "PPH Amount");
            $objPHPExcel->getActiveSheet()->setCellValue('K3', "PPN");
            $objPHPExcel->getActiveSheet()->setCellValue('L3', "PPN Amount");
            $objPHPExcel->getActiveSheet()->setCellValue('M3', "Materai");
            $objPHPExcel->getActiveSheet()->setCellValue('N3', "Total Nilai");
            $objPHPExcel->getActiveSheet()->setCellValue('O3', "Metode Pembayaran");
            $objPHPExcel->getActiveSheet()->setCellValue('P3', "Nama Penerima");
            $objPHPExcel->getActiveSheet()->setCellValue('Q3', "No Rekening");
            $objPHPExcel->getActiveSheet()->setCellValue('R3', "Diusulkan Oleh");
            $objPHPExcel->getActiveSheet()->setCellValue('S3', "Tgl Diusulkan");
            $objPHPExcel->getActiveSheet()->setCellValue('T3', "Disetujui 1");
            $objPHPExcel->getActiveSheet()->setCellValue('U3', "Tgl Disetujui 1");

            $baris = 4;
            $x = 1;
            if ($dataNdk->result() !== null && count($dataNdk->result()) > 0) {
                foreach ($dataNdk->result() as $data) {
                    for ($column = 'A'; $column <= 'U'; $column++) {
                        $objPHPExcel->setActiveSheetIndex(0)->getStyle($column . $baris)->applyFromArray([
                            'borders' => [
                                'allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
                            ],
                        ]);
                    }
                    if ($data->mata_uang == 1) {
                        $curFormat = $idrFormat;
                    } else {
                        $curFormat = $usdFormat;
                    }
                    $objPHPExcel->getActiveSheet()->setCellValue('A' . $baris, $x);
                    $objPHPExcel->getActiveSheet()->setCellValue('B' . $baris, $data->pt_name);
                    $objPHPExcel->getActiveSheet()->setCellValue('C' . $baris, $data->no_ndk);
                    $objPHPExcel->getActiveSheet()->setCellValue('D' . $baris, indo_date($data->tgl_ndk));
                    $objPHPExcel->getActiveSheet()->setCellValue('E' . $baris, $data->no_inv);
                    $objPHPExcel->getActiveSheet()->setCellValue('F' . $baris, $data->dari_name);
                    $objPHPExcel->getActiveSheet()->setCellValue('G' . $baris, $data->perihal);
                    $objPHPExcel->getActiveSheet()->getStyle('H' . $baris)
                        ->getNumberFormat()
                        ->setFormatCode($curFormat);
                    $objPHPExcel->getActiveSheet()->setCellValue('H' . $baris, $data->nilai_ndk);
                    $objPHPExcel->getActiveSheet()->setCellValue('I' . $baris, $data->pph_type == null ? "-" : "PPH " . $data->pph_type . "%");
                    $objPHPExcel->getActiveSheet()->getStyle('J' . $baris)
                        ->getNumberFormat()
                        ->setFormatCode($curFormat);
                    $objPHPExcel->getActiveSheet()->setCellValue('J' . $baris, $data->pph_amount == 0 ? "-" : $data->pph_amount);
                    $objPHPExcel->getActiveSheet()->setCellValue('K' . $baris, $data->ppn_type == null ? "-" : "PPH " . $data->ppn_type . "%");
                    $objPHPExcel->getActiveSheet()->getStyle('L' . $baris)
                        ->getNumberFormat()
                        ->setFormatCode($curFormat);
                    $objPHPExcel->getActiveSheet()->setCellValue('L' . $baris, $data->ppn_amount == 0 ? "-" : $data->ppn_amount);
                    $objPHPExcel->getActiveSheet()->getStyle('M' . $baris)
                        ->getNumberFormat()
                        ->setFormatCode($curFormat);
                    $objPHPExcel->getActiveSheet()->setCellValue('M' . $baris, $data->materai == 0 ? "-" : $data->materai);
                    $objPHPExcel->getActiveSheet()->getStyle('N' . $baris)
                        ->getNumberFormat()
                        ->setFormatCode($curFormat);
                    $objPHPExcel->getActiveSheet()->setCellValue('N' . $baris, $data->total_nilai_ndk);
                    $objPHPExcel->getActiveSheet()->setCellValue('O' . $baris, $data->metode == 'C' ? "Cash" : "Transfer");
                    $objPHPExcel->getActiveSheet()->setCellValue('P' . $baris, $data->nama_penerima);
                    $objPHPExcel->getActiveSheet()->setCellValue('Q' . $baris, $data->no_rekening == null ? "-" : $data->no_rekening);
                    $objPHPExcel->getActiveSheet()->setCellValue('R' . $baris, $data->diusulkan_oleh);
                    $objPHPExcel->getActiveSheet()->setCellValue('S' . $baris, indo_date($data->tgl_diusulkan));
                    $objPHPExcel->getActiveSheet()->setCellValue('T' . $baris, $data->setuju1);
                    $objPHPExcel->getActiveSheet()->setCellValue('U' . $baris, $data->tgl_setuju1 == null ? "-" : indo_date($data->tgl_setuju1));

                    $x++;
                    $baris++;
                }
            } else {
                $objPHPExcel->getActiveSheet()->setCellValue('A5', "no data available in database");
                $objPHPExcel->getActiveSheet()->mergeCells('A5:U5');
                $objPHPExcel->getActiveSheet()->getStyle('A5')->getFont()->setBold(true);
                $objPHPExcel->getActiveSheet()->getStyle('A5')->getFont()->setSize(12);
                $objPHPExcel->getActiveSheet()->getStyle('A5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            }

            $filename = "ReportNDK" . ".xlsx";

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename=' . $filename);
            header('Cache-Control: max-age=0');

            $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $writer->save('php://output');

            exit;
        }
    }

    // fn Export Data to Excel
    // public function print_excel()
    // {
    //     $spreadsheet = new Spreadsheet();
    //     $worksheet = $spreadsheet->getActiveSheet();

    //     $idrFormat = '_-Rp* #,##0_-;[Red]-Rp* #,##0_-';
    //     $usdFormat = '_($* #,##0.00_);_($* (#,##0.00);_($* "-"??_);_(@_)';

    //     $spreadsheet->getProperties()->setCreator("Point Of Sales");
    //     $spreadsheet->getProperties()->setLastModifiedBy("Point Of Sales");
    //     $spreadsheet->getProperties()->setTitle("Report Data");
    //     $spreadsheet->getProperties()->setSubject("");
    //     $spreadsheet->getProperties()->setDescription("");

    //     $style_col = [
    //         'font' => ['bold' => true],
    //         'alignment' => [
    //             'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
    //             'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
    //         ],
    //         'borders' => [
    //             'allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
    //         ],
    //     ];

    //     if (isset($_POST['export'])) {
    //         $tgl1 = $_POST['tgl_from'];
    //         $tgl2 = $_POST['tgl_to'];
    //         $id = $this->session->userdata('ses_id');

    //         $dataNdk = $this->m_entry->get_excel($tgl1, $tgl2, $id);

    //         $worksheet->setCellValue('A1', "REPORT DATA NDK");
    //         $worksheet->mergeCells('A1:T2');
    //         $worksheet->getStyle('A1')->getFont()->setBold(true);
    //         $worksheet->getStyle('A1')->getFont()->setSize(15);
    //         $worksheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    //         $worksheet->getStyle('A1')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

    //         for ($column = 'A'; $column <= 'T'; $column++) {
    //             $worksheet->getStyle($column . '3')->applyFromArray($style_col);
    //         }

    //         $worksheet->setCellValue('A3', "No");
    //         $worksheet->setCellValue('B3', "PT");
    //         $worksheet->setCellValue('C3', "No NDK");
    //         $worksheet->setCellValue('D3', "Tanggal");
    //         $worksheet->setCellValue('E3', "No Inovice");
    //         $worksheet->setCellValue('F3', "Dari");
    //         $worksheet->setCellValue('G3', "Perihal");
    //         $worksheet->setCellValue('H3', "Nilai");
    //         $worksheet->setCellValue('I3', "PPH");
    //         $worksheet->setCellValue('J3', "PPH Amount");
    //         $worksheet->setCellValue('K3', "PPN");
    //         $worksheet->setCellValue('L3', "PPN Amount");
    //         $worksheet->setCellValue('M3', "Total Nilai");
    //         $worksheet->setCellValue('N3', "Metode Pembayaran");
    //         $worksheet->setCellValue('O3', "Nama Penerima");
    //         $worksheet->setCellValue('P3', "No Rekening");
    //         $worksheet->setCellValue('Q3', "Diusulkan Oleh");
    //         $worksheet->setCellValue('R3', "Tgl Diusulkan");
    //         $worksheet->setCellValue('S3', "Disetujui 1");
    //         $worksheet->setCellValue('T3', "Tgl Disetujui 1");

    //         $baris = 4;
    //         $x = 1;
    //         if ($dataNdk->result() !== null && count($dataNdk->result()) > 0) {
    //             foreach ($dataNdk->result() as $data) {
    //                 for ($column = 'A'; $column <= 'T'; $column++) {
    //                     $worksheet->getStyle($column . $baris)->applyFromArray([
    //                         'borders' => [
    //                             'allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
    //                         ],
    //                     ]);
    //                 }
    //                 if ($data->mata_uang == 1) {
    //                     $curFormat = $idrFormat;
    //                 } else {
    //                     $curFormat = $usdFormat;
    //                 }
    //                 $worksheet->setCellValue('A' . $baris, $x);
    //                 $worksheet->setCellValue('B' . $baris, $data->pt_name);
    //                 $worksheet->setCellValue('C' . $baris, $data->no_ndk);
    //                 $worksheet->setCellValue('D' . $baris, indo_date($data->tgl_ndk));
    //                 $worksheet->setCellValue('E' . $baris, $data->no_inv);
    //                 $worksheet->setCellValue('F' . $baris, $data->dari_name);
    //                 $worksheet->setCellValue('G' . $baris, $data->perihal);
    //                 $worksheet->getStyle('H' . $baris)
    //                     ->getNumberFormat()
    //                     ->setFormatCode($curFormat);
    //                 $worksheet->setCellValue('H' . $baris, $data->nilai_ndk);
    //                 $worksheet->setCellValue('I' . $baris, $data->pph_type == null ? "-" : "PPH " . $data->pph_type . "%");
    //                 $worksheet->getStyle('J' . $baris)
    //                     ->getNumberFormat()
    //                     ->setFormatCode($curFormat);
    //                 $worksheet->setCellValue('J' . $baris, $data->pph_amount == 0 ? "-" : $data->pph_amount);
    //                 $worksheet->setCellValue('K' . $baris, $data->ppn_type == null ? "-" : "PPH " . $data->ppn_type . "%");
    //                 $worksheet->getStyle('L' . $baris)
    //                     ->getNumberFormat()
    //                     ->setFormatCode($curFormat);
    //                 $worksheet->setCellValue('L' . $baris, $data->ppn_amount == 0 ? "-" : $data->ppn_amount);
    //                 $worksheet->getStyle('M' . $baris)
    //                     ->getNumberFormat()
    //                     ->setFormatCode($curFormat);
    //                 $worksheet->setCellValue('M' . $baris, $data->total_nilai_ndk);
    //                 $worksheet->setCellValue('N' . $baris, $data->metode == 'C' ? "Cash" : "Transfer");
    //                 $worksheet->setCellValue('O' . $baris, $data->nama_penerima);
    //                 $worksheet->setCellValue('P' . $baris, $data->no_rekening == null ? "-" : $data->no_rekening);
    //                 $worksheet->setCellValue('Q' . $baris, $data->diusulkan_oleh);
    //                 $worksheet->setCellValue('R' . $baris, indo_date($data->tgl_diusulkan));
    //                 $worksheet->setCellValue('S' . $baris, $data->setuju1);
    //                 $worksheet->setCellValue('T' . $baris, $data->tgl_setuju1 == null ? "-" : indo_date($data->tgl_setuju1));

    //                 $x++;
    //                 $baris++;
    //             }
    //         } else {
    //             $worksheet->setCellValue('A5', "no data available in database");
    //             $worksheet->mergeCells('A5:T5');
    //             $worksheet->getStyle('A5')->getFont()->setBold(true);
    //             $worksheet->getStyle('A5')->getFont()->setSize(12);
    //             $worksheet->getStyle('A5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    //             $worksheet->getStyle('A5')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
    //         }

    //         $filename = "ReportNDK" . ".xlsx";

    //         $writer = new Xlsx($spreadsheet);
    //         header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    //         header('Content-Disposition: attachment;filename="' . $filename . '"');
    //         header('Cache-Control: max-age=0');
    //         $writer->save('php://output');
    //     }
    //     exit;
    // }
}
