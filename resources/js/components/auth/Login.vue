<template>
    <div>
       <!-- <div class="alert alert-danger" v-if="error">
          <p>Sign in fail. Please try again!</p>
        </div> -->
        <!-- <form autocomplete="off" @submit.prevent="login" method="post">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" class="form-control" v-model="user.name" placeholder="username"  required>
            </div>
            <div class="form-group">
                <label for="password">Password </label>
                <input type="password" id="password" class="form-control" v-model="user.password" required>
            </div>
            <button class="btn btn-secondary" type="submit">Sign In</button>
        </form> -->
        <div class="wrapper" >
            <div id="formContent">
                <!-- Tabs Titles -->
                <h2 v-bind:class="{active: isLogin}" v-on:click="signIn"> Sign In </h2>
                <h2 v-bind:class="{active: !isLogin}" v-on:click="signUp">Sign Up </h2>

                <!-- Login Form -->
                <form v-if="isLogin" autocomplete="off" v-on:submit.prevent="login">
                    <input type="text" class="fadeIn second" name="name" placeholder="name" v-model="user.name">
                    <div class="alert-error" role="alert" v-if="error && errors.name">
                        {{errors.name[0]}}
                    </div>

                    <input type="password" class="fadeIn third" name="password" placeholder="password" v-model="user.password">
                    <div class="alert-error" role="alert" v-if="error && errors.password">
                        {{errors.password[0]}}
                    </div>


                    <input type="submit" class="fadeIn fourth" value="Log In">
                </form>

                <form v-else autocomplete="off" v-on:submit.prevent="register">
                    <input type="text"  class="fadeIn second" name="name" placeholder="name" v-model="userRegister.name">
                    <div class="alert-error" role="alert" v-if="error && errors.name">
                        {{errors.name[0]}}
                    </div>

                    <input type="email"  class="fadeIn second" name="email" placeholder="email" v-model="userRegister.email">
                    <div class="alert-error" role="alert" v-if="error && errors.email">
                        {{errors.email[0]}}
                    </div>

                    <input type="password"  class="fadeIn third" name="password" placeholder="password" v-model="userRegister.password">


                    <input type="password"  class="fadeIn third" name="password_confirmation"
                        v-model="userRegister.password_confirmation" placeholder="password confirmation">
                    <div class="alert-error" role="alert" v-if="error && errors.password">
                        {{errors.password[0]}}
                    </div>

                    <input type="submit" class="fadeIn fourth" value="Register">
                </form>

                <!-- Remind Passowrd -->
                <div id="formFooter">
                    <!-- use the modal component, pass in the prop -->

                </div>

            </div>
        </div>
    </div>
</template>

<script>
// import modalMeo from "./ModelTest"
export default {

    data() {
        return {
            isLogin: true,
            user: {
                name: "",
                password: "",
            },
            userRegister: {
                name: "",
                email: "",
                password: "",
                password_confirmation: "",
            },
            error: false,
            errors: {

            }
        }
    },
    methods: {
        login: function () {
            // confirm(this.$store.state.auth.user.name);
            // confirm(this.user.password);
            axios.post("/api/auth/login", {
                name: this.user.name,
                password: this.user.password
            })
            .then(response => {
                //save token
                // console.log(response.data.user);
                this.error = false;
                localStorage.setItem(
                    'token',
                    response.data.token
                )
                window.location.replace("/");
            })
            .catch(error =>  {
                // handle error
                // console.log('ssssssssssssssssss');
                this.error = true;
                this.errors = error.response.data.error;
                console.log(error.response.data.error);
            })
        },
        register: function () {
            // confirm(this.$store.state.auth.user.name);
            // confirm(this.user.password);
            axios.post("/api/auth/register", {
                name: this.userRegister.name,
                email: this.userRegister.email,
                password: this.userRegister.password,
                password_confirmation: this.userRegister.password_confirmation,
            })
            .then(response => {
                //save token
                // console.log(response.data.user);
                this.error =  false;

                window.location.replace("/");
            })
            .catch(error =>  {
                // handle error
                // console.log('ssssssssssssssssss');
                this.error = true;
                this.errors = error.response.data.error;
                console.log(error.response.data.error);
            })
        },
        signIn: function() {
            this.isLogin = true;
            this.error = false;
            this.errors = {};
        },

        signUp: function() {
            this.isLogin = false;
            this.error = false;
            this.errors = {};
        }
    },
    computed: {


    },
    components: {
    }
}
</script>

