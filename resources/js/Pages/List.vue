<script setup>
import AppLayout from "@/Layouts/Layout.vue";
import { ref } from "vue";

const props = defineProps({
  message: Object,
  errors: Object,
  list: {
    id: Number,
    date: String,
    hour: String,
    name: String,
  },
  role: String,
});
</script>

<template>
  <AppLayout>
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
              style="background-image: url('/img/fondo.png'); overflow-x: hidden"
            >
              <el-row :gutter="80">
                <el-col :span="24">
                  <el-form-item>
                    <span class="intro-text">
                      {{
                        props.role === "Driver"
                          ? "Your tasks and activities"
                          : "Tasks and activities"
                      }}
                    </span>
                  </el-form-item>
                </el-col>
              </el-row>

              <el-row :gutter="80" class="list-holder">
                <el-col :span="24">
                  <div
                    class="
                      w-full
                      border-0 border-solid border-b-2
                      h-20
                      flex
                      items-center
                      activity-border-gray
                    "
                    v-for="(item, index) in props.list"
                    :key="index"
                  >
                    <div class="flex justify-between items-center w-full">
                      <div class="whitespace-nowrap green-label">
                        {{ item.date }}
                      </div>
                      <div class="activity-text-gray w-full mx-4">
                        {{ item.name }}
                      </div>
                      <a :href="`${item.type}/${item.id}/edit`">
                        <el-button type="success" round class="send-button"
                          >Enter {{ item.type }}</el-button
                        >
                      </a>
                    </div>
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
.list-holder {
  overflow-x: auto;
  height: 500px;
}

.list-holder::-webkit-scrollbar {
  display: none;
}
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
.activity-border-gray div.el-form-item__content {
  max-width: 100% !important;
}

.green-label {
  font-weight: bold !important;
  color: #5c881a !important;
}
</style>
