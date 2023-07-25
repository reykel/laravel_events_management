<script setup>
import AppLayout from "@/Layouts/Layout.vue";
import { Inertia } from "@inertiajs/inertia";
import { Link } from "@inertiajs/inertia-vue3";
import { ref } from "vue";

const props = defineProps({
  message: Object,
  errors: Object,
  activity: {
    id: Number,
    date: String,
    hour: String,
    name: String,
    user: String,
    executives: String,
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
                          {{ props?.activity?.data.name }}
                        </span>
                      </el-form-item>
                    </el-col>
                  </el-row>
                  <el-row :gutter="80">
                    <el-col :span="12">
                      <el-form-item
                        :error="errors.user_id"
                        class="green-label activity-field"
                        label="Driver:"
                      >
                        <span class="activity-text-gray">{{
                          props?.activity?.data.user.name
                        }}</span>
                      </el-form-item>

                      <el-form-item
                        :error="errors.date"
                        class="green-label activity-field"
                        label="Date:"
                      >
                        <span class="activity-text-gray">{{
                          props?.activity?.data.date
                        }}</span>
                      </el-form-item>
                      <el-form-item
                        :error="errors.hour"
                        class="green-label activity-field"
                        label="Hour:"
                      >
                        <span class="activity-text-gray">{{
                          props?.activity?.data.hour
                        }}</span>
                      </el-form-item>

                      <el-form-item
                        :error="errors.name"
                        class="green-label activity-field"
                        label="Task name:"
                      >
                        <span class="activity-text-gray">{{
                          props?.activity?.data.name
                        }}</span>
                      </el-form-item>

                      <el-form-item
                        :error="errors.address"
                        class="green-label activity-field"
                        label="Address:"
                      >
                        <span class="activity-text-gray">{{
                          props?.activity?.data.address
                        }}</span>
                      </el-form-item>

                      <el-form-item
                        :error="errors.comment"
                        class="
                          green-label
                          comment-input comment-input-activity
                          activity-field
                        "
                        label="Comment:"
                      >
                        <span class="activity-text-gray">{{
                          props?.activity?.data.comment
                        }}</span>
                      </el-form-item>

                   <!--   <el-form-item
                        class="green-label my-5 activity-field"
                        label="Asistance"
                      />
                      <div class="list-holder">
                        <div
                          class="
                            w-full
                            border-0 border-solid border-b-2
                            h-9
                            flex
                            items-center
                            activity-border-gray
                          "
                          v-for="(
                            item, index
                          ) in props?.activity?.data?.executives.split(',')"
                          :key="index"
                        >
                          <div class="activity-text-gray w-full mx-4">
                            {{ item.name }}
                          </div>
                        </div>
                      </div>
                      </el-form-item>-->
                      <el-form-item class="green-label my-5 activity-field">
                        <Link :href="route('activity.index')">
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

<style >
.activity-field div:nth-child(1) {
  display: flex;
  align-items: center !important;
}
.list-holder {
  overflow-x: auto;
  max-height: 500px;
}

.list-holder::-webkit-scrollbar {
  display: none;
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
.activity-text-gray {
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
.activity-field {
  margin-bottom: 25px !important;
}
</style>
