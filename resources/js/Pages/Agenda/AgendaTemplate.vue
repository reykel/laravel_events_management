<script setup>
import AppLayout from "@/Layouts/Layout.vue";
import { Inertia } from "@inertiajs/inertia";
import { Link } from "@inertiajs/inertia-vue3";
import { ref } from "vue";

const props = defineProps({
  message: Object,
  errors: Object,
  title: String,
  url: String,
  list: {
    id: Number,
    date: String,
    hour: String,
    name: String,
  },
});

const onSubmit = () => {
  return Inertia.get(`/agenda/create`);
};

const remove = (id) => {
  return Inertia.post(`/agenda/remove/${id}`);
};
</script>

<template>
  <AppLayout :title="title + ' list'">
    <template #header />
    <div class="">
      <div
        class="py-12 back-container"
        style="background-image: url('/img/fondo.png')"
      >
        <div class="mx-auto sm:px-28 lg:px-36">
          <div class="overflow-hidden sm:rounded-lg text-justify">
            <el-alert
              :title="message?.text"
              type="success"
              v-if="message?.text"
            />
            <el-container>
              <el-main class="py-12 with-bg" style="overflow-x: hidden">
                <el-row :gutter="80">
                  <el-col :span="12">
                    <el-form-item>
                      <span class="intro-text"> {{ title }} list </span>
                    </el-form-item>
                  </el-col>
                  <el-col :span="12" class="text-right">
                    <a
                      :href="
                        'agendas/export'
                      "
                      target="_blank"
                    >
                      <el-button type="success" class="send-button" round
                        >Export to Excel</el-button
                      >
                    </a>
                  </el-col>
                </el-row>
                <div class="list-holder">
                  <el-row
                    :gutter="80"
                    class="
                      w-full
                      border-0 border-solid border-b-2
                      h-20
                      pt-2
                      flex
                      items-center
                      activity-border-gray
                    "
                    v-for="(item, index) in props.list"
                    :key="index"
                  >
                    <el-col :span="19">
                      <div class="flex justify-between items-center w-full">
                        <div class="green-label w-full mx-4 whitespace-nowrap">
                          {{ item.date }}
                        </div>
                        <div class="green-label w-full mx-4 whitespace-nowrap">
                          {{ item.hour_start }}
                        </div>
                        <div class="green-label w-full mx-4 whitespace-nowrap">
                          {{ item.hour_end }}
                        </div>
                        <div class="flex justify-between items-center w-full">
                          <div class="green-label mx-4 whitespace-nowrap">
                            {{ item.name }}
                          </div>
                        </div>
                      </div>
                    </el-col>
                    <el-col :span="5">
                      <div class="flex justify-between">
                        <Link
                          :href="
                            route(
                              'agenda_show',
                              { id: item.id }
                            )
                          "
                        >
                          <el-button round type="info">View</el-button>
                        </Link>
                        <Link
                          :href="
                            route(
                              'agenda_edit',
                              { id: item.id }
                            )
                          "
                        >
                          <el-button round type="success">Edit</el-button>
                        </Link>
                        <el-popconfirm
                          title="Are you sure you want to delete this?"
                          @confirm="remove(item.id)"
                        >
                          <template #reference>
                            <el-button size="mini" type="danger" round
                              >Delete</el-button
                            >
                          </template>
                        </el-popconfirm>
                      </div>
                    </el-col>
                  </el-row>
                </div>
                <el-row :gutter="80" class="mt-5">
                  <el-col :span="12">
                    <el-form-item>
                      <el-button
                        type="success"
                        round
                        @click.prevent="onSubmit()"
                        class="send-button"
                        >Create</el-button
                      >
                    </el-form-item>
                  </el-col>
                </el-row>
              </el-main>
            </el-container>
          </div>
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

.green-label {
  font-weight: bold !important;
  color: #5c881a !important;
}

.activity-border-gray .el-form-item__content {
  max-width: 100% !important;
}
</style>
