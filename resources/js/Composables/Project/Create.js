import { router, useForm } from '@inertiajs/vue3';
import { useSetOption } from '@/Utilities/helpers';

export default function (props) {
  const form = useForm({
    title: '',
    state: 1,
    type_id: '',
    priority: 1,
    active: true,
    start_date: new Date().toISOString().split('T')[0],
    end_date: '',
    description: '',
  });

  const fields = {
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

  const submit = () => {
    form.post(route('project.store'));
  };

  const back = () => {
    router.visit(route('project.store'));
  };

  return { form, fields, submit, back };
}
