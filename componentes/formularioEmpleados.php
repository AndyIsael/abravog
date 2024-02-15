<div>
    <h4 class="titulo">Datos del empleado <span style="color: red">*</span></h4>
    <div class="row">
        <div class="input-field col s6 l4">
            <input id="clave" type="text" class="validate" minlength="1" value="<?php if (isset($empleado)) echo $empleado['clave_empleado']; ?>" required>
            <label for="clave">Clave del empleado <span style="color: red">*</span></label>
        </div>
        <div class="input-field col s6 l4">
            <input id="nombre" type="text" class="validate" minlength="1" value="<?php if (isset($empleado)) echo $empleado['nombre'] ?>" required>
            <label for="nombre">Nombre del empleado <span style="color: red">*</span></label>
        </div>
        <div class="input-field col s6 l4">
            <input id="fcnacimiento" type="text" class="validate" minlength="1" value="<?php if (isset($empleado)) echo $empleado['fecha_nacimiento'] ?>" required>
            <label for="fcnacimiento">Fecha de nacimiento <span style="color: red">*</span></label>
        </div>
        <div class="input-field col s6 l4">
            <select id="genero" class="validate" name="genero" required>
                <option disabled selected value="">Género</option>
                <option value="1">Masculino</option>
                <option value="2">Femenino</option>
            </select>
            <label for="genero">Selecciona un género <span style="color: red">*</span></label>
        </div>
        <div class="input-field col s6 l4">
            <input id="sueldo" type="text" class="validate" minlength="1" value="<?php if (isset($empleado)) echo $empleado['sueldo_base'] ?>" required>
            <label for="sueldo">Sueldo base $ <span style="color: red">*</span></label>
        </div>
    </div>

    <h4 class="titulo">Detalle del empleado <span style="color: red">*</span></h4>
    <div class="row">
        <div class="input-field col s6 l4">
            <input id="puesto" type="text" class="validate" minlength="1" value="<?php if (isset($empleado)) echo $empleado['puesto'] ?>" required>
            <label for="puesto">Puesto <span style="color: red">*</span></label>
        </div>
        <div class="input-field col s6 l4">
            <input id="xprofecional" type="text" class="validate" minlength="1" value="<?php if (isset($empleado)) echo $empleado['experiencia_profesional'] ?>" required>
            <label for="xprofecional">Experiencia Profesional <span style="color: red">*</span></label>
        </div>
    </div>
</div>