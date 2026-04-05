import { useForm } from '@inertiajs/vue3';

export default function (props) {
  const detail = props.project;
  const form = useForm({
    title: detail.title,
    order: detail.order,
    owner_id: detail.owner_id,
    state: detail.state,
    type_id: detail.type_id,
    priority: detail.priority,
    active: Boolean(detail.active),
    start_date: detail.start_date,
    end_date: detail.end_date,
    description: detail.description,
  });
  
  const submit = () => {
    form.put(route('project.update', detail.id));
  };

  return { form, submit };
}
