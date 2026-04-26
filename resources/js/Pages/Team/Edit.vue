<script setup>
import {
  BForm,
  BFormGroup,
  BFormInput,
  BFormInvalidFeedback,
  BCard,
  BFormTextarea,
  BButton
} from 'bootstrap-vue-next';
import { router, useForm } from '@inertiajs/vue3';
import { back } from '@/Utilities/helpers';

const props = defineProps({
  team: Object
});

const form = useForm({
  name: props.team.name,
  leader_code: props.team.leader.code,
  description: props.team.description
});
</script>
<template>
  <h3 class="m-0">Edit Team</h3>
  <hr>

  <BForm @submit.prevent="form.put(route('team.update'))">
    <BCard>
      <template #header>
          <BFormInput type="text" id="name" placeholder="Enter Team Name ..." v-model="form.name" />
          <div class="text-danger" v-if="form.errors.name">{{ form.errors.name }}</div>
      </template>

      <div class="d-flex flex-column gap-3">
        <BFormGroup label-cols="12" label-cols-md="4" label-cols-lg="2" label-for="leader_code" label="Leader">
          <BFormInput type="text" id="leader_code" placeholder="Enter User Code..." v-model="form.leader_code" />
          <div class="text-danger" v-if="form.errors.leader_code">{{ form.errors.leader_code }}</div>
        </BFormGroup>

        <BFormGroup label-cols="12" label-cols-md="4" label-cols-lg="2" label-for="description" label="Description">
          <BFormTextarea type="text" id="description" v-model="form.description" />
          <div class="text-danger" v-if="form.errors.description">{{ form.errors.description }}</div>
        </BFormGroup>
      </div>
    </BCard>

    <div class="d-flex gap-2 justify-content-start my-3">
      <BButton variant="outline-secondary" type="button" @click="back">Back</BButton>
      <BButton variant="primary" type="submit">Update</BButton>
    </div>
  </BForm>
</template>
