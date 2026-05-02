<script setup>
import { ref, watch } from 'vue';
import { router } from '@inertiajs/vue3';
import routes from '@/app/routes';

const width = {
  close: 50,
  open: 250,
};
const show = ref(false);
const sidebar = ref(null);
const menuBtn = ref(null);

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

const emit = defineEmits([
  "onLink"
]);

function logout() {
  router.delete(route('logout'));
}
</script>
<template>
  <div id="sidebar" ref="sidebar">
    <button class="ms-auto" id="menu-btn" ref="menuBtn" @click="show = !show">
      <div></div>
      <div></div>
      <div></div>
    </button>
    <BListGroup class="scroll p-2">
      <template v-for="item in routes" :key="item.route">
        <BListGroupItem class="d-flex" @click="item.sub ? null : emit('onLink', item.route)" button>
          <template v-if="item.sub">
            <BAccordion>
              <BAccordionItem :title="item.label">
                <BListGroup>
                  <BListGroupItem v-for="subItem in item.sub" :key="subItem.route"
                    @click="emit('onLink', subItem.route)" button>
                    {{ subItem.label }}
                  </BListGroupItem>
                </BListGroup>
              </BAccordionItem>
            </BAccordion>
          </template>
          <template v-else>
            {{ item.label }}
          </template>
        </BListGroupItem>
      </template>
      <BListGroupItem @click="logout" button>
        Logout
      </BListGroupItem>
    </BListGroup>
  </div>
</template>
