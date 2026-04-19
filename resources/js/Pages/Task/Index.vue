<script setup>
import {
  BButton,
  BListGroup,
  BListGroupItem
} from 'bootstrap-vue-next';
import { router } from '@inertiajs/vue3';

const props = defineProps({
  tasks: Object
});
</script>
<template>
  <div class="d-flex align-items-center">
    <h3>Task List</h3>
  </div>
  <hr>

  <div class="row">
    <template v-for="([type, list]) in Object.entries(tasks)" :key="type">
      <div class="col-4">
        <h6>{{ type }}</h6>
        <BListGroup>
          <BListGroupItem class="d-flex" v-for="([_, task]) in Object.entries(list)" :key="task.id" v-if="list.length"
            @click="router.visit(route('task.show', task.id))" button>
            {{ task.description }}
            <BButton variant="danger" @click.stop="router.delete(route('task.destroy', task.id))" class="ms-auto">
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
