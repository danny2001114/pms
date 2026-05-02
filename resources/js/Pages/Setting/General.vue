<script setup>
import { router } from '@inertiajs/vue3';
</script>
<template>
  <div class="d-flex align-items-center">
    <h3 class="m-0">General Setting</h3>
    <BButton class="ms-auto" size="sm" variant="primary" @click="router.visit(route('project.create'))">
      Add
    </BButton>
  </div>
  <hr>

  <div class="row">
    <div class="col-3">
      <BCard>
        <h3>Project Type</h3>
        <div class="d-flex align-items-center mt-5">
          <span>Total - 0</span>
          <BButton class="ms-auto" variant="primary" @click="router.visit(route('setting.general.project_type.index'))">
            Add
          </BButton>
        </div>
      </BCard>
    </div>

    <div class="col-3">
      <BCard>
        <h3>Skill</h3>
        <div class="d-flex align-items-center mt-5">
          <span>Total - 0</span>
          <BButton class="ms-auto" variant="primary" @click="router.visit(route('setting.general.skill.index'))">Add</BButton>
        </div>
      </BCard>
    </div>
  </div>
</template>
