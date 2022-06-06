import App from './components/App'
import User from './components/User'

const routes = [
    {
        path: '/',
        component: App,
        name: 'index',
    },
    {
        path: '/users',
        component: User,
        name: 'user',
    }
];

export default routes;
