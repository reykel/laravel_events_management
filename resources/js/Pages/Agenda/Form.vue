<script setup>
import AppLayout from "@/Layouts/Layout.vue";
import { Inertia } from "@inertiajs/inertia";
import { ref } from "vue";

const props = defineProps({
  message: Object,
  errors: Object,
  edit: Boolean,
  executives: [],
  users: [],
  agenda: {
    id: Number,
    date: String,
    hour: String,
    name: String
  },
});

const form = ref(
  props?.agenda?.data || {
  date: null,
  hour: null,
  name: null
});

const onSubmit = () => {
  if (props.edit)
    return Inertia.put(
      `/agenda/${props?.agenda?.data.id}/agenda-update`,
      form.value
    );
  else if (props?.agenda?.data.id != null)
    return Inertia.put(`/agenda/${props?.agenda?.data.id}/agenda-update`, form.value);
  else return Inertia.post("/agenda/store", form.value);
};
const onCheckboxChange = (value, id) => {
  if (value) form.executives.push(id);
};
</script>

<template>
  <AppLayout title="Assign agenda">
    <template #header />
    <div
      class="py-4 bg-white back-container"
      style="background-image: url('/img/fondo.png')"
    >
      <div class="mx-auto sm:px-28 lg:px-36">
        <div class="overflow-hidden sm:rounded-lg text-justify">
          <el-alert
            :title="this.$page.props.flash.message.text"
            type="success"
            v-if="this.$page.props.flash.message"
          />
          <el-container>
            <el-main class="py-12 overflow-x-hidden">
              <el-form>
                <el-row :gutter="80">
                  <el-col :span="12">
                    <el-form-item>
                      <span class="intro-text">
                        {{
                          props.edit === true
                            ? props?.agenda?.data.name
                            : "Assign agenda"
                        }}
                      </span>
                    </el-form-item>
                  </el-col>
                </el-row>
                <el-row :gutter="20">
                  <el-col :span="12">
                    <el-form-item
                      :error="errors.date"
                      :class="
                        props.edit === true
                          ? 'green-label aligned-item task-field full-date-width'
                          : 'green-label task-field full-date-width'
                      "
                      label="Date:"
                    >
                      <el-date-picker
                        v-model="form.date"
                        type="date"
                        format="YYYY/MM/DD"
                        value-format="YYYY-MM-DD"
                        class="full-date-width"
                        v-if="props.edit === false"
                      />
                      <span
                        class="activity-text-gray"
                        v-if="props.edit === true"
                        >{{ props?.agenda?.data.date }}</span
                      >
                    </el-form-item>
                    <el-form-item
                      :error="errors.hour_start"
                      :class="
                        props.edit === true
                          ? 'green-label aligned-item task-field full-date-width'
                          : 'green-label task-field full-date-width'
                      "
                      label="Hour starts:"
                    >
                      <el-time-picker
                        v-model="form.hour_start"
                        format="HH:mm"
                        value-format="HH:mm"
                        class="full-date-width"
                        v-if="props.edit === false"
                      />
                      <span
                        class="activity-text-gray"
                        v-if="props.edit === true"
                        >{{ props?.agenda?.data.hour }}</span
                      >
                    </el-form-item>
                    <el-form-item
                      :error="errors.hour_end"
                      :class="
                        props.edit === true
                          ? 'green-label aligned-item task-field full-date-width'
                          : 'green-label task-field full-date-width'
                      "
                      label="Hour ends:"
                    >
                      <el-time-picker
                        v-model="form.hour_end"
                        format="HH:mm"
                        value-format="HH:mm"
                        class="full-date-width"
                        v-if="props.edit === false"
                      />
                      <span
                        class="activity-text-gray"
                        v-if="props.edit === true"
                        >{{ props?.agenda?.data.hour }}</span
                      >
                    </el-form-item>
                    <el-form-item
                      :error="errors.name"
                      :class="
                        props.edit === true
                          ? 'green-label aligned-item task-field full-date-width'
                          : 'green-label task-field full-date-width'
                      "
                      label="Agenda:"
                    >
                      <el-input
                        v-model="form.name"
                        v-if="props.edit === false"
                      />

                      <span
                        class="activity-text-gray"
                        v-if="props.edit === true"
                        >{{ props?.agenda?.data.name }}</span
                      >
                    </el-form-item>


                    <el-form-item
                      :error="errors.comments"
                      :class="
                        props.edit === true
                          ? 'green-label aligned-item task-field full-date-width'
                          : 'green-label task-field full-date-width'
                      "
                      label="Comments:"
                    >
                      <el-input
                        v-model="form.comments"
                        v-if="props.edit === false"
                      />

                      <span
                        class="comment-input"
                        v-if="props.edit === true"
                        >{{ props?.agenda?.data.comments }}</span
                      >
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
  </AppLayout>
</template>

<style>
.list-holder {
  overflow-x: auto;
  height: 500px;
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
div.el-form-item__label {
  margin-right: 25px;
}
.green-label {
  margin-bottom: 2px;
}
.green-label label,
.el-form-item__label,
span.green-label {
  font-weight: bold !important;
  color: #5c881a !important;
}
.aligned-item div:nth-child(1) {
  align-items: center;
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
.comment-input label,
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
input:focus,
textarea:focus,
select:focus {
  --tw-ring-color: transparent !important;
}
.task-field {
  margin-bottom: 25px !important;
}
</style>
