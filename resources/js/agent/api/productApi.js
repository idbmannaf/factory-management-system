import axios from "axios"
const _apiBase = "http://cpnew.test/api/agent/ecommerce/"
/**
 * Mocking client-server processing
 */
 const _products = [
    // { 'id': 1, 'name': 'iPad 4 Mini', 'price': 500.01, 'inventory': 2 },
    // { 'id': 2, 'name': 'H&M T-Shirt White', 'price': 10.99, 'inventory': 10 },
    // { 'id': 3, 'name': 'Charli XCX - Sucker CD', 'price': 19.99, 'inventory': 5 }
  ]
  
  export default {
    getProducts (cb) {
      axios.get(_apiBase+'product').then(res => {
        setTimeout(() => cb(res.data), 100)
      })
    },
    newProduct (cb) {
      axios.post(_apiBase+'product/create').then(res => {
        setTimeout(() => cb(res.data), 100)
      })
    },
  
    buyProducts (products, cb, errorCb) {
      setTimeout(() => {
        // simulate random checkout failure.
        (Math.random() > 0.5 || navigator.webdriver)
          ? cb()
          : errorCb()
      }, 100)
    }
  }