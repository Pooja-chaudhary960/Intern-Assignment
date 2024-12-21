 <!--Given array is [8,7,2,5,3,1] and target sum is 10, find the pair of elements that add up to the target sum and 
  Given array is [5,2,6,8,1,9] and target sum is 12, check if the pair matches the sum and if not print No pairs found
  -->

<?php
function findAllPairs($nums, $target) {
    $found = false; // Flag to track if any pair is found

    for ($i = 0; $i < count($nums); $i++) {
        for ($j = $i + 1; $j < count($nums); $j++) {
            if ($nums[$i] + $nums[$j] == $target) {
                echo "Pair found ($nums[$i], $nums[$j])<br>";
                $found = true;
            }
        }
    }

    if (!$found) {
        echo "Pair not found<br>";
    }
}

$nums1 = [8, 7, 2, 5, 3, 1];
$target1 = 10;
echo "Input: nums = [" . implode(", ", $nums1) . "]<br>";
echo "Target = $target1<br>";
findAllPairs($nums1, $target1);
echo "--------------------------<br>";

$nums2 = [5, 2, 6, 8, 1, 9];
$target2 = 20;
echo "Input: nums = [" . implode(", ", $nums2) . "]<br>";
echo "Target = $target2<br>";
findAllPairs($nums2, $target2);
?>
