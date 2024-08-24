<template>
  <div class="w-full">
    <div class="flex flex-col md:flex-row items-center gap-1 w-full mt-3">
      <label :for="id" class="text-md font-medium text-gray-700 w-full md:w-1/4">
        {{ label }}
      </label>
      <input
        :id="id"
        :type="type"
        :placeholder="placeholder"
        :value="modelValue"
        @input="handleInput"
        class="mt-1 block py-2 px-3 w-full md:w-3/4 border-2 border-black rounded-md"
        :class="error ? 'border-2 border-scandiweb_red' : ''"
      />
    </div>
  </div>
</template>

<script setup>
import { defineProps, defineEmits } from 'vue'

// Define props without TypeScript type annotations
const props = defineProps({
  modelValue: String,
  id: String,
  label: String,
  type: String,
  placeholder: String,
  error: Boolean
})

const emit = defineEmits(['update:modelValue'])

const handleInput = (event) => {
  const target = event.target
  if (target) {
    emit('update:modelValue', target.value)
  }
}
</script>
