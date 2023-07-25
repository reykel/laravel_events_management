<script setup>
import AppLayout from "@/Layouts/Layout.vue";
import { Inertia } from "@inertiajs/inertia";
import { ref } from "vue";

const props = defineProps({
  message: Object,
  errors: Object,
  edit: Boolean,
  executives: Object,
  users: Object,
  task: {
    id: Number,
    date: String,
    hour: String,
    name: String,
    user: Object,
    executive: Object,
    address: String,
    mobile: String,
    comment: String,
  },
});
const formModel = ref(
  props?.task?.data || {
    date: null,
    hour: null,
    name: null,
    user: null,
    executive: null,
    address: null,
    comment: null,
  }
);

const onSubmit = () => {
  if(formModel.value.executive.id){
    formModel.value.executive = formModel.value.executive.id
  }
  if(formModel.value.user.id){
    formModel.value.user = formModel.value.user.id
  }
  if (props.edit)
    return Inertia.put(
      `/task/${props?.task?.data.id}/driver-update`,
      formModel.value
    );
  else if (props?.task?.data.id != null) {
    return Inertia.put(`/task/${props?.task?.data.id}`, formModel.value);
  } else return Inertia.post("/task", formModel.value);
};
</script>

<template>
  <AppLayout title="Assign Task">
    <template #header />
    <div
      class="py-12 back-container"
      style="background-image: url('/img/fondo.png')"
    >
      <div class="py-4">
        <div class="mx-auto sm:px-28 lg:px-36">
          <div class="overflow-hidden sm:rounded-lg text-justify">
            <el-alert
              :title="this.$page.props.flash.message.text"
              type="success"
              v-if="this.$page.props.flash.message"
            />
            <el-container>
              <el-main class="overflow-x-hidden">
                <el-form>
                  <el-row :gutter="80">
                    <el-col :span="12">
                      <el-form-item>
                        <span class="intro-text">
                          {{
                            props.edit === true
                              ? props?.task?.data.name
                              : "Assign Task"
                          }}
                        </span>
                      </el-form-item>
                    </el-col>
                  </el-row>
                  <el-row :gutter="80">
                    <el-col :span="12">
                      <el-form-item
                        :error="errors.user"
                        :class="
                          props.edit === true
                            ? 'green-label aligned-item task-field full-date-width'
                            : 'green-label task-field full-date-width'
                        "
                        label="Driver:"
                      >
                        <el-select
                          v-model="formModel.user"
                          placeholder=" "
                          class="full-date-width"
                          v-if="props.edit === false"
                        >
                          <template v-for="item in props.users" :key="item.id">
                            <el-option
                              v-if="item.role === 'Driver'"
                              :label="item.name"
                              :value="item.id"
                            />
                          </template>
                        </el-select>
                        <span
                          class="task-text-gray"
                          v-if="props.edit === true"
                          >{{ props?.task?.data.user }}</span
                        >
                      </el-form-item>

                      <el-form-item
                        :error="errors.date"
                        :class="
                          props.edit === true
                            ? 'green-label aligned-item task-field'
                            : 'green-label task-field'
                        "
                        label="Date:"
                      >
                        <el-date-picker
                          v-model="formModel.date"
                          type="date"
                          format="YYYY/MM/DD"
                          value-format="YYYY-MM-DD"
                          class="full-date-width"
                          v-if="props.edit === false"
                        />
                        <span
                          class="task-text-gray"
                          v-if="props.edit === true"
                          >{{ props?.task?.data.date }}</span
                        >
                      </el-form-item>
                      <el-form-item
                        :error="errors.hour"
                        :class="
                          props.edit === true
                            ? 'green-label aligned-item task-field'
                            : 'green-label task-field'
                        "
                        label="Hour:"
                      >
                        <el-time-picker
                          v-model="formModel.hour"
                          format="HH:mm"
                          value-format="HH:mm"
                          class="full-date-width"
                          v-if="props.edit === false"
                        />
                        <span
                          class="task-text-gray"
                          v-if="props.edit === true"
                          >{{ props?.task?.data.hour }}</span
                        >
                      </el-form-item>

                      <el-form-item
                        :error="errors.name"
                        :class="
                          props.edit === true
                            ? 'green-label aligned-item task-field full-date-width'
                            : 'green-label task-field full-date-width'
                        "
                        label="Task name:"
                      >
                        <el-input
                          v-model="formModel.name"
                          v-if="props.edit === false"
                        />
                        <span
                          class="task-text-gray"
                          v-if="props.edit === true"
                          >{{ props?.task?.data.name }}</span
                        >
                      </el-form-item>
                      <el-form-item
                        :error="errors.executive"
                        :class="
                          props.edit === true
                            ? 'green-label aligned-item task-field'
                            : 'green-label task-field'
                        "
                        label="Name:"
                        v-if="props.edit === false"
                      >
                        <el-select
                          v-model="formModel.executive"
                          placeholder=" "
                          class="full-date-width"
                          style="width: 240px"
                        >
                          <el-option
                            v-for="item in props.executives"
                            :key="item.id"
                            :label="item.name"
                            :value="item.id"
                          />
                        </el-select>
                        <span
                          class="task-text-gray"
                          v-if="props.edit === true"
                          >{{ props?.task?.data.executive }}</span
                        >
                      </el-form-item>
                      <el-form-item
                        :error="errors.address"
                        :class="
                          props.edit === true
                            ? 'green-label aligned-item task-field'
                            : 'green-label task-field'
                        "
                        label="Address:"
                      >
                        <el-input
                          v-model="formModel.address"
                          v-if="props.edit === false"
                        />
                        <span
                          class="task-text-gray"
                          v-if="props.edit === true"
                          >{{ props?.task?.data.address }}</span
                        >
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
                        class="green-label comment-input comment-input-task"
                        label="Comment:"
                        v-if="props.edit === true"
                      >
                        <el-input
                          v-model="formModel.comment"
                          type="textarea"
                          :rows="4"
                        />
                      </el-form-item>

                      <el-form-item class="flex button-holder">
                        <el-button
                          type="success"
                          round
                          @click.prevent="onSubmit()"
                          class="send-button"
                          >Save</el-button
                        >
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
.button-holder .el-form-item__content {
  justify-content: end;
  margin-top: 28px;
}
.full-date-width {
  width: 100% !important;
  height: unset !important;
}
div.el-form-item__label {
  margin-right: 25px;
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
.comment-input label,
.green-label div:nth-child(2) span {
  margin-top: 0px;
}

.comment-input-task textarea {
  margin-top: 5px;
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
