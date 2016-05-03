        <script type="text/javascript" src="<?php echo base_url('js/jquery/jquery-2.2.0.min.js')?>"></script>
        <script type="text/javascript" src="<?php echo base_url('bootstrap/js/bootstrap.min.js')?>"></script>
        <script type="text/javascript" src="<?php echo base_url('js/saribe-eModal/dist/eModal.min.js')?>"></script>
        <script>
            var base_url = '<?php echo base_url("index.php/main"); ?>';
            var medicos = '<?php echo json_encode($medicos); ?>';
            var medicos = JSON.parse(medicos);
        </script>
        <script type="text/javascript" src="<?php echo base_url('js/helper.js')?>"></script>
    </body>

</html>