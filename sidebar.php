<?php 
?>
<aside class="main-sidebar bg-navy">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
        <?php if(isset($_SESSION['profile'])){
                 ?>
                  <img src="<?php echo $_SESSION['profile']; ?>" class="img-circle" alt="User Image">
                 <?php
               }else{ ?>
                <img src="images/avatar04.png" class="img-circle" alt="User Image">
                <?php
                }
                ?>
        </div>
   
        <div class="pull-left info">
          <p><?php echo $user; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li>
          <a href="account.php">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <?php if(isset($_SESSION['role'])){
          if($_SESSION['role'] == 'Analyst')
          { ?>
          <li>
          <a href="sources.php?report_id=<?php echo $report_id;?>">
            <i class="fa fa-walking"></i> <span>Information Gather</span>
          </a>
        </li>
        <li>
          <a href="search.php?report_id=<?php echo $report_id;?>">
            <i class="fa fa-search"></i> <span>Search</span>
          </a>
        </li>
        <li>
          <a href="toc.php?report_id=<?php echo $report_id;?>">
            <i class="fa fa-list"></i> <span>TOC</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Classification</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="classified.php?click=y&report_id=<?php echo $report_id;?>"><i class="fa fa-circle-o"></i> Classified</a></li>
            <li><a href="unclassified.php?click=y&report_id=<?php echo $report_id;?>"><i class="fa fa-circle-o"></i> Unclassified</a></li>
          </ul>
        </li>
        <li>
          <a href="query.php?report_id=<?php echo $report_id;?>">
            <i class="fa fa-paste"></i> <span>Build Reports</span>
          </a>
        </li>
        <li>
          <a href="add_charts.php?report_id=<?php echo $report_id;?>">
            <i class="fa fa-pie-chart"></i> <span>Add Charts</span>
          </a>
        </li>
        <li>
          <a href="built_report.php?report_id=<?php echo $report_id;?>">
            <i class="fa fa-file"></i> <span>Generated Report</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-upload"></i> <span>Uploads</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
        <li>
          <a href="template_upload.php?report_id=<?php echo $report_id;?>">
            <i class="fa fa-upload"></i> <span>Upload template</span>
          </a>
        </li>
        <li>
          <a href="local_resource.php?report_id=<?php echo $report_id;?>">
            <i class="fa fa-desktop"></i> <span>Add Local Resource</span>
          </a>
          </ul>
        </li>
        <?php }
        }
        ?>
        </ul>
    </section>
    <!-- /.sidebar -->
  </aside>