let actions = {
    createProduct({commit}, product) {
        axios.product('/api/products', product)
            .then(res => {
                commit('CREATE_PRODUCT', res.data)
            }).catch(err => {
            console.log(err)
        })

    },
    fetchProducts({commit}) {
        axios.get('/api/products')
            .then(res => {
                commit('FETCH_PRODUCTS', res.data)
            }).catch(err => {
            console.log(err)
        })
    },
    deleteProducts({commit}, product) {
        axios.delete(`/api/products/${product.id}`)
            .then(res => {
                if (res.data === 'ok')
                    commit('DELETE_PRODUCT', product)
            }).catch(err => {
            console.log(err)
        })
    }
}

export default actions
