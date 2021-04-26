<template>
<div>
<div class="row">
<div class="col-md-4 mx-auto">
  <div class="card">
    <div class="card-body">
    <form id="create" @submit.prevent="createTransaction">
        <div class="form-group">
            <label>Nama Produk</label>
            <div class="error" v-if="errors.product">
                {{errors.product[0]}}
            </div>
            <select v-model="product" class="form-control">
            <option disabled value="">Please select one</option>
            <option v-for="(item, index) in products" :key="index" v-bind:value="item.id">{{item.name}}</option>
            </select>
        </div>
        <div class="form-group">
            <label>Total</label>
             <div class="error" v-if="errors.total">
                {{errors.total[0]}}
            </div>
            <input type="text" class="form-control" name="total" id="total" v-model="total">
        </div>
        <button class="btn btn-sm btn-block btn-success" >Tambah</button>
    </form>
    </div>
  </div>
</div>
<div class="col-md-6 mx-auto">
 <div class="card">
    <div class="card-body">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Barang Yang dibeli</h3>
              <div class="box-tools">
                
              </div>
            </div>
            <!-- /.box-header -->
            <div class="form-group">
            <label>ID Customer</label>
            <div class="error" v-if="errors.idc">
                {{errors.idc[0]}}
            </div>
            <input 
            type="text" 
            class="form-control" 
            name="idc" 
            id="idc" 
            @input="showname()"
            v-model="idc">
            {{cname}}
        </div>
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover" >
                <thead><tr>
                  <th>NO</th>
                  <th>Barang</th>
                  <th>Jumlah</th>
                  <th>Harga</th>
                  <th>Total</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(cart, index) in carts" :key="cart.id">
                  <td>{{index+1}}</td>
                  <td>{{cart.name}}</td>
                  <td>{{cart.total}}</td>
                  <td>{{cart.capital}}</td>
                  <td>{{cart.total * cart.capital}}</td>
                  <!-- <td><a href="" class="btn btn-sm btn-warning" @click.prevent="">Edit</a></td> -->
                  <td>
                    <a href="" class="btn btn-sm btn-danger" @click.prevent="deleteDetail(cart.id)">Hapus</a>
                  </td>
                </tr>
                <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>Total :</td>
                <td v-show="total_price">{{total_price}}</td>
                </tr>
              </tbody></table>
            </div>
            <!-- /.box-body -->
            <div class="row">
              <div class="col-5 mx-auto">
          <button 
          class="btn btn-sm btn-block btn-success" 
          @click.prevent="input()">
          selesai
          </button>
          </div>
              <div class="col-5 mx-auto">
          <button 
          class="btn btn-sm btn-block btn-danger" 
          @click.prevent="cancel()">
          Cancel
          </button>
          </div>
         </div>
          </div>
          <!-- /.box -->
        </div>
  </div>
  </div>
  </div>
 
  </div>
</template>

<script>  
import axios from 'axios';
    export default {
       mounted() {
           console.log('Component mounted.')
        this.transaction()
        this.createTransaction()
        this.showDetail()
        this.showname()
        },
        beforeMount(){
          this.showDetail()
        },
        data(){
          return {
              carts:[],
                idc: '',
                total: '',
                total_price: '',
                product: '',
                products: [],
                errors:{},
                cname:''
            
          }
          
        },
        methods:{
          showname:function(){
            var idc = this.idc
            
            axios.get(`/api/transaction/${idc}/showname`)
            .then((response) => {
              if (response.status == 200 && response.data.status == 'success') {
                // console.log(response)
                  this.cname = response.data.result
                }
                else
                {
                  this.cname = 'Customer Tidak Ada'
                }
              
            });
          },

            showDetail:function(){
              axios.get('/api/transaction/showdetail')
              .then((response) => {
                 this.carts = response.data.result;
                 this.total_price = response.data.total_price;
                 this.refreshDetail();
              });
           },
            cancel:function () {
              axios.post('/api/transaction/showdetail/cancel')
              .then( (response) => {
                  if (response.status == 200 && response.data.status == 'success')
                    {
                        this.refreshDetail();
                    } else {
                        alert('Error Delete Data. Check Console.');
                        console.log(response);
                    }
              })
            },
            deleteDetail:function(id) {
              axios.delete('/api/transaction/showdetail/delete/'+id)
              .then((response) => {
                 if (response.status == 200 && response.data.status == 'success')
                    {
                      this.showDetail();
                      console.log(response);
                      return this.$vs.notify({
                        title : 'Success',
                        Text : "Delete Berhasil",
                        color : 'primary',
                      })
                    } else {
                        alert('Error Delete Data. Check Console.');
                        console.log(response);
                    }
              });
            },
            createTransaction:function(){


                var param = {
                    product: this.product, 
                    total: this.total
                };
                axios.post('/api/transaction/create', param).then((response) => {
                   if (response.status == 200 && response.data.status == 'success')
                    {
                        this.cart = response.data
                        // router.push({name: 'Home'});
                      this.refreshDetail();
                      this.product = '',
                      this.total = ''
                    } else {
                      alert(response.data.status);
                        console.log(response);
                    }
              }).catch((error) => {
                    this.errors = error.response.data.errors;
            });
             },
            refreshDetail:function(){
              axios.get('/api/transaction/showdetail')
              .then((response) => {
                 this.carts = response.data.result;
                 this.total_price = response.data.total_price;
              });
            },
            input:function() {

              if(this.carts.length == 0){
                return this.$vs.notify({
                  title : 'Transaction Failed',
                  Text : "Data Transaksi Tidak Ada",
                  color : 'danger',
                })
              }

              var param = {
                 idc: this.idc
             };
              axios.post('/api/transaction/done', param)
               .then((response) => {
                if (response.status == 200 && response.data.status == 'success')
                    {
                     this.refreshDetail();
                     this.idc = ''
                     return this.$vs.notify({
                        title : 'Success',
                        Text : "Transaksi Berhasil",
                        color : 'primary',
                      })
                    } 
              }).catch((error) => {
                    this.errors = error.response.data.errors;
            });
            },
             transaction: function(){
              axios.get('/api/transaction')
              .then(function (response) {
                 this.products = response.data;
              }.bind(this));
            }
             
        }
    }
  
</script>