<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import JetValidationErrors from "@/Jetstream/ValidationErrors.vue";
import AppLayout from "@/Layouts/Layout.vue";
import { ref } from "vue";

const form = useForm({
  name: "",
  email: "",
  password: "",
  user: "",
  password_confirmation: "",
  terms: false,
  phone: "",
});
const formValidation = ref({
  name: false,
  email: false,
  password: false,
  user: false,
  password_confirmation: false,
});

const props = defineProps({
  canResetPassword: Boolean,
  status: String,
  errors: Object,
});

const submit = () => {
  form.post(route("register"), {
    onFinish: () => form.reset("password", "password_confirmation"),
  });
};
const validateName = () => {
  const result = form.name !== "";
  formValidation.value.name = result;
  props.errors.name = result ? false : "The name can't be empty.";
};
const validateEmail = () => {
  const result = form.email !== "";
  formValidation.value.email = result;
  props.errors.email = result ? false : "The email can't be empty.";
};
const validatePhone = () => {
  const result = form.phone !== "";
  formValidation.value.phone = result;
  props.errors.phone = result ? false : "The phone can't be empty.";
};
const validatePassword = () => {
  const result = !!form.password.match(
    /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d#`¿?¡!@$%^&*\(\)/\-+_.=,;'":]{8,}$/
  );
  formValidation.value.password = result;
  props.errors.password = result
    ? false
    : "Needs at least an uppercase letter, a number and 8 characters.";
};
const validateConfirmPassword = () => {
  const result = form.password === form.password_confirmation;
  formValidation.value.password_confirmation = result;
  props.errors.password_confirmation = result
    ? false
    : "The passwords don't match.";
};
</script>

<template>
  <AppLayout>
    <template #header />
    <div class="py-12 bg-white">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden sm:rounded-lg">
          <el-alert
            :title="this.$page.props.flash.message.text"
            type="success"
            v-if="this.$page.props.flash.message"
          />
          <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
          </div>
          <el-form-item>
            <span class="intro-text px-10 px:sm-0">Register</span>
          </el-form-item>
          <div class="grid lg:grid-cols-3 gap-4 px-10 px:sm-0">
            <form @submit.prevent="submit">
              <div>
                <!--
                <el-form-item label="Name" :error="errors.name">
                  <el-input
                    v-model="form.name"
                    type="text"
                    autofocus
                    required
                    @blur="validateName"
                  ></el-input>
                </el-form-item>
                -->
              </div>
              <div class="mt-4">
                <el-form-item label="Email" :error="errors.email">
                  <el-input
                    v-model="form.email"
                    type="email"
                    @blur="validateEmail"
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
                    @blur="validatePassword"
                  ></el-input>
                </el-form-item>
              </div>
              <div class="mt-4">
                <el-form-item
                  label="Confirm Password"
                  :error="errors.password_confirmation"
                >
                  <el-input
                    v-model="form.password_confirmation"
                    @blur="validateConfirmPassword"
                    type="password"
                    required
                  ></el-input>
                </el-form-item>
              </div>
              <div class="mt-4">
                <el-form-item label="Phone" :error="errors.phone">
                  <el-input
                    v-model="form.phone"
                    type="phone"
                    @blur="validatePhone"
                    required
                  ></el-input>
                </el-form-item>
              </div>
              <!--
              <el-form-item label="User" :error="errors.user">
                <el-select v-model="form.user" class="w-full">
                  <el-option label="Driver" value="Driver"></el-option>
                </el-select>
              </el-form-item>
              -->
              <!-- <div class="block mt-4">
                                 <label class="flex items-center">
                                     <JetCheckbox v-model:checked="form.remember" name="remember" />
                                     <span class="ml-2 text-sm text-gray-600">Remember me</span>
                                 </label>
                             </div>-->

              <div class="flex items-center justify-s mt-10 pt-6">
                <!--   <Link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900">
                                       Forgot your password?
                                   </Link>-->
                <el-button
                  type="success"
                  round
                  :disabled="
                    form.processing ||
                    //!formValidation.name ||
                    !formValidation.email ||
                    !formValidation.password ||
                    !formValidation.phone ||
                    !formValidation.password_confirmation
                  "
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
