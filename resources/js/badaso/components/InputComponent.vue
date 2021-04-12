<template>
<div class="card">
    <div class="card-body">
    <form id="create" @submit.prevent="createData">
        <div class="form-row form-group">
             <div class="col-sm-5">
            <label>ID Customer</label>
            <input type="text" name="idCustomer" class="form-control" v-model="idCustomer">
        </div>
        <div class="col-sm-7">
            <label>Nama Customer</label>
            <input type="text" name="name" class="form-control" v-model="name">
        </div>
        </div>
        <div class="form-group">
            <label>Nama Produk</label>
            <select v-model="Product" class="form-control">
            <option disabled value="">Please select one</option>
            <option v-for="(item, index) in products" :key="index" value="item.id">{{item.name}}</option>
            
            </select>
        </div>
        <div class="form-group">
            <label>Total</label>
            <input type="text" class="form-control" name="total" id="total" v-model="total">
        </div>
        <button class="btn btn-sm btn-block btn-success">Tambah</button>
    </form>
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