import axios from 'axios'

const apiClient = axios.create({
    baseURL: 'http://localhost:8461/api', 
    header: {
        'Content-Type': 'applicatio/json',
    },
});

apiClient.interceptors.request.use(
    (config) => {
        const token = localStorage.getItem('token');
        if (token) {
            config.headers['Authorization'] = `Bearer ${token}`;
        }
        return config;
    },
    (error) => {
        return Promise.reject(error);
    }
);

export default {
    getPosts() {
        return apiClient.get('/posts');
    },
    getPost(slug) {
        return apiClient.get(`/posts/${slug}`);
    },
    login(credentials) {
        return apiClient.post('/login', credentials);
    },
    createPost(data) {
        return apiClient.post('/posts', data);
    },
    updatePost(slug, data) {
        return apiClient.put(`/posts/${slug}`, data);
    },
    deletePost(slug) {
        return apiClienct.delete(`/posts/${slug}`);
    }
};