<?php
include('../Administrativo/formulario.php');
?>

<h3>Asignar Tribunal</h3>
<br>
<form action='#' method='post'>
    <div class="form-group">
        <div class="form-group">
            <div class="form-group">
                <select width="50px" name="cbxDirector" class="form-control" aria-label="Default select example" required="true">
                <option value="">--- Director de Proyecto --- </option>
                    <?php
                            foreach ($usuario as $rows1) {                                
                                echo "<option value='" . $rows1[0] . "'>" . $rows1[1] . "</option>";
                            }

                            ?>
                </select>
            </div>
            <br>
            <div class="form-group">                
                <select name="cbxPresidente" class="form-control"  aria-label="Default select example" required="true">
                <option value="">--- Presidente de Proyecto --- </option>
                    <?php
                            foreach ($usuario as $rows1) {
                                echo "<option value='" . $rows1[0] . "'>" . $rows1[1] . "</option>";
                            }

                            ?>
                </select>
            </div>
            <br>
            <div class="form-group">
                <select name="cbxVocal" class="form-control" aria-label="Default select example" required="true">
                <option value="">--- Vocal de Proyecto --- </option>
                    <?php
                            foreach ($usuario as $rows1) {
                                echo "<option value='" . $rows1[0] . "'>" . $rows1[1] . "</option>";
                            }

                            ?>
                </select>
            </div>
            <BR>

            <div class="form-group">                
                <input type="text" class="form-control" id="codigo" name="estadoUTE" required="true"
                    placeholder="Estado UTE:">
            </div>
            <br>
            <div class="form-group">
                <input type="text" class="form-control" id="codigo" name="seccion" required="true"
                    placeholder="A que Sección pertenece:">
            </div>
            <br>
            <div class="form-group">
                <input type="text" class="form-control" id="codigo" name="periodo" required="true"
                    placeholder="En que Período esta?">
            </div>
            <br>
            <div class="form-group">
                <input type="text" class="form-control" id="codigo" name="seccion" required="true"
                    placeholder="Existe alguna observacion?:">
            </div>

            <br>
            <div class="form-group">
            <label for="start">Fecha de Finalización:</label>            
            <input type="date" class="paswordhept" id="start" name="fin">
            <br>
            <button type="submit" class="btn btn-default" name="aplicar">Aplicar</button>
            </div>
        </div>



</form>
