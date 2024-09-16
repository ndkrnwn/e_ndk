<footer class="main-footer">
    <div class="float-right d-none d-sm-block fontpoppins-input">
        <b>Version</b> 1.2.0
    </div>
    <strong class="fontpoppins-input">Copyright &copy; 2022 <a href="#">First Resources</a>.</strong>
</footer>

</div>

<script type="text/javascript" src="<?= base_url('assets/'); ?>dist/js/mdb.min.js"></script>

<script src="<?= base_url('assets/'); ?>plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url('assets/'); ?>plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/'); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DATEPICKER -->
<script src="<?= base_url('assets/'); ?>plugins/daterangepicker/daterangepicker.js"></script>
<!-- SweetAlert2 -->
<script src="<?= base_url('assets/'); ?>plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/sweetalert2/sweetshow.js"></script>
<!-- Toastr -->
<script src="<?= base_url('assets/'); ?>plugins/toastr/toastr.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url('assets/'); ?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/moment/moment.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/daterangepicker/daterangepicker.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script>
    $('form').on('focus', 'input[type=number]', function(e) {
        $(this).on('wheel.disableScroll', function(e) {
            e.preventDefault()
        })
    })
    $('form').on('blur', 'input[type=number]', function(e) {
        $(this).off('wheel.disableScroll')
    })
</script>
<script>
    window.addEventListener('load', function() {
        change_mu();
        hitungPph();
        hitungPpn();
        toggleFielddollar();
        toggleFieldmetode();
    });

    window.onload = function() {
        jam();
    }
</script>

