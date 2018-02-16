import { Client } from 'node-rest-client';

const client = new Client();

/**
 * The base URL of the API.
 */
const baseUrl = 'http://localhost:8080/api';

/**
 * Returns an absolute API URI path.
 *
 * @param path
 * @returns {*}
 */
function url(path) {
    return baseUrl + path;
}

/**
 * Registers remote methods
 */
client.registerMethod('answersAggregationByCode', url('/survey/${code}/answersAggregation'), 'GET');
client.registerMethod('answersByCode', url('/survey/${code}/answers'), 'GET');

export default client;
