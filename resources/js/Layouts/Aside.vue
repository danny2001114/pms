<script setup>
import {
  BButton,
  BListGroup,
  BListGroupItem
} from 'bootstrap-vue-next';
import { ref, watch } from 'vue';
import { router } from '@inertiajs/vue3';

// === props ==== //
defineProps({
  current: String
});

// ==== vars ==== //
const nav = [
  { route: "dashboard.index", label: "Dashboard" },
  { route: "project.index", label: "Project" },
];
const width = {
  close: 50,
  open: 250,
};
const show = ref(false);
const sidebar = ref(null);
const menuBtn = ref(null);

// ==== watchers ==== //
watch(show, function (show) {
  const menuList = sidebar.value.querySelector(".scroll");
  if (show) {
    sidebar.value.style.width = width.open + 'px';
    menuList.style.opacity = "100%";
    menuBtn.value.classList.add('active');
  } else {
    sidebar.value.style.width = width.close + 'px';
    menuList.style.opacity = "0%";
    menuBtn.value.classList.remove('active');
  }
});

// ==== emiters ==== //
const emit = defineEmits([
  "onLink"
]);
</script>
<style>
  #sidebar {
    width: 50px;
    height: 100vh;
    box-shadow: 0 0 .3rem #2e2e2e;
    position: sticky;
    top: 0;
    overflow-x: hidden;
    overflow-y: scroll;
    scrollbar-width: none;
    transition: width .8s ease-in-out;
  }

  #menu-btn {
    width: 40px;
    display: flex;
    flex-direction: column;
    background: transparent;
    border: none;
    padding: 10px;
    gap: 5px;
  }

  #menu-btn div {
    width: 100%;
    height: 3px;
    background: black;
    border-radius: 1rem;
    transition: all 0.4s ease;
  }

  /* ACTIVE STATE */
  #menu-btn.active div:nth-child(1) {
    transform: translateY(8px) rotate(45deg);
  }

  #menu-btn.active div:nth-child(2) {
    opacity: 0;
  }

  #menu-btn.active div:nth-child(3) {
    transform: translateY(-8px) rotate(-45deg);
  }

  #sidebar .scroll {
    width: 100%;
    height: max-content;
    opacity: 0%;
    transition: opacity .6s linear;
  }
</style>
<template>
  <div 
    id="sidebar" 
    ref="sidebar">
    <button 
      class="ms-auto"
      id="menu-btn" 
      ref="menuBtn" 
      @click="show = !show">
      <div></div>
      <div></div>
      <div></div>
    </button>
    <BListGroup class="scroll p-2">
      <BListGroupItem
        v-for="item in nav"
        :key="item.route"
        @click="emit('onLink', item.route)"
        button>
      {{ item.label }}
    </BListGroupItem>
    </BListGroup>
  </div>
</template>
