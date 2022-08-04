<?php
//if (!isset($_SESSION)) { session_start(); }

require '../Model/test.php';
require '../Model/Tag.php';
$hikes = new HikeManager();
$hikesInfo = $hikes->getHikes();
$tags = new Tag();
$tag = $tags->getTag();

$title = 'Homepage';
require_once '../view/head.php';
?>

<body>
  <?php require_once '../view/header.php' ?>

  <button type="button" class="collapsible">Filter by tags</button>

  <div id="myBtnContainer" class="content" style="display:none"
  >
    <button class="btn active" onclick="filterSelection('all')"> Show all</button>
    <?php foreach ($tag as $key => $btnvalue) : ?>
      <button class="btn" onclick="filterSelection('<?=$btnvalue['tag_name']?>')"> <?=$btnvalue['tag_name']?></button>
    <?php endforeach ?>
  </div>
  

  <section id="allHikes" class="container">
      <?php foreach ($hikesInfo as $key => $hvalue) : ?>
        <?php
          $hike_id = $hvalue['hike_id'];
          $tag = new Tag();
          $tagInfo = $tag->linkTag($hike_id);
        ?>

        <?php 
        $tagClass = "";
        foreach ( $tagInfo as $key => $value){
          $tag = new Tag();
          $tagName = $tag->getTagById($value['tag_id']);
          $tagClass = $tagClass ." " .$tagName['tag_name'];
          }
        ?>

      <div class="hike <?=$tagClass?>">

        <a href="/hike?hikeID=<?php echo $hvalue['hike_id'] ?>">

          <h3><?= $hvalue['hike_name'] ?></h3>

          <div>
            
            <img src="<?= $hvalue["image_path"]?>" alt="Photo: <?= $hvalue['hike_name'] ?>" style="width:30%";>
            <p>Date mise à jour: <?= $hvalue['update_date'] ?></p>
            <p>Temps: <?= $hvalue['duration'] ?></p>
            <p>Distance: <?= $hvalue['distance'] ?>km</p>
            <p>Tags:</p>
            <ol>
              <?php foreach ( $tagInfo as $key => $value):  ?>
                <?php
                $tag = new Tag();
                $tagName = $tag->getTagById($value['tag_id'])
                ?>
                <li><p><?= $tagName['tag_name']?> </p></li>
              <?php endforeach ?>
            </ol>
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
        td = tr[i].getElementsByTagName("h3")[0]; //td
        if (td) {
          txtValue = td.textContent || td.innerText;

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

<script>
    filterSelection("all")
    function filterSelection(c) {
      var x, i;
      x = document.getElementsByClassName("hike");
      if (c == "all") c = "";
      // Add the "show" class (display:block) to the filtered elements, and remove the "show" class from the elements that are not selected
      for (i = 0; i < x.length; i++) {
        w3RemoveClass(x[i], "show");
        if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
      }
    }

    // Show filtered elements
    function w3AddClass(element, name) {
      var i, arr1, arr2;
      arr1 = element.className.split(" ");
      arr2 = name.split(" ");
      for (i = 0; i < arr2.length; i++) {
        if (arr1.indexOf(arr2[i]) == -1) {
          element.className += " " + arr2[i];
        }
      }
    }

    // Hide elements that are not selected
    function w3RemoveClass(element, name) {
      var i, arr1, arr2;
      arr1 = element.className.split(" ");
      arr2 = name.split(" ");
      for (i = 0; i < arr2.length; i++) {
        while (arr1.indexOf(arr2[i]) > -1) {
          arr1.splice(arr1.indexOf(arr2[i]), 1);
        }
      }
      element.className = arr1.join(" ");
    }

    // Add active class to the current control button (highlight it)
    var btnContainer = document.getElementById("myBtnContainer");
    var btns = btnContainer.getElementsByClassName("btn");
    for (var i = 0; i < btns.length; i++) {
      btns[i].addEventListener("click", function() {
        var current = document.getElementsByClassName("active");
        current[0].className = current[0].className.replace(" active", "");
        this.className += " active";
      });
    }
  </script>
  
  <script>
    var coll = document.getElementsByClassName("collapsible");
    var i;

    for (i = 0; i < coll.length; i++) {
      coll[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var content = this.nextElementSibling;
        if (content.style.display === "block") {
          content.style.display = "none";
        } else {
          content.style.display = "block";
        }
      });
    }
  </script>

  <style>
    .container {
  overflow: hidden;
}

.hike {
/*   float: left;
  background-color: #2196F3;
  color: #ffffff;
  width: 100px;
  line-height: 100px;
  text-align: center;
  margin: 2px; */
  display: none; /* Hidden by default */
}

/* The "show" class is added to the filtered elements */
.show {
  display: block;
}

/* Style the buttons */
.btn {
  border: none;
  outline: none;
  padding: 12px 16px;
  margin-bottom: 6px;
  background-color: #f1f1f1;
  cursor: pointer;
}

/* Add a light grey background on mouse-over */
.btn:hover {
  background-color: #ddd;
}

/* Add a dark background to the active button */
.btn.active {
  background-color: #666;
  color: white;
}
  </style>

  <?php require_once '../view/footer.php'; ?>

</body>

</html>