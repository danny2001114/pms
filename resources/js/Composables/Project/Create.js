import { useForm } from '@inertiajs/vue3';

export default function () {
    const form = useForm({
      title: '',
      description: '',
    });
    
    const submit = () => {
      form.post(route('project.store'));
    };

    return {form, submit};
}
