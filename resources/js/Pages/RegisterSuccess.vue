<script setup>
import AppLayout from "@/Layouts/Layout.vue";

</script>

<template>
  <AppLayout>
    <template #header />
    <div class="py-4 bg-white">
      <div class="mx-auto sm:px-28 lg:px-36">
        <div class="bg-white overflow-hidden sm:rounded-lg text-justify">
          <el-container>
            <el-main>
              <h2 class="text-2xl my-4 font-bold">
                 Your account has been created successfully.
              </h2>
              <div class="bg-white overflow-hidden sm:rounded-lg text-justify">
                <!-- For you to login, your account needs to be activated by our admin. An email will be send to you to notify the activation. -->
                Please, login into our platform to proceed. We will send you an email right after with a verification code.
              </div>
            </el-main>
          </el-container>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<style scoped>
p {
  margin-bottom: 10px;
}
p,
ul.ul li {
  color: #9dafbd;
}
ul.ul li {
  padding-left: 10px;
}
ul.ul {
  counter-reset: list;
}
ul.ul > li {
  list-style: none;
}
ul.ul > li:before {
  content: counter(list, lower-alpha) ") ";
  counter-increment: list;
}
a {
  text-decoration: underline;
}
a,
h3 {
  font-weight: bold;
  color: #5c881a;
}
</style>
