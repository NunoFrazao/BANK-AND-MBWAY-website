<template>
    <footer id="main-footer" class="footer pt-3">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-6 mb-sm-4">
                    <div class="copyright text-center text-sm text-muted">
                        <span class="footer-text">Made by </span>
                        <a href="/" class="font-weight-bold footer-text" target="_blank">
                            Ivo Ferreira, João Onofre, José Parreira e Nuno Frazão
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</template>

<script>

</script>

<style scoped>
footer#main-footer {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 3.5rem;
    background-color: #fff;
    border-top: 1px solid #d7d7d7;
    z-index: 9999;
}

@media (max-width: 992px) {
    footer#main-footer .footer-text {
        font-size: 0.7rem;
    }
}
</style>