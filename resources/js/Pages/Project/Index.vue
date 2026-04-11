<script setup>
import { 
  BButton, 
  BListGroup, 
  BListGroupItem
} from 'bootstrap-vue-next';
import useProjectIndex from '@/Composables/Project/Index';

// ==== props ==== //
const props = defineProps({
  projectLists: Object
});

// ==== import ==== //
const { 
  destroy 
} = useProjectIndex();
</script>
<template>
  <div class="container mt-5">
    <h1 class="mb-4">Projects</h1>
    <div class="d-flex align-items-center">
      <div class="ms-auto">
        <BButton 
          variant="primary" 
          :href="route('project.create')" 
          class="mb-3">
          Create New
        </BButton>
        <BButton 
          variant="warning" 
          :href="route('project.type.index')" 
          class="mb-3 ms-2">
          Manage Type
        </BButton>
      </div>
    </div>
    <div class="row">
      <template 
        v-for="([type, list]) in Object.entries(projectLists)" 
        :key="type">
        <div class="col-4">
          <h6>{{ type }}</h6>
          <BListGroup>
            <BListGroupItem 
              class="d-flex" v-for="([_, project]) in Object.entries(list)" 
              :key="project.id" v-if="list.length" 
              :href="route('project.show', project.id)">
              {{ project.title }}
              <BButton 
                variant="danger" 
                @click="destroy(project.id)" 
                class="ms-auto">
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
  </div>
</template>
