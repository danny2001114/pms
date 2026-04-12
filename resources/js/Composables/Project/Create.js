import { useForm, router } from '@inertiajs/vue3';
import { useSetOption } from '@/Utilities/helpers';

export default function (props) {
    // ==== vars ==== //
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
            options: useSetOption(props.stateOptions)
        },
        type_id: {
            type: 'select',
            label: 'Type',
            options: useSetOption(props.projectTypeOptions)
        },
        priority: {
            type: 'select',
            options: useSetOption(props.priorityOptions)
        },
        start_date: {
            type: 'date'
        },
        end_date: {
            type: 'date'
        },
    };

    // ==== actions ==== //
    function submit() {
        form.post(route('project.store'));
    }

    function back() {
        router.visit(route('project.index'));
    }

    // ==== export ==== //
    return {
        form,
        fields,
        submit,
        back
    };
}
