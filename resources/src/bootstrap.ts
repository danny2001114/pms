import axios from 'axios';

// Extend the Window interface to include axios
declare global {
	interface Window {
		axios: typeof axios;
	}
}

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
