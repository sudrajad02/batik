</div><!-- /#right-panel -->
<!-- Right Panel -->

<script src="<?php echo base_url() ?>assets/admin/jquery/dist/jquery.js"></script>
<script src="<?php echo base_url() ?>assets/admin/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/admin/popper.js/dist/umd/popper.min.js"></script>
<script src="<?php echo base_url() ?>assets/admin/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>assets/admin/js/main.js"></script>


<script src="<?php echo base_url() ?>assets/admin/chart.js/dist/Chart.bundle.min.js"></script>
<script src="<?php echo base_url() ?>assets/admin/js/dashboard.js"></script>
<script src="<?php echo base_url() ?>assets/admin/js/widgets.js"></script>
<script src="<?php echo base_url() ?>assets/admin/jqvmap/dist/jquery.vmap.min.js"></script>
<script src="<?php echo base_url() ?>assets/admin/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
<script src="<?php echo base_url() ?>assets/admin/jqvmap/dist/maps/jquery.vmap.world.js"></script>
<script>
    (function($) {
        "use strict";

        jQuery('#vmap').vectorMap({
            map: 'world_en',
            backgroundColor: null,
            color: '#ffffff',
            hoverOpacity: 0.7,
            selectedColor: '#1de9b6',
            enableZoom: true,
            showTooltip: true,
            values: sample_data,
            scaleColors: ['#1de9b6', '#03a9f5'],
            normalizeFunction: 'polynomial'
        });
    })(jQuery);
</script>

</body>

</html>