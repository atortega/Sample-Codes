import store from './store'

const Welcome = () => import('./components/home/Welcome.vue' /* webpackChunkName: "resource/js/components/welcome" */)
const CategoryList = () => import('./components/admin/category/List.vue' /* webpackChunkName: "resource/js/components/category/list" */)
const CategoryCreate = () => import('./components/admin/category/Add.vue' /* webpackChunkName: "resource/js/components/category/add" */)
const CategoryEdit = () => import('./components/admin/category/Edit.vue' /* webpackChunkName: "resource/js/components/category/edit" */)
const Login = () => import('./components/Login.vue' /* webpackChunkName: "resource/js/components/login" */)
const Register = () => import('./components/Register.vue' /* webpackChunkName: "resource/js/components/Register" */)
const UsersList = () => import('./components/admin/user/List.vue' /* webpackChunkName: "resource/js/components/admin/user/list" */)
const ForgotPassword = () => import('./components/ForgotPassword.vue' /* webpackChunkName: "resource/js/components/ForgotPassword" */)
const Admin = () => import('./components/admin/Main.vue')
const SubcategoryList = () => import('./components/admin/subcategory/List.vue')
const SubcategoryCreate = () => import('./components/admin/subcategory/Add.vue')
const Rooms = () => import('./components/admin/rooms/List.vue')
const RoomCreate = () => import('./components/admin/rooms/Add.vue')
const Images = () => import('./components/admin/images/List.vue')
const ImagesCreate = () => import('./components/admin/images/Add.vue')
const TestimonyList = () => import('./components/admin/testimonials/List.vue')
const TestimonialCreate = () => import('./components/admin/testimonials/Add.vue')

export const routes = [
    {
        name: 'home',
        path: '/',
        components: {
            default: Welcome
        }
    },
    
    {
        name: 'login',
        path: '/login',
        component: Login,
        beforeEnter: (to, from, next) => {
            if (store.getters.isLoggedIn) {
                next({path: '/'})
            } else {
                next()
            }
        }
    },
    {
        name: 'forgotpassword',
        path: '/forgotpassword',
        component: ForgotPassword,
        beforeEnter: (to, from, next) => {
            if (store.getters.isLoggedIn) {
                next({path: '/'})
            } else {
                next()
            }
        }
        
    },
    {
        name: 'register',
        path: '/register',
        component: Register,
        beforeEnter: (to, from, next) => {
            if (store.getters.isLoggedIn) {
                next({path: '/'})
            } else {
                next()
            }
        }
    },
    {
        name: 'usersList',
        path: '/users',
        beforeEnter: (to, from, next) => {
            if (store.getters.isLoggedIn) {
                next()
            } else {
                next({path:'/login'})
            }
        },
        components: {
            admin_view: UsersList
        }
    },
    {
        name: 'admin',
        path: '/admin',
        beforeEnter: (to, from, next) => {
            if (store.getters.isLoggedIn) {
                next()
            } else {
                next({path:'/login'})
            }
        },
        component: Admin,
        children: [
        {
            name: 'CategoryList',
            path: 'category',
            components: {
                admin_view: CategoryList
            },
        },
        {     
            name: 'categoryAdd',
            path: 'category/add',
            components: {
                admin_view: CategoryCreate
            }
           
        },
        {
            name: 'categoryEdit',
            path: '/category/:id/edit',
            components: {
                admin_view: CategoryEdit
            }
        },
        {
            name: 'SubcategoryList',
            path: 'subcategory',
            components: {
                admin_view: SubcategoryList
            },
        },
        {     
            name: 'SubcategoryAdd',
            path: 'subcategory/add',
            components: {
                admin_view: SubcategoryCreate
            }
           
        },
        {     
            name: 'Rooms',
            path: 'rooms',
            components: {
                admin_view: Rooms
            }
           
        },
        {     
            name: 'roomsAdd',
            path: 'rooms/add',
            components: {
                admin_view: RoomCreate
            }
           
        },
        {     
            name: 'Images',
            path: 'images',
            components: {
                admin_view: Images
            }
           
        },
        {     
            name: 'imagesAdd',
            path: 'images/add',
            components: {
                admin_view: ImagesCreate
            }
           
        },
        {     
            name: 'Testimonials',
            path: 'testimonials',
            components: {
                admin_view: TestimonyList
            }
           
        },
        {     
            name: 'testimonyAdd',
            path: 'testimonial/add',
            components: {
                admin_view: TestimonialCreate
            }
           
        },
        {
            path: 'users',
            components: {
                admin_view: UsersList
            }
        }]
        
    }
        

]