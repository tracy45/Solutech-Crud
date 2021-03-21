<template>
    <div>
        <h4 class="text-center font-weight-bold">Products</h4>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Product</th>
                <th scope="col">Description</th>
                <th scope="col">Quantity</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="product in products">
                <td>{{product.name}}</td>
                <td>{{product.description}}</td>
                <td>{{product.quantity}}</td>

                <td>
                    <button class="btn btn-danger" @click="deleteProducts"><i style="color:white" class="fa fa-trash"></i></button>
                </td>
            </tr>
            </tbody>
        </table>
            </div>


</template>

<script>
import {mapGetters} from 'vuex'
export default {
    data() {
        return {
            products: []
        };
    },

    created() {
        this.getProducts('127.0.0.1:8000/api/products');
    },

    methods: {
        getProducts(api_url) {
            // api_url = api_url || '/api/products';
            fetch(api_url)
                .then(response => response.json())
                .then(response => {
                    this.products.push(response.data);
                })
                .catch(err => console.log(err));
        }
    },


    computed: {
        ...mapGetters([
            'products'
        ])
    }
}
</script>
