<script setup>
import {
  BForm,
  BFormGroup,
  BFormInput,
  BFormInvalidFeedback,
  BFormRadioGroup,
  BCard,
  BButton
} from 'bootstrap-vue-next';
import { useForm, router } from '@inertiajs/vue3';
import InfoAlert from '@/Components/InfoAlert.vue';
import { back } from '@/Utilities/helpers';

const props = defineProps({
  user: Object,
  roles: Array,
  genders: Array
});

const form = useForm({
  name: props.user.name,
  role: props.user.role,
  gender: props.user.gender,
  email: props.user.email,
  phone: props.user.phone
});
</script>
<template>
  <h3 class="m-0">Edit User</h3>
  <hr>

  <InfoAlert />
  <BForm @submit.prevent="form.put(route('user.update', user.id))">
    <BCard>
      <template #header>
                <BFormInput type="text" id="name" placeholder="Enter User Name ..." v-model="form.name" />
        <div class="text-danger" v-if="form.errors.name">{{ form.errors.name }}</div>
      </template>

      <div class="d-flex flex-column gap-3">
        <BFormGroup label-cols="12" label-cols-md="4" label-cols-lg="2" label-for="code" label="Code">
          <input type="text" class="form-control" id="code" disabled :value="user.code"/>
        </BFormGroup>

        <BFormGroup label-cols="12" label-cols-md="4" label-cols-lg="2" label="Role">
          <BFormRadioGroup :options="roles" id="role" v-model="form.role" />
          <div class="text-danger" v-if="form.errors.role">{{ form.errors.role }}</div>
        </BFormGroup>

        <BFormGroup label-cols="12" label-cols-md="4" label-cols-lg="2" label="Gender">
          <BFormRadioGroup :options="genders" id="gender" v-model="form.gender" />
          <div class="text-danger" v-if="form.errors.gender">{{ form.errors.gender }}</div>
        </BFormGroup>

        <BFormGroup label-cols="12" label-cols-md="4" label-cols-lg="2" label-for="email" label="Email">
          <BFormInput type="email" id="email" v-model="form.email" />
          <div class="text-danger" v-if="form.errors.email">{{ form.errors.email }}</div>
        </BFormGroup>

        <BFormGroup label-cols="12" label-cols-md="4" label-cols-lg="2" label-for="phone" label="Phone">
          <BFormInput type="tel" id="phone" v-model="form.phone" />
          <div class="text-danger" v-if="form.errors.phone">{{ form.errors.phone }}</div>
        </BFormGroup>
      </div>
    </BCard>

    <div class="d-flex gap-2 justify-content-start my-3">
      <BButton variant="outline-secondary" type="button" @click="back">Back</BButton>
      <BButton variant="primary" type="submit">Update</BButton>
    </div>
  </BForm>
</template>
