<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <table class="table table-striped" id="tabel-pencocokan">
                    <thead>
                        <tr>
                            <th><?php echo "No."; ?></th>
                            <?php foreach ($header as $head_key => $item) : ?>
                                <th><?php echo $item ?></th>
                            <?php endforeach; ?>
                            <th>Pilih</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($data as $data_key => $value) : $string = ""; ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <?php foreach ($value as $items => $item) : ?>
                                    <td><?php echo $item; ?></td>
                                <?php endforeach; ?>
                                <td><input type="checkbox" name="alternative[]" value="<?php echo $data_key //$_SESSION['data'][$data_key]['alternative']['id_alt'] ?>" id=""></td>
                            </tr>
                        <?php $i++;
                        endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <button class="btn btn-success btn-block" id="btn-bantu">BANTU PILIH</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        $('#tabel-pencocokan').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
        })
    })
</script>