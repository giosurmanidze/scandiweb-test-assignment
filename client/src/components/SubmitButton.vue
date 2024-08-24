<script setup>
defineProps({
  btnContent: {
    type: String
  }
})
</script>

<template>
  <button type="submit" class="relative">
    <span class="absolute top-0 left-0 mt-1 ml-1 h-full w-full rounded bg-gray-700"></span>
    <span
      class="fold-bold relative inline-block h-full w-full rounded border-2 border-black bg-black px-3 py-1 text-base font-bold text-white transition duration-100 hover:bg-gray-900 hover:text-scandiweb_red"
      >{{ btnContent }}</span
    >
  </button>
</template>
