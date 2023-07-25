<script setup>
import { ref } from "vue";
import ListTemplate from "@/Pages/Task/ListTemplate.vue";

const props = defineProps({
  message: Object,
  errors: Object,
  list: {
    id: Number,
    date: String,
    hour: String,
    user: String,
    name: String,
  },
});
</script>

<template>
  <list-template
    :list="list"
    :errors="errors"
    :message="message"
    title="Activity"
    url="/activity/"
  />
</template>