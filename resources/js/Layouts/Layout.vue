<script setup>
import { ref, computed } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { Head, Link, usePage } from "@inertiajs/inertia-vue3";
import JetBanner from "@/Jetstream/Banner.vue";
import JetDropdown from "@/Jetstream/Dropdown.vue";
import JetDropdownLink from "@/Jetstream/DropdownLink.vue";

defineProps({
  title: {
    type: String,
    default: "European Events Management 2022",
  },
});
const page = usePage();
const showingNavigationDropdown = ref(false);
const logout = () => {
  if (page.props.value.auth.user) {
    Inertia.post(`/logout?id=${page.props.value.auth.user.id}`);
  }
};
</script>

<template>
  <div>
    <Head :title="title" />

    <JetBanner />

    <div class="min-h-screen bg-gray-100">
      <nav class="bg-white border-b border-gray-100"></nav>

      <!-- Page Heading -->
      <header v-if="$slots.header" class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-2 px-4 sm:px-6 lg:px-8">
          <slot name="header">
            <div class="flex items-center">
              <Link :href="route('dashboard')">
                <img alt="logo" src="/img/logo.png" class="inline-block"
              /></Link>
              <img
                alt="logo"
                src="/img/logo-2.png"
                class="ml-4 mr-4 hidden md:inline-block"
              />
              <div class="vertical-divider hidden md:inline-block"></div>
              <div class="flex h-20 items-center hidden md:flex">
                <h2 class="ml-3 header-text">
                  European Events Management 2022
                </h2>
              </div>
              <JetDropdown
                :contentClasses="['bg-primary']"
                align="right"
                width="60"
                class="ml-auto"
              >
                <template #trigger>
                  <span class="inline-flex">
                    <button
                      type="button"
                      class="
                        inline-flex
                        items-center
                        px-3
                        py-2
                        border border-transparent
                        text-md
                        leading-4
                        font-medium
                        bg-white
                        focus:outline-none
                        transition
                        my-rounded
                        text-primary
                      "
                    >
                      Menu
                      <img
                        alt="logo"
                        src="/img/menu.png"
                        class="inline-block"
                        style="border-radius: 50%"
                      />
                    </button>
                  </span>
                </template>
                <template #content>
                  <div class="w-60 bg-primary my-rounded" id="green-drop">
                    <JetDropdownLink
                      :href="route('executives_list')"
                      class="first-item text-white"
                      v-if="
                        $page.props.user &&
                        $page.props.user.role_id &&
                        $page.props.user.role_id === 1 &&
                        $page.props?.auth.user.confirmed
                      "
                    >
                      Assistant list
                    </JetDropdownLink>
                    <JetDropdownLink
                      :href="route('activity.index')"
                      class="text-white"
                      v-if="
                        $page.props.user &&
                        $page.props?.user?.role_id &&
                        $page.props?.user?.role_id == 1 &&
                        $page.props?.auth.user.confirmed
                      "
                    >
                      Activity list
                    </JetDropdownLink>
                    <JetDropdownLink
                      :href="route('task.create')"
                      class="text-white"
                      v-if="
                        $page.props.user &&
                        $page.props.user.role_id &&
                        $page.props.user.role_id === 1 &&
                        $page.props?.auth.user.confirmed
                      "
                    >
                      Assign task
                    </JetDropdownLink>
                    <JetDropdownLink
                      :href="route('activity.create')"
                      class="text-white"
                      v-if="
                        $page.props.user &&
                        $page.props.user.role_id &&
                        $page.props.user.role_id === 1 &&
                        $page.props?.auth.user.confirmed
                      "
                    >
                      Assign activity
                    </JetDropdownLink>
                    <JetDropdownLink
                      v-if="
                        $page.props.user &&
                        $page.props.user.role_id &&
                        $page.props.user.role_id == 2 &&
                        $page.props?.auth.user.confirmed
                      "
                      :href="route('driver_list')"
                      class="first-item text-white"
                    >
                      Task and activities
                    </JetDropdownLink>
                    <JetDropdownLink
                      :href="route('dashboard')"
                      v-if="!$page.props?.user"
                      class="text-white"
                    >
                      Guest details form
                    </JetDropdownLink>
                    <JetDropdownLink :href="route('agenda')" class="text-white">
                      Provisional Agenda
                    </JetDropdownLink>
                    <JetDropdownLink :href="route('agenda_index')" class="text-white">
                      Agenda management
                    </JetDropdownLink>
                    <JetDropdownLink
                      :href="route('contact')"
                      class="last-item text-white"
                    >
                      Contact
                    </JetDropdownLink>
                  </div>
                </template>
              </JetDropdown>
              <JetDropdown align="right" width="60">
                <template #trigger>
                  <span class="inline-flex">
                    <button
                      type="button"
                      class="
                        inline-flex
                        items-center
                        px-3
                        py-2
                        border border-transparent
                        text-sm
                        leading-4
                        font-medium
                        text-gray-500
                        bg-white
                        transition
                        my-rounded
                      "
                    >
                      <span v-if="$page.props.user">{{
                        $page.props.user.name
                      }}</span>
                      <img
                        alt="logo"
                        src="/img/user.png"
                        class="inline-block"
                        style="border-radius: 50%; margin-left: 5px"
                      />
                    </button>
                  </span>
                </template>
                <template #content>
                  <div class="w-60">
                    <JetDropdownLink
                      v-if="$page.props.user"
                      :href="route('profile.show')"
                      class="first-item border-b border-gray-200"
                    >
                      My Profile
                    </JetDropdownLink>
                    <JetDropdownLink
                      v-if="!$page.props.user"
                      :href="route('login')"
                      class="first-item border-b border-gray-200"
                    >
                      Login
                    </JetDropdownLink>
                    <form
                      @submit.prevent="logout"
                      v-if="$page.props.user"
                      class="last-item"
                    >
                      <JetDropdownLink as="button"> Log Out </JetDropdownLink>
                    </form>
                    <JetDropdownLink
                      :href="route('register')"
                      class="last-item"
                      v-if="!$page.props.user"
                    >
                      Register
                    </JetDropdownLink>
                  </div>
                </template>
              </JetDropdown>
            </div>
            <img
              alt="logo"
              src="/img/logo-2.png"
              class="ml-4 mr-4 mb-4 mt-2 md:hidden"
            />
            <div class="flex h-10 items-center md:hidden">
              <h2 class="ml-3 header-text">
                European Events Management 2022
              </h2>
            </div>
          </slot>
        </div>
      </header>

      <!-- Page Content -->
      <main>
        <slot />
      </main>
      <footer>
        <p>
          Iberdrola ©2022. All Rights Reserved European Events Management 2022
          | <Link :href="route('event_policy')">Privacy policy</Link>
        </p>
      </footer>
    </div>
  </div>
</template>
<style>
.my-rounded {
  border-radius: 25px;
}
.my-rounded a {
  color: #9dafbd;
}
.first-item {
  padding-top: 10px;
}
.first-item a {
  border-bottom: 1px solid #d1dbe3;
}
.last-item a {
  border-radius: 0 0 25px 25px;
}
</style>
