<script setup>
import {
  BCard,
  BForm,
  BButton
} from 'bootstrap-vue-next';
import InfoAlert from '@/Components/InfoAlert.vue';
import FormControl from '@/Components/FormControl.vue';
import useLogin from '@/Composables/Auth/Login';

// ==== import ==== //
const {
  form,
  submit
} = useLogin();
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
        <BForm 
          @submit.prevent="submit" 
          class="d-flex flex-column gap-3">
          <div>
            <FormControl
              v-model="form.code" 
              type="text" 
              field="code" 
              :group="false"
              :error="form.errors.code"
              placeholder="Enter Login Code"/>
          </div>
      
          <div>
            <FormControl
              v-model="form.password" 
              type="password" 
              field="password" 
              :group="false"
              :error="form.errors.password"
              placeholder="Enter Password"/>
          </div>
    
          <BButton 
            type="submit" 
            variant="primary" 
            :disabled="form.processing">
            Login
          </BButton>
        </BForm>
      </BCard>
    </div>
  </div>
</template>
