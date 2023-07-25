<script setup>
import AppLayout from "@/Layouts/Layout.vue";
import { ref } from "vue";
import {  Link } from "@inertiajs/inertia-vue3";
import ExecutiveForm from "../../Forms/ExecutiveForm";

const props = defineProps({
  executive: Object,
    errors: Object,
});

</script>

<template>
  <AppLayout title="Assistant Edit">
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
                    <span class="intro-text"> Assistant edit </span>
                  </el-form-item>
                </el-col>
              </el-row>
                <executive-form
                    :model="executive.data"
                    :errors="errors"
                    :url="`/executives/update/${executive.data.id}`"
                    action="update"
                />
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
</style>
