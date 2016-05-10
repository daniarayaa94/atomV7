
<div class="col-sm-12 form-horizontal">

    <div class="col-sm-6">

        <div class="form-group" style="padding-left: 30px;padding-top: 15px;">
            <p><b>Usuario: </b><?php echo $cotizacion->nombre; ?></p>
        </div>

        <div class="form-group" style="padding-left: 30px">
            <p><b>Fecha: </b><?php echo $cotizacion->fechaSolicitud; ?></p>
        </div>

        <div class="form-group" style="padding-left: 30px">
            <p><b>Comentarios: </b><?php echo $cotizacion->comentarios; ?></p>
        </div>
    </div>

    <div class="col-sm-6">

        <div class="form-group" style="padding-left: 30px;padding-top: 15px;">
            <p><b>Estado: </b><?php echo $cotizacion->estado; ?></p>
        </div>

        <?php if($cotizacion->estado == 'Respondida'){?>
            <div class="form-group" style="padding-left: 30px;padding-top: 15px;">
                <p><b>Fecha Respuesta: </b><?php echo $cotizacion->fechaRespuesta; ?></p>
            </div>
        <?php }?>
        
        
    </div>

</div>

<div class="box-body col-sm-12">



    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Marca</th>
                <th>Unidad ($)</th>
                <th>Cantidad</th>
                <th>Subtotal</th>

            </tr>
            </thead>
            <tbody>

            <?php if (sizeof($productos_list) == 0){ ?>
                <td class="text-center" colspan="9">Sin registros.</td>
            <?php }else {
                  foreach ($productos_list as $row){ ?>
            <tr>
                <td class="text-center"><img src="<?php echo base_url()."assets/".explode(";",$row['imagenes'])[0] ?>" alt="<?php echo $row['nombre'] ?>" style="width: 50px;height: 50px;" class="img-thumbnail"></td>
                <td class="text-left"><?php echo $row['nombre'] ?></td>
                <td class="text-left"><?php echo $row['marca'] ?></td>
                <td class="text-left"><?php echo $row['valor'] ?></td>
                <td class="text-left"><?php echo $row['cantidad'] ?></td>
                <td class="text-left"><?php echo $row['subtotal'] ?></td>

            </tr>

            <?php }
            }?>

            <tr>
                <td class="text-center"></td>
                <td class="text-left"></td>
                <td class="text-left"></td>
                <td class="text-left"></td>
                <td class="text-left"><b>Total: </b></td>
                <td class="text-left"><?php echo $cotizacion->total; ?></td>

            </tr>


            </tbody>
        </table>

        <div class="box-footer" id="descargar" hidden>
            <a class="btn btn-success" id="download" data-toggle="tooltip" title="" data-original-title="Descargar excel">
                                            <i class="fa fa-file-excel-o"></i> Descargar excel</a>
        </div>

        <div class="form-group" id="respuesta">

            <div class="box-header with-border">
                <h3 class="box-title">Respuesta</h3>
            </div>

            <div id="editor" class="mailbox-read-message" >

                <form id="send" method="post" class="form-horizontal">

                    <div class="form-group" >
                        <textarea id="editor1" name="editor1" rows="20" cols="80" ></textarea>
                    </div>

                    <input type="text" value="" id="idCot" name="idCot" hidden/>

                    <div class="box-footer" >
                        <!--<a href="<?php echo $descargar_excel;?>" class="btn btn-success" id="download" data-toggle="tooltip" title="" data-original-title="Descargar excel">
                                            <i class="fa fa-cloud-download"></i> Descargar excel</a>-->

                        <button type="submit" class="btn btn-info pull-right"  data-whatever="@mdo">Enviar</button>
                    </div>


                </form>
            </div>

           
        </div>

    </div>
    
</div><!-- /.box-body -->