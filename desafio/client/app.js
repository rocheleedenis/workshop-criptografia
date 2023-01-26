const axios = require('axios');
const _sodium = require('libsodium-wrappers');
const dotenv = require('dotenv').config();

const privateKey = process.env.PRIVATE_KEY;
const apiEndpoint = process.env.BASE_URL;

const sign = async(text) => {
    await _sodium.ready;
    const sodium = _sodium;

    const signedText = sodium.crypto_sign_detached(
        text,
        Buffer.from(privateKey, 'hex')
    );

    return Buffer.from(signedText).toString('base64');
}

const instance = axios.create({
    baseURL: apiEndpoint,
    timeout: 300,
    headers: {
        'X-API-KEY': '123abc',
    }
});

const makeGet = async(url) => {
    const signedReq = await sign(`POST;${url}`);

    instance.defaults.headers.common['X-API-SIGNATURE'] = signedReq;

    const { data } = await instance.get(url);
}

makePost = async(url, params) => {
    const signedReq = await sign(`POST;${url};${JSON.stringify(params)}`);

    instance.defaults.headers.common['X-API-SIGNATURE'] = signedReq;

    const { data } = await instance.post(url, params);
}


// makeGet('/users');

makePost('/users', {
    username: 'yampi',
    name: 'Yamperson'
});