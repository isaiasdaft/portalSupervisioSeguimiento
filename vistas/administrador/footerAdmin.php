    <script src="../../librerias/jquery-3.7.1.min.js"></script>
    <script src="../../librerias/bootstrap4/bootstrap.min.js"></script>
    <script src="../../librerias/bootstrap4/popper.min.js"></script>
    <script src="../../librerias/sweetalert.min.js"></script>
    <script src="../../librerias/datatable/jquery.dataTables.min.js"></script>
    <script src="../../librerias/datatable/dataTables.bootstrap4.min.js"></script>

    <script>
        // JavaScript para agregar clases al cerrar sesión
        function cerrarSesion() {
            // Agrega las clases para la animación
            document.body.classList.add('logged-out', 'logged-out-effect');

            // Lógica real para cerrar sesión después de 2 segundos.
            setTimeout(function() {
                // Redirige a la página de inicio de sesión
                window.location.href = 'cerrar_sesion.php';

                // Quita las clases de animación después de 1 segundo adicional
                setTimeout(function() {
                    document.body.classList.remove('logged-out', 'logged-out-effect');
                }, 1000);
            }, 1000);
        }
    </script>


    </body>

    </html>