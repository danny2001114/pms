<script setup>
import { 
  BButton,
  BCard,
  BRow,
  BCol
} from 'bootstrap-vue-next';
import { useHumanizeStr } from '../../Utilities/helpers';

const props = defineProps({
  project: Object,
});

const info = {
  code: props.project.code,
  owner: props.project.recipient?.name ?? props.project.owner?.name ?? "Admin",
  state: props.project.state_text,
  type: props.project.type.label,
  priority: props.project.priority_text,
  start_date: props.project.start_date,
  end_date: props.project.end_date,
}

</script>
<template>
  <div class="container mt-5">
    <BCard>
      <template #header>
        <h3>{{ project.title }}</h3>
      </template>
      <BRow v-for="([label, value], index) in Object.entries(info)" :key="index">
        <BCol cols="2">{{ useHumanizeStr(label) }}</BCol>
        <BCol cols="8">: {{ value }}</BCol>
      </BRow>
      <hr>
      <b class="mt-3">Description</b>
      <p>{{ project.description }}</p>
    </BCard>

    <div class="mt-3">
      <BButton variant="primary" :href="route('project.index')" class="me-2">
        Back
      </BButton>
      <BButton variant="warning" :href="route('project.edit', project.id)">
        Edit
      </BButton>
    </div>
  </div>
</template>
