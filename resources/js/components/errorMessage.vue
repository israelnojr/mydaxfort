<template>
    <div class="container">
        <ul class="alert alert-danger alert-dismissible fade show flash">
            <li class="list-group item" v-for="error in errors" :key="errors.indexOf(error)" >
                {{error}}
                <button type="button" class="close">
                    <span aria-hidden="true">
                        X
                    </span>
                </button>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
