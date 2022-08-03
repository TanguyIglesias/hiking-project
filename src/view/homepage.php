<?php
if (!isset($_SESSION)) { session_start(); }
require '../Model/test.php';
$hikes = new HikeManager();
$hikesInfo = $hikes->getHikes();
$title = 'Homepage';
require_once '../view/head.php';
?>

<body>
  <?php require_once '../view/header.php' ?>

  <input type="text" id="searchInput" onkeyup="searchFunction()" placeholder="Search...">


  <section id="allHikes">
      <?php foreach ($hikesInfo as $key => $value) : ?>
      <div class="hike">

        <h3><?= $value['hike_name'] ?></h3>

        <a href="/hike?hikeID=<?php echo $value['hike_id'] ?>">
          <div>
            
            <img src="<?= $value["image_path"]?>" alt="Photo: <?= $value['hike_name'] ?>" style="width:30%";>
            <p>Date mise à jour: <?= $value['update_date'] ?></p>
            <p>Temps: <?= $value['duration'] ?></p>
            <p>Distance: <?= $value['distance'] ?>km</p>
          </div>
        </a>
      
      </div>
    <?php endforeach ?>
  </section>

  <script>
            function searchFunction() {
                    // Declare variables
                    var input, filter, table, tr, td, i, txtValue;
                    input = document.getElementById("searchInput");
                    filter = input.value.toUpperCase();
                    table = document.getElementById("allHikes");
                    //tr = table.getElementsByTagName("div"); //tr
                    tr = document.getElementsByClassName("hike");

                    // Loop through all table rows, and hide those who don't match the search query
                    for (i = 0; i < tr.length; i++) {
                        td = tr[i].getElementsByTagName("h3"); //td
                        console.log(td.innerHTML);
                        
                        if (td) {
                            txtValue = td.textContent || td.innerText;
                            console.log(td.textContent);

                            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                tr[i].style.display = "";
                            } 
                            else {
                                tr[i].style.display = "none";
                            }
                        }
                    }
            }
        </script>

  <?php require_once '../view/footer.php'; ?>

</body>

</html>