<template>
    <div>
        <h4 class="text-center font-weight-bold">Supplier</h4>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Suppliers</th>

            </tr>
            </thead>
            <tbody>
            <tr v-for="supplier in suppliers">
                <td>{{suppliers.name}}</td>
            </tr>
            </tbody>
        </table>


    </div>
</template>

<script>
export default {
    data() {
        return {
            suppliers: []
        };
    },

    created() {
        this.getSupplier();
    },

    methods: {
        getSupplier(api_url) {
            api_url = api_url || '/api/suppliers';
            fetch(api_url)
                .then(response => response.json())
                .then(response => {
                    this.suppliers = response.data;
                })
                .catch(err => console.log(err));
        }
    }
};
</script>

<style scoped>

</style>
