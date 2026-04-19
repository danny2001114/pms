<script setup>
import {
  BButton,
  BListGroup,
  BListGroupItem
} from 'bootstrap-vue-next';
import { Link, router } from '@inertiajs/vue3';

const props = defineProps({
  projectLists: Object
});

function destroy(projectId, id) {
  if (confirm('Are you sure you want to delete this project?')) {
    router.delete(route('project.destroy', [projectId, id]));
  }
}
</script>
<template>
  <div class="d-flex align-items-center">
    <h3>Project List</h3>
    <BButton class="ms-auto" variant="primary" @click="router.visit(route('project.create'))">
      Add
    </BButton>
  </div>
  <hr>

  <div class="row">
    <template v-for="([type, list]) in Object.entries(projectLists)" :key="type">
      <div class="col-4">
        <h6>{{ type }}</h6>
        <BListGroup>
          <BListGroupItem class="d-flex" v-for="([_, project]) in Object.entries(list)" :key="project.id"
            v-if="list.length" @click="router.visit(route('project.show', project.id))" button>
            {{ project.title }}
            <BButton variant="danger" @click.stop="destroy(project.id)" class="ms-auto">
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
