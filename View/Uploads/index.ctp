<div class="container">
  <div class="row">
    <div class="col-md-12">
      <blockquote>
        <h1 style="font-size:22px;"><?= $Lang->get("Uploads"); ?></h1>
      </blockquote>

      <div class="row">

        <table class="table table-striped">
          <thead>
            <tr>
              <th><?= $Lang->get("TABLE_HEAD_LEVEL"); ?></th>
              <th><?= $Lang->get("TABLE_HEAD_DATE"); ?></th>
              <th><?= $Lang->get("TABLE_HEAD_AUTHOR"); ?></th>
              <th><?= $Lang->get("TABLE_HEAD_COMMENT"); ?></th>
            </tr>
          </thead>

          <tbody>
            <?php foreach($uploads as $upload){ ?>
            <tr>
              <td class="col-md-1" style="font-size:18px;">

              <?php
              $level = $upload['Uploads']['level'];
              if($level == 1){
                echo '<span class="label label-info" style="padding:8px;"><i class="fa fa-picture-o"></i> IMAGE</span>';
              }else if($level == 2){
                echo '<span class="label label-warning" style="padding:8px;"><i class=" fa fa-file"></i> FICHIER</span>';
              }else if($level == 3){
                echo '<span class="label label-danger" style="padding:8px;"><i class="fa fa-file-archive-o"></i> ZIP</span>';
              }else{
                echo '<span class="label label-success" style="padding:8px;"><i class="fa fa-folder-open"></i> AUTRE</span>';
              }
              ?>

              </td>
              <td class="col-md-2"><?= date("d-m-Y H:i:s", strtotime($upload['Uploads']['created'])); ?></td>
              <td class="col-md-1"><?= $upload['Uploads']['author']; ?></td>
              <td class="col-md-9"><?= $upload['Uploads']['description']; ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>

        </div>
    </div>
  </div>
</div>
