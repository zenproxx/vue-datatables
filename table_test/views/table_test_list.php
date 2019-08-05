<script src="//unpkg.com/vue/dist/vue.js"></script>
<script src="//unpkg.com/element-ui/lib/index.js"></script>
<script src="//unpkg.com/element-ui/lib/umd/locale/en.js"></script>
<script src="//unpkg.com/vue-data-tables@3.4.4/dist/data-tables.min.js"></script>

<style>
    @import url("//unpkg.com/element-ui/lib/theme-chalk/index.css");
</style>
<div id="app">
    <div>

        <div class="container">
            <div class="row">

                <div class="col-md-12 mt-5">

                    <div class="row mb-3">

                        <!-- tombol create -->
                        <div class="col-md-4">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#ModalCreate"><i class="fa fa-plus"></i> Tambah Data</button>
                        </div>

                        <!-- Pesan -->
                        <div class="col-md-4">
                            <!-- kosong -->
                        </div>

                        <!-- search data -->
                        <div class="col-md-4">
                            <input class="form-control" type="text" placeholder="Cari Berdasarkan NO" v-model="filters[0].value">
                        </div>
                    </div>
                </div>
                <br>

                <div class="col-md-12 mt-2">
                    <div style="overflow-x: auto;">
                        <data-tables :data="data" :action-col="actionCol" :filters="filters" ref="table" @selection-change="handleSelectionChange">
                            <el-table-column type="selection"></el-table-column>

                            <el-table-column v-for="title in titles" :prop="title.prop" :label="title.label" :key="title.prop" sortable="custom"></el-table-column>
                        </data-tables>
                    </div>
                </div>


            </div>
        </div>


    </div>
</div>

<div class="modal" id="ModalEdit" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content" id="app_edit">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="varchar">Nama <?php echo form_error('nama') ?></label>
                    <input type="text" class="form-control" name="nama"  placeholder="Nama" v-model="nama" />
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat <?php echo form_error('alamat') ?></label>
                    <textarea class="form-control" rows="3" name="alamat" placeholder="Alamat" v-model="alamat"></textarea>
                </div>
                <div class="form-group">
                    <label for="int">No Hp <?php echo form_error('no_hp') ?></label>
                    <input type="text" class="form-control" name="no_hp"  placeholder="No Hp" v-model="no_hp" />
                </div>
                <input type="hidden" name="id" v-model="id" />
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                <a href="<?php echo base_url('table_test') ?>" class="btn btn-danger"><i class="fa fa-angle-left"></i> Kembali</a>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="ModalRead" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content" id="app_read">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <table class="table">
                    <tr>
                        <td>Nama</td>
                        <td>{{ nama }}</td>
                    </tr>

                    <tr>
                        <td>Alamat</td>
                        <td>{{ alamat }}</td>
                    </tr>

                    <tr>
                        <td>NO Handphone</td>
                        <td>{{ no_hp }}</td>
                    </tr>
                </table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="ModalCreate" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content" id="app_read">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

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
                    <input type="text" class="form-control" name="no_hp" id="no_hp" placeholder="No Hp" v-model="no_hp" />
                </div>
                <input type="hidden" name="id" v-model="id" />
                <button type="submit" class="btn btn-primary" onclick="tambah()"><i class="fa fa-save"></i> Simpan</button>
                <a href="<?php echo base_url('table_test') ?>" class="btn btn-danger"><i class="fa fa-angle-left"></i> Kembali</a>
            </div>
            <div class="modal-footer">
            </div>

            </div>
        </div>
</div>




