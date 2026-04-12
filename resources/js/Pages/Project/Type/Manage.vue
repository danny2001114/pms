<script setup>
import {
  BButton,
  BCard,
  BInputGroup,
  BCol,
  BFormGroup
} from 'bootstrap-vue-next';
import { router } from '@inertiajs/vue3';
import ScrollableTable from '@/Components/ScrollableTable.vue';
import FormControl from '@/Components/FormControl.vue';
import useProjectTypeManage from '@/Composables/Project/Type/Manage';

// === props === //
defineProps({
  projectTypeList: Array,
  total: Number
});

// === import === //
const {
  form, 
  search, 
  fields,
  store, 
  edit, 
  update, 
  destroy, 
  clear
} = useProjectTypeManage();
</script>
<template>
  <div class="container my-5">
    <BCard>
      <div class="d-flex flex-column gap-2">
        <BFormGroup 
          label="Label"
          label-for="label"
          label-cols="2">
          <FormControl 
            v-model="form.label"
            type="text" 
            :group="false"
            field="label" 
            :error="form.errors.label"/>
        </BFormGroup>
  
        <BFormGroup 
          label="Remark"
          label-for="remark"
          label-cols="2">
          <FormControl 
            v-model="form.remark"
            type="textarea" 
            :group="false"
            field="remark" 
            :error="form.errors.remark"/>
          </BFormGroup>
  
        <BFormGroup 
          label="Active"
          label-for="active"
          label-cols="2">
          <FormControl 
            v-model="form.active"
            type="switch" 
            field="active" 
            :error="form.errors.active"/>
        </BFormGroup>
      </div>
      <template #footer>
        <div class="text-end">
          <BButton 
            variant="primary" 
            @click="store" 
            v-if="!form.id">
            Add
          </BButton>
          <BButton 
            variant="primary" 
            @click="update" 
            v-if="form.id">
            Update
          </BButton>
          <BButton 
            class="ms-1" 
            variant="danger" 
            @click="clear" 
            v-if="form.id">
            Cancel
          </BButton>
        </div>
      </template>
    </BCard>

    <ScrollableTable 
      :total="total" 
      :list="projectTypeList" 
      :form="form" 
      :fields="fields" 
      @onDestroy="destroy" 
      @onEdit="edit">
      <template #searchBar>
        <BCol cols="3" class="ms-auto">
          <BInputGroup>
            <FormControl 
              v-model="search.label"
              type="text" 
              field="search_label"
              :group="false"
              placeholder="Search with label..." />
            <template #append>
              <BButton 
                variant="primary" 
                :href="route('project.type.index', search)">
                Search
              </BButton>
            </template>
          </BInputGroup>
        </BCol>
      </template>
      </ScrollableTable>
      <div class="text-center mt-3">
        <BButton @click="router.visit(route('project.index'))">Back</BButton>
      </div>
  </div>
</template>
