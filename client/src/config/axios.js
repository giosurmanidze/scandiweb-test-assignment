import axios from 'axios';

const axiosInstance = axios.create({
    baseURL: 'https://scandiweb-test-assignment.site/',
    headers: {
        Accept: 'application/json',
        'Content-Type': 'application/x-www-form-urlencoded',
    },
});
export default axiosInstance;
