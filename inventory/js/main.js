 $(document).ready(function(){
    //var DOMAIN = "http://localhost/inventory/";
    $("#register_form").on("submit",function(){
        var status=false;
        var name  = $("#uName");
        var email = $("#uEmail");
        var pass1 = $("#password1");
        var pass2 = $("#password2");
        var type  = $("#uType");
      
        var e_patt = new RegExp(/^[A-Za_z0-9_-]+(\.[A-Za-z0-9_-]*@[a_z0-9_-]+(\.[a-z0-9_-]+)*(\.[a-z]{2,4})$/);
        
        if(name.val()=="" || name.val().length<4){
            name.addClass("border-danger");
            $("#u_error").html("<span class='text-danger'>Please Enter Name and Name should be more than 4 char</span>");
            status = false;
        }else{
            name.removeClass("border-danger");
            $("#u_error").html("");
            status = true;
        }    
    })
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
    
    
    // category add section
    $("#cat_form").on("submit",function(){
      var cat = $("#category_name");
      var c_patt = new RegExp(/^[a-zA-Z ]+$/);
      if(cat.val()==""){
          cat.addClass("border-danger");
          $("#cat_error").html("<span class='text-danger'>Please Enter category Name</span>");
      }else if(!c_patt.test(cat.val())){
          cat.addClass("border-danger");
          $("#cat_error").html("<span class='text-danger'>Only letters and whitespace allowed</span>");
      }else{
        $.ajax({
            url : "includes/process.php",
         method : "POST",
           data : $("#cat_form").serialize(),
        success : function(data){
            if(data=="Category_Added"){
            cat.removeClass("border-danger");
            $("#cat_error").html("<span class='text-success'>New Category Added Successfully</span>");
            cat.val("");
            fetch_category();// this is used in product page
            }else if(data=="Category_Exist"){
            cat.removeClass("border-danger");
            $("#cat_error").html("<span class='text-danger'>Already Same Category Exist</span>");
            cat.val("");    
            }
            else{
                 alert(data);   
            }
        }
                 
        })   
      }  
    })
    // brand section
    $("#brand_form").on("submit",function(){
      var brand = $("#brand_name");
      //var cat = $("#select_cat");
      var b_patt = new RegExp(/^[a-zA-Z ]+$/);
      if(brand.val()==""){
          brand.addClass("border-danger");
          $("#brand_error").html("<span class='text-danger'>Please Enter brand Name</span>");
      }
      else if(!b_patt.test(brand.val())){
          brand.addClass("border-danger");
          $("#brand_error").html("<span class='text-danger'>Only letters and whitespace allowed</span>");
      }else{
        $.ajax({
            url : "includes/process.php",
         method : "POST",
           data : $("#brand_form").serialize(),
        success : function(data){
            if(data=="Brand_Added"){
            brand.removeClass("border-danger");
            $("#brand_error").html("<span class='text-success'>New Brand Added Successfully</span>");
            brand.val("");
            //cat.val("");

            fetch_brand(); // this is used in product page
            }else if(data=="Brand_Exist"){
            brand.removeClass("border-danger");
            $("#brand_error").html("<span class='text-danger'>Already Same Brand Exist</span>");
            brand.val("");
            cat.val("");

            //$("#select_cat").val("");

            }
            else{
                 alert(data);   
            }
        }
                 
        })   
      }  
    })
    
    // product add
    $("#product_form").on("submit",function(){
        $.ajax({
            url : "includes/process.php",
         method : "POST",
           data : $("#product_form").serialize(),
        success : function(data){
            if(data=="Product_Added"){
              alert("Product Added Successfully");
              $("#product_name").val("");
              $("#select_cat").val("");
              $("#select_brand").val("");
              $("#product_price").val("");
              $("#product_qty").val("");
              
            }else if(data=="Product_Exist"){
            $("#pd_error").html("<span class='text-danger'>Already Same Product Exist,Try Another</span>");
              $("#product_name").val("");
              $("#select_cat").val("");
              $("#select_brand").val("");
              $("#product_price").val("");
              $("#product_qty").val("");
            }
            else{
                 alert(data);   
            }
        }
                 
        })  
    })
})


