<template>
  <Header :onSubmit="handleSave" pageTitle="Product Add" />
  <div class="flex w-full flex-col items-center justify-start h-screen mt-16 px-4 md:px-8 lg:px-16">
    <form @submit.prevent="handleSave" id="product_form" class="w-full max-w-lg">
      <p class="text-red-800 text-md">
        All fields are required!
        <span v-if="errors.duplicate_sku_error">
          {{ notify() }}
        </span>
      </p>

      <div class="mb-4">
        <CustomTextField
          id="sku"
          label="SKU"
          placeholder="Enter product SKU"
          v-model="form.sku"
          :error="errors.sku"
        />
      </div>
      <div class="mb-4">
        <CustomTextField
          id="name"
          label="Name"
          placeholder="Enter product name"
          v-model="form.name"
          :error="errors.name"
        />
      </div>
      <div class="mb-4">
        <CustomTextField
          id="price"
          label="Price"
          placeholder="Enter product price"
          v-model="form.price"
          :error="errors.price"
        />
      </div>
      <div class="flex flex-col flex-end mt-5 w-full">
        <SelectMenu v-model="form.type" id="productType" />
        <div class="w-full md:w-3/4 text-red-800">
          {{
            form.type === 'book'
              ? 'Please, provide size'
              : form.type === 'dvd'
                ? 'Please, provide weight'
                : form.type === 'furniture'
                  ? 'Please, provide dimensions in HxWxL format'
                  : ''
          }}
        </div>
      </div>

      <!-- Conditional Input Fields -->
      <div class="mb-7 flex flex-col gap-5 items-center w-full">
        <div v-if="form.type === 'book'" class="flex flex-col gap-5 items-center w-full">
          <CustomTextField
            id="weight"
            label="Weight (KG)"
            type="number"
            v-model="form.weight"
            placeholder="Enter product weight"
            :error="errors.weight"
          />
        </div>

        <div v-if="form.type === 'dvd'" class="flex flex-col gap-5 items-center w-full">
          <CustomTextField
            id="size"
            label="Size (MB)"
            type="number"
            v-model="form.size"
            placeholder="Enter product size"
            :error="errors.size"
          />
        </div>
        <div v-if="form.type === 'furniture'" class="flex flex-col gap-5 items-center w-full">
          <CustomTextField
            id="width"
            label="Width (CM)"
            type="number"
            v-model="form.width"
            placeholder="Enter product width"
            :error="errors.width"
          />
          <CustomTextField
            id="height"
            label="Height (CM)"
            type="number"
            v-model="form.height"
            placeholder="Enter product height"
            :error="errors.height"
          />
          <CustomTextField
            id="length"
            label="Length (CM)"
            type="number"
            v-model="form.length"
            placeholder="Enter product length"
            :error="errors.length"
          />
        </div>
      </div>
    </form>
  </div>
</template>
<script setup>
import { ref, watch } from 'vue'
import CustomTextField from '@/components/CustomTextField.vue'
import Header from '@/components/Header.vue'
import axios from '@/config/axios.js'
import router from '@/router'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'
import validatedForm from '@/utils/fieldValidations.js'
import SelectMenu from '@/components/SelectMenu.vue'

const form = ref({
  sku: '',
  name: '',
  price: '',
  type: '',
  weight: '',
  size: '',
  width: '',
  height: '',
  length: ''
})

const errors = ref({
  sku: false,
  name: false,
  price: false,
  weight: false,
  size: false,
  width: false,
  height: false,
  length: false,
  duplicate_sku_error: false
})

const notify = () => {
  if (errors.value.duplicate_sku_error) {
    toast.error('This SKU already exists!', {
      position: toast.POSITION.TOP_CENTER
    })
    errors.value.duplicate_sku_error = false // Reset after notification
  }
}

// Watch for duplicate SKU error and trigger notification
watch(
  () => errors.value.duplicate_sku_error,
  (newVal) => {
    if (newVal) notify()
  }
)
const handleSave = async () => {
  if (!validatedForm(errors, form)) {
    return
  }
  const filteredData = Object.fromEntries(
    Object.entries(form.value).filter(([key, value]) => value !== '')
  )

  try {
    const response = await axios.post('/create-product', filteredData)
    await router.push({ name: 'ProductListPage' })
  } catch (error) {
    console.error('Error during save:', error)
    const errorData = error.response?.data?.error
    if (errorData?.startsWith('SQLSTATE[23000]')) {
      errors.value.duplicate_sku_error = true
      errors.value.sku = true
    }
  }
}

</script>
