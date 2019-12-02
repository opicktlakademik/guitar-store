<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Tabel Pencocokan
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-default btn-sm" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body" id="pencocokan">
                <table id="example2" class="table table-bordered table-striped tableInstall">
                    <thead>
                        <tr>
                            <?php foreach ($thead as $key => $value) : ?>
                                <th><?php echo $value ?></th>
                            <?php endforeach; ?>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody id='table-body'>
                        <?php foreach ($tbody as $key => $value) : ?>
                            <tr>
                                <?php for ($i = 2; $i < sizeof($value) - 2; $i += 2) : ?>
                                    <td id="<?php echo $i ?>">
                                        <?php echo $value[$i]; ?>

                                    </td>
                                <?php endfor; ?>
                                <td align="center">
                                    <?php if ($value[sizeof($value) - 2] !== $value[sizeof($value) - 1]) : ?>
                                        <button data-alt-pencocokan="<?php echo $value[1] ?>" class="btn btn-default btn-xs btn-danger btn-remove">
                                            Empty
                                        </button>
                                    <?php endif; ?>
                                    <button data-alt-pencocokan="<?php echo $value[1] ?>" class="btn btn-default btn-xs btn-warning btn-edit" data-id-alt="<?php echo $value[0] ?>">
                                        <i class="fa fa-edit"></i> Edit
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        $('.tableInstall').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
        });
        $('#riwayat').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
        });
    })
</script>