

     <div class="container">  
         <?php
            echo $this->Form->create('User', array('type' => 'post', 
                'action'=>'login','class' => 'form-signin form-horizontal'));
         ?>
         

<!--        <form class="form-signin form-horizontal" action="login">-->
        <div class="top-bar">
          <h3><i class="icon-leaf"></i> Avocado<b>Panel</b></h3>
        </div>
        <div class="well no-padding">

          <div class="control-group">
            <label class="control-label" for="inputName"><i class="icon-user"></i></label>
            <div class="controls">
              <input type="text" id="inputName" placeholder="Username" name="data[User][email]">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputUsername"><i class="icon-key"></i></label>
            <div class="controls">
              <input type="password" id="inputUsername" placeholder="Password" name="data[User][password]">
            </div>
          </div>

        <div class="padding">
          <button class="btn btn-primary" type="submit">Sign in</button>
          <button class="btn" type="button">Forgot Password</button>
          </div>
        </div>
<?php echo $this->Form->end();?>
<!--      </form>-->

    </div> 