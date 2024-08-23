import AddProductPage from '@/Pages/AddProductPage.vue'
import ProductListPage from '@/Pages/ProductListPage.vue'
import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "ProductListPage",
      component: ProductListPage,
    },{
      path: "/add-product",
      name: "AddProductPage",
      component: AddProductPage,
    },
  ]
})

export default router
