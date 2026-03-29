<script setup>
import {
  BButton,
  BTable,
  BSpinner,
  BRow,
  BCol
} from 'bootstrap-vue-next';
import { ref } from 'vue';
import axios from 'axios';

const props = defineProps({
  list: Array,
  total: Number,
  fields: Array,
  form: Object,
  destroyRoute: String,
  fetchRoute: String
});

const loading = ref(false);

function destroy(id) {
  axios
    .delete(route(props.destroyRoute, id))
    .then((res) => {
      if (id == props.form.id) {
        props.form.reset();
        props.form.clearErrors();
        props.form.active = true;
      }
      
      const removedId = res.data.id;
      const idx = props.list.findIndex((item) => Number(item.id) === Number(removedId));
      if (idx !== -1) {
        props.list.splice(idx, 1);
      }
    })
    .catch((err) => console.log(err));
}

function edit(item) {
  Object.assign(props.form, item);
  props.form.active = Boolean(item.active);
}

function fetch() {
  if (props.list.length >= props.total) return;

  loading.value = true;
  const query = Object.fromEntries(new URLSearchParams(window.location.search));
  axios
    .get(route(props.fetchRoute, query), {
      params: {
        last_id: props.list.at(-1)?.id ?? null
      }
    })
    .then((res) => {
      props.total = res.data.total;
      props.list.push(...res.data.incomings);
    })
    .catch((err) => console.log(err))
    .finally(() => loading.value = false);
}
</script>

<template>
  <BRow class="mt-4">
    <BCol cols="2" class="fw-bold">total - {{ total }}</BCol>
    <slot name="searchBar"></slot>
  </BRow>
  <div class="scrollable-table mt-3">
    <BTable :items="list" :fields="fields" striped hover>
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
        <BButton variant="danger" size="sm" @click="destroy(data.item.id)">
          Delete
        </BButton>
      </template>
      <template v-if="list.length < total" #custom-foot>
        <tr>
          <td :colspan="fields.length" class="text-center">
            <BSpinner variant="primary" v-if="loading" />
            <BButton variant="primary" size="sm" @click="fetch" v-else>Load More</BButton>
          </td>
        </tr>
      </template>
    </BTable>
  </div>
</template>
