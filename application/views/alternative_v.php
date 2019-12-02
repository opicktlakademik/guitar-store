<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Alternative</h3>
                <div class="float-sm-right">
                    <button class="btn btn-primary btn-form">
                        Tambah
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table id="example2" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Merk</th>
                            <th>Jenis</th>
                            <th>Harga</th>
                            <th>Stock</th>
                            <th>Actoin</th>
                        </tr>
                    </thead>
                    <tbody id='table-body'>
                        <?php
                        $i = 1;
                        foreach ($alternatives as $idx => $row) :
                            ?>
                            <tr id='<?php echo $row->id ?>'>
                                <td><?php echo $i ?></td>
                                <td><?php echo $row->merk ?></td>
                                <td><?php echo $row->jenis_guitar ?></td>
                                <td><?php echo $row->harga ?></td>
                                <td><?php echo $row->stock ?></td>
                                <td align="center">
                                    <button class="btn btn-small btn-remove" data-id="<?php echo $row->id ?>">
                                        <i class="fa fa-times"></i>
                                    </button>
                                    <button class="btn btn-small btn-form" data-id="<?php echo $row->id ?>">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php
                            $i++;
                        endforeach;
                        ?>
                    </tbody>
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