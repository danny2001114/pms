<script setup>
import { useForm } from '@inertiajs/vue3';
import {
  BCard,
  BFormInput,
  BForm,
  BFormInvalidFeedback,
  BButton
} from 'bootstrap-vue-next';
import InfoAlert from '@/Components/InfoAlert.vue';

const form = useForm({
  code: '',
  password: ''
});

const submit = () => {
  form.post(route('login'));
}
</script>
<style scoped>
  .container-fluid {
    display: grid;
    place-items: center;
    min-height: 100vh;
    width: 100%;
  }
</style>
<template>
  <div class="container-fluid row">
    <div>
      <InfoAlert class="col-12 col-md-6 col-lg-4 mx-auto" />
      <BCard class="col-12 col-md-6 col-lg-4 mx-auto p-0">
        <BForm  @submit.prevent="submit" class="d-flex flex-column gap-3">
          <div>
            <BFormInput id="code" v-model="form.code" :state="form.errors.code ? false : null"
            placeholder="Enter Login Code" />
            <BFormInvalidFeedback>{{ form.errors.code }}</BFormInvalidFeedback>
          </div>
      
          <div>
            <BFormInput id="password" v-model="form.password" :state="form.errors.password ? false : null"
            placeholder="Enter Password" />
            <BFormInvalidFeedback>{{ form.errors.password }}</BFormInvalidFeedback>
          </div>
    
          <BButton type="submit" variant="primary" :disabled="form.processing">
            Login
          </BButton>
        </BForm>
      </BCard>
    </div>
  </div>
</template>
