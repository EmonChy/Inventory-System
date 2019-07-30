$(document).ready(function(){  
  // fetch category from db and show in the page manage_categories.php  
  /*
  manageCategory();
  function manageCategory(){
       $.ajax({
          url:"includes/process.php",
       method:"POST",
         data:{manageCategory:1},
      success:function(data){
        $("#get_cat").html(data);
        $("#example").DataTable();
        }   
    })
  }*/
  /*
 // delete category   
 $("body").delegate( ".del_cat", "click", function(){
    var did = $(this).attr("did");
    $.ajax({
          url:"includes/process.php",
       method:"POST",
         data:{deleteCategory:1,id:did},
      success:function(data){
          if(data=="Category_Deleted"){
          //alert("data deleted successfully");
           manageCategory();
           }else{
               alert("Oops!! Not deleted");
           }           
        }   
    })
  })
     */
  
  // fetch brand from db and show in the page manage_brands.php  
  /*
  manageBrand();
  function manageBrand(){
       $.ajax({
          url:"includes/process.php",
       method:"POST",
         data:{manageBrand:1},
      success:function(data){
        $("#get_brand").html(data);
        $('#example').DataTable();
        }   
    })
  }
    */
   
    // fetch category records
    fetch_category();
    function fetch_category(){
        $.ajax({
            url : "includes/process.php",
         method : "POST",
           data : {getCategory:1},
         success: function(data){
             var choose = "<option value=''>Choose Category</option>";
             $("#select_cat").html(choose+data);
         }
        })
    }
     // fetch brand records
    fetch_brand();
    function fetch_brand(){
        $.ajax({
            url : "includes/process.php",
         method : "POST",
           data : {getBrand:1},
         success: function(data){
             var choose = "<option value=''>Choose Brand</option>";
             $("#select_brand").html(choose+data);
         }
        })
    }
    
    
    
 // category record fetch from db and send to modal   
 $("body").delegate( ".edit_cat", "click", function(){
    var eid = $(this).attr("eid");
    $.ajax({
          url:"includes/process.php",
       method:"POST",
     dataType:"json",
         data:{updateCategory:1,id:eid},
      success:function(data){
        console.log(data);
        $("#catId").val(data["catId"]);
        $("#updt_cat").val(data["category_name"]);         
        }   
    })
  })
  // update category section
  $("#update_cat_form").on("submit",function(){
      var cat = $("#updt_cat");
      var c_patt = new RegExp(/^[a-zA-Z- ]+$/);
      if(cat.val()==""){
          cat.addClass("border-danger");
          $("#catupdt_error").html("<span class='text-danger'>Please Enter category Name</span>");
         
      }else if(!c_patt.test(cat.val())){
          cat.addClass("border-danger");
          $("#catupdt_error").html("<span class='text-danger'>Only letters and whitespace allowed</span>");

      }else{
            $.ajax({
            url : "includes/process.php",
         method : "POST",
           data : $("#update_cat_form").serialize(),
        success : function(data){
            if(data=="updated")
            window.location.href="";
          }
                                          
        })
      }
  })
  
 // brand record fetch from db and send to modal   
 $("body").delegate( ".edit_br", "click", function(){
    var eid = $(this).attr("eid");
    $.ajax({
          url:"includes/process.php",
       method:"POST",
     dataType:"json",
         data:{updateBrand:1,id:eid},
      success:function(data){
        console.log(data);
        $("#brId").val(data["bId"]);
        $("#updt_br").val(data["brand_name"]);         
        }   
    })
  })
  
  // update brand section
  
    $("#update_br_form").on("submit",function(){
      var br = $("#updt_br");
      var br_patt = new RegExp(/^[a-zA-Z ]+$/);
      if(br.val()==""){
          br.addClass("border-danger");
          $("#catupdt_error").html("<span class='text-danger'>Please Enter Brand Name</span>");
         
      }else if(!br_patt.test(br.val())){
          br.addClass("border-danger");
          $("#brupdt_error").html("<span class='text-danger'>Only letters and whitespace allowed</span>");

      }else{
            $.ajax({
            url : "includes/process.php",
         method : "POST",
           data : $("#update_br_form").serialize(),
        success : function(data){
            if(data=="updated")
            window.location.href="";
          }
                                          
        })
      }
  })
  
   // product record fetch from db and send to modal   
 $("body").delegate( ".edit_pr", "click", function(){
    var eid = $(this).attr("eid");
    $.ajax({
          url:"includes/process.php",
       method:"POST",
     dataType:"json",
         data:{updateProduct:1,id:eid},
      success:function(data){
        console.log(data);
        $("#prId").val(data["pId"]);
        $("#added_date").val(data["date"]);
        $("#updt_pr").val(data["product_name"]);         
        $("#select_cat").val(data["cId"]);         
        $("#select_brand").val(data["bId"]);         
        $("#product_price").val(data["product_price"]);         
        $("#product_qty").val(data["product_stock"]);         
        }   
    })
  })
  // update product form
  $("#update_prd_form").on("submit",function(){
        $.ajax({
            url : "includes/process.php",
         method : "POST",
           data : $("#update_prd_form").serialize(),
        success : function(data){
            if(data=="Product_Updated"){
                //alert(data);
            window.location.href="";                          
           }           
        }                 
        })  
    })
  
  
})

