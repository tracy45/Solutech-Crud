let mutations = {
    CREATE_PRODUCT(state, product) {
        state.products.unshift(product)
    },
    FETCH_PRODUCTS(state, products) {
        return state.products = products
    },
    DELETE_PRODUCTS(state, product) {
        let index = state.products.findIndex(item => item.id === product.id)
        state.products.splice(index, 1)
    }

}
export default mutations
