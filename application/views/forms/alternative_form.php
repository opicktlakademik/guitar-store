    <form role="form" id="alternative_form" action="<?php echo $action ?>" method="POST">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <p>Data Guitar</p>
                </div>
                <input type="hidden" name="id_alt_hidden" value="<?php echo isset($data->id_alt) ? $data->id_alt : NULL ?>">
                <input type="hidden" name="id_pck_hidden" value="<?php echo isset($data->id_pencocokan) ? $data->id_pencocokan : NULL ?>">
                <div class="form-group">
                    <label for="exampleInputEmail1">Merk</label>
                    <input type="text" name="merk" value="<?php echo isset($data->merk) ? $data->merk : NULL ?>" class="form-control" id="Merk" placeholder="Masukan Merk guitar" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Jenis</label>
                    <input type="text" value="<?php echo isset($data->jenis_guitar) ? $data->jenis_guitar : NULL ?>" name="jenis_guitar" class="form-control" id="nomor-telepon" placeholder="Masukan jenis guitar" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Harga</label>
                    <input type="text" value="<?php echo isset($data->harga) ? $data->harga : NULL ?>" name="harga" class="form-control" id="harga" placeholder="Masukan harga">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Stock</label>
                    <input type="text" value="<?php echo isset($data->stock) ? $data->stock : NULL ?>" name="stock" class="form-control" id="stock" placeholder="Masukan stock">
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <p>Nilai Kecocokan</p>
                </div>
                <?php echo $criteria ?>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary float-md-right">Submit</button>
                </div>
            </div>
        </div>
    </form>

    <script>
        $(function() {
            let dataKriteria = JSON.parse('<?php echo json_encode($data_kriteria, JSON_NUMERIC_CHECK) ?>');
            dataKriteria.map((val, i) => {

                if (val[2] > 1) {
                    $(`select[name=${val[0]}] option[value=${val[1]}] `).attr('selected', 'selected');
                    console.log("+2")
                } else {
                    $(`input[name=${val[0]}]`).val(val[1]);
                }
            });
            console.log(dataKriteria);

        })
    </script>