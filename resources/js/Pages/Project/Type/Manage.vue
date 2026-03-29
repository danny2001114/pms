<script setup>
import {
  BButton,
  BCard,
  BFormGroup,
  BFormInput,
  BFormTextarea,
  BFormCheckbox,
  BInputGroup,
  BCol
} from 'bootstrap-vue-next';
import useProjectTypeManage from '@/Composables/Project/Type/Manage';
import ScrollableTable from '@/Components/ScrollableTable.vue';

defineProps({
  project_type_list: Array,
  total: Number
});

const {
  form, search, fields,
  store, edit, update, destroy, clear
} = useProjectTypeManage();
</script>

<template>
  <div class="container my-5">
    <BCard>
      <BFormGroup class="mt-2" label-cols="4" label-cols-lg="2" label="Label" label-for="label">
        <BFormInput id="label" v-model="form.label"></BFormInput>
      </BFormGroup>
      <BFormGroup class="mt-2" label-cols="4" label-cols-lg="2" label="Remark" label-for="remark">
        <BFormTextarea id="remark" v-model="form.remark"></BFormTextarea>
      </BFormGroup>
      <BFormGroup class="mt-2" label-cols="4" label-cols-lg="2" label="Active" label-for="active">
        <BFormCheckbox id="active" v-model="form.active" switch></BFormCheckbox>
      </BFormGroup>
      <template #footer>
        <div class="text-end">
          <BButton variant="primary" @click="store" v-if="!form.id">Add</BButton>
          <BButton variant="primary" @click="update" v-if="form.id">Update</BButton>
          <BButton class="ms-1" variant="danger" @click="clear" v-if="form.id">Cancel</BButton>
        </div>
      </template>
    </BCard>

    <ScrollableTable :total="total" :list="project_type_list" :form="form" :fields="fields" 
      @onDestroy="destroy" @onEdit="edit">
      <template #searchBar>
        <BCol cols="3" class="ms-auto">
          <BInputGroup>
            <BFormInput id="label" placeholder="Search with label..." v-model="search.label"></BFormInput>
            <template #append>
              <BButton variant="primary" :href="route('project.type.index', search)">Search</BButton>
            </template>
          </BInputGroup>
        </BCol>
      </template>
      </ScrollableTable>
      <div class="text-center mt-3">
        <BButton :href="route('project.index')">Back</BButton>
      </div>
  </div>
</template>
