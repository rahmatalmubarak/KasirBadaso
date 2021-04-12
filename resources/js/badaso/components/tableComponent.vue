<template>
<div class="card">
    <div class="card-body">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Barang Yang dibeli</h3>
              <div class="box-tools">
                <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
                 <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody><tr>
                  <th>Barang</th>
                  <th>Jumlah</th>
                  <th>Harga</th>
                  <th>Total</th>
                  <th>Aksi</th>
                </tr>
                <tr>
                  <td>183980980</td>
                  <td>John Doe</td>
                  <td>11-7-2014</td>
                  <td><span class="label label-success">Approved</span></td>
                  <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                </tr>

              </tbody></table>
            </div>
            <!-- /.box-body -->
          <button class="btn btn-sm btn-block btn-success">selesai</button>
          </div>
          <!-- /.box -->
        </div>
    </div>
</template>

<script>  
import axios from 'axios';
import BadasoText from './BadasoText.vue';
    export default {
        mounted() {
           console.log('Component mounted.')
        this.transaction()
        },
        data(){
            return {
                Product: 0,
                products: []  
            }
        },
        methods:{
            transaction: function(){
              axios.get('/api/transaction')
              .then(function (response) {
                 this.products = response.data;
              }.bind(this));
            }
        },
      
    }
</script>