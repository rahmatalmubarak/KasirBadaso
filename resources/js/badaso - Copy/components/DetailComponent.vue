<template>
<div>
  <vs-row>
      <div class="vs-col vs-xs- vs-sm-12 vs-lg-8" vs-md="12" style="margin-left: 0%; width: 100%;">
       <router-link to="this.$router.go(-1)"><i class="vs-icon notranslate icon-scale material-icons null" style="cursor: pointer; float: left; padding-top: 0.6rem;">arrow_back_ios</i></router-link>
      </div>
       <vs-col vs-lg="12">
        <vs-card>
          <div slot="header">
            <h3>
              Detail Transaksi
             </h3>
           </div>
          <vs-row>
            <vs-col>      
              <table class="table">
                <thead><tr>
                  <th>NO</th>
                  <th>Barang</th>
                  <th>Jumlah</th>
                  <th>Harga</th>
                  <th>Total</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(cart, index) in carts" :key="cart.id">
                  <td>{{index+1}}</td>
                  <td>{{cart.name}}</td>
                  <td>{{cart.total}}</td>
                  <td>{{cart.capital}}</td>
                  <td>{{cart.total * cart.capital}}</td>
                 
                </tr>
                <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>Total :</td>
                <td v-show="total_price">{{total_price}}</td>
                </tr>
              </tbody>
              </table>
            </vs-col>
          </vs-row>
        </vs-card>
      </vs-col>
    </vs-row>
  </div>
</template>
<script>  
import axios from 'axios';
    export default {
       mounted() {
           console.log('Component mounted.')
           console.log(this.Detail())
        },
        data(){
          return {
              carts:[],     
               total_price: '',       
               users: '',       
          }
          
        },
        methods:{
            Detail:function(){
              var id = this.$route.params.id;
              axios.get(`/api/transaction/${id}/detail`)
              .then((response) => {
                 this.carts = response.data.result;
                  this.total_price = response.data.total_price;
                  // console.log(response.data.total_price);
              });
           },
           
        }
    }
  
</script>
<style>
.display-label {
  width: 30%;
  font-weight: bold;
}
.display-value {
  widows: 70%;
}
</style>
