<!--  Scripts-->
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="js/materialize.js"></script>
<script src="js/init.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var elems = document.querySelectorAll('.modal');
        var options = {dismissible: false}
        var instances = M.Modal.init(elems, options);
    });

    document.addEventListener('DOMContentLoaded', function () {
        var elems = document.querySelectorAll('select');
        var instances = M.FormSelect.init(elems);
    });

    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.datepicker');

        var options = {
            format: 'dd/mm/yyyy',
            i18n: {
                months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Set", "Oct", "Nov", "Dic"],
                weekdays: ["Domingo","Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
                weekdaysShort: ["Dom","Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
                weekdaysAbbrev: ["D","L", "M", "M", "J", "V", "S"],
                cancel: 'Cancelar',
                done: 'Aceptar'
            }
        }
        var instances = M.Datepicker.init(elems, options);
    });
</script>
</body>
</html>
