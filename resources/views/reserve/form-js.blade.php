
  <script type="text/javascript">
    $(document).ready(function(){
      $('select').formSelect();
      $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
      });
      $('.timepicker').timepicker({
        twelveHour: false,
      });
      $('.tooltipped').tooltip();
    });
  </script>
