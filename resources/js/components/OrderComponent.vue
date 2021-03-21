<template>
    <div>
        <form action="" @submit="addProduct">
            <h4 class="text-center font-weight-bold">Post creation form</h4>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Title" v-model=" product.name ">
            </div>
            <div class="form-group">
                <textarea class="form-control" placeholder="Body" v-model="product.description"></textarea>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Title" v-model=" product.quantity ">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Title" v-model=" supplier.name ">
            </div>
            <button type="submit" class="btn btn-success">place Order</button>
        </form>
    </div>

</template>

<script>
export default {
    data() {
        return {
            products: [],
            product: {
                "id": '',
                "name": '',
                "description": '',
                "quantity": ''
            },
            suppliers:[],
            supplier:{
                id:'',
                name:''
            }
        };
    },

    created() {
        this.getProducts();
        this.getSuppliers();

    },

    methods: {
        getProducts(api_url) {
            let vm = this;
            api_url = api_url || '/api/products';
            fetch(api_url)
                .then(response => response.json())
                .then(response => {
                    this.products = response.data;

                })
                .catch(err => console.log(err));
        },
        getSuppliers(api_url) {
            let vm = this;
            api_url = api_url || '/api/supplier';
            fetch(api_url)
                .then(response => response.json())
                .then(response => {
                    this.products = response.data;

                })
                .catch(err => console.log(err));
        },



        addProduct() {
            fetch('api/products', {
                method: 'post',
                body: JSON.stringify(this.post),
                headers: {
                    'content-type': 'application/json'
                }
            })
                .then(response => response.json())
                .then(data => {
                    this.getProducts();
                })
                .catch(err => console.log(err));
        }
    },


    addSupplier() {
        fetch('api/suppliers', {
            method: 'post',
            body: JSON.stringify(this.post),
            headers: {
                'content-type': 'application/json'
            }
        })
            .then(response => response.json())
            .then(data => {
                this.getSuppliers();
            })
            .catch(err => console.log(err));
    },

    computed: {
        isValid() {
            return this.product.name !== '' && this.product.description !== '' && this.product.quantity !== ''
        }
    }

};
</script>

<style scoped>

</style>