<style scoped>


    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
    }

    html {
        background-color: #44475f;
    }

    body {
        font-family: "Poppins", sans-serif;
        height: 100vh;
    }

    a {
        color: #92badd;
        display:inline-block;
        text-decoration: none;
        font-weight: 400;
    }

    h2 {
        cursor: pointer;
        text-align: center;
        font-size: 16px;
        font-weight: 600;
        text-transform: uppercase;
        display:inline-block;
        margin: 40px 8px 10px 8px;
        color: #cccccc;
    }

    /* STRUCTURE */

    .wrapper {
        display: flex;
        align-items: center;
        flex-direction: column;
        justify-content: center;
        width: 100%;
        min-height: 100%;
        padding: 20px;
    }

    #formContent {
        -webkit-border-radius: 10px 10px 10px 10px;
        border-radius: 10px 10px 10px 10px;
        background: #fff;
        padding: 30px;
        width: 90%;
        max-width: 450px;
        position: relative;
        padding: 0px;
        -webkit-box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
        box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
        text-align: center;
    }

    #formFooter {
        background-color: #f6f6f6;
        border-top: 1px solid #dce8f1;
        padding: 25px;
        text-align: center;
        -webkit-border-radius: 0 0 10px 10px;
        border-radius: 0 0 10px 10px;
    }



    /* TABS */

    h2.inactive {
        color: #cccccc;
    }

    h2.active {
        color: #0d0d0d;
        border-bottom: 2px solid #5fbae9;
    }



    /* FORM TYPOGRAPHY*/

    input[type=button], input[type=submit], input[type=reset]  {
        background-color: #44475f;
        color: white;
        padding: 15px 80px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        text-transform: uppercase;
        font-size: 13px;
        -webkit-box-shadow: 0 10px 30px 0 rgba(79, 145, 179, 0.4);
        box-shadow: 0 10px 30px 0 #3e454866;
        -webkit-border-radius: 5px 5px 5px 5px;
        border-radius: 5px 5px 5px 5px;
        margin: 5px 20px 40px 20px;
        -webkit-transition: all 0.3s ease-in-out;
        -moz-transition: all 0.3s ease-in-out;
        -ms-transition: all 0.3s ease-in-out;
        -o-transition: all 0.3s ease-in-out;
        transition: all 0.3s ease-in-out;
    }

    input[type=button]:hover, input[type=submit]:hover, input[type=reset]:hover  {
        background-color: #203641;
    }

    input[type=button]:active, input[type=submit]:active, input[type=reset]:active  {
        -moz-transform: scale(0.95);
        -webkit-transform: scale(0.95);
        -o-transform: scale(0.95);
        -ms-transform: scale(0.95);
        transform: scale(0.95);
    }

    input[type=text], input[type=password], input[type=email] {
        background-color: #f6f6f6;
        border: none;
        color: #0d0d0d;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 5px;
        width: 85%;
        border: 2px solid #f6f6f6;
        -webkit-transition: all 0.5s ease-in-out;
        -moz-transition: all 0.5s ease-in-out;
        -ms-transition: all 0.5s ease-in-out;
        -o-transition: all 0.5s ease-in-out;
        transition: all 0.5s ease-in-out;
        -webkit-border-radius: 5px 5px 5px 5px;
        border-radius: 5px 5px 5px 5px;
    }

    input[type=text]:focus, input[type=password]:focus, input[type=email]:focus {
        background-color: #fff;
        border-bottom: 2px solid #5fbae9;
    }

    input[type=text]::-moz-focus-outer, input[type=password]::placeholder, input[type=email]::placeholder{
        color: #cccccc;
    }

    .alert-error{
        color: red;
    }

</style>
