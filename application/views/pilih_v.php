<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><b>Menentukan Kriteria</b></h3>
            </div>
            <div class="card-body">
                <table class="table table-striped table-biasa" id="data-criteria">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Criteria</th>
                            <th>Jenis</th>
                            <th>Bobot</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($criteria as $key => $value) : ?>
                            <tr>
                                <td><?php echo "C" . $i; ?></td>
                                <td><?php echo $value->criteria; ?></td>
                                <td><?php echo $value->jenis; ?></td>
                                <td><?php echo $value->bobot; ?></td>
                            </tr>
                        <?php $i++;
                                endforeach; ?>
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
                <table class="table table-striped table-biasa" id="data-criteria">
                    <thead>
                        <tr>
                            <?php foreach ($header as $key_header => $item_header) : ?>
                                <th><?php echo  $item_header  ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data_alt as $key => $alternative) : ?>
                            <tr>
                                <?php foreach ($alternative['alternative'] as $alt_key => $alt) : ?>
                                    <?php if ($alt_key !== "id_alt" and $alt_key !== "id_pck") : ?>
                                        <td><?php echo $alt ?></td>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <?php foreach ($alternative['pencocokan'] as $pck_key => $pck) : ?>
                                    <td><?php echo $pck['criteria'] ?></td>
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
                <h3 class="card-title"><b>Konversi Dalam Angka Kecocokan Alternative Terhadap Kriteria (Matriks Keputusan)</b> </h3>
            </div>
            <div class="card-body">
                <table class="table table-striped table-biasa" id="data-criteria">
                    <thead>
                        <tr>
                            <?php foreach ($header as $key_header => $item_header) : ?>
                                <th><?php echo  $item_header  ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data_alt as $key => $alternative) : ?>
                            <tr>
                                <?php foreach ($alternative['alternative'] as $alt_key => $alt) : ?>
                                    <?php if ($alt_key !== "id_alt" and $alt_key !== "id_pck") : ?>
                                        <td><?php echo $alt ?></td>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <?php foreach ($alternative['pencocokan'] as $pck_key => $pck) : ?>
                                    <td><?php echo $pck['nilai'] ?></td>
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
                <h3 class="card-title"><b>Matriks Normalisasi</b></h3>
            </div>
            <div class="card-body">
                <table class="table table-striped table-biasa" id="normalisasi">
                    <thead>
                        <tr>
                            <?php foreach ($header as $key_header => $item_header) : ?>
                                <th><?php echo  $item_header  ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($normalisasi as $key => $value) : ?>
                            <tr>
                                <?php for ($i = 0; $i < sizeof($value) - 1; $i++) : ?>
                                    <td><?php echo $value[$i] ?></td>
                                <?php endfor; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><b>Hitung Preferensi</b></h3>
            </div>
            <div class="card-body">
                <table class="table table-striped table-biasa" id="preferensi">
                    <thead>
                        <tr>
                            <?php for ($i = 0; $i < sizeof($header) - $jml_crt; $i++) : ?>
                                <th><?php echo  $header[$i] ?></th>
                            <?php endfor; ?>
                            <th>Nilai Preferensi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($preferensi as $key => $value) : ?>
                            <tr>
                                <?php for ($i = 0; $i < sizeof($value); $i++) : ?>
                                    <td><?php echo $value[$i] ?></td>
                                <?php endfor; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><b>Perankingan</b></h3>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="perankingan">
                    <thead>
                        <tr>
                            <?php for ($i = 0; $i < sizeof($header) - $jml_crt; $i++) : ?>
                                <th><?php echo  $header[$i] ?></th>
                            <?php endfor; ?>
                            <th>Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($preferensi as $key => $value) : ?>
                            <tr>
                                <?php for ($i = 0; $i < sizeof($value); $i++) : ?>
                                    <td><?php echo $value[$i] ?></td>
                                <?php endfor; ?>
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
        $('.table-biasa').DataTable({
            "paging": true,
            "search": true
        })

        $('#perankingan').DataTable({
            "paging": true,
            "search": true,
            "sort": true,
            "order": [[2, "desc"]]
        });
    })
</script>