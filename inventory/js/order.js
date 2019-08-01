$(document).ready(function(){
    // function call
    addNewRow();
    // action for add
    $("#add").click(function(){
        addNewRow();
    })
    function addNewRow(){
    $.ajax({
        url:"includes/process.php",
     method:"POST",
      data : {getNewOrderForm:1},
    success: function(data){
        $("#invoice_item").append(data);
        // this is used to increment the serial number
        var n=0;
        $(".number").each(function(){
            $(this).html(++n);   
          })
        }        
     })
   }
   // action for remove 
   $("#remove").click(function(){
       $("#invoice_item").children("tr:last").remove();
       calculate(0,0); // when user click, all the calculations will be decrease  
   })
   // when user adding products,input fields will get value by their respective products
   $("#invoice_item").delegate(".pId","change",function(){
       var pId = $(this).val();
       var tr  = $(this).parent().parent();
       $.ajax({
           url:"includes/process.php",
        method:"POST",
      dataType:"json",
          data:{getPriceAndQty:1,id:pId},
       success:function(data){
            tr.find(".tqty").val(data["product_stock"]);
            tr.find(".pro_name").val(data["product_name"]);
            tr.find(".qty").val(1);
            tr.find(".price").val(data["product_price"]);
            tr.find(".amt").html(tr.find(".qty").val()*tr.find(".price").val());
            calculate(0,0); // function call
          }  
       })       
   })
   // when user update the quantity,then this section will work
   $("#invoice_item").delegate(".qty","keyup",function(){
       var qty = $(this);
       var tr  = $(this).parent().parent();
       if(isNaN(qty.val())){
           alert("Please enter a valid quantity");
           qty.val(1);
       }else{
           if((qty.val()-0)>(tr.find(".tqty").val()-0)){
               alert("Sorry!This much of quantity not available");
               // then set quantity 1 and set base price
               qty.val(1);
               tr.find(".amt").html(tr.find(".qty").val()*tr.find(".price").val());
               calculate(0,0);// function call
           }else{
               // updated price, when updt the quantity
               tr.find(".amt").html(qty.val()*tr.find(".price").val());
               calculate(0,0);// function call
           }
       }
 
   })
   
   // calculation process of products
   
   function calculate(dis,paid){
       var sub_total = 0; 
       var gst = 0;
       var net_total = 0;
       var discount = dis;
       var paid_amount = paid;
       var due = 0;
       $(".amt").each(function(){
           sub_total = sub_total+($(this).html()*1); // for total amount and html is used   
       })                                            // bcz it is not a input field and 1 multiply bcz 
                                                     // sometimes it takes input as a string
       gst = 0.18 * sub_total;         // calculate gst
       net_total = gst + sub_total;    // total amount
       net_total = net_total-discount; // subtract discount from total
       
       due = net_total-paid_amount;   // due amount
       
       $("#sub_total").val(sub_total); // value stored in the field
       $("#gst").val(gst);
       $("#discount").val(discount);
       
       // if net amount is less than zero
       if(net_total<0){
           alert("Sorry! not possible this amount of discount");
           $("#discount").val(0);        // field will be zero
           net_total = gst + sub_total;  // net total will be same         
           $("#net_total").val(net_total);
           due = net_total-paid_amount;  // due will be same as net total 
           $("#due").val(due);           
           }else{
            $("#net_total").val(net_total); // add total in the field
        }
       // if paid amount is more than total amount
       if(paid_amount>net_total){
           alert("Sorry! not possible this amount of paid");
           $("#paid").val(0);          // field will be zero
           $("#due").val(net_total);   //  net total
           
       }else{
         $("#due").val(due); 
       }
   }
   $("#discount").keyup(function(){
       var discount = $(this).val(); // get the value
       calculate(discount,0); // call the function and passes parameter discount and paid
   })
   
   $("#paid").keyup(function(){
       var paid = $(this).val(); // get the value 
       var discount = $("#discount").val(); // get the value
       calculate(discount,paid); // call the function and passes parameter discount and paid
   })
   
   
   
   //----Order info saved into db--------
   
   $("#order_form").click(function(){
       var invoice = $("#get_ordered_data").serialize();
       
           $.ajax({
           url: "includes/process.php",
        method: "POST",
          data: $("#get_ordered_data").serialize(),
      success:function(data){
            if(data>0){
                //alert("Completed");
                $("#get_ordered_data").trigger("reset");
                //window.location.href="";
                if(confirm("Do you want to print invoice?")){
                 window.location.href="includes/invoice_bill.php?invoice_no="+data+"&"+invoice;  
                }
            }else if(data=="missing"){
               alert("Please! Fill all the records");
            }else if(data=="not_avail"){
               alert("Currently product is not available in stock");
            }            
         }
       })
     
   })   
})