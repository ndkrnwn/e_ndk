<?php
header("Content-type: application/pdf");

$date = date("d F Y", strtotime($tgl_ndk));

if ($mata_uang == 1) {
    $jumlah = indo_currency($total_nilai_ndk);
    $terbilang = '# ' . terbilang($total_nilai_ndk) . ' rupiah #';
} else {
    $jumlah = usd_currency($total_nilai_ndk);
    $terbilang = '# ' . terbilang($total_nilai_ndk) . ' dollar #';
}

$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetAutoPageBreak('5');

$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(10, 5, '', 0, 1);
$pdf->Cell(190, 5, $pt, 0, 1, 'C');
//$pdf->Cell(190, 5, 'NOTA DEMO TESTING', 0, 1, 'C');
$pdf->Cell(190, 5, 'NOTA DISPOSISI KEUANGAN', 0, 1, 'C');
$pdf->SetFont('Arial', 'BU', 11);
$pdf->Cell(190, 5, 'Nomor :' . $no_ndk, 0, 1, 'C');
$pdf->Cell(10, 5, '', 0, 1);

$dataIndex = array(
    array("Tanggal", ":", $date),
    array("Perihal", ":", $perihal),
    array("Jumlah", ":", $jumlah),
    array("Terbilang", ":", $terbilang)
);

$dataPengajuan = "Pengajuan";
$diusulkanHeader = array(
    array("Diusulkan Oleh,",  "Disetujui Oleh,"),
    array("",  "")
);

$pengajuanFill = array(
    array("Nama", ":", $diusulkan_oleh,  "Nama", ":", $setuju1),
    array("Jabatan", ":", $jbtn_usul, "Jabatan", ":", $jbtn_setuju1),
    array("Tanggal", ":", indo_date($tgl_diusulkan), "Tanggal", ":", $tgl_setuju1 == null ? " " : indo_date($tgl_setuju1))
);

$direkturHeader = array(
    array("( untuk nilai & hal yang perlu disetujui selain Direktur ) \n Disetujui oleh"),
    array("")
);

$direkturFill = array(
    array("Nama", ":", $setuju2),
    array("Jabatan", ":", $jbtn_setuju2),
    array("Tanggal", ":", $tgl_setuju2 == null ? " " : indo_date($tgl_setuju2))
);

$keuanganHeader = "Konfirmasi oleh Dep. Keuangan";
$data6 = array(
    array("",  "")
);

$keuanganFill = array(
    array("Nama", ":", $konfirm1,  "Nama", ":", $konfirm2),
    array("Jabatan", ":", $jbtn_konfirm1, "Jabatan", ":", $jbtn_konfirm2),
    array("Tanggal", ":", $tgl_konfirm1 == null ? " " : indo_date($tgl_konfirm1), "Tanggal", ":", $tgl_konfirm2 == null ? " " : indo_date($tgl_konfirm2))
);

$realisasiHeader = "Realisasi Tunai";
$realisasiSubHeader = array(
    array("Dibayar Oleh,",  "Diterima Oleh,"),
    array("",  "")
);

$realisasiFill = array(
    array("Nama", ":",  "Nama", ":"),
    array("Tanggal", ":", "Tanggal", ":")
);

$ttdHeader = array(
    array("Ttd,",  "Tanggal,"),
    array("",  "")
);

$ttdFill = array(
    array("Maker", ":", "Maker", ":"),
    array("Realese I", ":", "Realese I", ":"),
    array("Realese II", ":", "Realese II", ":")
);

$catatanHeader = "Catatan :";
$catatanFill = array(
    array($ket)
);


if ($tgl_inv) {
    $dataTglInv = "TGL INVOICE : " . indo_date($tgl_inv);
} else {
    $dataTglInv = null;
}

if ($no_inv) {
    $dataInv = "INVOICE NO : " . $no_inv;
} else {
    $dataInv = null;
}

if ($nilai_ndk != 0) {
    if ($mata_uang == 1) {
        $dataAmount = array(
            array("Total Tagihan", ": Rp", idrc($nilai_ndk)),
        );
    } else {
        $dataAmount = array(
            array("Total Tagihan", ": $", usdc($nilai_ndk)),
        );
    }
} else {
    $dataAmount = null;
}

if ($ppn_amount != 0) {
    $dataPpn = array(
        array("PPN " . $ppn_type . "%", ": Rp",  idrc($ppn_amount)),
    );
} else {
    $dataPpn = null;
}

if ($pph_amount != 0) {
    $dataPph = array(
        array("PPH " . $pph_type . "%", ": Rp", "( " .  idrc($pph_amount) . " )"),
    );
} else {
    $dataPph = null;
}

if ($potongan != 0) {
    if ($mata_uang == 1) {
        $dataPotongan = array(
            array("Total Potongan", ": Rp", "( " . idrc($potongan) . " )"),
        );
    } else {
        $dataPotongan = array(
            array("Total Potongan", ": $", "( " . usdc($potongan) . " )"),
        );
    }
} else {
    $dataPotongan = null;
}

if ($materai != 0) {
    if ($mata_uang == 1) {
        $dataBeamaterai = array(
            array("Materai", ": Rp", idrc($materai)),
        );
    } else {
        $dataBeamaterai = array(
            array("Materai", ": $", usdc($materai)),
        );
    }
} else {
    $dataBeamaterai = null;
}

if ($mata_uang == 1) {
    $dataTotal = array(
        array("Total Dibayar", ": Rp",  idrc($total_nilai_ndk))
    );
} else {
    $dataTotal = array(
        array("Total Dibayar", ": $",  usdc($total_nilai_ndk))
    );
}

$date = new DateTime();
$timezone = new DateTimeZone('Asia/Kuala_Lumpur');
$date->setTimezone($timezone);

$currentDateTime = $date->format('Y-m-d ( H:i:s )');

$pdf->TableIndex($dataIndex);
$pdf->TableApprover($dataPengajuan, $diusulkanHeader, $pengajuanFill, $direkturHeader, $direkturFill, $keuanganHeader, $data6, $keuanganFill, $realisasiHeader, $realisasiSubHeader, $realisasiFill, $ttdHeader, $ttdFill);
$pdf->TableDetail($catatanHeader, $catatanFill, $dataTglInv, $dataInv, $dataAmount, $dataPpn, $dataPph, $dataPotongan, $dataBeamaterai, $dataTotal);
$pdf->setFooterTextLeft('Copyright© First Resources 2022');
$pdf->setFooterTextRight('Dibuat Oleh : ' . $fullname);
$pdf->setFooterTextRight2('Print Date : ' . $currentDateTime);
$pdf->Output();
