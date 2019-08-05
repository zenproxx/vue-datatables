
<div class="col-md-6 offset-md-3 col-sm-8 offset-sm-2 col-12">
    <div class="card mt-5 mb-5">
        <div class="card-body">
           
           <div class="mt-2 mb-2">
               <h3 class="text-center">Table_test Read</h3>
           </div>
           
            <table border="0" class="table" id="app">
	    <tr><td>Nama</td><td>{{ nama }}</td></tr>
	    <tr><td>Alamat</td><td>{{ alamat }}</td></tr>
	    <tr><td>No Hp</td><td>{{ no_hp }}</td></tr>  </table>
            
            <div class="text-center">
                <a href="<?php echo base_url('table_test') ?>" class="btn btn-primary"><i class="fa fa-angle-left"></i> Kembali</a>
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
