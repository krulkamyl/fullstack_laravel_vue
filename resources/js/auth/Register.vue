<template>
    <div class="w-50 m-auto">
        <div class="card card-body">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" placeholder="Enter your name" class="form-control" v-model="user.name"
                    :class="[{'is-invalid': this.errorFor('name')}]" />
                <v-errors :errors="errorFor('name')"></v-errors>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" placeholder="Enter your e-mail" class="form-control" v-model="user.email"
                    :class="[{'is-invalid': this.errorFor('email')}]" />
                <v-errors :errors="errorFor('email')"></v-errors>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Enter your password" class="form-control"
                    v-model="user.password" :class="[{'is-invalid': this.errorFor('password')}]" />
                <v-errors :errors="errorFor('password')"></v-errors>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Re-type password</label>
                <input type="password" name="password_confirmation" placeholder="Confirm your password" class="form-control"
                    v-model="user.password_confirmation" :class="[{'is-invalid': this.errorFor('password_confirmation')}]" />
                <v-errors :errors="errorFor('password_confirmation')"></v-errors>
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-lg btn-block" :disabled="loading" @click="register">
                    Register
                </button>
            </div>

            <hr />

            <div>
                Already have an account?
                <router-link :to="{name: 'login'}" class="font-weight-bold">Log-in</router-link>
            </div>

        </div>
    </div>
</template>

<script>
    import ValidationErrors from '../shared/mixins/ValidationErrors';
    import { logIn } from './../shared/Utils/auth';
    export default {
        mixins: [ValidationErrors],
        data() {
            return {
                loading: false,
                user: {
                    name: null,
                    email: null,
                    password: null,
                    password_confirmation: null
                }
            }
        },
        methods: {
            async register() {
                this.loading = true;
                this.errors = null;

                try {
                    const response = await axios.post('http://127.0.0.1:8000/register', this.user);    
                    if (response.status == 201) {
                        logIn();

                        this.$store.dispatch("loadUser");
                        this.$router.push({name: "home"});
                    }

                } catch (error) {
                    this.errors = error.response && error.response.data.errors;
                }

                this.loading = false;
            }
        }
    }

</script>
