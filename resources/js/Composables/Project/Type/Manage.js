import { router, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

export default function () {
    // ==== vars ==== //
    const form = useForm({
        id: '',
        label: '',
        remark: '',
        active: true,
    });
    const search = ref({
        label: ""
    });
    const fields = [
        { key: 'serial', label: '.No' },
        { key: 'label', label: 'Label' },
        { key: 'remark', label: 'Remark' },
        { key: 'active', label: 'Active' },
        { key: 'actions', label: 'Actions' }
    ];

    // ==== actions ==== //
    function store() {
        router.post(route('project.type.store'), form, {
            preserveState: true,
            onSuccess: () => {
                clear();
            },
            onError: (err) => {
                Object.assign(form.errors, err);
            }
        });
    }

    function edit(item) {
        form.clearErrors();
        Object.assign(form, item);
        form.active = Boolean(item.active);
    }

    function update() {
        router.put(route('project.type.update', form.id), form, {
            preserveState: true,
            onSuccess: () => {
                clear();
            },
            onError: (err) => {
                Object.assign(form.errors, err);
            }
        });
    }

    function destroy(id) {
        router.delete(route('project.type.destroy', id, {
            preserveState: true
        }));
    }

    function clear() {
        form.reset();
        form.active = true;
        form.clearErrors();
    }

    // ==== export ==== //
    return {
        form,
        search,
        fields,
        store,
        edit,
        update,
        destroy,
        clear
    };
}
