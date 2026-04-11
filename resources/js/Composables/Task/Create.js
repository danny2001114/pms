import { router, useForm } from '@inertiajs/vue3';
import { useSetOption } from '@/Utilities/helpers';

export default function (props) {
    // ==== vars ==== //
    const form = useForm({
        description: '',
        priority: 1,
        start_date: new Date().toISOString().split('T')[0],
        end_date: '',
    });
    const fields = {
        priority: {
            type: 'select',
            options: useSetOption(props.priorityOptions)
        },
        start_date: {
            type: 'date',
        },
        end_date: {
            type: 'date'
        },
    };

    // ==== actions ==== //
    function submit() {
        form.post(route('project.task.store', props.projectId));
    }

    function back() {
        router.visit(route('project.show', props.projectId));
    }

    // ==== export ==== //
    return {
        form,
        fields,
        submit,
        back
    };
}
