<script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
<script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><b>Tabel Hasil Perhitungan</b></h4>
            </div>
            <div class="card-body">
                <table id="example2" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th><small><b>Alternative</b></small></th>
                            <?php foreach ($criteria as $key => $value) : ?>
                                <th><small><b><?php echo $value['criteria'] ?></b></small></th>
                            <?php endforeach; ?>
                            <th> <small><b>Hit. Vektor</small></b></th>
                            <th> <small><b>Perankingan</small></b></th>
                        </tr>
                    </thead>
                    <tbody id='table-body'>
                        <?php
                        $i = 1;
                        $id_perhitungan = date('mdyHis') . rand(5, 100);
                        foreach ($alternative as $key2 => $value2) :
                            $col_span = 0;
                            ?>
                            <tr class="data-alt">
                                <td><small><?php echo $d = $key2 ?></small></td>
                                <?php for ($k = 0; $k < sizeof($value2) - 1; $k++) : ?>
                                    <td>
                                        <small><?php echo $value2[$k] ?></small>
                                    </td>
                                    <?php $col_span++; ?>
                                <?php endfor; ?>
                            </tr>
                        <?php $i++;
                            $hasil_perhitungan[] = [
                                'id_alternative' => $value2[sizeof($value2) - 1],
                                'hasil_perhitungan' => $value2[sizeof($value2) - 2],
                                'id_perhitungan' => $id_perhitungan,
                            ];
                        endforeach;
                        $_SESSION['hasil_perhitungan'] = $hasil_perhitungan;
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="<?php echo $col_span - 1 ?>" align="center">Total</td>
                            <td><?php echo $total_vektor ?></td>
                            <td><?php echo $total_perankingan ?></td>
                        </tr>
                    </tfoot>
                </table>
                <div class="card-footer bg-white">
                    <a href="<?php echo site_url('Hitungwp/simpan/' . $token) ?>"><button class="btn btn-block btn-primary btn-simpan" data-hasil="">Simpan</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <h4 class="card-title"><b>Kriteria, Bobot dan Normalisasi</b></h4>
    </div>
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <caption>
                <p class="float-sm-left">
                    Perhitungan Normalisasi menggunakan rumus
                    <small> \[Wj = {Wj \over \sum {Wj}} \] </small>
                    dimana: <br>
                    W = Bobot <br>
                    j = Index W
                </p>
            </caption>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Criteria</th>
                    <th>Jenis</th>
                    <th>Bobot</th>
                    <th>Normalisasi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($criteria as $crit => $valcrit) : ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $valcrit['criteria'] ?></td>
                        <td><?php echo $valcrit['jenis'] ?></td>
                        <td><?php echo $valcrit['bobot'] ?></td>
                        <td><?php echo $valcrit['normalisasi'] ?></td>
                    </tr>

                <?php
                    $i++;
                endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" align="center">Total</td>
                    <td colspan=""><?php echo $total_bobot ?></td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<script>
    $(function() {
        let table = $('#example2').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "order": [
                ['<?php echo $col_span ?>', "desc"]
            ]
        });
    })
</script>