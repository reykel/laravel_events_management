<script setup>
import AppLayout from "@/Layouts/Layout.vue";
import { ref } from "vue";
import {  Link } from "@inertiajs/inertia-vue3";

const props = defineProps({
  executive: Object,
    errors: Object,
});
</script>

<template>
  <AppLayout title="Executive Edit">
    <template #header />
    <div class="py-4 bg-white">
      <div class="mx-auto sm:px-28 lg:px-36">
        <div class="bg-white overflow-hidden sm:rounded-lg text-justify">
          <el-alert
            :title="message?.text"
            type="success"
            v-if="message?.text"
          />
          <el-container>
            <el-main
              class="py-12 with-bg"
              style="background-image: url('img/fondo.png'); overflow-x: hidden"
            >
              <el-row :gutter="80">
                <el-col :span="12">
                  <el-form-item>
                    <span class="intro-text"> Assistant's details </span>
                  </el-form-item>
                </el-col>
              </el-row>
              <el-row id="exc-details">
                  <el-col :span="8">
                      <p class="text-lg"><b>Name:</b>  <span class="green-label">{{ executive.data.name }}</span></p>
                      <p class="text-lg"><b>Last name:</b> <span class="green-label">{{ executive.data.last_name }}</span></p>
                      <p class="text-lg"><b>Email:</b>  <span class="green-label">{{ executive.data.email }}</span></p>
                      <p class="text-lg"><b>Company:</b>  <span class="green-label">{{ executive.data.company }}</span></p>
                      <p class="text-lg"><b>Nationality:</b> <span class="green-label">{{ executive.data.nationality }}</span></p>
                      <p class="text-lg"><b>Passport:</b> <span class="green-label">{{ executive.data.passport }}</span></p>
                      <p class="text-lg"><b>Phone:</b>  <span class="green-label">+{{ executive.data.phone_code }} {{ executive.data.phone }}</span></p>
                      <p class="text-lg"><b>Mobile:</b> <span class="green-label">+{{ executive.data.mobile_code }} {{ executive.data.mobile }}</span></p>
                      <p class="text-lg"><b>Allergies:</b>  <span class="green-label">{{ executive.data.allergies }}</span></p>
                      <p class="text-lg"><b>Special needs:</b> <span class="green-label">{{ executive.data.special_needs }}</span></p>
                      <p class="text-lg"><b>Assist to the social program:</b> <span class="green-label"><span v-if="executive.data.assist">Yes</span><span v-else>No</span></span></p>
                  </el-col>
                  <el-col :span="8">
                     <p class="text-lg"><b class="border-b border-b-green-900">Arrival</b></p>
                      <p><b>Type:</b>  <span class="green-label">{{ executive.data.arrival_type }}</span></p>
                      <div v-if="executive.data.arrival_type === 'Airplane'">
                          <p><b>Airport:</b>  <span class="green-label">{{ executive.data.arrival_airport }}</span></p>
                          <p><b>Terminal:</b>  <span class="green-label">{{ executive.data.arrival_terminal }}</span></p>
                          <p><b>Airline:</b>  <span class="green-label">{{ executive.data.arrival_airline }}</span></p>
                          <p><b>Flight number:</b>  <span class="green-label">{{ executive.data.arrival_flight_number }}</span></p>
                      </div>
                      <div v-if="executive.data.arrival_type === 'Train'">
                          <p><b>Station:</b>  <span class="green-label">{{ executive.data.arrival_station }}</span></p>
                          <p><b>Train number:</b>  <span class="green-label">{{ executive.data.arrival_train_number }}</span></p>
                      </div>
                      <div class="pl-3">
                          <p><b>Date:</b> <span class="green-label">{{ executive.data.arrival_date }}</span></p>
                          <p><b>Hotel:</b>  <span class="green-label">{{ executive.data.arrival_hotel }}</span></p>
                          <p><b>Address:</b> <span class="green-label">{{ executive.data.arrival_address }}</span></p>
                          <p><b>Transfer:</b> <span class="green-label"><span v-if="executive.data.arrival_transfer">Yes</span><span v-else>No</span></span></p>

                      </div>
                  </el-col>
                  <el-col :span="8">
                      <p class="text-lg"><b>Departure</b></p>
                      <p><b>Type:</b>  <span class="green-label">{{ executive.data.departure_type }}</span></p>
                      <div v-if="executive.data.departure_type === 'Airplane'">
                          <p><b>Airport:</b>  <span class="green-label">{{ executive.data.departure_airport }}</span></p>
                          <p><b>Terminal:</b>  <span class="green-label">{{ executive.data.departure_terminal }}</span></p>
                          <p><b>Airline:</b>  <span class="green-label">{{ executive.data.departure_airline }}</span></p>
                          <p><b>Flight number:</b>  <span class="green-label">{{ executive.data.departure_flight_number }}</span></p>
                      </div>
                      <div v-if="executive.data.departure_type === 'Train'">
                          <p><b>Station:</b>  <span class="green-label">{{ executive.data.departure_station }}</span></p>
                          <p><b>Train number:</b>  <span class="green-label">{{ executive.data.departure_train_number }}</span></p>
                      </div>
                      <div class="pl-3">
                          <p><b>Date:</b> <span class="green-label">{{ executive.data.departure_date }}</span></p>
                          <p><b>Hotel:</b>  <span class="green-label">{{ executive.data.departure_hotel }}</span></p>
                          <p><b>Address:</b> <span class="green-label">{{ executive.data.departure_address }}</span></p>
                          <p><b>Transfer:</b> <span class="green-label"><span v-if="executive.data.departure_transfer">Yes</span><span v-else>No</span></span></p>

                      </div>
                  </el-col>
              </el-row>
            </el-main>
          </el-container>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<style scoped>
.activity-text-gray,
.activity-text-gray span {
  color: #9dafbd !important;
}
.activity-text-gray span.el-checkbox__label {
  margin-left: 10px;
}
.activity-border-gray {
  border-color: #9dafbd !important;
}

.green-label {
  font-weight: bold !important;
  color: #5c881a !important;
}

.activity-border-gray .el-form-item__content {
  max-width: 100% !important;
}
#exc-details p {
  line-height: 2.5em !important;
  margin-right: 25px;
  margin-bottom: 15px;
}
</style>
