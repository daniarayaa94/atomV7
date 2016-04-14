<div class="login-box">
    <div class="login-logo">
        <a href="admin"><b>Atom</b></a>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg">Iniciar sesion</p>

        <form action="<?php echo base_url();?>admin/login/iniciar_sesion_post" method="post">
            <div class="form-group has-feedback">
                <input type="email" class="form-control" placeholder="Email" name="email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Password" name="password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">

                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
            </div>
        </form>

    </div>
</div>