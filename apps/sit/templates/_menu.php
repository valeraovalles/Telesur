<div id="menu">
    <ul class="menu">
        <li><a href="<?php echo url_for('solicitud/index')?>"><span>INICIO</span></a></li>
        <li><a href="/Telesur/web"><span>APLICACIONES</span></a></li>
        
        <?php if($sf_user->hasCredential('sit_admin')){?>
        <li><a href="#" class="parent"><span>ADMINISTRACION</span></a>
                <div>
                    <ul>
                        <?php if($sf_user->isSuperAdmin()){ ?>
                        <li><a href="<?php echo url_for('unidades/index')?>"><span>Unidades</span></a></li>
                        <li><a href="<?php echo url_for('UsuarioUnidad/index')?>"><span>Usuario Unidad</span></a></li>
                        <?php }?>

                        <li><a href="<?php echo url_for('categorias/index')?>"><span>Categorias</span></a></li>
                        <li><a href="<?php echo url_for('tickets/index')?>"><span>Gestionar Tikets</span></a></li>
                        <li><a href="<?php echo url_for('tickets_asignados/index')?>"><span>Tikets Asignados</span></a></li>
                        <li><a href="<?php echo url_for('tickets/mixtos')?>"><span>Mixtos</span></a></li>
                        <li><a href="<?php echo url_for('tickets/general')?>"><span>General</span></a></li>

                    </ul>
                </div>
        </li>
        
        <?php if($sf_user->isSuperAdmin()){ ?>
        <li><a href="#" class="parent"><span>REPORTES</span></a>
                <div>
                    <ul>
                        <li><a href="<?php echo url_for('reportes/index')?>"><span>Informe Gestión</span></a></li>
                    </ul>
                </div>
        </li>
        <?php }}?>
        
        <li><a href="<?php echo url_for("sfGuardAuth/signout")?>"><span>SALIR</span></a></li>
    </ul>
</div>
        
        
        <!--
        <li><a href="#" class="parent"><span>Home</span></a>
            <div><ul>
                <li><a href="#" class="parent"><span>Sub Item 1</span></a>
                    <div><ul>
                        <li><a href="#" class="parent"><span>Sub Item 1.1</span></a>
                            <div><ul>
                                <li><a href="#"><span>Sub Item 1.1.1</span></a></li>
                                <li><a href="#"><span>Sub Item 1.1.2</span></a></li>
                            </ul></div>
                        </li>
                        <li><a href="#"><span>Sub Item 1.2</span></a></li>
                        <li><a href="#"><span>Sub Item 1.3</span></a></li>
                        <li><a href="#"><span>Sub Item 1.4</span></a></li>
                        <li><a href="#"><span>Sub Item 1.5</span></a></li>
                        <li><a href="#"><span>Sub Item 1.6</span></a></li>
                        <li><a href="#" class="parent"><span>Sub Item 1.7</span></a>
                            <div><ul>
                                <li><a href="#"><span>Sub Item 1.7.1</span></a></li>
                                <li><a href="#"><span>Sub Item 1.7.2</span></a></li>
                            </ul></div>
                        </li>
                    </ul></div>
                </li>
                <li><a href="#"><span>Sub Item 2</span></a></li>
                <li><a href="#"><span>Sub Item 3</span></a></li>
            </ul></div>
        </li>
        <li><a href="#" class="parent"><span>Product Info</span></a>
            <div><ul>
                <li><a href="#" class="parent"><span>Sub Item 1</span></a>
                    <div><ul>
                        <li><a href="#"><span>Sub Item 1.1</span></a></li>
                        <li><a href="#"><span>Sub Item 1.2</span></a></li>
                    </ul></div>
                </li>
                <li><a href="#" class="parent"><span>Sub Item 2</span></a>
                    <div><ul>
                        <li><a href="#"><span>Sub Item 2.1</span></a></li>
                        <li><a href="#"><span>Sub Item 2.2</span></a></li>
                    </ul></div>
                </li>
                <li><a href="#"><span>Sub Item 3</span></a></li>
                <li><a href="#"><span>Sub Item 4</span></a></li>
                <li><a href="#"><span>Sub Item 5</span></a></li>
                <li><a href="#"><span>Sub Item 6</span></a></li>
                <li><a href="#"><span>Sub Item 7</span></a></li>
            </ul></div>
        </li>
        <li><a href="#"><span>Help</span></a></li>
        <li class="last"><a href="#"><span>Contacts</span></a></li>
    </ul>
</div>
-->