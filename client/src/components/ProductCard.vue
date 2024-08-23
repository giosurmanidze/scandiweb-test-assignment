<template>
  <div class="flex items-center">
    <input
      type="checkbox"
      :id="'checkbox-' + index"
      :value="product.sku"
      :checked="isChecked"
      @change="handleChange"
      class="delete-checkbox h-5 w-5 custom-checkbox cursor-pointer"
    />
    <label :for="'checkbox-' + index" class="ml-2 text-gray-800"></label>
  </div>
  <br />
  <div class="flex flex-col gap-2">
    <h3 class="text-lg font-semibold text-gray-800">{{ product.sku }}</h3>
    <h3 class="text-xl font-bold text-gray-900">{{ product.name }}</h3>
    <h3 class="text-gray-600 text-sm">{{ product.price }} $</h3>
    <h3 class="text-gray-600 text-sm">
      {{
        product.type === 'book'
          ? `Weight: ${product.weight}`
          : product.type === 'dvd'
            ? `Size: ${product.size} MB`
            : `Dimension: ${product.height}x${product.width}x${product.length}`
      }}
    </h3>
  </div>
</template>

<script setup>
import { defineEmits, defineProps, computed } from 'vue'

const emit = defineEmits(['update:checkboxValues'])

const props = defineProps({
  product: {
    type: Object
  },
  index: Number,
  modelValue: Array
})

const isChecked = computed(() => props.modelValue?.includes(props.product.sku))

const handleChange = (event) => {
  const target = event.target
  const sku = target.value
  const checked = target.checked

  emit('update:checkboxValues', { sku, checked })
}
</script>

<style scoped>
.custom-checkbox {
  accent-color: #e04f4f;
}
</style>
