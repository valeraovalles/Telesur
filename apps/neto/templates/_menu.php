<div id="menu">
    <ul class="menu">
        <li><a href="<?php echo url_for('generar/index')?>"><span>INICIO</span></a></li>
        <li><a href="/Telesur/web"><span>APLICACIONES</span></a></li>
        
        <li><a href="#" class="parent"><span>ADMINISTRACION</span></a>
                <div><ul>
                    <li><a href="#" class="parent"><span>Usuarios</span></a>
                        <div><ul>
                            <li><a href="<?php echo url_for('@sf_guard_user')?>"><span>Listado</span></a></li>
                            <li><a href="<?php echo url_for('@sf_guard_group')?>"><span>Grupos</span></a></li>
                            <li><a href="<?php echo url_for('@sf_guard_permission')?>"><span>Permisos</span></a></li>
                        </ul></div>
                    </li>
                    <li><a href="<?php echo url_for('sincronizar/index')?>"><span>Sincronizar BD</span></a></li>
                 </ul></div>
            </li>
        
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