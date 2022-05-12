import axios from "axios";

export function fetchOrders(filters) {
    let params = null;

    if (filters) {
        params = {};
        params.filter = filters;
    }

    return axios({
        method: 'get',
        url: 'http://localhost:8000/api/orders',
        responseType: 'json',
        headers: {
            'Access-Control-Allow-Origin': '*',
        },
        params: params,
    });
}
