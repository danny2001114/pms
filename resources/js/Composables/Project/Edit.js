import { useForm } from '@inertiajs/vue3';

export default function useProjectEdit(project) {
  const form = useForm({
    title: project.title,
    description: project.description,
  });

  const submit = () => {
    form.put(route('project.update', project.id));
  };

  return { form, submit };
}
