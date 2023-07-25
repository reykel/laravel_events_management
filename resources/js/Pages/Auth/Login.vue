<script setup>
import { Link, useForm } from "@inertiajs/inertia-vue3";
import JetValidationErrors from "@/Jetstream/ValidationErrors.vue";
import AppLayout from "@/Layouts/Layout.vue";
defineProps({
  canResetPassword: Boolean,
  status: String,
  errors: Object,
});

const form = useForm({
  email: "",
  password: "",
  remember: true,
});

const submit = () => {
  form
    .transform((data) => ({
      ...data,
      remember: form.remember ? "on" : "",
    }))
    .post(route("login"), {
      onFinish: () => form.reset("password"),
    });
};
</script>

<template>
  <AppLayout title="Login">
    <template #header />
    <div class="py-12 bg-white">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden sm:rounded-lg">
          <el-alert
            :title="this.$page.props.flash.message.text"
            type="success"
            v-if="this.$page.props.flash.message"
          />

          <JetValidationErrors class="mb-4" />

          <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
          </div>
          <el-form-item>
            <span class="intro-text px-10 px:sm-0">Login</span>
          </el-form-item>
          <div class="grid lg:grid-cols-3 gap-4 px-10 px:sm-0">
            <form @submit.prevent="submit">
              <div>
                <el-form-item label="Email" :error="errors.email">
                  <el-input
                    v-model="form.email"
                    type="email"
                    autofocus
                    required
                  ></el-input>
                </el-form-item>
              </div>
              <div class="mt-4">
                <el-form-item label="Password" :error="errors.password">
                  <el-input
                    v-model="form.password"
                    type="password"
                    required
                    autocomplete="current-password"
                  ></el-input>
                </el-form-item>
              </div>
              <!-- <div class="block mt-4">
                                <label class="flex items-center">
                                    <JetCheckbox v-model:checked="form.remember" name="remember" />
                                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                                </label>
                            </div>-->

              <div class="flex items-center justify-between mt-10 pt-6">
               <Link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900">
                     Forgot your password?
               </Link>
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
