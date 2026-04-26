<script setup>
import {
  BButton,
  BListGroup,
  BListGroupItem
} from 'bootstrap-vue-next';
import { router } from '@inertiajs/vue3';

const props = defineProps({
  projects: Object
});
</script>
<template>
  <div class="d-flex align-items-center">
    <h3>Project List</h3>
    <BButton class="ms-auto" size="sm" variant="primary" @click="router.visit(route('project.create'))">
      Add
    </BButton>
  </div>
  <hr>

  <div class="row">
    <template v-for="([type, list]) in Object.entries(projects)" :key="type">
      <div class="col-4">
        <h5 class="text-center mb-3">{{ type }}</h5>
        <BListGroup>
          <BListGroupItem class="d-flex" v-for="project in list.data" :key="project.id"
            v-if="list.data.length" @click="router.visit(route('project.show', project.id))" button>
            {{ project.title }}
            <BButton variant="danger" @click.stop="router.delete(route('project.destroy', project.id))" class="ms-auto">
              Delete
            </BButton>
          </BListGroupItem>
          <BListGroupItem v-else>
            Empty
          </BListGroupItem>
        </BListGroup>
      </div>
    </template>
  </div>
</template>
