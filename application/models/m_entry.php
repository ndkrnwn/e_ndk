<?php
defined('BASEPATH') or exit('No direct script access allowed');

class m_entry extends CI_Model
{

    // start datatables
    var $column_order = array(null, 'pt', 'no_ndk', 'tgl_ndk', 'perihal', 'nilai_ndk', 'diusulkan_oleh', 'tgl_diusulkan'); //set column field database for datatable orderable
    var $column_search = array('pt', 'no_ndk', 'tgl_ndk', 'perihal', 'nilai_ndk', 'diusulkan_oleh', 'tgl_diusulkan'); //set column field database for datatable searchable
    var $order = array('id' => 'desc'); // default order

    // ServerSide Pagination User / All
    private function _get_datatables_query($id = null)
    {
        $this->load->database("default", TRUE);
        // $this->load->database("second", TRUE);
        if ($id != null) {
            $this->db->select('a.*');
            // $this->db->select('a.* ,b.explanation as kepada_name, c.explanation as dari_name, d.explanation as pt_name');
            $this->db->from('tb_entry as a');
            $this->db->where('a.createdby', $id);
            // $this->db->join('db_master.ms_parameter as b', 'a.kepada = b.code');
            // $this->db->join('db_master.ms_parameter as c', 'a.dari = c.code');
            // $this->db->join('db_master.ms_parameter as d', 'a.pt = d.code');
        } else {
            $this->db->select('a.*');
            $this->db->from('tb_entry as a');
        }


        $i = 0;
        foreach ($this->column_search as $item) { // loop column
            if (isset($_POST['search']['value'])) { // if datatable send POST for search
                if ($i === 0) { // first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) { // here order processing
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables($id = null)
    {
        if ($id != null) {
            $this->_get_datatables_query($id);
        } else {
            $this->_get_datatables_query();
        }
        if (isset($_POST['length']) && isset($_POST['start']))
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered($id = null)
    {
        if ($id != null) {
            $this->_get_datatables_query($id);
        } else {
            $this->_get_datatables_query();
        }
        $query = $this->db->get();
        return $query->num_rows();
    }

    function count_all($id = null)
    {
        $this->db->from('tb_entry');
        if ($id != null) {
            $this->db->where('createdby', $id);
        }
        return $this->db->count_all_results();
    }

    // ServerSide Pagination All Deleted data
    private function _get_datatables_query_deleted()
    {
        $this->load->database("default", TRUE);
        $this->db->select('a.*');
        $this->db->from('tb_entry_del as a');

        $i = 0;
        foreach ($this->column_search as $item) { // loop column
            if (isset($_POST['search']['value'])) { // if datatable send POST for search
                if ($i === 0) { // first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) { // here order processing
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables_deleted()
    {
        $this->_get_datatables_query_deleted();
        if (isset($_POST['length']) && isset($_POST['start']))
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_deleted()
    {
        $this->_get_datatables_query_deleted();
        $query = $this->db->get();
        return $query->num_rows();
    }

    function count_all_deleted()
    {
        $this->db->from('tb_entry_del');
        return $this->db->count_all_results();
    }

    // fn Get Data NDK by Id and User ID
    public function get($id = null, $user_id = null)
    {
        $DB = $this->load->database("second", TRUE);
        $this->db->select('a.* , b.explanation as kepada_name , c.explanation as dari_name, d.explanation as pt_name ');
        $this->db->from('tb_entry as a');
        if ($id != null && $user_id != null) {
            $this->db->where('a.id', $id);
            $this->db->where('a.createdby', $user_id);
        }
        $this->db->join($DB->database . '.ms_parameter as b', 'a.kepada = b.code');
        $this->db->join($DB->database . '.ms_parameter as c', 'a.dari = c.code');
        $this->db->join($DB->database . '.ms_parameter as d', 'a.pt = d.code');
        $query = $this->db->get();
        return $query;
    }

    // fn Get Data NDK by Id - Admin Level
    public function get_adm($id)
    {
        $DB = $this->load->database("second", TRUE);
        $this->db->select('a.* , b.explanation as kepada_name , c.explanation as dari_name, d.explanation as pt_name ');
        $this->db->from('tb_entry as a');
        $this->db->where('a.id', $id);
        $this->db->join($DB->database . '.ms_parameter as b', 'a.kepada = b.code');
        $this->db->join($DB->database . '.ms_parameter as c', 'a.dari = c.code');
        $this->db->join($DB->database . '.ms_parameter as d', 'a.pt = d.code');
        $query = $this->db->get();
        return $query;
    }

    // fn Get Deleted Data NDK
    public function get2()
    {
        $DB = $this->load->database("second", TRUE);
        $this->db->select('a.* , b.explanation as kepada_name , c.explanation as dari_name, d.explanation as pt_name, e.name as nama_user ');
        $this->db->from('tb_entry_del as a');
        $this->db->join($DB->database . '.ms_parameter as b', 'a.kepada = b.code');
        $this->db->join($DB->database . '.ms_parameter as c', 'a.dari = c.code');
        $this->db->join($DB->database . '.ms_parameter as d', 'a.pt = d.code');
        $this->db->join($DB->database . '.ms_user as e', 'a.createdby = e.id');
        $this->db->order_by('a.id', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    // fn Get All Data NDK
    public function get3()
    {
        $DB = $this->load->database("second", TRUE);
        $this->db->select('a.* , b.explanation as kepada_name , c.explanation as dari_name, d.explanation as pt_name, e.name as nama_user ');
        $this->db->from('tb_entry as a');
        $this->db->join($DB->database . '.ms_parameter as b', 'a.kepada = b.code');
        $this->db->join($DB->database . '.ms_parameter as c', 'a.dari = c.code');
        $this->db->join($DB->database . '.ms_parameter as d', 'a.pt = d.code');
        $this->db->join($DB->database . '.ms_user as e', 'a.createdby = e.id');
        $this->db->order_by('a.id', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    // fn Get All Data NDK by User Id
    public function get_entry_user($id)
    {
        $DB = $this->load->database("second", TRUE);
        $this->db->select('a.* , b.explanation as kepada_name , c.explanation as dari_name, d.explanation as pt_name , e.name as nama_user ');
        $this->db->from('tb_entry as a');
        $this->db->where('a.createdby', $id);
        $this->db->join($DB->database . '.ms_parameter as b', 'a.kepada = b.code');
        $this->db->join($DB->database . '.ms_parameter as c', 'a.dari = c.code');
        $this->db->join($DB->database . '.ms_parameter as d', 'a.pt = d.code');
        $this->db->join($DB->database . '.ms_user as e', 'a.createdby = e.id');
        $this->db->order_by('a.id', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    // fn no_ndk Numbering
    public function no_ndk($post)
    {
        $pt = $post['pt'];
        $dept = $post['dari'];

        $array_bln = array(01 => "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
        $bln = $array_bln[date('n')];

        $sql = " SELECT MAX(MID(a.no_ndk,1,3)) AS no_ndk 
        FROM ( 
            SELECT *
            FROM tb_entry 
            UNION 
            SELECT *
            FROM tb_entry_del 
            ) as A  
        WHERE MID(a.no_ndk, -4) = DATE_FORMAT(CURDATE(), '%Y')
        -- WHERE MID(a.no_ndk, -4) = '2023'
        AND MID(a.no_ndk,4,5) like '%$pt%'
        AND MID(a.no_ndk,8,5) like '%$dept%' 
              ";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $row = $query->row();
            $n = ((int)$row->no_ndk) + 1;
            $no = sprintf("%'.03d", $n);
        } else {
            $no = "001";
        }

        // $no_ndk = $no . "/" . $pt . "/" . $dept . "/" . $bln . "/" . '2023';
        $no_ndk = $no . "/" . $pt . "/" . $dept . "/" . $bln . "/" . date('Y');


        return $no_ndk;
    }

    // fn Add Data Entry
    public function add($post)
    {
        // New Entry Data 
        $params['tgl_inv'] = $post['tgl_inv'] != "" ? $post['tgl_inv'] : null;
        $params['no_inv'] = $post['invoice_no'] != "" ? $post['invoice_no'] : null;
        $params['ppn_type'] = $post['ppn_type'] != "" ? $post['ppn_type'] : null;
        $params['pph_type'] = $post['pph_type'] != "" ? $post['pph_type'] : null;

        // PPH PPN POTONGAN - TOTAL NILAI NDK
        $params['pph_amount'] = $post['pph_amount'];
        $params['ppn_amount'] = $post['ppn_amount'];
        if ($post['potongan'] != "") {
            $pot_value = $post['potongan'];
        } else {
            $pot_value = 0;
        }
        $params['potongan'] = $pot_value;

        if ($post['materai'] != "") {
            $mat_value = $post['materai'];
        } else {
            $mat_value = 0;
        }
        $params['materai'] = $mat_value;

        $params['total_nilai_ndk'] = $post['nilai_ndk']  + $post['ppn_amount'] - $post['pph_amount'] - $pot_value + $mat_value;
        // End New Entry Data

        $params['pt'] = $post['pt'];
        $params['no_ndk'] = $this->no_ndk($post);
        $params['tgl_ndk'] = $post['tgl_ndk'];
        $params['kepada'] = $post['kepada'];
        $params['dari'] = $post['dari'];
        $params['perihal'] = $post['perihal'];
        $params['mata_uang'] = $post['mata_uang'];
        $params['nilai_ndk'] = $post['nilai_ndk'];
        $params['ket'] = $post['ket'] != "" ? $post['ket'] : null;
        $params['metode'] = $post['metode'];
        $params['nama_penerima'] = $post['nama_penerima'];
        $params['no_rekening'] = $post['no_rekening'] != "" ? $post['no_rekening'] : null;
        $params['diusulkan_oleh'] = $post['diusulkan_oleh'];
        $params['jbtn_usul'] = $post['jbtn_usul'];
        $params['tgl_diusulkan'] = $post['tgl_diusulkan'];

        $params['setuju1'] = $post['setuju1'];
        $params['jbtn_setuju1'] = $post['jbtn_setuju1'];
        $params['tgl_setuju1'] = $post['tgl_setuju1'] ? $post['tgl_setuju1'] : null;

        $params['setuju2'] = $post['setuju2'] ? $post['setuju2'] : null;
        $params['jbtn_setuju2'] = $post['jbtn_setuju2'] ? $post['jbtn_setuju2'] : null;
        $params['tgl_setuju2'] = $post['tgl_setuju2'] ? $post['tgl_setuju2'] : null;

        $params['konfirm1'] = $post['konfirm1'] ? $post['konfirm1'] : null;
        $params['jbtn_konfirm1'] = $post['jbtn_konfirm1'] ? $post['jbtn_konfirm1'] : null;
        $params['tgl_konfirm1'] = $post['tgl_konfirm1'] ? $post['tgl_konfirm1'] : null;

        $params['konfirm2'] = $post['konfirm2'] ? $post['konfirm2'] : null;
        $params['jbtn_konfirm2'] = $post['jbtn_konfirm2'] ? $post['jbtn_konfirm2'] : null;
        $params['tgl_konfirm2'] = $post['tgl_konfirm2'] ? $post['tgl_konfirm2'] : null;

        $params['Print'] = 'N';
        $params['createddate'] = date('Y-m-d H:i:s');
        $params['createdby'] = $this->session->userdata('ses_id');
        $this->db->insert('tb_entry', $params);
    }

    // fn Edit Data Entry
    public function edit($post)
    {
        // New Entry Data 
        $params['tgl_inv'] = $post['tgl_inv'] != "" ? $post['tgl_inv'] : null;
        $params['no_inv'] = $post['invoice_no'] != "" ? $post['invoice_no'] : null;
        $params['ppn_type'] = $post['ppn_type'] != "" ? $post['ppn_type'] : null;
        $params['pph_type'] = $post['pph_type'] != "" ? $post['pph_type'] : null;

        // PPH PPN POTONGAN - TOTAL NILAI NDK
        $params['pph_amount'] = $post['pph_amount'];
        $params['ppn_amount'] = $post['ppn_amount'];
        if ($post['potongan'] != "") {
            $pot_value = $post['potongan'];
        } else {
            $pot_value = 0;
        }
        $params['potongan'] = $pot_value;

        if ($post['materai'] != "") {
            $mat_value = $post['materai'];
        } else {
            $mat_value = 0;
        }
        $params['materai'] = $mat_value;

        $params['total_nilai_ndk'] = $post['nilai_ndk']  + $post['ppn_amount'] - $post['pph_amount'] - $pot_value + $mat_value;
        // End New Entry Data

        $params['perihal'] = $post['perihal'];
        $params['mata_uang'] = $post['mata_uang'];
        $params['nilai_ndk'] = $post['nilai_ndk'];
        $params['ket'] = $post['ket'] != "" ? $post['ket'] : null;
        $params['metode'] = $post['metode'];
        $params['nama_penerima'] = $post['nama_penerima'];
        $params['no_rekening'] = $post['no_rekening'] != "" ? $post['no_rekening'] : null;
        $params['jbtn_usul'] = $post['jbtn_usul'];
        $params['tgl_diusulkan'] = $post['tgl_diusulkan'];

        $params['setuju1'] = $post['setuju1'];
        $params['jbtn_setuju1'] = $post['jbtn_setuju1'];
        $params['tgl_setuju1'] = $post['tgl_setuju1'] ? $post['tgl_setuju1'] : null;

        $params['setuju2'] = $post['setuju2'] ? $post['setuju2'] : null;
        $params['jbtn_setuju2'] = $post['jbtn_setuju2'] ? $post['jbtn_setuju2'] : null;
        $params['tgl_setuju2'] = $post['tgl_setuju2'] ? $post['tgl_setuju2'] : null;

        $params['konfirm1'] = $post['konfirm1'] ? $post['konfirm1'] : null;
        $params['jbtn_konfirm1'] = $post['jbtn_konfirm1'] ? $post['jbtn_konfirm1'] : null;
        $params['tgl_konfirm1'] = $post['tgl_konfirm1'] ? $post['tgl_konfirm1'] : null;

        $params['konfirm2'] = $post['konfirm2'] ? $post['konfirm2'] : null;
        $params['jbtn_konfirm2'] = $post['jbtn_konfirm2'] ? $post['jbtn_konfirm2'] : null;
        $params['tgl_konfirm2'] = $post['tgl_konfirm2'] ? $post['tgl_konfirm2'] : null;

        $this->db->where('id', $post['id']);
        $this->db->update('tb_entry', $params);
    }

    // fn Update Print Field when Printed Doc
    public function cetak_updt($id)
    {
        $params['print'] = 'Y';
        $this->db->where('id', $id);
        $this->db->update('tb_entry', $params);
    }

    // Fn Deleted Data NDK
    public function del($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tb_entry');
    }

    // Fn Deleted Data NDK - tb_entry_del
    public function del_idx2($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tb_entry_del');
    }

    // fn Delete Data to tb_entry_del if data already printed
    function insert_into($id)
    {
        $this->db->from('tb_entry');
        $this->db->where('id', $id);
        $q = $this->db->get()->result();
        foreach ($q as $r) { // loop over results
            $this->db->insert('tb_entry_del', $r); // insert each row to another table
        }
    }

    // fn Restore Data to tb_entry from tb_entry_del
    function restore_into($id)
    {
        $this->db->from('tb_entry_del');
        $this->db->where('id', $id);
        $q = $this->db->get()->result();
        foreach ($q as $r) { // loop over results
            $this->db->insert('tb_entry', $r); // insert each row to another table
        }
    }

    public function get_excel($tgl1, $tgl2, $id)
    {
        $DB = $this->load->database("second", TRUE);
        $this->db->select('a.* , b.explanation as kepada_name , c.explanation as dari_name, d.explanation as pt_name, e.name as nama_user ');
        $this->db->from('tb_entry as a');
        $this->db->where('a.tgl_ndk BETWEEN "' . date('Y-m-d', strtotime($tgl1)) . '" and "' . date('Y-m-d', strtotime($tgl2)) . '"');
        $this->db->where('a.createdby', $id);
        $this->db->join($DB->database . '.ms_parameter as b', 'a.kepada = b.code');
        $this->db->join($DB->database . '.ms_parameter as c', 'a.dari = c.code');
        $this->db->join($DB->database . '.ms_parameter as d', 'a.pt = d.code');
        $this->db->join($DB->database . '.ms_user as e', 'a.createdby = e.id');
        $this->db->order_by('a.id', 'DESC');
        $query = $this->db->get();
        return $query;
    }
}
