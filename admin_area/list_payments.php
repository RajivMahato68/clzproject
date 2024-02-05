<h3 class="text-center text-success">All Payments</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-info text-center">


    <?php
$get_payments="select * from `user_payment`";
$result=mysqli_query($con,$get_payments);
$row_count=mysqli_num_rows($result);
echo "<tr>
<th>S.N</th>
<th>Invoice Number</th>
<th>Amount</th>
<th>Payments Mode</th>
<th>Order Date</th>
<th>Delete</th>
</tr>
</thead>
<tbody class='bg-secondary text-light'>";

if($row_count==0){
    echo "<h2 class='bg-danger text-center mt-5'>No Payment received Yet</h2>";
}else{
    $number=0;
    while($row_data=mysqli_fetch_assoc($result)){
        $order_id=$row_data['order_id'];
        $payment_id=$row_data['payment_id'];
        $amount=$row_data['amount'];
        $invoice_number=$row_data['invoice_number'];
        $payment_mode=$row_data['payment_mode'];
        $date=$row_data['date'];
        $number++;
        echo "<tr>
        <td>$number</td>
        <td>$invoice_number</td>
        <td>$amount</td>
        <td>$payment_mode</td>
        <td>$date</td>
        <td><a href='index.php?delete_payments=$order_id'<i class='fa-solid fa-trash'></i></a></td> 
    </tr>";
    }
}

?>
        
        
    </tbody>
</table>