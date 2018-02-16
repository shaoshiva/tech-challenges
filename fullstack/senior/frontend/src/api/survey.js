import { Client } from 'node-rest-client';

const client = new Client();

const baseUrl = 'http://localhost:8080/api';

// registering remote methods
client.registerMethod('aggregationByCode', baseUrl+'/survey/statistics/aggregationByCode/${code}', 'GET');

export default client;
