    <form role="form" id="isian_form" action="<?php echo $action ?>" method="POST">
        <input type="hidden" name="id_hidden" value="<?php echo isset($data->id) ? $data->id : NULL ?>">
        <div class="form-group">
            <label for="exampleInputEmail1">Nama Jenis Isian</label>
            <input type="text" name="text" value="<?php echo isset($data->text) ? $data->text : NULL ?>" class="form-control" id="nama_jenis_isian" placeholder="Masukan nama jenis isian" required>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Jenis</label>
            <select class="custom-select" id="jenis_isian">
                <option value="numeric">Numeric</option>
                <option value="rentang">Rentang</option>
                <option value="qualitas">Qualitas</option>
                <option value="" selected>--Pilih Jenis Isian--</option>
            </select>
        </div>
        <div class="form-group" id="field_jenis_isian">

        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>

    <script>
        $('#jenis_isian').on('change', function() {
            let jenis = this.value;
            $('#field_jenis_isian').empty()
            switch (jenis) {
                case 'rentang':
                    $('#field_jenis_isian').append(
                        `
                        <div class='row'>
                            <div class='col-md-12'>
                                <a href='#' class='btn btn-xs btn-success float-md-right'><i class='fa fa-plus' /> Tambah Rentang</a>
                            </div>
                            <div class='col-md-4'>
                                <label>From</label>
                                <input type='text' name='from' placeholder='Rentang dari' class='form-control' required />
                            </div>
                            <div class='col-md-4'>
                                <label>To</label>
                                <input type='text' name='to' placeholder='Sampai rentang' class='form-control' required/>
                            </div>
                            <div class='col-md-4'>
                                <label>Nilai </label>
                                <input type='number' name='nilai' placeholder='Nilai rentang ini' required class='form-control' />
                            </div>
                        </div>
                        `
                    )
                    break;

                default:
                    break;
            }
        })
    </script>