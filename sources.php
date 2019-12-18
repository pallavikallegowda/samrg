<?php session_start(); 
    if(isset($_SESSION['user_id'])){
    include('header.php');
    $report_id=$_GET['report_id'];
    include('sidebar.php');
    include("automation_db_connect.php");
?>
<div class="content-wrapper">
  <section class="content-header">
          <?php
              include("automation_db_connect.php");
              $sql='select * from report where report_id='.$report_id.';';
              $result = $conn->query($sql);
              if (!$result) {
                  echo "DB Error, could not list tables\n";
                  echo 'MySQL Error: ' . mysqli_error($conn);
              }
              while ($row = $result->fetch_assoc()) {
                  echo "<h3>".$row['title']."</h3>";
              }
              $conn->close();
          ?>
  </section>
<section class="content">
  <div class="row">
    <div class="col-lg-5">
      <form action="source_action.php" class="mx-auto" method="POST">
        <div class="form-group container-fluid ml-2">
          <table class="table table-borderless">
            <input type="hidden" value="<?php echo $report_id ?>" name="report_id">
              <tr>
                <td colspan="3"><label for="sources">Sources:</label></td>
              </tr>
              <tr>
                <td colspan="3">
                <textarea class="form-control mb-3" rows='5' cols='100' id="sources" name='sources'></textarea>
                </td>
              </tr>
          </table>
          <div class="container-fluid">
            <button type="submit" name="crawl" class="btn btn-primary">Crawl</button>
          </div>
        </div>
      </form>
    </div>
    <div class="col-lg-7">
      <?php
        chdir("Reports/Report ".$report_id);
        if(file_exists("all_sources.txt")){
      ?>
      <h3 class="text-center">You have already gathered information from following URLS:</h3>
      <ul class="list-group list-group-flush">
        <?php
          $fn = fopen("all_sources.txt","r");
          while(! feof($fn)){
            $sources = fgets($fn);
            if($sources == " " || $sources == null){
              continue;
            }
        ?>
        <li class="list-group-item"><a href="<?php echo $sources ; ?>" target="_blank"><?php echo $sources ; ?></a></li>
        <?php 
          } 
          fclose($fn);
          chdir("../..");
        ?>
      </ul>
      <?php
        }
      ?>
    </div>
  </div>
</section>
</div>
<?php 
include "footer.php"; }
else {
include('session_expired.php');
}
?>
