<script setup>
import {
  BButton,
  BCard,
  BInputGroup,
  BFormGroup,
  BForm,
  BFormInput,
  BFormInvalidFeedback,
  BFormRadioGroup,
  BFormCheckbox,
  BTable
} from 'bootstrap-vue-next';
import { router, useForm } from '@inertiajs/vue3';

const props = defineProps({
  auth: Object,
  errors: Object,
  projectTypes: Object
});

const form = useForm({
  id: '',
  label: '',
  remark: '',
  active: true,
});

const search = useForm({
  label: ''
})

const fields = [
  { key: 'serial', label: 'No.' },
  { key: 'label', label: 'Label' },
  { key: 'remark', label: 'Remark' },
  { key: 'active', label: 'Active' },
  { key: 'actions', label: 'Actions' }
];

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
</script>
<template>
  <h3 class="m-0">Project Type Manage</h3>
  <hr>

  <BForm @submit.prevent="form.id ? store : update">
    <BCard>
      <div class="d-flex flex-column gap-2">
        <BFormGroup label-cols="12" label-cols-md="4" label-cols-lg="2" label-for="label" label="Label">
          <BFormInput type="text" id="label" v-model="form.label" />
          <div class="text-danger" v-if="form.errors.label">{{ form.errors.label }}</div>
        </BFormGroup>

        <BFormGroup label-cols="12" label-cols-md="4" label-cols-lg="2" label-for="label" label="Label">
          <BFormCheckbox id="active" v-model="form.active" switch />
          <div class="text-danger" v-if="form.errors.active">{{ form.errors.active }}</div>
          <div class="text-danger" v-if="form.errors.label">{{ form.errors.label }}</div>
        </BFormGroup>

        <BFormGroup label-cols="12" label-cols-md="4" label-cols-lg="2" label-for="remark" label="Remark">
          <BFormTextarea type="text" id="remark" v-model="form.remark" />
          <div class="text-danger" v-if="form.errors.remark">{{ form.errors.remark }}</div>
        </BFormGroup>
      </div>
      <template #footer>
        <div class="text-end">
          <template v-if="form.id">
            <BButton variant="primary" type="submit" @click="update">Update</BButton>
            <BButton class="ms-1" variant="danger" type="button" @click="clear">Cancel</BButton>
          </template>
          <template v-else>
            <BButton variant="primary" type="submit" @click="store">Add</BButton>
          </template>
        </div>
      </template>
    </BCard>
  </BForm>

  <div class="mt-4 row">
    <div class="ms-auto col-3">
      <BInputGroup>
        <BFormInput type="text" id="search_label" placeholder="Search With Label ..." v-model="search.label" />
        <template #append>
          <BButton variant="primary" @click="filter">Search</BButton>
        </template>
      </BInputGroup>
      <div class="text-danger" v-if="search.errors.label">{{ search.errors.label }}</div>
    </div>
  </div>
  <div class="scrollable-table mt-3">
    <BTable :items="projectTypes.data" :fields="fields" striped hover>
      <template #cell(serial)="data">
        {{ data.index + 1 }}
      </template>
      <template #cell(active)="data">
        {{ Boolean(data.item.active) ? "true" : "false" }}
      </template>
      <template #cell(actions)="data">
        <BButton variant="warning" size="sm" class="me-1" @click="edit(data.item)">
          Edit
        </BButton>
        <BButton variant="danger" size="sm" @click="router.delete(route('project.type.destroy', data.item.id))">
          Delete
        </BButton>
      </template>
    </BTable>
  </div>

  <div class="mt-3">
    <BButton @click="router.visit(route('project.index'))">Back</BButton>
  </div>
</template>
