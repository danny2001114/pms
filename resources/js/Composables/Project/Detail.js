import { useForm } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import { useSetOption } from '@/Utilities/helpers';

export default function (props) {
  const detail = props.project;
  const isEdit = ref(false);
  const form = useForm({
    title: detail.title,
    owner_code: detail.owner.code,
    state: detail.state,
    type_id: detail.type_id,
    priority: detail.priority,
    active: detail.active,
    start_date: detail.start_date,
    end_date: detail.end_date,
    description: detail.description,
  });

  const fields = {
    owner_code: {
      type: 'text',
    },
    state: {
      type: 'select',
      options: useSetOption(props.state_options)
    },
    type_id: {
      type: 'select',
      label: 'Type',
      options: useSetOption(props.project_type_options)
    },
    priority: {
      type: 'select',
      options: useSetOption(props.priority_options)
    },
    start_date: {
      type: 'date'
    },
    end_date: {
      type: 'date'
    },
  };

  const info = computed(() => ({
    code: props.project.code,
    owner: props.project.owner.name + `(${props.project.owner.code})`,
    state: props.project.state_text,
    type: props.project.type.label,
    priority: props.project.priority_text,
    start_date: props.project.start_date,
    end_date: props.project.end_date,
  }));

  const submit = () => {
    form.put(route('project.update', detail.id), {
      onSuccess: () => {
        form.clearErrors();
        isEdit.value = false;
      }
    });
  };

  const edit = () => {
    isEdit.value = true;
  }

  const back = () => {
    form.reset();
    form.clearErrors();
    isEdit.value = false;
  };

  return { form, fields, info, isEdit, edit, submit, back };
}
