<script setup>
import { RouterView } from 'vue-router'
import Footer from './Footer.vue'
</script>

<template>
  <div class="h-screen border-y-green-700 flex flex-col justify-between items-center">
    <RouterView />
    <Footer />
  </div>
</template>
