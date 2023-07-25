<script setup>
import AppLayout from "@/Layouts/Layout.vue";

</script>

<template>
  <AppLayout title="European Events Management 2022">
      <template #header />
    <div class="py-4 bg-white">
      <div class="mx-auto sm:px-28 lg:px-36">
        <div class="bg-white overflow-hidden sm:rounded-lg text-justify">
          <el-container>

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
