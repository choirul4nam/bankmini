
  <!-- /.content-wrapper -->
  <footer>
    <strong>Development By &copy; 2020 <a href="https://hosterweb.co.id">HOSTERWEB INDONESIA</a>
  </footer>
            <!-- /.content-wrapper -->
        </div>
        <!-- /.main-wrapper -->

        <!-- ========== COMMON JS FILES ========== -->
        <script src="<?php echo base_url() ?>assets/Theme/js/jquery/jquery-2.2.4.js"></script>
        <script src="<?php echo base_url() ?>assets/Theme/js/jquery-ui/jquery-ui.js"></script>
        <script src="<?php echo base_url() ?>assets/Theme/js/bootstrap/bootstrap.js"></script>
        <script src="<?php echo base_url() ?>assets/Theme/js/pace/pace.min.js"></script>
        <script src="<?php echo base_url() ?>assets/Theme/js/lobipanel/lobipanel.min.js"></script>
        <script src="<?php echo base_url() ?>assets/Theme/js/iscroll/iscroll.js">j</script>
        <script src="<?php echo base_url() ?>assets/Theme/js/DataTables/DataTables-1.10.13/js/jquery.dataTables.js"></script> 
        <script src="<?php echo base_url() ?>assets/Theme/js/DataTables/DataTables-1.10.13/js/dataTables.bootstrap.js"></script> 

        <!-- ========== PAGE JS FILES ========== -->
        <script src="<?php echo base_url() ?>assets/Theme/js/prism/prism.js"></script>
        <script src="<?php echo base_url() ?>assets/Theme/js/waypoint/waypoints.min.js"></script>
        <script src="<?php echo base_url() ?>assets/Theme/js/counterUp/jquery.counterup.min.js"></script>
        <script src="<?php echo base_url() ?>assets/Theme/js/amcharts/amcharts.js"></script>
        <script src="<?php echo base_url() ?>assets/Theme/js/amcharts/serial.js"></script>
        <script src="<?php echo base_url() ?>assets/Theme/js/amcharts/plugins/export/export.min.js"></script>
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/Theme/js/amcharts/plugins/export/export.css" type="text/css" media="all" />
        <script src="<?php echo base_url() ?>assets/Theme/js/amcharts/themes/light.js"></script>
        <script src="<?php echo base_url() ?>assets/Theme/js/toastr/toastr.min.js"></script>
        <script src="<?php echo base_url() ?>assets/Theme/js/icheck/icheck.min.js"></script>
        <script src="<?php echo base_url() ?>assets/Theme/js/bootstrap-tour/bootstrap-tour.js"></script>

        <!-- ========== THEME JS ========== -->
        <script src="<?php echo base_url() ?>assets/Theme/js/main.js"></script>
        <script src="<?php echo base_url() ?>assets/Theme/js/production-chart.js"></script>
        <script src="<?php echo base_url() ?>assets/Theme/js/traffic-chart.js"></script>
        <script src="<?php echo base_url() ?>assets/Theme/js/task-list.js"></script>        
        <script src="<?php echo base_url() ?>assets/Theme/js/script.js"></script>
        <script>
            $('#tableLulus').DataTable();
            $('#dataTableSiswa').DataTable({
                'scrollX' : true
            });
                 $(function($) {
                $('input.blue-style').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue'
                });
                $('input.green-style').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green'
                });
                $('input.red-style').iCheck({
                    checkboxClass: 'icheckbox_square-red',
                    radioClass: 'iradio_square-red'
                });
                $('input.flat-black-style').iCheck({
                    checkboxClass: 'icheckbox_flat',
                    radioClass: 'iradio_flat'
                });

                $('input.line-style').each(function(){
                    var self = $(this),
                      label = self.next(),
                      label_text = label.text();

                    label.remove();
                    self.iCheck({
                      checkboxClass: 'icheckbox_line-blue',
                      radioClass: 'iradio_line-blue',
                      insert: '<div class="icheck_line-icon"></div>' + label_text
                    });
                  });
            });
            // $(function(){

                // Counter for dashboard stats
                // $('.counter').counterUp({
                //     delay: 10,
                //     time: 1000
                // });

                // Welcome notification
                // toastr.options = {
                //     "closeButton": true,
                //     "debug": false,
                //     "newestOnTop": false,
                //     "progressBar": false,
                //     "positionClass": "toast-top-right",
                //     "preventDuplicates": false,
                //     "onclick": null,
                //     "showDuration": "300",
                //     "hideDuration": "1000",
                //     "timeOut": "3500",
                //     "extendedTimeOut": "1000",
                //     "showEasing": "swing",
                //     "hideEasing": "linear",
                //     "showMethod": "fadeIn",
                //     "hideMethod": "fadeOut"
                // }
                // toastr["success"]("One stop solution to your website admin panel!", "Welcome to Options!");


            // });

        $("#tb_tipeuser").DataTable();
         $('#tb_staff').DataTable( {
                     "scrollX": true
                } );

        $("#tb_tahunakademik").DataTable();
        // $("#tb_staff").DataTable();

        $(".s_provinsi").change(function() {
        $.get("http://localhost/bms/staff/getkota/" + this.value, function(result) {
            let data = JSON.parse(result);
            $(".s_kota").html('<option>Pilih kota</option>')
            $(".s_kota").removeAttr('disabled')
            $(".s_kecamatan").html('<option>Pilih Kecamatan</option>')
            data.forEach(function(dataKota) {
                $(".s_kota").append('<option value="' + dataKota.id_kota + '">' + dataKota.name_kota + '</option>')
            })
        })
        });

        $(".s_kota").change(function() {
        $.get("http://localhost/bms/staff/getkecamatan/" + this.value, function(result) {
            console.log(result)
            let data = JSON.parse(result);
            $(".s_kecamatan").removeAttr('disabled')
            $(".s_kecamatan").html('<option>Pilih Kecamatan</option>')

            data.forEach(function(dataKecamatan) {
                $(".s_kecamatan").append('<option value="' + dataKecamatan.id_kecamatan + '">' + dataKecamatan.kecamatan + '</option>')
            })
        })
        })
        $('#debet').change(function(){            
            if($(this).val() === 'siswa'){
                if($('#kredit').val() === 'Pilih' || $('#kredit').val() === null || $('#kredit').val() === ' '){
                    $('#kredit').html('<option>Pilih</option><option value="sekolah">sekolah</option>')
                }
                else if($('#kredit').val() === 'siswa'){
                    $('#kredit').html('<option>Pilih</option><option value="sekolah">sekolah</option>')
                }
            }else if($(this).val() === 'sekolah'){
                if($('#kredit').val() === 'Pilih' || $('#kredit').val() === null || $('#kredit').val() === ' '){
                     $('#kredit').html('<option>Pilih</option><option value="siswa">siswa</option>')
                }else if($('#kredit').val() === 'sekolah'){
                    $('#kredit').html('<option>Pilih</option><option value="siswa">siswa</option>')
                }
            }else{
                 $('#kredit').html('<option>Pilih</option><option value="siswa">siswa</option><option value="sekolah">sekolah</option>')
            }
        })
        $('#kredit').change(function(){            
            if($(this).val() === 'siswa'){
                if($('#debet').val() === 'Pilih' || $('#debet').val() === null || $('#debet').val() === ' '){
                    $('#debet').html('<option>Pilih</option><option value="sekolah">sekolah</option>')
                }
                else if($('#debet').val() === 'siswa'){
                    $('#debet').html('<option>Pilih</option><option value="sekolah">sekolah</option>')
                }
            }else if($(this).val() === 'sekolah'){
                if($('#debet').val() === 'Pilih' || $('#debet').val() === null || $('#debet').val() === ' '){
                     $('#debet').html('<option>Pilih</option><option value="siswa">siswa</option>')
                }else if($('#debet').val() === 'sekolah'){
                    $('#debet').html('<option>Pilih</option><option value="siswa">siswa</option>')
                }
            }else{
                 $('#debet').html('<option>Pilih</option><option value="siswa">siswa</option><option value="sekolah">sekolah</option>')
            }
        })
        </script>

<script type="text/javascript">
function toggle(source) {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
    }
}
</script>
        <!-- ========== ADD custom.js FILE BELOW WITH YOUR CHANGES ========== -->
    </body>
</html>
