<script setup>
import {
  BCard,
  BForm,
  BButton,
  BFormInput,
  BFormInvalidFeedback
} from 'bootstrap-vue-next';
import { useForm } from "@inertiajs/vue3";
import InfoAlert from '@/Components/InfoAlert.vue';

// ==== form ==== //
const form = useForm({
  code: '',
  password: ''
});
</script>
<style scoped>
#login-form {
  display: grid;
  place-items: center;
  min-height: 100vh;
  width: 100%;
}
</style>
<template>
  <div class="row" id="login-form">
    <div>
      <InfoAlert class="col-12 col-md-6 col-lg-4 mx-auto" />
      <BCard class="col-12 col-md-6 col-lg-4 mx-auto p-0">
        <BForm @submit.prevent="form.post(route('login'));" class="d-flex flex-column gap-3">
          <BFormInput type="text" id="name" v-model="form.code" :state="form.errors.code"
            placeholder="Enter Login Code" />
          <BFormInvalidFeedback>{{ form.errors.code }}</BFormInvalidFeedback>
  
          <BFormInput type="password" id="password" v-model="form.password" :state="form.errors.password"
            placeholder="Enter Password" />
          <BFormInvalidFeedback>{{ form.errors.password }}</BFormInvalidFeedback>
  
          <BButton type="submit" variant="primary" :disabled="form.processing">
            Login
          </BButton>
        </BForm>
      </BCard>
    </div>
  </div>
</template>
