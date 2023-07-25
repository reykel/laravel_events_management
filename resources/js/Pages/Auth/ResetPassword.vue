<script setup>
import {  useForm } from '@inertiajs/inertia-vue3';
import AppLayout from "@/Layouts/Layout.vue";
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue';

const props = defineProps({
    email: String,
    token: String,
    errors: Object,
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('password.update'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
  <AppLayout title="Change Password">
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
          <div class="pt-2 pb-2 mb-4">
            <span class="intro-text px-10 px:sm-0">Change Password</span>
          </div>
          <div class="grid lg:grid-cols-3 gap-4 px-10 px:sm-0">
            <form @submit.prevent="submit">
              <div>
                <el-form-item label="Email" :error="errors.email">
                <input
                  id="email"
                  v-model="form.email"
                  type="email"
                  required
                  autofocus
                />
                </el-form-item>
              </div>

              <div class="mt-4">
                <el-form-item label="Password" :error="errors.password">
                  <el-input
                    id="password"
                    v-model="form.password"
                    type="password"
                    required
                  />
                </el-form-item>
              </div>

              <div class="mt-4">
                <el-form-item label="Password confirmation" :error="errors.password_confirmation">
                  <el-input
                  id="password_confirmation"
                  v-model="form.password_confirmation"
                  type="password"
                  required
                  autocomplete="new-password"
                />
                </el-form-item>
              </div>

              <div class="flex items-center justify-end mt-4">
                <el-button
                  type="success"
                  round
                  :disabled="form.processing"
                  @click.prevent="submit()"
                  class="send-button"
                >   Change
                </el-button>
            <!--    <JetButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                  Change Password
                </JetButton>-->
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<!--<template>
    <Head title="Reset Password" />

    <JetAuthenticationCard>
        <template #logo>
            <JetAuthenticationCardLogo />
        </template>

        <JetValidationErrors class="mb-4" />

        <form @submit.prevent="submit">
            <div>
                <JetLabel for="email" value="Email" />
                <JetInput
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="mt-1 block w-full"
                    required
                    autofocus
                />
            </div>

            <div class="mt-4">
                <JetLabel for="password" value="Password" />
                <JetInput
                    id="password"
                    v-model="form.password"
                    type="password"
                    class="mt-1 block w-full"
                    required
                    autocomplete="new-password"
                />
            </div>

            <div class="mt-4">
                <JetLabel for="password_confirmation" value="Confirm Password" />
                <JetInput
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    required
                    autocomplete="new-password"
                />
            </div>

            <div class="flex items-center justify-end mt-4">
                <JetButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Reset Password
                </JetButton>
            </div>
        </form>
    </JetAuthenticationCard>
</template>-->
