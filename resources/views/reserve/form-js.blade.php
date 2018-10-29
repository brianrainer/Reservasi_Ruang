
  <script type="text/javascript">
    $(document).ready(function(){
      $('select').formSelect();
      $("select[required]").css({display: "block", height: 0, padding: 0, width: 0, position: 'absolute'});
      $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        minDate: new Date(),
      });
      $('.timepicker').timepicker({
        twelveHour: false,
      });
      $('.tooltipped').tooltip();
    });
  </script>
