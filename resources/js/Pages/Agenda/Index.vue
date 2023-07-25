<script setup>
import { ref } from "vue";
import ListTemplate from "@/Pages/Agenda/AgendaTemplate.vue";

const props = defineProps({
  message: Object,
  errors: Object,
  list: {
    id: Number,
    date: String,
    hour: String,
    name: String,
  },
});
</script>

<template>
  <list-template
    :list="list"
    :errors="errors"
    :message="message"
    title="Agenda"
    url="/agenda/"
  />
</template>