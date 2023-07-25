<script setup>
import AppLayout from "@/Layouts/Layout.vue";
import { ref } from "vue";

const props = defineProps({
  message: Object,
  title: String,
  url: String,
  list: {
    id: Number,
    name: String,
    date: String,
    hour_start: String,
    hour_end: String,
  },
});
</script>

<template>
  <AppLayout title="Agenda">
    <template #header />
    <div
      class="py-4 bg-white back-container"
      style="background-image: url('/img/fondo.png')"
    >
      <div class="mx-auto sm:px-28 lg:px-36">
        <div class="overflow-hidden sm:rounded-lg text-justify">
          <el-alert
            :title="message?.text"
            type="success"
            v-if="message?.text"
          />
          <el-container>
            <el-main class="py-12 overflow-x-hidden">
              <div>
                <h1 class="my-4 green-label">Agenda</h1>
                <div v-for="(item, index) in props.list" :key="index">
                  <div class="flex flex-col pb-4 green-label2 border-0 border-dashed border-b-2 ">
                        <b> Workshop, discussion and decision</b>
                    <div class="flex">
                      <div class="mr-6 flex items-center"><span>{{ item.date }} ( {{ item.hour_start }} - {{ item.hour_end }} ) | {{ item.name }}
                          </span>
                      </div>
                    </div>
                      <p> 
                        {{ item.comments }}
                      </p>
                  </div>
                </div>
              </div>
            </el-main>
          </el-container>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<style scoped>
a,
p,
h3,
li {
  color: #9dafbd;
  font-size: 14px;
}
a {
  text-decoration: none;
}
h2 {
  font-size: 18px;
}
h2,
.pipe {
  color: #5c881a;
  font-weight: bold;
}
ul {
  list-style-image: url("../../../public/img/bullet.svg");
}
ul li {
  margin-left: 15px;
}
.green-label2 div {
  border-color: #9dafbd;
  padding-top: 10px;
  padding-bottom: 10px;
}
</style>
