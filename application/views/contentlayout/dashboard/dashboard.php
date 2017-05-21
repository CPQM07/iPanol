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
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?= $solpen ?></h3>
              <p>Solicitudes pendientes por recepcionar</p><!-- manda a vista entregadigital -->
            </div><!-- where = 3 -->
            <div class="icon">
              <i class="ion ion-clipboard"></i>
            </div>
            <a href="<?=site_url('gestion/entregadigital')?>" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-orange">
            <div class="inner">
              <h3><?= $solsinasig; ?><sup style="font-size: 20px"></sup></h3>

              <p>Solicitudes pendientes sin asignación</p><!-- manda a vista entregamanual -->
            </div><!-- where = 1 -->
            <div class="icon">
              <i class="ion ion-settings"></i>
            </div>
            <a href="<?=site_url('gestion/entregamanual')?>" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?= $baja ?><sup style="font-size: 20px"></sup></h3>

              <p>Productos / insumos dados de baja</p><!-- manda a la vista baja -->
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

        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Cantidad productos fuera del pañol por dia</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-11">
                  <div class="chart">
                    <!-- Sales Chart Canvas -->
                    <canvas id="chart-area4" width="600" height="200"></canvas>
                  </div>
                  <!-- /.chart-responsive -->
                </div>
                <div class="col-md-1">
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
        <!-- /.col -->
        <button id="actHoy" value="<?= $activosHoy; ?>" class="hidden"></button>
        <button id="actAyer" value="<?= $activosAyer; ?>" class="hidden"></button>
        <button id="funHoy" value="<?= $fungiblesHoy; ?>" class="hidden"></button>
        <button id="funAyer" value="<?= $fungiblesAyer; ?>" class="hidden"></button>
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
    var fungHoy=document.getElementById("funHoy").value;
    var fungAyer=document.getElementById("funAyer").value;

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
          data : [4,3,0,2,1,actiAyer,actiHoy] /*productos activos*/
        },
        {
          label: "Segunda serie de datos",
          fillColor : "rgba(151,187,205,0.2)",
          strokeColor : "#e3e3e3",
          pointColor : "#e3e3e3",
          pointStrokeColor : "#fff",
          pointHighlightFill : "#fff",
          pointHighlightStroke : "rgba(151,187,205,1)",
          data : [5,4,0,3,3,fungAyer,fungHoy] /*productos fungibles*/
        }
      ]

    }
  var ctx4 = document.getElementById("chart-area4").getContext("2d");
  window.myPie = new Chart(ctx4).Line(lineChartData, {responsive:true});
    });
  </script>
  <?php } ?>