
  <!-- /.content-wrapper -->
  <footer>
    <strong>Development By &copy; 2020 <a href="https://hosterweb.co.id">HOSTERWEB INDONESIA</a>
  </footer>
            <!-- /.content-wrapper -->
        </div>
        <!-- /.main-wrapper -->

        <!-- ========== COMMON JS FILES ========== -->
        <script src="<?php echo base_url() ?>assets/Theme/js/jquery/jquery-2.2.4.min.js"></script>
        <script src="<?php echo base_url() ?>assets/Theme/js/jquery-ui/jquery-ui.min.js"></script>
        <script src="<?php echo base_url() ?>assets/Theme/js/bootstrap/bootstrap.min.js"></script>
        <script src="<?php echo base_url() ?>assets/Theme/js/pace/pace.min.js"></script>
        <script src="<?php echo base_url() ?>assets/Theme/js/lobipanel/lobipanel.min.js"></script>
        <script src="<?php echo base_url() ?>assets/Theme/js/iscroll/iscroll.js">j</script>

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
        <script>
            $(function(){

                // Counter for dashboard stats
                $('.counter').counterUp({
                    delay: 10,
                    time: 1000
                });

                // Welcome notification
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "3500",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
                toastr["success"]("One stop solution to your website admin panel!", "Welcome to Options!");

            });
        </script>

        <!-- ========== ADD custom.js FILE BELOW WITH YOUR CHANGES ========== -->
    </body>
</html>
