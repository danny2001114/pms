import { router } from '@inertiajs/vue3';

export default function useProjectIndex() {
    const fields = [
      { key: 'id', label: 'ID' },
      { key: 'title', label: 'Title' },
      { key: 'description', label: 'Description' },
      { key: 'actions', label: 'Actions' },
    ];
    
    const destroy = (id) => {
      if (confirm('Are you sure you want to delete this project?')) {
        router.delete(route('project.destroy', id));
      }
    };

    return { fields, destroy }
}
