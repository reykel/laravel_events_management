<script setup>
import AppLayout from "@/Layouts/Layout.vue";
import { Inertia } from "@inertiajs/inertia";
import { Link } from "@inertiajs/inertia-vue3";
import { ref } from "vue";

const props = defineProps({
  message: Object,
  errors: Object,
  task: {
    id: Number,
    date: String,
    hour: String,
    name: String,
    user: String,
    executive: String,
    address: String,
    mobile: String,
    comment: String,
  },
});
</script>

<template>
  <AppLayout title="Assign Task">
    <template #header />
    <div class="py-12 back-container">
      <div class="py-4">
        <div class="mx-auto sm:px-28 lg:px-36">
          <div class="overflow-hidden sm:rounded-lg text-justify">
            <el-container>
              <el-main class="overflow-x-hidden">
                <el-form>
                  <el-row :gutter="80">
                    <el-col :span="12">
                      <el-form-item>
                        <span class="intro-text">
                          {{ props?.task?.data.name }}
                        </span>
                      </el-form-item>
                    </el-col>
                  </el-row>
                  <el-row :gutter="80">
                    <el-col :span="12">
                      <el-form-item
                        :error="errors.user_id"
                        class="green-label task-field"
                        label="Driver:"
                      >
                        <span class="task-text-gray">{{
                          props?.task?.data.user.name
                        }}</span>
                      </el-form-item>

                      <el-form-item
                        :error="errors.date"
                        class="green-label task-field"
                        label="Date:"
                      >
                        <span class="task-text-gray">{{
                          props?.task?.data.date
                        }}</span>
                      </el-form-item>
                      <el-form-item
                        :error="errors.hour"
                        class="green-label task-field"
                        label="Hour:"
                      >
                        <span class="task-text-gray">{{
                          props?.task?.data.hour
                        }}</span>
                      </el-form-item>

                      <el-form-item
                        :error="errors.name"
                        class="green-label task-field"
                        label="Task name:"
                      >
                        <span class="task-text-gray">{{
                          props?.task?.data.name
                        }}</span>
                      </el-form-item>
                      <el-form-item
                        :error="errors.executive"
                        class="green-label task-field"
                        label="Name:"
                      >
                        <span class="task-text-gray">{{
                          props?.task?.data.executive.name
                        }}</span>
                      </el-form-item>
                      <el-form-item
                        :error="errors.address"
                        class="green-label task-field"
                        label="Address:"
                      >
                        <span class="task-text-gray">{{
                          props?.task?.data.address
                        }}</span>
                      </el-form-item>

                      <el-form-item
                        :error="errors.mobile"
                        :class="
                          props.edit === true
                            ? 'green-label aligned-item'
                            : 'green-label'
                        "
                        label="Mobile:"
                        v-if="props.edit === true"
                      >
                        <span class="task-text-gray">{{
                          props?.task?.data.mobile
                        }}</span>
                      </el-form-item>

                      <el-form-item
                        :error="errors.comment"
                        class="
                          green-label
                          comment-input comment-input-task
                          task-field
                        "
                        label="Comment:"
                      >
                        <span class="task-text-gray">{{
                          props?.task?.data.comment
                        }}</span>
                      </el-form-item>
                      <el-form-item class="green-label my-5 activity-field">
                        <Link :href="route('task.index')">
                          <el-button round type="success">Back</el-button>
                        </Link>
                      </el-form-item>
                    </el-col>
                  </el-row>
                </el-form>
              </el-main>
            </el-container>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<style>
.task-field div:nth-child(1) {
  display: flex;
  align-items: center !important;
}
.button-holder .el-form-item__content {
  justify-content: end;
  margin-top: 28px;
}
.full-date-width {
  width: 100% !important;
  height: unset !important;
}
.green-label {
  margin-bottom: 2px;
}
.green-label label,
.el-form-item__label {
  font-weight: bold !important;
  color: #5c881a !important;
}
.aligned-item div:nth-child(1) {
  align-items: center;
}
.task-text-gray {
  color: #9dafbd;
}
.green-label div:nth-child(2) span {
  margin-top: 0px;
}

input:-webkit-autofill,
input:-webkit-autofill:hover,
input:-webkit-autofill:focus,
textarea:-webkit-autofill,
textarea:-webkit-autofill:hover,
textarea:-webkit-autofill:focus,
select:-webkit-autofill,
select:-webkit-autofill:hover,
select:-webkit-autofill:focus {
  -webkit-box-shadow: 0 0 0px 1000px #fff inset !important;
}
input:focus,
textarea:focus,
select:focus {
  --tw-ring-color: transparent !important;
}
.task-field {
  margin-bottom: 25px !important;
}
</style>
