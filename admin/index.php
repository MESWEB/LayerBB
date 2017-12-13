<?php

define('BASEPATH', 'Staff');
require_once('../applications/wrapper.php');

if (!$LAYER->perm->check('access_administration')) {
    redirect(SITE_URL);
}//Checks if user has permission to create a thread.
//require_once('template/top.php');
echo $ADMIN->template('top');

echo '<div class="col-md-12">
        <div class="page-header">
          <h1>Administration Panel</h1>
        </div>
      </div></div>';

$versions = @file_get_contents('http://layerbb.com/version_list.php');
if ($versions != '') {
    $versionList = explode("|", $versions);
    foreach ($versionList as $version) {
        if (version_compare(LayerBB_VERSION, $version, '<')) {
            $alert = $ADMIN->alert('<p>New version found: ' . $version . '<br /><a href="https://github.com/InfernoGroupUK/LayerBB/releases" target="_blank">&raquo; Download Now?</a></p>', 'warning');
        }
    }
}

if ($LAYER->data['site_enable'] == 0) {
    echo "<div class='alert alert-danger' role='alert'>
  <b>Forum Offline:</b> Your forum has been disabled, this can be changed by going to the <a href='general.php'>general settings</a>.
</div>";
}

if (file_exists('../install')) {
    echo "<div class='alert alert-danger' role='alert'>
  <b>Security Alert:</b> You have not deleted the install directory, this could potentially impact the security of your forum. Please remove the install directory!
</div>";
}
if (file_exists('../update.php')) {
    echo "<div class='alert alert-danger' role='alert'>
  <b>Security Alert:</b> You have not deleted the update.php file, this could potentially impact the security of your forum. Please remove the update.php file!
</div>";
}

echo $ADMIN->box(
    'Dashboard',
    'This forum is powered by LayerBB <strong>' . LayerBB_VERSION . '</strong>.' . @$alert,
    '<table class="table">
         <thead>
           <tr>
             <th>Forum Statistic</th>
              <th>Value</th>
            </tr>
         </thead>
         <tbody>
           <tr>
             <td>Threads</td>
             <td>' . stat_threads() . '</td>
           </tr>
          <tr>
             <td>Posts</td>
             <td>' . stat_posts() . '</td>
           </tr>
           <tr>
             <td>Users</td>
             <td>' . stat_users() . '</td>
           </tr>
        </tbody>
       </table>'
);

echo $ADMIN->box(
    'Github and Updates',
    'Get LayerBB on Github <a href="https://github.com/InfernoGroupUK/LayerBB">here</a>.<br />
       To keep up with the updates on LayerBB, you can watch the LayerBB Github repository or visit our website at <a href="https://www.layerbb.com">LayerBB.com</a> regularly!'
);

//require_once('template/bot.php');
echo $ADMIN->template('bot');

?>
