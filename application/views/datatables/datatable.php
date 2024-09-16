<link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

<!-- DataTables  & Plugins -->
<script src="<?= base_url('assets/') ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/') ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/') ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url('assets/') ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/') ?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url('assets/') ?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/') ?>plugins/jszip/jszip.min.js"></script>
<script src="<?= base_url('assets/') ?>plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url('assets/') ?>plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url('assets/') ?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url('assets/') ?>plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url('assets/') ?>plugins/datatables-buttons/js/buttons.colVis.min.js"></script>


<script>
    $(document).ready(function() {
        $('#db_all').DataTable({
            "serverSide": true,
            "processing": true,
            "ajax": {
                "url": "<?= base_url('entry/get_all') ?>",
                "type": "POST"
            },
            "order": [],
            "columnDefs": [{
                    "orderable": false,
                    "targets": [0, 7],
                },
                {
                    "width": "18%",
                    "targets": [7],
                },
                {
                    "className": "text-center",
                    "targets": [1, 3, 6, 7]
                },
            ],
        });
        $('#db_user').DataTable({
            "serverSide": true,
            "processing": true,
            "ajax": {
                "url": "<?= base_url('entry/get_data_user') ?>",
                "type": "POST"
            },
            "order": [],
            "columnDefs": [{
                    "orderable": false,
                    "targets": [0, 7],
                },
                {
                    "width": "18%",
                    "targets": [7],
                },
                {
                    "className": "text-center",
                    "targets": [1, 3, 6, 7]
                },
            ],
        });
        $('#db_delete').DataTable({
            "serverSide": true,
            "processing": true,
            "ajax": {
                "url": "<?= base_url('entry/get_data_deleted') ?>",
                "type": "POST"
            },
            "order": [],
            "columnDefs": [{
                    "orderable": false,
                    "targets": [0, 7],
                },
                {
                    "width": "10%",
                    "targets": [7],
                },
                {
                    "className": "text-center",
                    "targets": [1, 3, 6, 7]
                },
            ],
        });
    });
</script>

</body>

</html>