<script>
    ELEMENT.locale(ELEMENT.lang.en)
    Vue.use(DataTables.DataTables)
    Vue.use(DataTables.DataTablesServer)
    var data, titles



    function tambah() {
        var data={
            'nama':$('#nama').val(),
            'alamat':$('#alamat').val(),
            'no_hp':$('#no_hp').val(),
        }
        
        $.post("http://localhost/wp-ci/app/table_test/create_action/",data,function(ret){
            alert (ret);
        })

    }

    function edit(id) {
        $('#ModalEdit').modal('show');
        var x = data[index]
        new Vue({
            el: '#app_edit',
            data: x
        });

    }

    function read(id) {
        $('#ModalRead').modal('show');
        var x = data[id]
        new Vue({
            el: '#app_read',
            data: x
        })
    }


    function hapus(id) {
        $.post("http://localhost/wp-ci/app/table_test/delete/" + id + "/", function() {
            alert("Berhasil Menghapus")
        })
    }
    
    
    $.getJSON("http://localhost/wp-ci/app/table_test/json", function(json) {
        data = json.data;


        titles = [{
            prop: "no",
            label: "NO."
        }, {
            prop: "id",
            label: "ID"
        }, {
            prop: "nama",
            label: "Nama"

        }, {
            prop: "alamat",
            label: "Alamat"

        }, {
            prop: "no_hp",
            label: "No Handphone"
        }, ]


        let mockServer = function(res) {
            let datas = serverData.slice()
            let allKeys = Object.keys(data[0])

            // do filter
            res && res.filters && res.filters.forEach(filter => {
                datas = datas.filter(data => {
                    let props = (filter.search_prop && [].concat(filter.search_prop)) || allKeys
                    return props.some(prop => {
                        if (!filter.value || filter.value.length === 0) {
                            return true
                        }
                        return [].concat(filter.value).some(val => {
                            return data[prop].toString().toLowerCase().indexOf(val.toLowerCase()) > -1
                        })
                    })
                })
            })

            // do sort
            if (res.sort && res.sort.order) {
                let order = res.sort.order
                let prop = res.sort.prop
                let isDescending = order === 'descending'

                datas.sort(function(a, b) {
                    if (a[prop] > b[prop]) {
                        return 1
                    } else if (a[prop] < b[prop]) {
                        return -1
                    } else {
                        return 0
                    }
                })
                if (isDescending) {
                    datas.reverse()
                }
            }

            return {
                data: datas.slice((res.page - 1) * res.pageSize, res.page * res.pageSize),
                req: res,
                ts: new Date(),
                total: datas.length
            }
        }

        let i = 1

        // fake http
        function http(res, time = 200) {
            return new Promise((resolve, reject) => {
                setTimeout(_ => {
                    var data = mockServer(res)
                    console.log('fake server return data: ', data)
                    resolve(data)
                }, time)
            })
        }


        var Main = {
            data() {
                return {
                    data,
                    titles,
                    filters: [{
                        prop: 'id',
                        value: ''
                    }],
                    actionCol: {
                        props: {
                            label: 'Aksi',
                        },
                        buttons: [{

                                props: {
                                    class: 'btn btn-primary btn-sm',
                                },
                                handler: row => {
                                    edit(row.id)
                                },
                                label: 'Edit'
                            },

                            {
                                props: {
                                    class: 'btn btn-success btn-sm',
                                },

                                handler: row => {
                                    read(row.id)
                                },

                                label: 'Lihat'
                            },

                            {
                                props: {
                                    class: 'btn btn-danger btn-sm',
                                },
                                handler: row => {
                                    hapus(row.id)
                                },
                                label: 'delete'
                            }
                        ]
                    },
                    selectedRow: []
                }
            },
            methods: {
                onCreate() {
                    
                    this.$refs.table.refresh();
                },
                onCreate100() {
                    [...new Array(100)].map(_ => {
                        this.onCreate()
                    })
                },
                handleSelectionChange(val) {
                    this.selectedRow = val
                },
                bulkDelete() {
                    this.selectedRow.map(row => {
                        this.data.splice(this.data.indexOf(row), 1)
                    })
                    this.$message('bulk delete success')
                }
            }
        }
        var Ctor = Vue.extend(Main)
        new Ctor().$mount('#app')
    });
</script>