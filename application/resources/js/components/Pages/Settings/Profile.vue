<template>
    <section class="h-100 gradient-custom-2">
        <div class="container">
            <div class="main-body">
                <div class="row gutters-sm">
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin"
                                        class="rounded-circle" width="150">
                                    <div class="mt-3">
                                        <h4>{{ detailuser.account_name }}</h4>
                                        <p class="text-secondary mb-1">{{ detailuser.account_privileges.account_dept }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-3">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-globe mr-2 icon-inline">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <line x1="2" y1="12" x2="22" y2="12"></line>
                                            <path
                                                d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z">
                                            </path>
                                        </svg>Website</h6>
                                    <span class="text-secondary">https://bootdey.com</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-github mr-2 icon-inline">
                                            <path
                                                d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22">
                                            </path>
                                        </svg>Github</h6>
                                    <span class="text-secondary">bootdey</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-twitter mr-2 icon-inline text-info">
                                            <path
                                                d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z">
                                            </path>
                                        </svg>Twitter</h6>
                                    <span class="text-secondary">@bootdey</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-instagram mr-2 icon-inline text-danger">
                                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                        </svg>Instagram</h6>
                                    <span class="text-secondary">bootdey</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-facebook mr-2 icon-inline text-primary">
                                            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z">
                                            </path>
                                        </svg>Facebook</h6>
                                    <span class="text-secondary">bootdey</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Username</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" v-model="detailuser.account_username" disabled>
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Full Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" v-model="detailuser.account_name" disabled>
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Password</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" v-model="detailuser.account_password" disabled>
                                        <i class="fa-solid fa-eye"></i>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Departemen</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" v-model="detailuser.account_privileges.account_dept"
                                            disabled>
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Role</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" v-model="detailuser.account_privileges.title" disabled>
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div data-app>
                                        <v-row justify="center">
                                            <v-dialog v-model="dialog" persistent max-width="600px">
                                                <template v-slot:activator="{ on, attrs }">
                                                    <v-btn color="primary" dark v-bind="attrs" v-on="on">
                                                        Edit User
                                                    </v-btn>
                                                </template>
                                                <v-card>
                                                    <v-card-title>
                                                        <span class="text-h5">Edit User Profile</span>
                                                    </v-card-title>
                                                    <v-card-text>
                                                        <v-container>
                                                            <v-row>
                                                                <v-col cols="12" sm="6" md="4">
                                                                    <v-text-field label="Username*"
                                                                        v-model="detailuser.account_username"
                                                                        :rules="usernameRules" color="blue" required>
                                                                    </v-text-field>
                                                                </v-col>
                                                                <v-col cols="12">
                                                                    <v-text-field label="FullName*"
                                                                        v-model="detailuser.account_name"
                                                                        :rules="fullnameRules" required>
                                                                    </v-text-field>
                                                                </v-col>
                                                                <v-col cols="12">
                                                                    <v-text-field label="Password*"
                                                                        v-model="detailuser.account_password"
                                                                        :rules="passwordRules" type="password" required>
                                                                    </v-text-field>
                                                                </v-col>
                                                                <v-col cols="12" sm="6">
                                                                    <v-select :items="listdept" label="Departemen*"
                                                                        item-text="text" item-value="value"
                                                                        v-model="detailuser.account_privileges.account_dept"
                                                                        required outlined></v-select>
                                                                </v-col>
                                                                <v-col cols="12" sm="6">
                                                                    <v-select :items="listrole" label="Role*"
                                                                        item-text="text" item-value="value"
                                                                        v-model="detailuser.account_privileges.title"
                                                                        required outlined></v-select>
                                                                </v-col>
                                                            </v-row>
                                                        </v-container>
                                                        <small>*indicates required field</small>
                                                    </v-card-text>
                                                    <v-card-actions>
                                                        <v-spacer></v-spacer>
                                                        <v-btn color="blue darken-1" text @click="closedialog">
                                                            Close
                                                        </v-btn>
                                                        <v-btn color="blue darken-1" text @click="saveuser">
                                                            Save
                                                        </v-btn>
                                                    </v-card-actions>
                                                </v-card>
                                            </v-dialog>
                                        </v-row>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="row gutters-sm">
                            <div class="col-sm-6 mb-3">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h6 class="d-flex align-items-center mb-3"><i
                                                class="material-icons text-info mr-2">assignment</i>Project Status</h6>
                                        <small>Web Design</small>
                                        <div class="progress mb-3" style="height: 5px">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: 80%"
                                                aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <small>Website Markup</small>
                                        <div class="progress mb-3" style="height: 5px">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: 72%"
                                                aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <small>One Page</small>
                                        <div class="progress mb-3" style="height: 5px">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: 89%"
                                                aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <small>Mobile Template</small>
                                        <div class="progress mb-3" style="height: 5px">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: 55%"
                                                aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <small>Backend API</small>
                                        <div class="progress mb-3" style="height: 5px">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: 66%"
                                                aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h6 class="d-flex align-items-center mb-3"><i
                                                class="material-icons text-info mr-2">assignment</i>Project Status</h6>
                                        <small>Web Design</small>
                                        <div class="progress mb-3" style="height: 5px">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: 80%"
                                                aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <small>Website Markup</small>
                                        <div class="progress mb-3" style="height: 5px">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: 72%"
                                                aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <small>One Page</small>
                                        <div class="progress mb-3" style="height: 5px">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: 89%"
                                                aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <small>Mobile Template</small>
                                        <div class="progress mb-3" style="height: 5px">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: 55%"
                                                aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <small>Backend API</small>
                                        <div class="progress mb-3" style="height: 5px">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: 66%"
                                                aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        <!-- </div> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
import {useTimer} from '../../../../Stores/Timer'
export default {
    props: ['id'],
    setup() {
        const timerstore = useTimer();
        return { timerstore }
    },
    data() {
        return {
            defaultSelected: "Departemen Paneling",
            dialog: false,
            detailuser: {
                account_privileges: {
                },
            },
            listdept: [],
            listrole: [{ text: "Super Admin Role", value: "Super Admin Role", },
            { text: "Admin Role", value: "Admin Role", },
            { text: "Staff Role", value: "Staff Role", },],
            //rules
            usernameRules: [
                v => !!v || 'Username is required',
                v => v.length <= 20 || 'username must be less than 20 characters',
                v => v.length > 3 || 'username must be more than 4 characters',
            ],
            fullnameRules: [
                v => !!v || 'Name is required',
                v => v.length <= 20 || 'Name must be less than 20 characters',
                v => v.length > 3 || 'Name must be more than 4 characters',
            ],
            passwordRules: [
                v => !!v || 'Password is required',
                v => v.length <= 20 || 'password  length must be less than 20 ',
                v => v.length >= 5 || 'password length must be more than 4',
            ],
            errors: {}
        }
    },
    onIdle() {
        this.timerstore.LogoutTimers()
        console.log("hellow")
    },
    mounted() {
        this.getUser(),
        this.getlistdepartemen()
    },
    methods: {
        getUser() {
            axios.get('/api/users/' + this.id).then((response) => {
                this.detailuser = response.data
            })
        },
        getlistdepartemen() {
            axios.post('/api/getlistdepartemennorole').then((response) => {
                this.listdept = response.data.data
            })
        },
        closedialog() {
            this.dialog = false
            this.errors = {}
            this.getUser()
        },
        saveuser() {
            console.log(this.detailuser)
            axios.post('/api/saveuser', this.detailuser).then((response) => {
                console.log(response)
                if(response.data.statusresponse=200){
                    this.$swal({
                        title: 'User Baru Berhasil diupdate',
                        icon: 'success'
                    });
                    this.dialog = false
                }
              
            }).catch((error) => {
                this.errors = error.response.data.errors
                let text = ""
                if(this.errors.account_username){
                    text= text + '<li>'+ this.errors.account_username +'</li>'
                }
                if(this.errors.account_name){
                    text= text + '<li>'+ this.errors.account_name +'</li>'
                }
                if(this.errors.account_password){
                    text= text + '<li>'+ this.errors.account_password +'</li>'
                }
                this.$swal({
                    title: "Terdapat Kesalahan pengisian form",
                    html: '<ol>'+ text +'</ol>',
                    icon: 'error'
                });
            })
        }
    },
}
</script>

<style scoped>
.text-green input {
    color: green !important;
}
</style>
