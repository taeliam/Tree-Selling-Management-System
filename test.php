
<?php
   function in_array_multi($needle, $haystack) {
      foreach ($haystack as $item) {
          if ($item === $needle || (is_array($item) & in_array_multi($needle, $item))) {
              return true;
          }
      }
   
      return false;
  }
   
  $myArray = array(array(10,20),array(11,22),array(111,222));
   
  var_dump($myArray);
   
  if (in_array(11, $myArray)) {
      echo "11 was found";
  }
   
  if (in_array_multi(11, $myArray)) {
      echo "11 was found with multi";
  }
?>