<footer>
    <div class="container">

        <div class="footer-up">

            <div class="footer-up-section">
                <div class="footer-up-section-content up">
                    <div class="content-image-logo">
                        <img src="resource/images/logo.svg">
                    </div>
                    <div class="items">
                        <a href="https://api.whatsapp.com/send?phone=+51<?= $empresa->Celular ?>" target="_blank">
                            <i class="fa fa-phone"></i> <?= $empresa->Celular ?>
                        </a>
                        <a href="mailto:<?= $empresa->Email ?>" target="_blank">
                            <i class="fa fa-envelope-o"></i> <?= $empresa->Email ?>
                        </a>
                        <a href="https://goo.gl/maps/qQ4iyjyR57Wosr4f6" target="_blank">
                            <i class="fa fa-map-marker"></i> <?= $empresa->Domicilio ?>
                        </a>
                    </div>
                </div>
                <div class="footer-up-section-content down">
                    <span>Aprende en nuestras redes:</span>
                    <div class="social-content">
                        <a href="https://twitter.com/" class="social-item" target="_blank" rel="noreferrer" title="Twitter">
                            <svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="twitter" class="svg-inline--fa fa-twitter fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path fill="currentColor" d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"></path>
                            </svg>
                        </a>
                        <a href="https://www.youtube.com/" class="social-item" target="_blank" rel="noreferrer" title="YouTube">
                            <svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="youtube" class="svg-inline--fa fa-youtube fa-w-18 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                <path fill="currentColor" d="M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z"></path>
                            </svg>
                        </a>
                        <a href="https://www.facebook.com/profile.php?id=100069510938768" class="social-item" target="_blank" rel="noreferrer" title="Facebook">
                            <svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="facebook-f" class="svg-inline--fa fa-facebook-f fa-w-10 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                <path fill="currentColor" d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"></path>
                            </svg>
                        </a>
                        <a href="https://www.instagram.com/" class="social-item" target="_blank" rel="noreferrer" title="Instagram">
                            <svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="instagram" class="svg-inline--fa fa-instagram fa-w-14 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path fill="currentColor" d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <div class="footer-middle-section">
                <div class="footer-middle-section-content">
                    <span>Explora</span>
                    <div class="category" style="border-left:solid 3px #9019d3">
                        <a href="./">Inicio</a>
                    </div>
                    <div class="category" style="border-left:solid 3px #7d9f0e">
                        <a href="./catalogo.php">Catálogo</a>
                    </div>
                    <div class="category" style="border-left:solid 3px #f34925">
                        <a href="./view">Administrar</a>
                    </div>
                </div>
            </div>

            <div class="footer-bottom-section">
                <div class="footer-bottom-section-content">
                    <span>Mapa de Ubicación</span>
                    <div class="text-left">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d975.4030912046085!2d-77.01095947081954!3d-12.070170199465723!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9105c89d8750c10b%3A0xa4ca7269ac5b74bc!2sJr.%20Francia%201798%2C%20Cercado%20de%20Lima%2015018!5e0!3m2!1sen!2spe!4v1630885103175!5m2!1sen!2spe" width="300" height="150" style="border:0;width:100%;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="layout-copyright">
                <span class="copyright">
                    Copyright ©
                    <script>
                        document.write(new Date().getFullYear());
                    </script>2021 Todos los derechos reservados |
                    Desarrollado por <a href="index.html" target="_blank" class="text-creator">SysSoft Integra</a>
                </span>
            </div>
        </div>

    </div>
</footer>