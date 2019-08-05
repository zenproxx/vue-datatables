
<div class="col-md-6 offset-md-3 col-sm-8 offset-sm-2 col-12">
    <div class="card mt-5 mb-5">
        <div class="card-body">

            <div class="mt-2 mb-2">
                <h3 class="text-center">Table_test</h3>
            </div>

            <div id="app">
            

                <form action='' v-model="action" method="post">
                    <div class="form-group">
                        <label for="varchar">Nama <?php echo form_error('nama') ?></label>
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" v-model="nama" />
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat <?php echo form_error('alamat') ?></label>
                        <textarea class="form-control" rows="3" name="alamat" id="alamat" placeholder="Alamat" v-model="alamat"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="int">No Hp <?php echo form_error('no_hp') ?></label>
                        <input type="text" class="form-control" name="no_hp" id="no_hp" placeholder="No Hp" v-model="no_hp"/>
                    </div>
                    <input type="hidden" name="id" v-model="id" />
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                    <a href="<?php echo base_url('table_test') ?>" class="btn btn-danger"><i class="fa fa-angle-left"></i> Kembali</a>
                </form>

            </div>
        </div>
    </div>
</div>


<script>
    var x= <?php echo json_encode($d_vue); ?>;
new Vue({
  el: '#app',
  data: x
});

</script>
