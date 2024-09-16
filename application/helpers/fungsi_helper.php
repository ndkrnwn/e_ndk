<?php

// fn Check Already Login
function check_already_login()
{
    $ci = &get_instance();
    $user_session = $ci->session->userdata('ses_id');
    if ($user_session) {
        redirect('home');
    }
}

// fn Check not Login
function check_not_login()
{
    $ci = &get_instance();
    $user_session = $ci->session->userdata('ses_id');
    if (!$user_session) {
        redirect('auth/login');
    }
}

// fn Check Admin
function check_admin()
{
    $ci = &get_instance();
    $ci->load->library('fungsi');
    if ($ci->fungsi->user_login()->group != 'GR1') {
        redirect('home');
    }
}

// fn IDR Currency

//function indo_currency($nominal)
//{
//    $result  = "Rp " . number_format($nominal, 2, ",", ".");
//    return $result;
//}


// Updated 25/6/2024
function indo_currency($nominal)
{
    // Pisahkan angka menjadi bagian sebelum dan setelah koma
    $parts = explode('.', $nominal);

    // Cek apakah ada angka setelah koma
    if (isset($parts[1]) && intval($parts[1]) !== 0) {
        // Jika ada angka setelah koma, tampilkan dengan 2 digit desimal
        $result = "Rp " . number_format($nominal, 2, ",", ".");
    } else {
        // Jika tidak ada angka setelah koma atau hanya nol, tampilkan tanpa digit desimal
        $result = "Rp " . number_format($nominal, 0, ",", ".");
    }

    return $result;
}

// fn USD Currency
function usd_currency($nominal)
{
    $result  = "$ " . number_format($nominal, 2, ".", ",");
    return $result;
}

// fn IDR Currency

//function idrc($nominal)
//{
//    $result  =  number_format($nominal, 2, ",", ".");
//    return $result;
//}

// Updated 25/6/2024
function idrc($nominal)
{
    // Pisahkan angka menjadi bagian sebelum dan setelah koma
    $parts = explode('.', $nominal);

    // Cek apakah ada angka setelah koma
    if (isset($parts[1]) && intval($parts[1]) !== 0) {
        // Jika ada angka setelah koma, tampilkan dengan 2 digit desimal
        $result = "Rp " . number_format($nominal, 2, ",", ".");
    } else {
        // Jika tidak ada angka setelah koma atau hanya nol, tampilkan tanpa digit desimal
        $result = "Rp " . number_format($nominal, 0, ",", ".");
    }

    return $result;
}

// fn USD Currency
function usdc($nominal)
{
    $result  =  number_format($nominal, 2, ".", ",");
    return $result;
}


// fn Indo Date
function indo_date($date)
{
    $d = substr($date, 8, 2);
    $m = substr($date, 5, 2);
    $y = substr($date, 0, 4);
    return $d . '/' . $m . '/' . $y;
}

// fn Penyebut
function penyebut($nilai)
{
    $nilai = abs($nilai);
    $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($nilai < 12) {
        $temp = " " . $huruf[$nilai];
    } else if ($nilai < 20) {
        $temp = penyebut($nilai - 10) . " belas";
    } else if ($nilai < 100) {
        $temp = penyebut($nilai / 10) . " puluh" . penyebut($nilai % 10);
    } else if ($nilai < 200) {
        $temp = " seratus" . penyebut($nilai - 100);
    } else if ($nilai < 1000) {
        $temp = penyebut($nilai / 100) . " ratus" . penyebut($nilai % 100);
    } else if ($nilai < 2000) {
        $temp = " seribu" . penyebut($nilai - 1000);
    } else if ($nilai < 1000000) {
        $temp = penyebut($nilai / 1000) . " ribu" . penyebut($nilai % 1000);
    } else if ($nilai < 1000000000) {
        $temp = penyebut($nilai / 1000000) . " juta" . penyebut($nilai % 1000000);
    } else if ($nilai < 1000000000000) {
        $temp = penyebut($nilai / 1000000000) . " milyar" . penyebut(fmod($nilai, 1000000000));
    } else if ($nilai < 1000000000000000) {
        $temp = penyebut($nilai / 1000000000000) . " trilyun" . penyebut(fmod($nilai, 1000000000000));
    }
    return $temp;
}

// fn tkoma
function tkoma($nilai)
{
    $ex = explode('.', $nilai);

    if (isset($ex[1]) && $ex[1] != "") {
        $a = abs($ex[1]);
    } else {
        $a = 0;
    }

    $string = array("nol", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan",   "sembilan", "sepuluh", "sebelas");
    $temp = "";

    if ($a == 0) {
        $temp .= "";
    } else if ($a >= 1 && $a < 10) {
        $temp .= " " . $string[$a];
    } else if ($a > 11 && $a < 20) {
        $temp .= penyebut($a - 10) . " belas";
    } else if ($a > 19 && $a < 100) {
        $temp .= penyebut($a / 10) . " puluh" . penyebut($a % 10);
    } else {
        $temp .= penyebut($a / 100) . "" . penyebut($a % 100);
    }

    return $temp;
}

// fn Terbilang
function terbilang($nilai)
{
    if ($nilai < 0) {
        $hasil = "minus " . trim(penyebut($nilai));
    } else {
        $poin = trim(tkoma($nilai));
        $hasil = trim(penyebut($nilai));
    }

    if ($poin) {
        $hasil = $hasil . " koma " . $poin;
    } else {
        $hasil = $hasil;
    }
    return $hasil;
}
