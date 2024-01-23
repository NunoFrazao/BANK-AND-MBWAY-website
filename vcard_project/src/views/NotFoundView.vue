<template>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="card h-100 mb-4">
                        <div class="card-header pb-0 px-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <h1 class="display-5">404</h1>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-4 p-3">
                            <router-link to="/">
                                <span class="text-danger">Go to Home</span>
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>

</script>

<style scoped>
h1,
a,
span {
    text-decoration: none;
    background: -webkit-linear-gradient(310deg, #141727 0%, #3A416F 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    transition: .1s ease;
}

span:hover,
a:hover {
    cursor: pointer;
    transform: scale(2);
}
</style>