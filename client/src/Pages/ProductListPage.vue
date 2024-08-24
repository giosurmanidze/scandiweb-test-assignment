<template>
  <Header :onSubmit="handleMassDelete" />
  <div class="w-full px-10 flex gap-10 flex-wrap my-16 justify-center">
    <div
      v-for="(product, index) in products"
      :key="index"
      class="bg-white p-10 rounded-lg shadow-md w-80 border-black border-2"
      v-if="products.length"
    >
      <ProductCard
        :product="product"
        :index="index"
        :modelValue="checkboxValues"
        @update:checkboxValues="updateCheckboxValues"
      />
    </div>
    <h2 v-else class="sm:text-xl md:text-3xl flex gap-3 items-center font-heading_font">
      No Products Found <img src="@/assets/empty_box.png" alt="empty box" width="70" height="70" />
    </h2>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import ProductCard from '@/components/ProductCard.vue'
import Header from '@/components/Header.vue'
import axios from '@/config/axios.js'

const products = ref([])
const checkboxValues = ref([])

const getProducts = async () => {
  try {
    const response = await axios('/products')
    products.value = response.data
  } catch (error) {
    console.error('Error fetching products:', error)
  }
}
getProducts()

const updateCheckboxValues = ({ sku, checked }) => {
  if (checked) {
    if (!checkboxValues.value.includes(sku)) {
      checkboxValues.value.push(sku);
    }
  } else {
    checkboxValues.value = checkboxValues.value.filter(value => value !== sku);
  }
};


const handleMassDelete = async () => {
  try {
    const skusToDelete = checkboxValues.value || []
    await axios.post('/mass-delete', skusToDelete)
    await getProducts()
    checkboxValues.value = []
  } catch (error) {
    console.error('Error deleting products:', error)
  }
}
</script>
