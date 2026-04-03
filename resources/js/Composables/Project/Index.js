import { router } from '@inertiajs/vue3';

export default function useProjectIndex() { 
    const destroy = (id, list) => {
      if (confirm('Are you sure you want to delete this project?')) {
        router.delete(route('project.destroy', id), {
          onSuccess: function () {
            
          }
        });
      }
    };

    return { destroy }
}
