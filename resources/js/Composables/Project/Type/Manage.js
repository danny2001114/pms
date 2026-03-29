import { useForm } from '@inertiajs/vue3';
import axios from 'axios';
import { ref, watch } from 'vue';
import { usePatch, useValidationMessage } from '@/Utilities/helpers.js'

export default function (props) {
  const projectTypeList = ref([...(props.project_type_list ?? [])]);
  const totalCount = ref(props.total);
  const form = useForm({
    id: '',
    label: '',
    remark: '',
    active: true,
  });
  const search = ref({
    label: ""
  });

  watch(
    () => projectTypeList.length,
    (v) => {
      totalCount.value = v;
    }
  );

  const action = {
    store: () => {
      axios
        .post(route('project.type.store'), form.data())
        .then((res) => {
          form.reset();
          form.clearErrors();
          form.active = true;
          projectTypeList.value.unshift(res.data.project_type);
        })
        .catch((err) => useValidationMessage(form, err));
    },
    update: () => {
      axios
        .put(route('project.type.update', form.id), form.data())
        .then((res) => {
          form.reset();
          form.clearErrors();
          form.active = true;
          usePatch(projectTypeList, res.data.project_type);
        })
        .catch((err) => useValidationMessage(form, err));
    },
    cancel: () => {
      form.id = "";
      form.label = "";
      form.remark = "";
      form.active = true;
      form.clearErrors();
    },
  };

  return { form, projectTypeList, totalCount, search, action };
}
