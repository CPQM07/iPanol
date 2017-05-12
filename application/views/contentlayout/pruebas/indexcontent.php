    <div class="content-wrapper">
      <section class="content-header">
        <h3>
          Titulo de la vista
        </h3>
      </section>

      <!-- Main content -->
        <div class="content">
          <div class="row">
            <button id="a" type="button">ALERT PRUEBA</button>
          </div>
        </div>
    </div>

<?php function MISJAVASCRIPTPERSONALIZADO(){  ?>
<script type="text/javascript" charset="utf-8">
  
  $("#a").click(function(event) {
    alert("funcionavista indexcontent");
  });

</script>
<?php } ?>