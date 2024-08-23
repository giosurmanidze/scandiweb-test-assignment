<template>
  <div class="mb-7 flex items-center w-full gap-1">
    <label for="productType" class="text-md font-medium text-gray-700 w-full md:w-1/4"
      >Type Switcher</label
    >
    <select
      v-model="selectedOption"
      class="mt-1 block py-2 px-3 w-full md:w-3/4 border-2 border-black rounded-md"
      id="productType"
    >
      <option value="" disabled>Select an option</option>
      <option v-for="option in options" :key="option" :value="option">
        {{ option }}
      </option>
    </select>
  </div>
</template>

<script setup>
import { computed, defineEmits, defineProps } from 'vue'

const props = defineProps({
  modelValue: {
    type: String,
    default: ''
  },
  id: String
})

const emit = defineEmits(['update:modelValue'])
const options = ['book', 'dvd', 'furniture']

const selectedOption = computed({
  get: () => props.modelValue,
  set: (value) => emit('update:modelValue', value)
})
</script>
