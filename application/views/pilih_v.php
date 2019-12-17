<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><b>Menentukan Kriteria</b></h3>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="data-criteria">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Criteria</th>
                            <th>Jenis</th>
                            <th>Bobot</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; foreach($criteria as $key => $value): ?>
                            <tr>
                                <td><?php echo "C" . $i; ?></td>
                                <td><?php echo $value->criteria; ?></td>
                                <td><?php echo $value->jenis; ?></td>
                                <td><?php echo $value->bobot; ?></td>
                            </tr>
                        <?php $i++; endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><b>Menentukan Kecocokan Alternative Terhadap Kriteria</b> </h3>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="data-criteria">
                    <thead>
                        <tr>
                            <?php foreach ($header as $key_header => $item_header) : ?>
                                <th><?php echo  $item_header  ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data_alt as $key => $alternative): ?>
                            <tr>
                                <?php foreach($alternative['alternative'] as $alt_key => $alt): ?>
                                    <?php if ($alt_key !== "id_alt" AND $alt_key !== "id_pck"): ?>
                                        <td><?php echo $alt ?></td>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <?php foreach($alternative['pencocokan'] as $pck_key => $pck): ?>
                                    <td><?php echo $pck['criteria']?></td>
                                <?php endforeach; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><b>Konversi Dalam Angka Kecocokan Alternative Terhadap Kriteria</b> </h3>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="data-criteria">
                    <thead>
                        <tr>
                            <?php foreach ($header as $key_header => $item_header) : ?>
                                <th><?php echo  $item_header  ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data_alt as $key => $alternative): ?>
                            <tr>
                                <?php foreach($alternative['alternative'] as $alt_key => $alt): ?>
                                    <?php if ($alt_key !== "id_alt" AND $alt_key !== "id_pck"): ?>
                                        <td><?php echo $alt ?></td>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <?php foreach($alternative['pencocokan'] as $pck_key => $pck): ?>
                                    <td><?php echo $pck['nilai']?></td>
                                <?php endforeach; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>





<script>
    $(document).ready(() => {
        $('.table').DataTable({
            "paging": true,
            "search": true
        })
    })
</script>