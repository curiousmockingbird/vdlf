import httpClient from './httpClient';

export default class Stories {

    static getAction(formData) {
        return httpClient.post('/action/all', formData);
    }
    static getUpdates(formData) {
        return httpClient.post('/updates/all', formData);
    }
}
