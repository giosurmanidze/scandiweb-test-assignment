<script setup>
defineProps({
  pageName: String,
  btnContent: String
})
</script>

<template>
  <RouterLink :to="{ name: pageName }" class="relative">
    <span class="absolute top-0 left-0 mt-1 ml-1 h-full w-full rounded bg-black"></span>
    <span
      class="fold-bold relative inline-block h-full w-full rounded border-2 border-black bg-white px-5 sm:py-1 md:py-2 text-base font-bold text-black transition duration-100 hover:bg-scandiweb_red hover:text-gray-900"
      >{{ btnContent }}</span
    >
  </RouterLink>
</template>
