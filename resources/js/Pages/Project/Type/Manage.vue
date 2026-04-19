<script setup>
import {
  BButton,
  BCard,
  BInputGroup,
  BCol,
  BFormGroup
} from 'bootstrap-vue-next';
import { router, useForm } from '@inertiajs/vue3';
import ScrollableTable from '@/Components/ScrollableTable.vue';
import FormControl from '@/Components/FormControl.vue';

// === props === //
defineProps({
  auth: Object,
  errors: Object,
  projectTypeList: Array,
  total: Number
});

// ==== form ==== //
const form = useForm({
  id: '',
  label: '',
  remark: '',
  active: true,
});

const search = useForm({
  label: ''
})

// ==== vars ==== //
const fields = [
  { key: 'serial', label: '.No' },
  { key: 'label', label: 'Label' },
  { key: 'remark', label: 'Remark' },
  { key: 'active', label: 'Active' },
  { key: 'actions', label: 'Actions' }
];

// ==== actions ==== //
function store() {
  form.post(route('project.type.store'), {
    onSuccess: () => {
      clear();
    }
  });
}

function update() {
  form.put(route('project.type.update', form.id), {
    onSuccess: () => {
      clear();
    }
  });
}

function edit(item) {
  form.clearErrors();
  Object.assign(form, item);
  form.active = Boolean(item.active);
}

function clear() {
  form.reset();
  form.active = true;
  form.clearErrors();
}

function filter() {
  search.get(route('project.type.index'), {
    preserveState: true,
    onStart: clear
  })
}

function destroy(id) {
  if (confirm('Are you sure you want to delete this project type?')) {
    router.delete(route('project.type.destroy', id));
  }
}
</script>
<template>
  <BCard>
    <div class="d-flex flex-column gap-2">
      <BFormGroup label="Label" label-for="label" label-cols="2">
        <FormControl v-model="form.label" type="text" :group="false" field="label" :error="form.errors.label" />
      </BFormGroup>

      <BFormGroup label="Remark" label-for="remark" label-cols="2">
        <FormControl v-model="form.remark" type="textarea" :group="false" field="remark" :error="form.errors.remark" />
      </BFormGroup>

      <BFormGroup label="Active" label-for="active" label-cols="2">
        <FormControl v-model="form.active" type="switch" field="active" :error="form.errors.active" />
      </BFormGroup>
    </div>
    <template #footer>
      <div class="text-end">
        <BButton variant="primary" @click="store" v-if="!form.id">
          Add
        </BButton>
        <BButton variant="primary" @click="update" v-if="form.id">
          Update
        </BButton>
        <BButton class="ms-1" variant="danger" @click="clear" v-if="form.id">
          Cancel
        </BButton>
      </div>
    </template>
  </BCard>

  <ScrollableTable :total="total" :list="projectTypeList" :fields="fields" @onDestroy="destroy"
    @onEdit="edit">
    <template #searchBar>
      <BCol cols="3" class="ms-auto">
        <BInputGroup>
          <FormControl v-model="search.label" type="text" field="search_label" :group="false"
            placeholder="Search with label..." />
          <template #append>
            <BButton variant="primary" @click="filter">Search</BButton>
          </template>
        </BInputGroup>
      </BCol>
    </template>
    <template #cell(active)="data">
      {{ Boolean(data.item.active) ? "true" : "false" }}
    </template>
  </ScrollableTable>
  <div class="text-center mt-3">
    <BButton @click="router.visit(route('project.index'))">Back</BButton>
  </div>
</template>
