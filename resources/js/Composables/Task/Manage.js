import { router } from '@inertiajs/vue3';

export default function (props) {
    // ==== actions ==== //
    function destroy(id) {
        if (confirm('Are you sure you want to delete this task?')) {
            router.delete(route('project.task.destroy', [props.projectId, id]));
        }
    }

    // ==== exports ==== //
    return {
        destroy
    }
}
