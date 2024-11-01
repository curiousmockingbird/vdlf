import HmacSHA1 from 'crypto-js/hmac-sha1';
import Base64 from 'crypto-js/enc-base64';

export default class Contact {
    static submitForm(dataJson) {
        var d = new Date();
        var expiration = 3600; // 1 hour,
        var unixtime = parseInt(d.getTime() / 1000);
        var future_unixtime = unixtime + expiration;
        var publicKey = SETTINGS.gf_public;
        var privateKey = SETTINGS.gf_private;
        var method = "POST";
        let data = JSON.parse(dataJson);
        var route = "forms/" + data.form_id + "/submissions";

        var stringToSign = publicKey + ":" + method + ":" + route + ":" + future_unixtime;

        var hash = HmacSHA1(stringToSign, privateKey);
        var base64 = hash.toString(Base64);
        var sig = encodeURIComponent(base64);
        var url = SETTINGS.app_url + '/gravityformsapi/' + route + '?api_key=' + publicKey + '&signature=' + sig + '&expires=' + future_unixtime;
        return axios.post(url, dataJson).then((response) => {
            return response.data;
        });
    }
};