<script>
    // Button VIEW MORE
    document.addEventListener('DOMContentLoaded', function() {
        var viewMoreButton = document.getElementById('view_more_button');
        var viewMoreDiv = document.getElementById('view_more');

        viewMoreButton.addEventListener('click', function() {
            if (viewMoreDiv.style.display === 'none') {
                viewMoreDiv.style.display = 'block';
                viewMoreButton.innerHTML = 'VIEW LESS <i class="fa fa-arrow-up"></i>';
            } else {
                viewMoreDiv.style.display = 'none';
                viewMoreButton.innerHTML = 'VIEW MORE <i class="fa fa-arrow-down"></i>';
            }
        });
    });

    // Button VIEW MORE DETAIL
    document.addEventListener('DOMContentLoaded', function() {
        var viewMoreButton = document.getElementById('view_more_button_detail');
        var viewMoreDiv = document.getElementById('view_more_detail');

        viewMoreButton.addEventListener('click', function() {
            if (viewMoreDiv.style.display === 'none') {
                viewMoreDiv.style.display = 'block';
                viewMoreButton.innerHTML = 'VIEW LESS <i class="fa fa-arrow-up"></i>';
            } else {
                viewMoreDiv.style.display = 'none';
                viewMoreButton.innerHTML = 'VIEW MORE <i class="fa fa-arrow-down"></i>';
            }
        });
    });

    // Input PPN PPH 
    var nilai_ndkInput = document.getElementById('nilai_ndk');
    var ppnTypeSelect = document.getElementById('ppn_type');
    var pphTypeSelect = document.getElementById('pph_type');
    var ppnAmountInput = document.getElementById('ppn_amount');
    var pphAmountInput = document.getElementById('pph_amount');
    var currencySelect = document.getElementById('currency_select');

    nilai_ndkInput.addEventListener('input', hitungPph);
    nilai_ndkInput.addEventListener('input', hitungPpn);
    pphTypeSelect.addEventListener('change', hitungPph);
    ppnTypeSelect.addEventListener('change', hitungPpn);


    function hitungPph() {
        var nilai_ndk = parseFloat(nilai_ndkInput.value); // Mengambil nilai dari input nilai_ndk dan mengubahnya menjadi float
        var pph_type = parseFloat(pphTypeSelect.value); // Mengambil nilai dari select pph_type dan mengubahnya menjadi float

        if (pphTypeSelect.value === '') {
            pphAmountInput.value = '0.00'; // Ubah sesuai kebutuhan format angka
        } else {
            var pph = (nilai_ndk * pph_type / 100);
            pphAmountInput.value = pph.toFixed(2);
        }
    }

    function hitungPpn() {
        var nilai_ndk = parseFloat(nilai_ndkInput.value); // Mengambil nilai dari input nilai_ndk dan mengubahnya menjadi float
        var ppn_type = parseFloat(ppnTypeSelect.value); // Mengambil nilai dari select ppn_type dan mengubahnya menjadi float
        if (ppnTypeSelect.value === '') {
            ppnAmountInput.value = '0.00'; // Ubah sesuai kebutuhan format angka
        } else {
            var ppn = (nilai_ndk * ppn_type / 100); // Menghitung nilai PPH
            ppnAmountInput.value = ppn.toFixed(2); // Menyimpan nilai ppn dengan dua angka di belakang koma
        }
    }
    // End. Input PPN PPH

    // Input Mata Uang
    const selectElem = document.getElementById('currency_select');
    const spanElem1 = document.getElementById('currency_nilai');
    const spanElem2 = document.getElementById('currency_pot');
    const spanElem3 = document.getElementById('currency_mat');

    selectElem.addEventListener('change', change_mu);
    currencySelect.addEventListener('change', toggleFielddollar);

    function toggleFielddollar() {
        if (currencySelect.value === '2') { // Jika mata uang adalah Dollar
            pphTypeSelect.classList.add('disabled', 'bg-gray-light');
            ppnTypeSelect.classList.add('disabled', 'bg-gray-light');
			
			pphAmountInput.setAttribute('readonly', 'readonly');
            ppnAmountInput.setAttribute('readonly', 'readonly');

            pphAmountInput.value = '0.00';
            ppnAmountInput.value = '0.00';

            pphTypeSelect.value = "";
            ppnTypeSelect.value = "";

        } else {
			pphAmountInput.removeAttribute('readonly');
            ppnAmountInput.removeAttribute('readonly');
            pphTypeSelect.classList.remove('disabled', 'bg-gray-light');
            ppnTypeSelect.classList.remove('disabled', 'bg-gray-light');
        }
    }

    function change_mu() {
        if (selectElem.value === '2') {
            spanElem1.innerHTML = '<b>$</b>';
            spanElem2.innerHTML = '<b>$</b>';
            spanElem3.innerHTML = '<b>$</b>';
        } else {
            spanElem1.innerHTML = '<b>Rp </b>';
            spanElem2.innerHTML = '<b>Rp </b>';
            spanElem3.innerHTML = '<b>Rp </b>';
        }
    };
    // End. Input Mata Uang

    // fn Metode Payment / No Rekening Field 
    var metodeSelect = document.getElementById('metode');
    var nrFieldrow = document.getElementById("nrFieldRow");
    var nrField = document.getElementById("no_rekening");
    metodeSelect.addEventListener('change', toggleFieldmetode);

    function toggleFieldmetode() {
        if (metodeSelect.value === 'C' || metodeSelect.value === '') { // Jika mata uang adalah Dollar
            nrFieldrow.style.display = "none";
            nrField.removeAttribute('required');
        } else {
            nrFieldrow.style.display = "block";
            nrField.setAttribute('required', 'required');
        }
    }

    //Jam Dashboard
    function jam() {
        var e = document.getElementById('jam'),
            d = new Date(),
            h, m, s;
        h = d.getHours();
        m = set(d.getMinutes());
        s = set(d.getSeconds());

        e.innerHTML = h + ':' + m + ':' + s;

        setTimeout('jam()', 1000);
    }

    function set(e) {
        e = e < 10 ? '0' + e : e;
        return e;
    }
    // End. Jam Dashboard

    // Input Textarea auto height
    var ketTextarea = document.getElementById('ket');
    var perihalTextarea = document.getElementById('perihal');

    ketTextarea.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';
    });

    perihalTextarea.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';
    });

    // Set ketinggian textarea saat halaman dimuat
    textarea.style.height = (textarea.scrollHeight) + 'px';
    // End. Input Textarea auto height
</script>

<script type="text/javascript">
    $(function() {
        $('#tgl_diusulkan').datetimepicker({
            format: 'YYYY-MM-DD',
            minDate: '<?php echo  date('Y-m-d'); ?>'
        });
        $('#tgl_setuju1').datetimepicker({
            format: 'YYYY-MM-DD',
            minDate: '<?php echo  date('Y-m-d'); ?>'
        });
        $('#tgl_setuju2').datetimepicker({
            format: 'YYYY-MM-DD',
            minDate: '<?php echo  date('Y-m-d'); ?>'
        });
        $('#tgl_konfirm1').datetimepicker({
            format: 'YYYY-MM-DD',
            minDate: '<?php echo  date('Y-m-d'); ?>'
        });
        $('#tgl_konfirm2').datetimepicker({
            format: 'YYYY-MM-DD',
            minDate: '<?php echo  date('Y-m-d'); ?>'
        });
        $('#tgl_inv').datetimepicker({
            format: 'YYYY-MM-DD',
        });
        $('#tgl_ndk').datetimepicker({
            format: 'YYYY-MM-DD',
            minDate: '<?php echo  date('Y-m-d'); ?>'
        });
        $('#tgl_from').datetimepicker({
            format: 'YYYY-MM-DD',
        });
        $('#tgl_to').datetimepicker({
            format: 'YYYY-MM-DD',
        });
    });
