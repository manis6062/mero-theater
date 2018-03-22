  $('#datepicker1').datepicker({
      todayBtn: "linked",
      language: "it",
      autoclose: true,
      todayHighlight: true,
      format: 'yyyy-mm-dd'
  });

  $('#datepicker2').datepicker({
      todayBtn: "linked",
      language: "it",
      autoclose: true,
      todayHighlight: true,
      format: 'yyyy-mm-dd'
  });


  $("#filter_btn").click(function() {
    if($('#filterDateForm').is(':visible')) {
       $('#filterDateForm').fadeOut()
    }
    else {
       $('#filterDateForm').fadeIn("slow","swing")
    }
  });