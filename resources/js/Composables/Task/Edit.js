import { router, useForm } from '@inertiajs/vue3';
import { useSetOption } from '@/Utilities/helpers';

export default function (props) {
    // ==== vars ==== //
    const form = useForm({
        description: props.task.description,
        priority: props.task.priority,
        state: props.task.state,
        start_date: props.task.start_date,
        end_date: props.task.end_date,
    });
    const fields = {
        state: {
            type: 'select',
            options: useSetOption(props.stateOptions)
        },
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
        form.put(route('project.task.update', [props.projectId, props.task.id]));
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
