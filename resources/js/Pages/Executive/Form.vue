<script setup>
import AppLayout from "@/Layouts/Layout.vue";
import ExecutiveForm from "@/Forms/ExecutiveForm.vue";
import { ref } from "vue";

const props = defineProps({
  errors: Object,
  message: Object,
});

const formModel = ref({
  captcha_token: "",
  name: null,
  last_name: null,
  email: null,
  passport: null,
  nationality: null,

  phone: null,
  phone_code: null,
  mobile: null,
  mobile_code: null,
  allergies: null,
  special_needs: null,
  company: null,
  assist: null,

  arrival_type: null,
  arrival_airport: null,
  arrival_terminal: null,
  arrival_airline: null,
  arrival_flight_number: null,
  arrival_station: null,
  arrival_train_number: null,
  arrival_other_location: null,

  arrival_date: null,
  arrival_hotel: null,
  arrival_address: null,
  arrival_transfer: null,

  departure_type: null,
  departure_airport: null,
  departure_terminal: null,
  departure_airline: null,
  departure_flight_number: null,
  departure_station: null,
  departure_train_number: null,
  departure_other_location: null,

  departure_date: null,
  departure_hotel: null,
  departure_address: null,
  departure_transfer: null,

  policy: null,
});
</script>

<template>
  <AppLayout>
    <template #header />
    <div
      class="py-12 bg-white back-container"
      style="background-image: url('img/fondo.png')"
    >
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden sm:rounded-lg">
          <el-alert
            :title="this.$page.props.flash.message.text"
            type="success"
            v-if="this.$page.props.flash.message"
          />
          <executive-form
            :model="formModel"
            :errors="errors"
            url="/executives"
            action="create"
          />
        </div>
      </div>
    </div>
  </AppLayout>
</template>
