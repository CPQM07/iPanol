<?php $self = $_SERVER['PHP_SELF'];
header("refresh:30; url=$self"); ?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h3>Panel de control
      </h3>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?= $solpen ?></h3>
              <p>Solicitudes por recepcionar</p><!-- manda a vista entregadigital -->
            </div><!-- where = 3 -->
            <div class="icon">
              <i class="ion ion-clipboard"></i>
            </div>
            <a href="<?=site_url('gestion/recepcion')?>" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-orange">
            <div class="inner">
              <h3><?= $solsinasig; ?><sup style="font-size: 20px"></sup></h3>

              <p>Solicitudes sin asignación</p><!-- manda a vista entregamanual -->
            </div><!-- where = 1 -->
            <div class="icon">
              <i class="ion ion-settings"></i>
            </div>
            <a href="<?=site_url('gestion/entregadigital')?>" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?= $parciales ?><sup style="font-size: 20px"></sup></h3>

              <p>Solicitudes parciales</p><!-- manda a la vista baja -->
            </div>
            <div class="icon">
              <i class="ion ion-ios-loop-strong"></i>
            </div>
            <a href="<?=site_url('gestion/entregadigital')?>" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?= $baja ?><sup style="font-size: 20px"></sup></h3>

              <p>Productos dados de baja</p><!-- manda a la vista baja -->
            </div>
            <div class="icon">
              <i class="ion ion-trash-a"></i>
            </div>
            <a href="<?=site_url('gestion/baja')?>" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">

        <div class="col-md-3">
          <!-- Info Boxes Style 2 -->
          <div id="acti" class="info-box bg-red" data-toggle="modal" data-target="#activo">
            <span  class="info-box-icon">
              <i class="icon ion-hammer"></i>
            </span>

            <div class="info-box-content">
              <span class="info-box-text">Stock crítico</span>
              <span id="activCant" class="info-box-number"><?=$act?></span><!-- esteeee -->

              <div class="progress">
                <div id="percentActiv" class="progress-bar" style="width: <?=$act?>%;"></div>
              </div>
                  <span class="progress-description">
                    Productos activos
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
          <div id="fungi" class="info-box bg-red" data-toggle="modal" data-target="#fungigi">
            <span class="info-box-icon"><i class="ion ion-pin"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Stock crítico</span>
              <span id="fungiCant" class="info-box-number"><?=$fun?></span>

              <div class="progress">
                <div id="percentFungi" class="progress-bar" style="width:<?=$fun?>%;"></div>
              </div>
                  <span class="progress-description">
                    Productos fungibles
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
          
        </div>
        <!-- /.col -->

        <div class="col-md-9">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Cantidad productos fuera del pañol por dia</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-10">
                  <div class="chart">
                    <!-- Sales Chart Canvas -->
                    <canvas id="chart-area4" width="600" height="200"></canvas>
                  </div>
                  <!-- /.chart-responsive -->
                </div>
                <div class="col-md-2">
                  <p class="text-center">
                    <strong>Productos</strong>
                  </p>

                  <div class="progress-group">
                    <p class="text-center">Activos</p>
                    <div class="progress sm">
                      <div class="progress-bar progress-bar-red" style="width: 100%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                  <div class="progress-group">
                    <p class="text-center">Fungibles</p>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-red" style="width: 0%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                </div>


                <!-- /.col -->
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- ./box-body -->

          </div>
          <!-- /.box -->
        </div>
        <button id="actHoy" value="<?= $activosHoy; ?>" class="hidden"></button>
        <button id="actAyer" value="<?= $activosAyer; ?>" class="hidden"></button>
        <button id="actAyer2" value="<?= $activosAyer2; ?>" class="hidden"></button>
        <button id="actAyer3" value="<?= $activosAyer3; ?>" class="hidden"></button>
        <button id="actAyer4" value="<?= $activosAyer4; ?>" class="hidden"></button>
        <button id="actAyer5" value="<?= $activosAyer5; ?>" class="hidden"></button>
        <button id="actAyer6" value="<?= $activosAyer6; ?>" class="hidden"></button>

        <button id="funHoy" value="<?= $fungiblesHoy; ?>" class="hidden"></button>
        <button id="funAyer" value="<?= $fungiblesAyer; ?>" class="hidden"></button>
        <button id="funAyer2" value="<?= $fungiblesAyer2; ?>" class="hidden"></button>
        <button id="funAyer3" value="<?= $fungiblesAyer3; ?>" class="hidden"></button>
        <button id="funAyer4" value="<?= $fungiblesAyer4; ?>" class="hidden"></button>
        <button id="funAyer5" value="<?= $fungiblesAyer5; ?>" class="hidden"></button>
        <button id="funAyer6" value="<?= $fungiblesAyer6; ?>" class="hidden"></button>


      <div class="modal fade bs-example-modal-lg" id="activo" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-tittle text-center">Productos activos en stock crítico</h4>
              <table class="table table-bordered table-responsive">
                <thead>
                  <tr>
                    <td>Nombre</td>
                    <td>Stock óptimo</td>
                    <td>Stock crítico</td>
                    <td>Stock actual</td>
                  </tr>
                </thead>
                <tbody id="showdata">
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade bs-example-modal-lg" id="fungigi" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-tittle text-center">Productos fungibles en stock crítico</h4>
              <table class="table table-bordered table-responsive">
                <thead>
                  <tr>
                    <td>Nombre</td>
                    <td>Stock óptimo</td>
                    <td>Stock crítico</td>
                    <td>Stock actual</td>
                  </tr>
                </thead>
                <tbody id="showdata1">
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>



      </div>
      <!-- /.row (main row) -->
    <!-- /.content -->
  </div>
  <!--  /.content-wrapper -->

  <?php function MISJAVASCRIPTPERSONALIZADO(){
    
    $fecha = getDate();
    $hour = $fecha['hours'];
    $min = $fecha['minutes'];

    $today       = strtotime("today $hour:$min");
    $yesterday2  = strtotime("yesterday $hour:$min");
    $yesterday3  = strtotime("yesterday -1 day $hour:$min");
    $yesterday4  = strtotime("yesterday -2 day $hour:$min");
    $yesterday5  = strtotime("yesterday -3 day $hour:$min");
    $yesterday6  = strtotime("yesterday -4 day $hour:$min");
    $yesterday7  = strtotime("yesterday -5 day $hour:$min");


    ?>
   <script type="text/javascript" charset="utf-8">
   $(document).ready(function() {

    var actiHoy=document.getElementById("actHoy").value;
    var actiAyer=document.getElementById("actAyer").value;
    var actiAyer2=document.getElementById("actAyer2").value;
    var actiAyer3=document.getElementById("actAyer3").value;
    var actiAyer4=document.getElementById("actAyer4").value;
    var actiAyer5=document.getElementById("actAyer5").value;
    var actiAyer6=document.getElementById("actAyer6").value;

    var fungHoy=document.getElementById("funHoy").value;
    var fungAyer=document.getElementById("funAyer").value;
    var fungAyer2=document.getElementById("funAyer2").value;
    var fungAyer3=document.getElementById("funAyer3").value;
    var fungAyer4=document.getElementById("funAyer4").value;
    var fungAyer5=document.getElementById("funAyer5").value;
    var fungAyer6=document.getElementById("funAyer6").value;

    var lineChartData = {
      labels : [
      "<?= date("d-m-Y", $yesterday7) ?>",
      "<?= date("d-m-Y", $yesterday6) ?>",
      "<?= date("d-m-Y", $yesterday5) ?>",
      "<?= date("d-m-Y", $yesterday4) ?>",
      "<?= date("d-m-Y", $yesterday3) ?>",
      "<?= date("d-m-Y", $yesterday2) ?>",
      "<?= date("d-m-Y", $today)?>"
      ],
      datasets : [
        {
          label: "Primera serie de datos",
          fillColor : "rgba(220,220,220,0.2)",
          strokeColor : "#dd4b39",
          pointColor : "red",
          pointStrokeColor : "#fff",
          pointHighlightFill : "#fff",
          pointHighlightStroke : "rgba(220,220,220,1)",
          data : [actiAyer6,actiAyer5,actiAyer4,actiAyer3,actiAyer2,actiAyer,actiHoy] /*productos activos*/
        },
        {
          label: "Segunda serie de datos",
          fillColor : "rgba(151,187,205,0.2)",
          strokeColor : "#e3e3e3",
          pointColor : "#e3e3e3",
          pointStrokeColor : "#fff",
          pointHighlightFill : "#fff",
          pointHighlightStroke : "rgba(151,187,205,1)",
          data : [fungAyer6,fungAyer5,fungAyer4,fungAyer3,fungAyer2,fungAyer,fungHoy] /*productos fungibles*/
        }
      ]

    }
    var ctx4 = document.getElementById("chart-area4").getContext("2d");
    window.myPie = new Chart(ctx4).Line(lineChartData, {responsive:true});

    /*------------------------------------------------------------------------*/ 
    });



    $( "#acti" ).click(function() {
      var html = '';          
      $.ajax({
        method:"POST",
        url: "<?=site_url('/Dashboard/msjCriticoActiv')?>",
        datatype:'json',
        success: function(data){
            var wid = data.msjActi.length;
            var a = data.msjActi;
              a.forEach(function(entry) {
                  html +='<tr>'+
                          '<td>'+entry.INV_PROD_NOM +'</td>'+/*nombre*/
                          '<td>'+entry.PROD_STOCK_OPTIMO +'</td>'+/*optimo*/
                          '<td>'+entry.PROD_STOCK_CRITICO +'</td>'+/*critico*/
                          '<td>'+entry.CANTIDAD+'</td>'+/*actual*/
                        '</tr>';
              });
          $("#activCant").text(wid);
          $("#percentActiv").css("width", wid);
          $('#showdata').html(html);
        },
        error: function(){
          alert('Error al cargar los datos');
        }
      });
    });

    $( "#fungi" ).click(function() {
      var html = '';          
      $.ajax({
        method:"POST",
        url: "<?=site_url('/Dashboard/msjFungi')?>",
        datatype:'json',
        success: function(data){
          var wid = data.msjFungi.length;
            var a = data.msjFungi;
              a.forEach(function(entry) {
                html +='<tr>'+
                        '<td>'+entry.INV_PROD_NOM +'</td>'+/*nombre*/
                        '<td>'+entry.PROD_STOCK_OPTIMO +'</td>'+/*optimo*/
                        '<td>'+entry.PROD_STOCK_CRITICO +'</td>'+/*critico*/
                        '<td>'+entry.INV_PROD_CANTIDAD+'</td>'+/*actual*/
                      '</tr>';
              });
          $("#fungiCant").text(wid);
          $("#percentFungi").css("width", wid);
          $('#showdata1').html(html);
        },
        error: function(){
          alert('Error al cargar los datos');
        }
      });
    });

  </script>
  <?php } ?>