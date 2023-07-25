<script setup>
import AppLayout from "@/Layouts/Layout.vue";
import { ref } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";

const props = defineProps({
  message: Object,
  errors: Object,
  list: {
    id: Number,
    name: String,
    mobile: String,
  },
});

const remove = (id) => {
  Inertia.post(route("executives_delete", { id: id }));
};
</script>

<template>
  <AppLayout title="Assistant list">
    <template #header />
    <div
      class="py-12 bg-white back-container"
      style="background-image: url('/img/fondo.png')"
    >
      <div class="mx-auto sm:px-28 lg:px-36">
        <div class="overflow-hidden sm:rounded-lg text-justify">
          <el-alert
            :title="$page.props.flash.message?.text"
            :type="$page.props.flash.message?.type"
            v-if="$page.props.flash.message?.text"
          />
          <el-container>
            <el-main class="py-12 overflow-x-hidden">
              <el-row :gutter="80">
                <el-col :span="12">
                  <el-form-item>
                    <span class="intro-text"> Assistant list </span>
                  </el-form-item>
                </el-col>
                <el-col :span="12" class="text-right">
                  <a href="executives/export" target="_blank">
                    <el-button type="success" class="send-button" round
                      >Export to Excel</el-button
                    >
                  </a>
                </el-col>
              </el-row>
              <div class="list-holder">
                <el-row
                  :gutter="80"
                  v-for="item in props.list"
                  :key="item.id"
                  class="
                    w-full
                    border-0 border-solid border-b-2
                    h-15
                    pt-2
                    activity-border-gray
                  "
                >
                  <el-col :span="19">
                    <el-form-item>
                      <div class="flex justify-between items-center w-full">
                        <span class="green-label w-full mx-4 whitespace-nowrap"
                          >{{ item.name }} {{ item.last_name }}
                        </span>
                        <div class="flex justify-between items-center w-full">
                          <span class="green-label whitespace-nowrap"
                            >{{ item.phone }}
                          </span>
                          <span class="green-label mx-4 whitespace-nowrap"
                            >{{ item.nationality }}
                          </span>
                        </div>
                      </div>
                    </el-form-item>
                  </el-col>
                  <el-col :span="5">
                    <div class="flex justify-between">
                      <Link :href="route('executives_show', { id: item.id })">
                        <el-button round type="info">View</el-button>
                      </Link>
                      <Link :href="route('executives_edit', { id: item.id })">
                        <el-button round type="success">Edit</el-button>
                      </Link>
                      <el-popconfirm
                        title="Are you sure to delete this assistant?"
                        @confirm="remove(item.id)"
                      >
                        <template #reference>
                          <el-button size="mini" type="danger" round
                            >Delete</el-button
                          >
                        </template>
                      </el-popconfirm>
                      <!--  <el-button round type="danger" @click="remove(item.id)">Delete</el-button>-->
                    </div>
                  </el-col>
                </el-row>
              </div>
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

.green-label {
  font-weight: bold !important;
  color: #5c881a !important;
}

.activity-border-gray .el-form-item__content {
  max-width: 100% !important;
}
</style>
