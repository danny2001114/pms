import { router } from '@inertiajs/vue3';

export default function () {
    // ==== actions ==== //
    function destroy(projectId, id) {
        if (confirm('Are you sure you want to delete this project?')) {
            router.delete(route('project.destroy', [projectId, id]));
        }
    }

    // ==== export ==== //
    return { 
        destroy 
    }
}
