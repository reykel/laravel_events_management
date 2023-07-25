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
  activity: {
    id: Number,
    date: String,
    hour: String,
    name: String,
    user: Object,
    executives: [],
    address: String,
    mobile: String,
    comment: String,
  },
});

const form = ref(
  props?.activity?.data || {
  date: null,
  hour: null,
  name: null,
  user: null,
  executives: [],
  address: null,
  comment: null,
});

const onSubmit = () => {
  if(form.value.user.id){
    form.value.user = form.value.user.id
  }
  if (props.edit)
    return Inertia.put(
      `/activity/${props?.activity?.data.id}/driver-update`,
      form.value
    );
  else if (props?.activity?.data.id != null)
    return Inertia.put(`/activity/${props?.activity?.data.id}`, form.value);
  else return Inertia.post("/activity", form.value);
};
const onCheckboxChange = (value, id) => {
  if (value) form.executives.push(id);
};
</script>

<template>
  <AppLayout title="Assign activity">
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
                            ? props?.activity?.data.name
                            : "Assign Activity"
                        }}
                      </span>
                    </el-form-item>
                  </el-col>
                </el-row>
                <el-row :gutter="20">
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
                        v-model="form.user"
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
                        class="activity-text-gray"
                        v-if="props.edit === true"
                        >{{ props?.activity?.data.user }}</span
                      >
                    </el-form-item>

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
                        >{{ props?.activity?.data.date }}</span
                      >
                    </el-form-item>
                    <el-form-item
                      :error="errors.hour"
                      :class="
                        props.edit === true
                          ? 'green-label aligned-item task-field full-date-width'
                          : 'green-label task-field full-date-width'
                      "
                      label="Hour:"
                    >
                      <el-time-picker
                        v-model="form.hour"
                        format="HH:mm"
                        value-format="HH:mm"
                        class="full-date-width"
                        v-if="props.edit === false"
                      />
                      <span
                        class="activity-text-gray"
                        v-if="props.edit === true"
                        >{{ props?.activity?.data.hour }}</span
                      >
                    </el-form-item>

                    <el-form-item
                      :error="errors.name"
                      :class="
                        props.edit === true
                          ? 'green-label aligned-item task-field full-date-width'
                          : 'green-label task-field full-date-width'
                      "
                      label="Activity:"
                    >
                      <el-input
                        v-model="form.name"
                        v-if="props.edit === false"
                      />
                      <span
                        class="activity-text-gray"
                        v-if="props.edit === true"
                        >{{ props?.activity?.data.name }}</span
                      >
                    </el-form-item>
                    <el-form-item
                      :error="errors.address"
                      :class="
                        props.edit === true
                          ? 'green-label aligned-item task-field full-date-width'
                          : 'green-label task-field full-date-width'
                      "
                      label="Address:"
                    >
                      <el-input
                        v-model="form.address"
                        v-if="props.edit === false"
                      />
                      <span
                        class="activity-text-gray"
                        v-if="props.edit === true"
                        >{{ props?.activity?.data.address }}</span
                      >
                    </el-form-item>
                  <!--  <el-form-item
                      class="green-label my-5 task-field"
                      label="Assistant"
                      v-if="props.edit === true"
                    />
                    <el-form-item
                      :error="errors.executives"
                      class="green-label w-full list-holder task-field"
                      v-if="props.edit === true"
                    >
                      <div class="flex flex-col w-full">
                        <el-checkbox-group v-model="form.executives">
                          <el-checkbox
                            class="
                              border-0 border-solid border-b-2
                              w-full
                              h-20
                              activity-text-gray activity-border-gray
                            "
                            v-for="item in props.executives"
                            :key="item.id"
                            :label="item.name"
                          >
                            {{ item.name }}
                          </el-checkbox>
                        </el-checkbox-group>
                      </div>
                    </el-form-item>-->
                    <el-form-item
                      :error="errors.comment"
                      class="green-label mt-9 comment-input task-field"
                      label="Comment:"
                      position="top"
                      v-if="props.edit === true"
                    >
                      <el-input
                        v-model="form.comment"
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
