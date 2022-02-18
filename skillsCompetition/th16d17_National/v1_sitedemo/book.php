<div class="card bg-light">
  <div class="card-header">
    <nav class="navbar-expand">
      <div class="navbar-nav">
        <?php
        $stepzone = (!empty($_GET['step'])) ? $_GET['step'] : 1;
        foreach ($steps as $key => $value) {
          echo '<a class="nav-link ' . ($stepzone == ($key + 1) ? "active" : "disabled") . '" href="?do=book&step=' . ($key + 1) . '">' . $value . '</a>';
          if ($stepzone == ($key + 1)) break;
          if (!empty($steps[$key + 1])) echo '<span class="nav-link"> > </span>';
        }
        ?>
      </div>
    </nav>
  </div>
  <form action="api.php?do=bookadd<?= $stepzone ?>" method="post">
    <div class="card-body row">
      <?php include_once("book_step" . $stepzone . ".php") ?>
    </div>
  </form>
</div>