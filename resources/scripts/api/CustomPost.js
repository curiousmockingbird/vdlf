import httpClient from './httpClient';


export default class CustomPost{
    static END_POINT = '/news-updates/all';
    static END_PRESS_POINT = '/press-releases/all';
    static END_STAFF_POINT = '/staff/all';
    static END_PARTNER_POINT = '/partner/all';
    static END_HIGHLIGHT = '/highlights/all';
    
    static getHighlights(formData) {
        return httpClient.post(this.END_HIGHLIGHT, formData);
    }

    static getNews(formData) {
        return httpClient.post(this.END_POINT, formData);
    }
    static getPress(formData) {
        return httpClient.post(this.END_PRESS_POINT, formData);
    }
    static getStaff(formData) {
        return httpClient.post(this.END_STAFF_POINT, formData);
    }
    static getPartner(formData) {
        return httpClient.post(this.END_PARTNER_POINT, formData);
    }
    //getNewsUpdates = (num) => http(END_POINT, { num });
}




