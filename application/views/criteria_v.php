<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Criteria</h3>
            </div>
            <div class="card-body">
                <table id="example2" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kriteria</th>
                            <th>Bobot</th>
                            <th>Jenis</th>
                            <th>Isian</th>
                            <th>Ket.</th>
                        </tr>
                    </thead>
                    <tbody id='table-body'>
                        <?php
                        $i = 1;
                        foreach ($criteria as $idx => $row) :
                            ?>
                            <tr id='<?php echo $row->id ?>'>
                                <td><?php echo $i ?></td>
                                <td><?php echo $row->criteria ?></td>
                                <td><?php echo $row->bobot ?></td>
                                <td><?php echo $row->jenis ?></td>
                                <td><?php echo $row->isian ?></td>
                                <td><?php echo $row->keterangan ?></td>
                            </tr>
                        <?php
                            $i++;
                        endforeach;
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Kriteria</th>
                            <th>Bobot</th>
                            <th>Jenis</th>
                            <th>Isian</th>
                            <th>Ket.</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
        });
    })
</script>