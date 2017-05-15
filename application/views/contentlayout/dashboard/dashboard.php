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
            </div>
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
              <h3>4<sup style="font-size: 20px"></sup></h3>

              <p>Solicitudes pendientes sin asignación</p><!-- manda a vista entregamanual -->
            </div>
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
              <h3>4<sup style="font-size: 20px"></sup></h3>

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
      </div>
      <!-- /.row (main row) -->
    <!-- /.content -->
  </div>
  <!--  /.content-wrapper -->

  <?php function MISJAVASCRIPTPERSONALIZADO(){  
    


    ?>
   <script type="text/javascript" charset="utf-8">
    var lineChartData = {
      labels : ["Lunes - 08","Martes - 09","Miercoles - 10","Jueves - 11","Viernes - 12","Sábado - 13"],
      datasets : [
        {
          label: "Primera serie de datos",
          fillColor : "rgba(220,220,220,0.2)",
          strokeColor : "#dd4b39",
          pointColor : "red",
          pointStrokeColor : "#fff",
          pointHighlightFill : "#fff",
          pointHighlightStroke : "rgba(220,220,220,1)",
          data : [4,6,7,2,1,6] /*productos activos*/
        },
        {
          label: "Segunda serie de datos",
          fillColor : "rgba(151,187,205,0.2)",
          strokeColor : "#e3e3e3",
          pointColor : "#e3e3e3",
          pointStrokeColor : "#fff",
          pointHighlightFill : "#fff",
          pointHighlightStroke : "rgba(151,187,205,1)",
          data : [10,4,4,3,6,1] /*productos fungibles*/
        }
      ]

    }
  var ctx4 = document.getElementById("chart-area4").getContext("2d");
  window.myPie = new Chart(ctx4).Line(lineChartData, {responsive:true});
  </script>
  <?php } ?>