</script>

<!-- SWAL ALERT -->
<script>
    $(function() {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        var flash = $('#swalDefaultSuccess').data('flash');
        if (flash) {
            Toast.fire({
                icon: 'success',
                title: ' Success, Data Has Been Saved.'
            })
        };
        var flash = $('#swalDefaultError').data('flash');
        if (flash) {
            Toast.fire({
                icon: 'error',
                title: ' Failed, Data Has not Been Saved.'
            })
        };
        var flash = $('#swalDefaultDeleted').data('flash');
        if (flash) {
            Toast.fire({
                icon: 'success',
                title: ' Success, Data Has Been Deleted.'
            })
        };
        var flash = $('#swalDefaultWarning').data('flash');
        if (flash) {
            Toast.fire({
                icon: 'error',
                title: ' You are loged in with this account.'
            })
        };
        var flash = $('#swalRelation').data('flash');
        if (flash) {
            Toast.fire({
                icon: 'warning',
                title: "Can't Delete Data, Already has Relation !"
            })
        };

        var flash = $('#swalLogin').data('flash');
        if (flash) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                text: 'Selamat Datang di E-NDK System Apps',
                title: 'Signed in successfully'
            })
        };

        var flash = $('#swalFailed').data('flash');
        if (flash) {
            Swal.fire({
                icon: 'error',
                title: 'Login Failed',
                text: 'Sorry, your username or password are incorrect - please try again.',
                timer: 1000,
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            })
        };
    });

    $('.button-logout').on('click', function(e) {
        e.preventDefault();
        const href = $(this).attr('href')

        Swal.fire({
            title: 'Are you sure want to logout?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Logout Now!'
        }).then((result) => {
            if (result.value) {
                document.location.href = href;
            }
        })
    });

    $(document).on('click', '#button-edit', function(event) {
        event.preventDefault();
        Swal.fire({
            icon: 'error',
            title: 'Tidak bisa edit Data !',
            text: 'Data sudah pernah di Cetak sebelumnya!',
        })
    });
</script>

<script type="text/javascript">
    function ajax_login() {
        var uname = $('#username').val();
        var pwd = $('#password').val();

        if (uname.length > 0 && pwd.length > 0) {
            $.ajax({
                url: "<?= base_url('auth/proses') ?>",
                type: "post",
                data: {
                    username: uname,
                    password: pwd,
                },
                success: function(result) {
                    var hasil = JSON.parse(result);
                    swal_show(hasil);
                }
            })
        }
    }
</script>

<script type="text/javascript">
    $(function() {

        var $src = $('#metode'),
            $src2 = $('#nama_penerima'),
            $src3 = $('#no_rekening'),
            $dst = $('#ket');

        $src.on('input', function() {
            var data1 = document.getElementById("metode").value;
            var data2 = document.getElementById("nama_penerima").value;
            var data3 = document.getElementById("no_rekening").value;

            if (data1 == 'C') {
                mb = 'Cash'
                $dst.val('Metode Pembayaran : ' + mb + '\n' +
                    'A/n : ' + data2 + '\n');
            } else if (data1 == 'T') {
                $dst.val('Rekening Pembayaran : ' + '\n' +
                    'A/n : ' + data2 + '\n' +
                    'No Rek : ' + data3);
            } else {
                $dst.val('A/n : ' + data2);
            }

        });

        $src2.on('input', function() {
            var data1 = document.getElementById("metode").value;
            var data2 = document.getElementById("nama_penerima").value;
            var data3 = document.getElementById("no_rekening").value;

            if (data1 == 'C') {
                mb = 'Cash'
                $dst.val('Metode Pembayaran : ' + mb + '\n' +
                    'A/n : ' + data2 + '\n');
            } else if (data1 == 'T') {
                $dst.val('Rekening Pembayaran : ' + '\n' +
                    'A/n : ' + data2 + '\n' +
                    'No Rek : ' + data3);
            } else {
                $dst.val('A/n : ' + data2);
            }
        });

        $src3.on('input', function() {
            var data1 = document.getElementById("metode").value;
            var data2 = document.getElementById("nama_penerima").value;
            var data3 = document.getElementById("no_rekening").value;

            if (data1 == 'C') {
                mb = 'Cash'
                $dst.val('Metode Pembayaran : ' + mb + '\n' +
                    'A/n : ' + data2 + '\n');
            } else if (data1 == 'T') {
                $dst.val('Rekening Pembayaran : ' + '\n' +
                    'A/n : ' + data2 + '\n' +
                    'No Rek : ' + data3);
            } else {
                $dst.val('A/n : ' + data2);
            }
        });

    });
