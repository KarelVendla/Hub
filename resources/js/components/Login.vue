<template>
    <div class="container">
        <div class="form-group p-5">
            Login
            <div>
                <form action="" method="post">
                    <input class="form-control" name="username" placeholder="Username" type="text"/>
                    <input class="form-control" name="password" placeholder="Password" type="password"/>
                    <button class="btn btn-primary p-2 mt-3" type="submit">Sign in</button>
                </form>        
            </div>
            <router-link to="/register" >Sign up</router-link>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {

        }
    }
</script>
