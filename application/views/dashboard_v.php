 <!-- Info boxes -->
 <div class="row">
     <div class="col-12 col-sm-6 col-md-3" title="Click to see more">
         <div class="info-box" id="criteria">
             <span class="info-box-icon bg-info elevation-1"><i class="fas fa-th-list"></i></span>

             <div class="info-box-content">
                 <span class="info-box-text">Criteria</span>
                 <span class="info-box-number">
                     <?php echo $criteria ?>
                 </span>
             </div>
             <!-- /.info-box-content -->
         </div>
         <!-- /.info-box -->
     </div>
     <!-- /.col -->
     <div class="col-12 col-sm-6 col-md-3" title="Click to see more">
         <div class="info-box mb-3" id="alternative">
             <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

             <div class="info-box-content">
                 <span class="info-box-text">Alternative</span>
                 <span class="info-box-number"><?php echo $alternative ?></span>
             </div>
             <!-- /.info-box-content -->
         </div>
         <!-- /.info-box -->
     </div>
     <!-- /.col -->

     <!-- fix for small devices only -->
     <div class="clearfix hidden-md-up"></div>

     <div class="col-12 col-sm-6 col-md-3">
         <div class="info-box mb-3">
             <span class="info-box-icon bg-success elevation-1"><i class="fas fa-calculator"></i></span>

             <div class="info-box-content">
                 <span class="info-box-text">Perhitungan</span>
                 <span class="info-box-number"><?php echo $riwayat . " x" ?></span>
             </div>
             <!-- /.info-box-content -->
         </div>
         <!-- /.info-box -->
     </div>
     <!-- /.col -->

     <!-- /.col -->
     <div class="col-md-12">
         <!-- Bar chart -->
         <div class="card card-primary card-outline">
             <div class="card-header">
                 <h3 class="card-title">
                     <i class="far fa-chart-bar"></i>
                     Perhitungan Terakhir
                 </h3>

                 <div class="card-tools">
                     <i class="fa fa-calendar-alt"></i> <?php echo isset($tanggal_terakhir) ? $tanggal_terakhir: NULL ?>
                     <button type="button" class="btn btn-tool" data-card-widget="collapse">
                         <i class="fas fa-minus"></i>
                     </button>
                 </div>
             </div>
             <div class="card-body">
                 <div id="bar-chart" style="height: 300px;"></div>
             </div>
             <!-- /.card-body-->
         </div>
         <!-- /.card -->
     </div>
 </div>
 <!-- /.row -->
 <script>
     $(function() {
         barChart('<?php echo json_encode($bar_data) ?>', '<?php echo json_encode($x_axis) ?>')
     })
 </script>