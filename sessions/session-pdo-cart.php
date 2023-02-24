<?php
if(!isset($_SESSION)){   session_start();    }

$total=0;
echo session_id()."<br><br";
print_r($_SESSION);

foreach ($_SESSION as $i){
    echo $i."<br><br>";
}


echo "<br><br>";

foreach ( $_SESSION['cart'] as $ino ) {
    ?>
<tr>
    <td>

        <?php echo $_SESSION['cart'][$ino]; ?>
    </td>
    <td>
         <?php  //echo  number_format((float)$items[$ino]['price'], 2, '.', ''); ?>
    </td>
    <td>
        Quantity: <?php echo "";?>        
    </td>
    <td>
        <button type='submit' name='delete' value='<?php echo $ino;?>'>Delete</button>
    </td>
</tr>
<?php
   // $total += number_format((float)$items[$ino]['price'], 2, '.', '');
} // end foreach
?>

Total: $<?php echo $total; ?>
    <tr>
        <td colspan="2">Total: $<?php echo($total); ?></td>
        
    </tr>
</table>



?>
