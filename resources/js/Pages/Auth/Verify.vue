<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import JetValidationErrors from "@/Jetstream/ValidationErrors.vue";
import AppLayout from "@/Layouts/Layout.vue";
defineProps({
  errors: Object,
});

const form = useForm({
  code: ""
});

const submit = () => {
  form
    .post(route("check_code"), {
      onFinish: () => form.reset("code"),
    });
};
</script>

<template>
  <AppLayout title="Verify code">
    <template #header />
    <div class="py-12 bg-white">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden sm:rounded-lg">
          <el-alert
            :title="$page.props.flash.message.text"
            :type="$page.props.flash.message.type"
            v-if="$page.props.flash.message"
          />

          <JetValidationErrors class="mb-4" />

          <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
          </div>
          <div class="pt-2 pb-2 mb-4">
            <span class="intro-text  px-10 px:sm-0">Verify Code</span>
            <p class="text-gray-600 mb-4 mt-4 px-10 px:sm-0">Write here the verification code we have sent to your e-mail</p>
          </div>

          <div class="grid lg:grid-cols-3 gap-4 px-10 px:sm-0">
            <form @submit.prevent="submit">
              <div>
                <el-form-item label="Code" :error="errors.code">
                  <el-input
                    v-model="form.code"
                    type="text"
                    autofocus
                    required
                  ></el-input>
                </el-form-item>
              </div>
              <div class="flex items-center justify-s mt-10 pt-6">
                <el-button
                  type="success"
                  round
                  :disabled="form.processing"
                  @click.prevent="submit()"
                  class="send-button"
                >Confirm</el-button
                >
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<style>
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
</style>
