import { useForm } from "@inertiajs/vue3";

export default function () {
    // ==== vars ==== //
    const form = useForm({
        code: '',
        password: ''
    });

    // ==== actions ==== //
    function submit() {
        form.post(route('login'));
    }

    // ==== export ==== //
    return {
        form,
        submit
    }
}
