<template>
  <div>
    <vs-row>
      <div class="vs-col vs-xs- vs-sm-12 vs-lg-8" vs-md="12" style="margin-left: 0%; width: 100%;">
        <i class="vs-icon notranslate icon-scale material-icons null" style="cursor: pointer; float: left; padding-top: 0.6rem;">arrow_back_ios</i> 
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
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(cart, index) in detail" :key="cart.id">
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
                <!-- <td v-show="total_price">{{total_price}}</td> -->
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
        this.detail()
    },
    
    data() {
      return{
        detail:[]
      }
    },

    methods: {
        detail: function() {
        axios.get('/transaction/detail')
        .then((response) => {
            this.detail = response.data.result;
        }).catch((err) => {
          
        });
        }
    },

    
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
