<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue';
import AppLayout from "@/Layouts/Layout.vue";

defineProps({
    status: String,
    errors: Object,
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>
<template>
  <AppLayout title="Reset Password">
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
            <span class="intro-text px-10 px:sm-0">Reset Password</span>
          </div>
          <p class="text-gray-600 mt-4 px-10 px:sm-0">
            Forgot your password? No problem.
          </p>
          <p class="text-gray-600 mb-4 px-10 px:sm-0">
            Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
          </p>
          <div class="grid lg:grid-cols-3 gap-4 px-10 px:sm-0">
            <form @submit.prevent="submit">
              <div>
                <el-form-item label="Email" :error="errors.email">
                <el-input
                  id="email"
                  v-model="form.email"
                  type="email"
                  required
                  autofocus
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
                > Send
                </el-button>
               <!-- <JetButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                  Email Password Reset Link
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
    <Head title="Forgot Password" />

    <JetAuthenticationCard>
        <template #logo>
            <JetAuthenticationCardLogo />
        </template>

        <div class="mb-4 text-sm text-gray-600">
            Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
        </div>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

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

            <div class="flex items-center justify-end mt-4">
                <JetButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Email Password Reset Link
                </JetButton>
            </div>
        </form>
    </JetAuthenticationCard>
</template>-->
