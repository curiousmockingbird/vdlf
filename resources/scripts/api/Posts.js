import httpClient from './httpClient';

export default class Stories {

    static getAction(formData) {
        return httpClient.post('/action/all', formData);
    }
    static getUpdates(formData) {
        return httpClient.post('/updates/all', formData);
    }
    static getCategories(formData) {
        return httpClient.post('/categories/all', formData);
    }
    static getStaff(formData) {
        return httpClient.post('/staff/all', formData);
    }
}
