import { router, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

export default function () {
  const form = useForm({
    id: '',
    label: '',
    remark: '',
    active: true,
  });
  const search = ref({
    label: ""
  });
  const fields = [
    { key: 'serial', label: '.No' },
    { key: 'label', label: 'Label' },
    { key: 'remark', label: 'Remark' },
    { key: 'active', label: 'Active' },
    { key: 'actions', label: 'Actions' }
  ];

  /**
   * create a project type and clear the form inputs if success
   */
  function store() {
    router.post(route('project.type.store'), form, {
      preserveState: true,
      onSuccess: () => {
        clear();
      }
    });
  }

  /**
   * Put all the data of item into form inputs
   * @param {object} item
   */
  function edit(item) {
    Object.assign(form, item);
    form.active = Boolean(item.active);
  }

  /**
   * update the project type of id from form and clear the form inputs if success
   */
  function update() {
    router.put(route('project.type.update', form.id), form, {
      preserveState: true,
      onSuccess: () => {
        clear();
      }
    });
  }

  /**
   * delete a project form list by id
   * @param {id} id 
   */
  function destroy(id) {
    router.delete(route('project.type.destroy', id, {
      preserveState: true
    }));
  }

  /**
   * clear the form inputs
   */
  function clear() {
    form.reset();
    form.active = true;
    form.clearErrors();
  }

  return { form, search, fields, store, edit, update, destroy, clear };
}
