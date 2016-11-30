<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="navbar navbar-default"">
      <ul class="nav navbar-nav">
        <li>
          <a href="<?php makeLink('') ?>">Home</a>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" 
             role="button" aria-haspopup="true" aria-expanded="false">
             Cursillo Management <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="<?php makeLink('cursillo/add.php') ?>">Create a New Weekend</a></li>
            <li><a href="<?php makeLink('cursillo/list.php') ?>">Weekend List</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="<?php makeLink('cursillo/registered.php') ?>">
              List Candidate Registrations
            </a></li>
            <li><a href="<?php makeLink('cursillo/registration.php') ?>">
              Register a Candidate
            </a></li>
            <li role="separator" class="divider"></li>
            <li><a href="<?php makeLink('parish/list.php') ?>">Parish List</a></li>
            <li><a href="<?php makeLink('parish/add.php') ?>">Create Parish</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" 
             role="button" aria-haspopup="true" aria-expanded="false">
             Individual Management <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="<?php makeLink('individual/add.php') ?>">Create Candidate</a></li>
            <li><a href="<?php makeLink('individual/list.php') ?>">Cursillistas</a></li>
            <li><a href="#"></a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" 
             role="button" aria-haspopup="true" aria-expanded="false">
             Team Management <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="<?php makeLink('role/add.php') ?>">Create Role</a></li>
            <li><a href="<?php makeLink('role/list.php') ?>">Role List</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="<?php makeLink('team/history.php') ?>">Team History</a></li>
            <li><a href="<?php makeLink('team/list.php') ?>">Team Members</a></li>
            <li><a href="<?php makeLink('team/build.php') ?>">Build a Team</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="<?php makeLink('talk/list.php') ?>">Talk Topics</a></li>
            <li><a href="<?php makeLink('talk/add.php') ?>">Create a Topic</a></li>
            <li><a href="<?php makeLink('talk/build.php') ?>">Assign Talks</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>