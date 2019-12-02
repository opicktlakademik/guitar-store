    <form role="form" id="criteria_form" action="<?php echo $action ?>" method="POST">
        <input type="hidden" name="id_hidden" value="<?php echo isset($data->id) ? $data->id : NULL ?>">
        <div class="form-group">
            <label for="exampleInputEmail1">Criteria</label>
            <input type="text" name="criteria" value="<?php echo isset($data->criteria) ? $data->criteria : NULL ?>" class="form-control" id="criteria_name" placeholder="Masukan nama kriteria" required>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Bobot</label>
            <input type="number" value="<?php echo isset($data->bobot) ? $data->bobot : NULL ?>" name="bobot" class="form-control" id="criteria_bobot" placeholder="00" required>
        </div> 
        <div class="form-group">
            <label>Ketreangan</label>
            <textarea class="form-control" name="keterangan" rows="3" placeholder="Masukan keterangan kriteria">
                <?php if (isset($data->keterangan)) {
                    echo trim($data->keterangan);
                }; ?>
            </textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>