</script>

<script type="text/javascript">
    // fungsi delete data pada table entry
    $(document).on('click', '#delete', function(event) {
        event.preventDefault();

        var id = $(this).data('id')

        Swal.fire({
            title: 'Anda yakin ingin menghapus data ini?',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya,Hapus!',
            closeOnConfirm: false
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: "<?= site_url('entry/del') ?>",
                    data: {
                        'delete': true,
                        id: id
                    },
                    async: false
                })
                location.href = '<?= site_url('entry') ?>'
            }
        });
    });

    // fungsi delete data jika sudah di print pada table entry
    $(document).on('click', '#move', function(event) {
        event.preventDefault();

        var id = $(this).data('id')

        Swal.fire({
            title: 'Anda yakin?',
            text: 'Data ini sudah pernah dicetak sebelumnya, Lanjutkan ?',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Tetap Hapus!',
            closeOnConfirm: false
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: "<?= site_url('entry/move') ?>",
                    data: {
                        'move': true,
                        id: id
                    },
                    async: false
                })
                location.href = '<?= site_url('entry') ?>'
            }
        });
    });

    $(document).on('click', '#restore', function(event) {
        event.preventDefault();

        var id = $(this).data('id')

        Swal.fire({
            title: 'Anda yakin?',
            text: 'Data ini akan direstore, Lanjutkan ?',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Tetap Restore!',
            closeOnConfirm: false
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: "<?= site_url('entry/restore') ?>",
                    data: {
                        'restore': true,
                        id: id
                    },
                    async: false
                })
                location.href = '<?= site_url('entry/deleted') ?>'
            }
        });
    });

    // fungsi print data pada table entry
    $(document).on('click', '#print', function(event) {
        event.preventDefault();

        const href = $(this).attr('href')

        Swal.fire({
            title: 'Anda yakin?',
            text: 'Cetak Dokumen ini ?',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Cetak!',
            closeOnConfirm: false
        }).then((result) => {
            if (result.value) {
                document.location.href = href;
            }
        });
    });

    // fungsi delete data dari table entry deleted
    $(document).on('click', '#del_idx2', function(event) {
        event.preventDefault();

        var id = $(this).data('id')

        Swal.fire({
            title: 'Anda yakin ingin menghapus data ini?',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya,Hapus!',
            closeOnConfirm: false
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: "<?= site_url('entry/del') ?>",
                    data: {
                        'del_idx2': true,
                        id: id
                    },
                    async: false
                })
                location.href = '<?= site_url('entry/deleted') ?>'
            }
        });
    });
</script>

<!-- Detail NDK -->
<script>
    $(document).on('click', '#detail', function() {
        $('#pt').text($(this).data('pt'))
        $('#no_ndk').text($(this).data('no_ndk'))
        $('#no_inv').text($(this).data('no_inv'))
        $('#tgl_ndk').text($(this).data('tgl_ndk'))
        $('#kepada').text($(this).data('kepada'))
        $('#dari').text($(this).data('dari'))
        $('#perihal').text($(this).data('perihal'))
        $('#nilai_ndk').text($(this).data('nilai_ndk'))

        // new ppn pph potongan materai
        $('#ppn_type').text($(this).data('ppn_type'))
        $('#pph_type').text($(this).data('pph_type'))
        $('#ppn_amount').text($(this).data('ppn_amount'))
        $('#pph_amount').text($(this).data('pph_amount'))
        $('#materai').text($(this).data('materai'))
        $('#potongan').text($(this).data('potongan'))
        $('#total_nilai_ndk').text($(this).data('total_nilai_ndk'))
        // end.

        $('#ket').text($(this).data('ket'))
        $('#metode').text($(this).data('metode'))
        $('#nama_penerima').text($(this).data('nama_penerima'))
        $('#no_rekening').text($(this).data('no_rekening'))
        $('#diusulkan_oleh').text($(this).data('diusulkan_oleh'))
        $('#tgl_diusulkan').text($(this).data('tgl_diusulkan'))
        $('#setuju1').text($(this).data('setuju1'))
        $('#tgl_setuju1').text($(this).data('tgl_setuju1'))
        $('#setuju2').text($(this).data('setuju2'))
        $('#tgl_setuju2').text($(this).data('tgl_setuju2'))
        $('#konfirm1').text($(this).data('konfirm1'))
        $('#tgl_konfirm1').text($(this).data('tgl_konfirm1'))
        $('#konfirm2').text($(this).data('konfirm2'))
        $('#tgl_konfirm2').text($(this).data('tgl_konfirm2'))
        $('#nama_user').text($(this).data('nama_user'))

    })
</script>