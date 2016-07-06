<?php
echo '<div id="navbar">
        <div><a href="index.php">Home</a></div>
        <div><a href="products.php">Products</a></div>
        <div><a href="customers.php">Customers</a></div>
        <div><a href="orders.php">Orders</a></div>
    </div>
    
    //code from: http://stackoverflow.com/questions/22877458/ho-to-make-current-menu-active-on-query-page
    <script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
    <script>
    $(function(){
      $("a").each(function() {
        if ($(this).prop("href") == window.location.href) {
          $(this).addClass("current");
        }
      });
    });
    </script>';
?>