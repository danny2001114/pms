import { useForm } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import { useSetOption } from '@/Utilities/helpers';

export default function (props) {
    // ==== vars ==== //
    const form = useForm({
        title: props.project.title,
        owner_code: props.project.owner.code,
        state: props.project.state,
        type_id: props.project.type_id,
        priority: props.project.priority,
        active: props.project.active,
        start_date: props.project.start_date,
        end_date: props.project.end_date,
        description: props.project.description,
    });
    const fields = {
        owner_code: {
            type: 'text',
        },
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
    const isEdit = ref(false);

    // ==== computors ==== //
    const info = computed(() => ({
        code: props.project.code,
        owner: props.project.owner.name + `(${props.project.owner.code})`,
        state: props.project.state_text,
        type: props.project.type.label,
        priority: props.project.priority_text,
        start_date: props.project.start_date,
        end_date: props.project.end_date,
    }));

    // ==== actions ==== //
    function submit() {
        form.put(route('project.update', props.project.id), {
            onSuccess: () => {
                form.clearErrors();
                isEdit.value = false;
            }
        });
    }

    function edit() {
        isEdit.value = true;
    }

    function back() {
        form.reset();
        form.clearErrors();
        isEdit.value = false;
    }

    // ==== export ==== //
    return {
        form,
        fields,
        info,
        isEdit,
        submit,
        edit,
        back
    };
}
