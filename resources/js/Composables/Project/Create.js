import { useForm } from '@inertiajs/vue3';

export default function () {
    const form = useForm({
      title: '',
      order: '',
      state: 1,
      type_id: '',
      priority: 1,
      active: true,
      start_date: new Date().toISOString().split('T')[0],
      end_date: '',
      description: '',
    });
    
    const submit = () => {
      form.post(route('project.store'));
    };

    return {form, submit};
}
