<template>
  <div class="w-full sm:px-4 md:px-10 flex flex-col justify-center border-b-[2px] border-scandiweb_red">
    <div class="flex justify-between items-center h-16">
      <h2 class="sm:text-xl md:text-3xl text-scandiweb_red font-heading_font">
        {{ routeName === 'ProductListPage' ? 'Product List' : 'Product Add' }}
      </h2>
      <div class="font-body_text_font">
        <div class="flex justify-center sm:gap-2 md:gap-6" v-if="routeName === 'ProductListPage'">
          <NavButton page-name="AddProductPage" btn-content="Add" />
          <SubmitButton btn-content="Mass Delete" @click="handleSubmit" />
        </div>
        <div v-else class="flex justify-center sm:gap-2 md:gap-6">
          <SubmitButton btn-content="Save" @click="handleSubmit" />
          <NavButton page-name="ProductListPage" btn-content="Cancel" />
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useRoute } from 'vue-router'
import { computed, defineProps } from 'vue'
import SubmitButton from '@/components/SubmitButton.vue'
import NavButton from '@/components/NavButton.vue'

const route = useRoute()
const routeName = computed(() => route.name)

const props = defineProps({
  onSubmit: Function
})

const handleSubmit = () => {
  if (props.onSubmit) {
    props.onSubmit()
  }
}
</script>
